<?php

namespace Modules\StudioOwners\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\StudioOwners\Entities\ImgListClass;
use Illuminate\Support\Facades\File;
use Modules\StudioOwners\Entities\imgClasses;

class ImgListClassController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function thumbnail(Request $request)
    {
        try {
            $master = new ImgListClass();
            $path = $request->img->store('images');
            $master->url = $path;
            $master->class_id = $request->class_id;
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
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function change(Request $request)
    {
        try {
            DB::beginTransaction();
            $listImg = ImgListClass::where('id', $request->id_old)->first();
            $image_path = $listImg->url;
            // dd($image_path);
            $new_array = explode("/", $image_path);
            // dd($new_array);
            $image_path = $new_array[3] . '/' . $new_array[4] . '/' . $new_array[5];
            // dd($image_path);
            if (File::exists($image_path)) {
                File::delete($image_path);
                // @unlink($image_path);
            }
            $listImg->delete();

            $master = new ImgListClass();
            $path = $request->img->store('images');
            $master->url = $path;
            $master->class_id = $listImg->class_id;
            $master->save();
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