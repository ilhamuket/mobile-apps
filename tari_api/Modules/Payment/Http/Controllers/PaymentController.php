<?php

namespace Modules\Payment\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Payment\Entities\Payment;
use Modules\Studio\Entities\CartClass;
use Modules\Studio\Entities\CartVideo;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            $master = Payment::get();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('payment::create');
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

            if ($check === 'ensiklo-live') {
                $cart = new CartClass();
                $cart->type = 'ensiklo-live';
                $cart->status = 'paid';
                $cart->class_id = $request->class_id;
                $cart->user_id  = $request->user()->id;
                $cart->save();
            }
            if ($check === 'ensiklo-video') {
                $cart = new CartVideo();
                $cart->status = 'paid';
                $cart->type = $request->type;
                $cart->user_id = $request->user()->id;
                $cart->video_id = $request->video_id;
                $cart->save();
            }
            $master = new Payment();;
            $master->status = 'paid';
            $master->type = $request->type;
            $master->methods = $request->methods;
            $master->user_id = $request->user()->id;
            $master->class_id = $request->class_id;
            $master->video_id = $request->video_id;
            $master->cart_class_id = $cart->id;
            $master->cart_video_id = $cart->id;
            $master->save();

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
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('payment::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('payment::edit');
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
