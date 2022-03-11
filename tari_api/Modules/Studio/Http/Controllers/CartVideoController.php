<?php

namespace Modules\Studio\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Plan\Entities\Subscription;
use Modules\Studio\Entities\CartVideo;
use Modules\StudioOwners\Entities\FormRegisterEnsiklovideo;

class CartVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function summary(Request $request)
    {
        try {
            $data = [
                "all" => 0,
                "paid" => 0,
                "unPaid" => 0,
                "waiting_confirmation" => 0,
                "waiting_payment" => 0,
                "cancelled" => 0,
            ];

            $id = $request->user()->id;

            $data["all"] = CartVideo::where("user_id", $id)->count();
            $data["paid"] = CartVideo::where("user_id", $id)->where("status", "paid")->where("isPaid", true)->count();
            $data["unPaid"] = CartVideo::where("user_id", $id)->where("status", "unPaid")->where("isPaid", false)->count();
            $data["waiting_payment"] = CartVideo::where("user_id", $id)->where("status", "waiting_payment")->where("isPaid", false)->count();
            $data["waiting_confirmation"] = CartVideo::where("user_id", $id)->where("status", "waiting_confirmation")->where("isPaid", true)->count();
            $data["cancelled"] = CartVideo::where("user_id", $id)->where("status", "cancelled")->count();

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
            $master = CartVideo::entities($request->entites)
                ->orderBy('id', 'desc')
                ->get();
            return Json::response($master);
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
    public function userCartVideo(Request $request)
    {
        try {
            $master = CartVideo::entities($request->entities)
                ->where('user_id', $request->user()->id)
                ->orderBy('id', 'desc')
                ->get();

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request, $video_id)
    {
        try {
            DB::beginTransaction();
            $cart = new CartVideo();
            $cart->status = "pending";
            $cart->type = "EnsikloLive";
            $cart->user_id = $request->user()->id;
            $cart->video_id = $video_id;
            $cart->save();

            //    dd($request->user()->dateOfBirth);

            $form = new FormRegisterEnsiklovideo();
            $form->fullName = $request->user()->firstName . ' ' . $request->user()->lastName;
            $form->contact = $request->input("contact", $request->user()->noHp);
            $form->address = $request->input("address", $request->user()->homeAddress ? $request->user()->homeAddress : 'null');
            $form->email = $request->input('email', $request->user()->email);
            $form->ttl = $request->input('ttl', $request->user()->dateOfBirth);
            $form->cart_video_id = $cart->id;
            $form->user_id = $request->user()->id;
            $form->video_id = $video_id;
            $form->plan_id = $request->plan_id;
            $form->save();

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
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function detailCartVideo(Request $request, $id)
    {
        try {
            $master = CartVideo::entities($request->entities)
                ->findOrFail($id);
            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
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
        return view('studio::edit');
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
