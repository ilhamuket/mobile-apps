<?php

namespace Modules\Administrator\Http\Controllers;

use App\Models\User;
use Brryfrmnn\Transformers\Json;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Administrator\Entities\CartClass;
use Modules\Payment\Entities\Payment;
use Modules\StudioOwners\Entities\FormRegister;
use Modules\StudioOwners\Entities\UserHaveClass;

class TransactionEnsikloLiveController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        try {
            $master = CartClass::entities($request->entities)
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
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function summary(Request $request)
    {
        try {
            $data = [
                "total" => 0,
                "paid" => 0,
                "pending" => 0,
                "cancelled" => 0,
                "waiting_confirmation" => 0,
                "waiting_payment" => 0,
                "waiting_proof" => 0,
            ];

            $data["total"] = CartClass::count();
            $data["paid"] = CartClass::where('status', 'paid')->where('isPaid', true)->count();
            $data["pending"] = CartClass::where('status', 'pending')->where('isPaid', false)->count();
            $data["cancelled"] = CartClass::where('status', 'cancelled')->count();
            $data["waiting_confirmation"] = CartClass::where('status', 'waiting_confirmation')->count();
            $data["waiting_payment"] = CartClass::where('status', 'waiting_payment')->count();
            $data["waiting_proof"] = CartClass::where('status', 'waiting_proof')->count();

            return Json::response($data);
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
    public function confirmationPaidEnsikloLive(Request $request, $cart_id)
    {
        try {
            DB::beginTransaction();
            $cartClass = CartClass::findOrFail($cart_id);
            $cartClass->isPaid = $request->input("isPaid", true);
            $cartClass->status = 'paid';
            $cartClass->save();
            // dd($cartClass->id);
            // make Payment Success
            $payment = new Payment();
            $payment->status = 'waiting_transfer';
            $payment->type = "live";
            $payment->methods = "transfer";
            $payment->user_id = $cartClass->user_id;
            $payment->class_id = $cartClass->class_id;
            $payment->cart_class_id = $cartClass->id;
            $payment->save();

            // user has class
            $user_has = new UserHaveClass();
            $user_has->status = 'waiting';
            $user_has->user_id = $cartClass->user_id;
            $user_has->class_id = $cartClass->class_id;
            $user_has->form_id = $cartClass->form->id;
            $user_has->absent = 0;
            $user_has->save();
            // user 
            $me = User::findOrFail($cartClass->user_id);
            $me->myClass()->attach($cartClass->user_id);

            DB::commit();
            return Json::response($payment);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            DB::rollBack();
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Spatie\Permission\Exceptions\UnauthorizedException $e) {
            DB::rollBack();
            return Json::exception('Error UnauthorizedException ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function rejectedConfirmationEnsikloLive(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $master = CartClass::findOrFail($id);
            if ($master->status == 'paid') {
                $master->status = $request->input("status", 'pending');
                $master->isPaid = false;

                if ($master->image_url !== null) {
                    $new_array = explode('/', $master->image_url);
                    $image_path = $new_array[3] . '/' . $new_array[4] . '/' . $new_array[5];

                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }

                    $master->image_url = null;
                }
                $master->save();

                $payment = Payment::where('cart_class_id', $master->id)->first();
                $payment->status = 'rejected';
                $payment->save();

                $user_has = UserHaveClass::where('form_id', $master->form->id)->first();
                $user_has->delete();

                $me = User::findOrFail($master->user_id);
                $me->myClass()->detach($master->user_id);
            } else {
                $master->status = $request->input("status", 'pending');
                $master->isPaid = false;

                $new_array = explode('/', $master->image_url);
                $image_path = $new_array[3] . '/' . $new_array[4] . '/' . $new_array[5];

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $master->image_url = null;
            }
            DB::commit();
            return Json::response($master);
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
    public function edit($id)
    {
        return view('administrator::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
