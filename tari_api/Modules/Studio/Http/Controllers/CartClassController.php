<?php

namespace Modules\Studio\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Studio\Entities\CartClass;

class CartClassController extends Controller
{
    public function summary(Request $request)
    {
        try {
            $data = [
                "all" => 0,
                "paid" => 0,
                "pending" => 0,
                "cancelled" => 0,
                "waiting_confirmation" => 0,
                "waiting_payment" => 0,
                "waiting_proof" => 0,
            ];

            $data["all"] = CartClass::where('user_id', $request->user()->id)->count();
            $data['paid'] = CartClass::where('user_id', $request->user()->id)->where('status', 'paid')->count();
            $data['pending'] = CartClass::where('user_id', $request->user()->id)->where('status', 'pending')->count();
            $data["waiting"] = CartClass::where("user_id", $request->user()->id)->where("status", "waiting")->count();
            $data["cancelled"] = CartClass::where("user_id", $request->user()->id)->where("status", "cancelled")->count();
            $data["waiting_confirmation"] = CartClass::where("user_id", $request->user()->id)->where("status", "waiting_confirmation")->count();
            $data["waiting_payment"] = CartClass::where("user_id", $request->user()->id)->where("status", "waiting_payment")->count();
            $data["waiting_proof"] = CartClass::where("user_id", $request->user()->id)->where("status", "waiting_proof")->count();

            return Json::response($data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function indexUser(Request $request)
    {
        try {
            $master = CartClass::where("user_id", $request->user()->id)
                // ->sort('status', '==', 'pending')
                ->orderBy('id', 'desc')
                ->summary($request->summary)->get();

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function storeWistlist(Request $request)
    {
        try {
            $master = new CartClass();
            $master->class_id = $request->class_id;
            $master->user_id = $request->user()->id;
            $master->type = 'EnsikloLive';
            $master->save();
            $master->user;
            $master->class;

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
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        try {
            $master = CartClass::entities($request->entities)
                ->type($request->type)
                ->where('user_id', $request->user()->id)
                ->orderBy('created_at', 'desc')
                ->summary($request->summary)
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
    public function detailCart(Request $request, $id)
    {
        try {
            $master = CartClass::entities($request->entities)
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
