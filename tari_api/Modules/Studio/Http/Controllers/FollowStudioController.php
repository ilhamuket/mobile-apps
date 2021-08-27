<?php

namespace Modules\Studio\Http\Controllers;

use App\Models\User;
use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Studio\Entities\FollowStudio;
use Modules\Studio\Entities\Studio;

class FollowStudioController extends Controller
{
    public function unFollow(Request $request, $slug)
    {
        try {
            DB::beginTransaction();
            $studio = Studio::where('slug', $slug)->first();
            $studio->followers()->detach($request->user()->id);
            // foreach ($master as $user) {
            //     dd($user['user_id'] == $request->user()->id);
            // }
            // $master->follow_status = false;
            // $master->save();
            // // dd($master);
            // $master->delete();

            DB::commit();
            return Json::response($studio);
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
    public function following(Request $request, $slug)
    {
        try {
            DB::beginTransaction();
            // Studio
            $studio = Studio::where('slug', $slug)->first();
            $studio->followers()->attach($request->user()->id);
            // Users
            // $user = User::findOrFail($request->user()->id);
            // $check = FollowStudio::where("studio_id", $studio->id)->orWhere('user_id', $user->id)->get();
            // foreach ($check as $x => $val) {
            //     // dd($val['user_id']);
            //     // dd();
            //     if (strcmp(strval($val['user_id']), strval($request->user()->id)) === 0) {
            //         $check->follow_status = true;
            //         $check->save();
            //     }
            // }
            // if ($check->user_id == $user->id) {
            //     $check->folow_status = true;
            // } else {
            //     // Saves On Databases
            //     $master = new FollowStudio();
            //     $master->studio_id = $studio->id;
            //     $master->user_id = $user->id;
            //     $master->follow_status = true;
            //     $master->save();
            // }
            DB::commit();
            return Json::response($studio);
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
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('studio::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('studio::create');
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