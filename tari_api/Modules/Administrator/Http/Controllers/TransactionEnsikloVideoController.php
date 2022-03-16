<?php

namespace Modules\Administrator\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Administrator\Entities\CartVideo;
use Modules\Payment\Entities\Payment;
use Modules\Plan\Entities\Subscription;
use Modules\Studio\Entities\UserHasVideo;

class TransactionEnsikloVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function summary(Request $request)
    {
        try {
            $data = [
                "total" => 0,
                "paid" => 0,
                "pending" => 0,
                "new" => 0,
                "waiting_confirmation" => 0,
                "waiting_payment" => 0,
            ];

            $data["total"] = CartVideo::count();
            $data["paid"] = CartVideo::where('status', 'paid')->count();
            $data["pending"] = CartVideo::where('status', 'pending')->count();
            $data["new"] = CartVideo::whereDate('created_at', now())->count();
            $data["waiting_confirmation"] = CartVideo::where('status', 'waiting_confirmation')->count();
            $data["waiting_payment"] = CartVideo::where('status', 'waiting_payment')->count();

            return Json::response($data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        try {
            $master = CartVideo::entities($request->entities)
                ->sort($request->sort)
                ->summary($request->summary)
                ->get();
            return Json::Response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function confirmationPaidVideo(Request $request, $cart_id)
    {
        try {
            DB::beginTransaction();
            $cart = CartVideo::findOrFail($cart_id);
            if ($cart->status != 'waiting_confirmation') {
                return Json::exception("Cart Video is not waiting confirmation");
            }
            $cart->status = 'paid';
            $cart->isPaid = true;
            $cart->save();

            $user_has_video = new UserHasVideo();
            $user_has_video->status = '';
            $user_has_video->type = 'ensiklo-video';
            $user_has_video->user_id = $request->user()->id;
            $user_has_video->video_id = $cart->video_id;
            $user_has_video->cart_video_id = $cart->id;
            if ($cart->subscription->plan->date_count == 1) {
                $user_has_video->start_subscription = $request->input('start_subscription', now());
                $user_has_video->end_subscription = date('Y-m-d', strtotime($request->input('start_subscription', now()) . ' +1 month'));
            }
            if ($cart->subscription->plan->date_count == 2) {
                $user_has_video->start_subscription = $request->input('start_subscription', now());
                $user_has_video->end_subscription = date('Y-m-d', strtotime($request->input('start_subscription', now()) . ' +2 month'));
            }
            if ($cart->subscription->plan->date_count == 3) {
                $user_has_video->start_subscription = $request->input('start_subscription', now());
                $user_has_video->end_subscription = date('Y-m-d', strtotime($request->input('start_subscription', now()) . ' +3 month'));
            }
            $user_has_video->save();

            $payment = new Payment();
            $payment->status = "waiting_transfer";
            $payment->type = "video";
            $payment->methods = "transfer";
            $payment->user_id = $cart->user_id;
            $payment->video_id = $cart->video_id;
            $payment->cart_video_id = $cart_id;
            $payment->save();

            DB::commit();
            return Json::response($cart);
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
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function reject(Request $request, $cart_id)
    {
        try {
            DB::beginTransaction();
            $cart = CartVideo::findOrFail($cart_id);
            if ($cart->status == 'pending') return Json::exception("Cart Video is Pending");
            if ($cart->status == 'paid') {
                $cart->status = 'pending';
                if ($cart->image_url != null) {
                    $new_array = explode('/', $cart->image_url);
                    $image_path = $new_array[3] . '/' . $new_array[4] . '/' . $new_array[5];
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                    $cart->image_url = null;
                }
                $subscription_id = $cart->subscription_id;
                $cart->subscription_id = null;
                $cart->save();


                // subscription delete
                $subscription = Subscription::where('id', $subscription_id)->first();
                $subscription->delete();

                // user has video delete
                $user_has_video = UserHasVideo::where('cart_video_id', $cart_id)->first();
                $user_has_video->delete();

                // payment status rejected
                $payment = Payment::where('cart_video_id', $cart->id)->first();
                if ($payment->status == 'paid') return Json::exception("Payment is Paid to Studio");
                $payment->status = 'rejected';
                $payment->save();
            } else {
                $cart->status = 'pending';
                $subscription_id = $cart->subscription_id;
                $cart->subscription_id = null;
                $cart->save();

                // subscription delete
                $subscription = Subscription::where('id', $subscription_id)->first();
                $subscription->delete();
            }
            DB::commit();
            return Json::response($cart);
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
    public function show($id)
    {
        return view('administrator::show');
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
