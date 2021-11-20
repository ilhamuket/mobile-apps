<?php

namespace Modules\Payment\Http\Controllers;

use App\Models\User;
use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Payment\Entities\Payment;
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
