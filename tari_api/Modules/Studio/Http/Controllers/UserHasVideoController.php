<?php

namespace Modules\Studio\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Studio\Entities\CartClass;
use Modules\Studio\Entities\CartVideo;
use Modules\Studio\Entities\UserHasVideo;

class UserHasVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function userHasVideo(Request $request)
    {
        try {
            $master = UserHasVideo::entities($request->entities)->where('user_id', $request->user()->id)
                ->paginate($request->input("paginate", 2));

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
    public function paidCart(Request $request, $cart_id)
    {
        try {
            DB::beginTransaction();
            $payment = CartVideo::findOrFail($cart_id);
            $payment->status = $request->input('status', "waiting_payment");
            $payment->save();

            // $userHasVideo = new UserHasVideo();
            // $userHasVideo->status = $request->input('status', '');
            // $userHasVideo->type = $request->input('type', 'video');
            // $userHasVideo->user_id = $request->user()->id;
            // $userHasVideo->video_id = $payment->video_id;
            // $userHasVideo->start_subscription = $request->input('start_subscription', now());
            // $userHasVideo->end_subscription = date('Y-m-d', strtotime($request->input('start_subscription', now()) . ' +1 month'));
            // $userHasVideo->save();
            DB::commit();
            return Json::response($userHasVideo);
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
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('studio::show');
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
