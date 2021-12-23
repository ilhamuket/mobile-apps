<?php

namespace Modules\StudioOwners\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Modules\Studio\Entities\FormRegisterEnsiklovideo;
use Modules\StudioOwners\Entities\CartVideo;
use PhpParser\Node\Stmt\Return_;

class FormRegisterEnsiklovideoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('studioowners::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('studioowners::create');
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
            $user = $request->user();
            $cart = new CartVideo();
            $cart->status = 'pending';
            $cart->type = "EnsikloVideo";
            $cart->user_id = $request->user()->id;
            $cart->video_id = $request->video_id;
            $cart->save();

            $master = new FormRegisterEnsiklovideo();
            $master->fullName = $user->firstName . $user->lastName;
            $master->address = $request->input("address", $user->homeAddress);
            $master->email = $user->email;
            $master->ttl = $request->input('ttl', $user->dateOfBirth);
            $master->cart_vidio_id = $cart->id;
            $master->user_id = $request->user()->id;
            $master->video_id = $request->video_id;
            $master->save();

            DB::commit();
            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
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
        return view('studioowners::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('studioowners::edit');
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
