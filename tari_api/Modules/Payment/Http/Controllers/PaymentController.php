<?php

namespace Modules\Payment\Http\Controllers;

use App\Models\User;
use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Payment\Entities\Payment;
use Modules\Plan\Entities\Subscription;
use Modules\Studio\Entities\CartClass;
use Modules\Studio\Entities\CartVideo;
use Modules\Studio\Entities\UserHasVideo;
use Modules\StudioOwners\Entities\UserHaveClass;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function summary()
    {
        try {
            $data = [
                "total" => 0,
                "paid" => 0,
                "waiting_transfer" => 0,
                "rejected" => 0,
                "new" => 0,
            ];

            $data["total"] = Payment::count();
            $data["paid"] = Payment::where("status", "paid")->count();
            $data["waiting_transfer"] = Payment::where('status', 'waiting_transfer')->count();
            $data["rejected"] = Payment::where('status', 'rejected')->count();
            $data["new"] = Payment::whereDate('created_at', now())->count();

            return Json::response($data);
        } catch (\Spatie\Permission\Exceptions\UnauthorizedException $e) {
            return Json::exception('Error UnauthorizedException ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        try {
            $master = Payment::entities($request->entities)
                ->summary($request->summary)
                ->orderBy('id', 'desc')
                ->get();

            return Json::response($master);
        } catch (\Spatie\Permission\Exceptions\UnauthorizedException $e) {
            return Json::exception('Error UnauthorizedException ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $check = $request->check;

            if ($check == 'ensiklo-live') {
                $cart = CartClass::findOrFail($request->cart_id);
                $cart->status = 'paid';
                $cart->save();
            }
            if ($check == 'ensiklo-video') {
                $cart = CartVideo::findOrFail($request->cart_id);
                $cart->status = 'paid';
                $cart->save();
            }
            $master = new Payment();
            $master->status = 'paid';
            $master->type = $request->type;
            $master->methods = $request->methods;
            $master->user_id = $request->user()->id;
            $master->class_id = $request->class_id;
            $master->video_id = $request->video_id;
            if ($check == 'ensiklo-live') {
                $master->cart_class_id = $cart->id;
                $user_has = new UserHaveClass();
                $user_has->status = 'waiting';
                $user_has->user_id = $request->user()->id;
                $user_has->class_id = $request->class_id;
                $user_has->form_id = $cart->form->id;
                $user_has->absent = 0;
                $user_has->save();
                $me = User::findOrFail($request->user()->id);
                $me->myClass()->attach($request->class_id);
            } else {
                $master->cart_video_id = $cart->id;
                $user_has = new UserHasVideo();
                $user_has->status = 'waiting';
                $user_has->type = $request->type;
                $user_has->user_id = $request->user()->id;
                $user_has->video_id = $request->video_id;
                $user_has->save();
            }
            $master->save();
            DB::commit();
            // $me = User::findOrFail($request->user()->id);
            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            DB::rollBack();
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function payLive(Request $request, $id)
    {
        try {

            $master = CartClass::findOrFail($id);
            if ($master->isPaid == 1) {
                return Json::exception('Already Paid');
            }
            $master->status = $request->input('status', 'waiting_payment');
            $master->isPaid = false;
            $master->bank_id = $request->bank_id;
            $master->save();

            return Json::response($master);
        } catch (\Spatie\Permission\Exceptions\UnauthorizedException $e) {
            return Json::exception('Error UnauthorizedException ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * @param int $cart_id
     * @return Renderable
     */

    public function payVideo(Request $request, $cart_id)
    {
        try {
            DB::beginTransaction();
            $cart = CartVideo::findOrFail($cart_id);

            $subscription = new Subscription();
            $subscription->type = $request->input("type", "ensiklovideo");
            $subscription->plan_id = $cart->form->plan_id;
            $subscription->user_id = $request->user()->id;
            $subscription->save();

            if ($cart->isPaid == 1) {
                return Json::exception('Already Paid');
            }
            $cart->status = $request->input("status", 'waiting_payment');
            $cart->type = $request->input('type', "ensiklovideo");
            $cart->isPaid = false;
            $cart->bank_id = $request->bank_id;
            $cart->subscription_id = $subscription->id;
            $cart->save();

            DB::commit();
            return Json::response($cart);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            DB::rollBack();
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    // public function verificationPaidLive(Request $request, $cart_id)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $check = $request->check;
    //         $cartClass = CartClass::findOrFail($cart_id);
    //         $cartClass->isPaid = $request->input("isPaid", $request->isPaid);
    //         $cartClass->save();
    //         $
    //         // make Payment Success
    //         $payment = new Payment();
    //         $payment->status = 'waiting_proof';
    //         $payment->type = $request->type_class;
    //         $payment->methods = "transfer";
    //         $payment->user_id = $request->user()->id;
    //         $payment->class_id = $request->class_id;
    //         $payment->cart_class_id = $cartClass->id;

    //         // user has class
    //         $user_has = new UserHaveClass();
    //         $user_has->status = 'waiting';
    //         $user_has->user_id = $request->user()->id;
    //         $user_has->class_id = $request->class_id;
    //         $user_has->form_id = $cartClass->form->id;
    //         $user_has->absent = 0;
    //         $user_has->save();
    //         $me = User::findOrFail($request->user()->id);
    //         $me->myClass()->attach($request->class_id);

    //         DB::commit();
    //         return Json::response($payment);
    //     } catch (\Illuminaste\Database\Eloquent\ModelNotFoundException $e) {
    //         DB::rollBack();
    //         return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         DB::rollBack();
    //         return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
    //     } catch (\ErrorException $e) {
    //         DB::rollBack();
    //         return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
    //     } catch (\Spatie\Permission\Exceptions\UnauthorizedException $e) {
    //         DB::rollBack();
    //         return Json::exception('Error UnauthorizedException ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
    //     }
    // }

    /**
     * Show the form for editing the specified resource.
     * @param int cart
     * @return Renderable
     */

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function sendProof(Request $request, $id)
    {
        try {
            $master = CartClass::findOrFail($id);
            $path = $request->img->store("images");
            $master->image_url = $path;
            $master->status = 'waiting_confirmation';
            $master->save();

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Spatie\Permission\Exceptions\UnauthorizedException $e) {
            return Json::exception('Error UnauthorizedException ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $cart_id
     * @return Renderable
     */

    public function sendProofVideo(Request $request, $cart_id)
    {
        try {
            $cart = CartVideo::findOrFail($cart_id);
            if ($cart->status != 'waiting_payment') return Json::exception("Cart is not waiting payment");
            $path = $request->img->store("images");
            $cart->image_url = $path;
            $cart->status = 'waiting_confirmation';
            $cart->save();

            return Json::response($cart);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Spatie\Permission\Exceptions\UnauthorizedException $e) {
            return Json::exception('Error UnauthorizedException ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function deletePayment(Request $request, $id)
    {
        try {
            $payment = Payment::findOrFail($id);
            if ($payment->status == 'rejected') {
                $payment->delete();
                return Json::response($payment);
            } else return Json::exception('Error Status');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Spatie\Permission\Exceptions\UnauthorizedException $e) {
            return Json::exception('Error UnauthorizedException ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * @param int $id
     * @return Renderable
     */

    public function transferToStudio(Request $request, $id)
    {
        try {
            $payment = Payment::findOrFail($id);
            if ($payment->status == 'waiting_transfer') {
                $path = $request->img->store("images");
                $payment->image_url = $path;
                $payment->status = 'paid';
                $payment->save();
                return Json::response($payment);
            } else return Json::exception('Error Status');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Spatie\Permission\Exceptions\UnauthorizedException $e) {
            return Json::exception('Error UnauthorizedException ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * @param int $id
     * @return Renderable
     */

    public function updatePayment(Request $request, $id)
    {
        try {
            $payment = Payment::findOrFail($id);
            if ($request->check === 'fill_bank') {
                $payment->to = $request->to;
                $payment->save();

                return Json::response($payment);
            } else return Json::exception('Error Status');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Spatie\Permission\Exceptions\UnauthorizedException $e) {
            return Json::exception('Error UnauthorizedException ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
}
