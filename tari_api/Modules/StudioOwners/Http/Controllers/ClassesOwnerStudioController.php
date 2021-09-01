<?php

namespace Modules\StudioOwners\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\StudioOwners\Entities\ClassesOwnerStudio;
use Modules\StudioOwners\Entities\OwnerStudio;
use PhpParser\Node\Stmt\Foreach_;

class ClassesOwnerStudioController extends Controller
{
    public function approvedBroadcast(Request $request)
    {
        try {
            if (is_array($request->id)) {
                $id = [];
                $id = $request->id;
                foreach ($id as $studio_id) {
                    $master = ClassesOwnerStudio::findOrFail($studio_id);
                    $master->status = true;
                    $master->save();
                }
            } else {
                return Json::exception('Not Found');
            }
            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function delBroadcast(Request $request)
    {
        try {
            if (is_array($request->id)) {
                $id = [];
                $id = $request->id;
                foreach ($id as $studio_id) {
                    $master = ClassesOwnerStudio::findOrFail($studio_id);
                    $master->delete();
                }
            } else {
                return Json::exception('Not Found');
            }
            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
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
            $me = $request->user();
            $studio = OwnerStudio::where('author_id', $me->id)->first();
            $studioClasses = ClassesOwnerStudio::where('studio_id', $studio->id)->entities($request->entities)->get();

            return Json::response($studioClasses);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
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
            $me = $request->user();
            $studio = OwnerStudio::where('author_id', $me->id)->first();

            $studioClasses = new ClassesOwnerStudio();
            $studioClasses->name = $request->name;
            $studioClasses->status = false;
            $studioClasses->levels = $request->levels;
            $studioClasses->about = $request->about;
            $studioClasses->isVerified = false;
            $studioClasses->author_id = $request->user()->id;
            $studioClasses->studio_id = $studio->id;
            $studioClasses->save();

            DB::commit();
            return Json::response($studioClasses);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollback();
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            DB::rollback();
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
        try {
            $master = ClassesOwnerStudio::findOrFail($id);
            $master->name = $request->input('name', $master->name);
            $master->levels = $request->input('levels', $master->levels);
            $master->about = $request->input('about', $master->about);
            $master->save();
            $master->studio;
            $master->author;

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $master = ClassesOwnerStudio::findOrFail($id);
            $master->delete();
            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
}