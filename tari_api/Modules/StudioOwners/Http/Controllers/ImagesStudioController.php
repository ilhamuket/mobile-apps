<?php

namespace Modules\StudioOwners\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Modules\Studio\Entities\ImagesStudio;
use Modules\StudioOwners\Entities\OwnerStudio;

class ImagesStudioController extends Controller
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
    public function storeThumbnail(Request $request)
    {
        try {
            $studio = OwnerStudio::where('author_id', $request->user()->id)->first();
            $master = new ImagesStudio();
            $master->name_thumbnail = $request->name_thumbnail;
            $path = $request->img->store('images');
            $master->url =  $path;
            $master->studio_id = $request->studio_id;
            $master->type = $request->type;
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
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $studio = OwnerStudio::where('author_id', $request->user()->id)->first();
            $studioImg = ImagesStudio::where('studio_id', $studio->id)->first();
            $new_array = explode('/', $studioImg->url);
            $image_path = $new_array[3] . '/' . $new_array[4] . '/' . $new_array[5];


            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $studioImg->delete();

            $master = new ImagesStudio();
            $path = $request->img->store('images');
            $master->name_thumbnail = 's';
            $master->url = $path;
            $master->studio_id = $request->studio_id;
            $master->type = 'studio';
            $master->save();
            DB::commit();
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
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
