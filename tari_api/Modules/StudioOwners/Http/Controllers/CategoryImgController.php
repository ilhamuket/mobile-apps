<?php

namespace Modules\StudioOwners\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Modules\StudioOwners\Entities\CategoryImg;

class CategoryImgController extends Controller
{
    public function changeThumbnail(Request $request)
    {
        try {
            DB::beginTransaction();
            $categoryImg = CategoryImg::where('category_id', $request->category_id)->first();
            $new_array = explode('/', $categoryImg->url);
            $image_path = $new_array[3] . '/' . $new_array[4] . '/' . $new_array[5];

            if (File::exists($image_path)) {
                File::delete($image_path);
                $categoryImg->delete();
            }

            if ($request->hasfile('img')) {
                //getting the file from view
                $image = $request->file('img');
                $image_size = $image->getSize();

                //getting the extension of the file
                $image_ext = $image->getClientOriginalExtension();

                //changing the name of the file
                $new_image_name = rand(123456, 999999) . "." . $image_ext;

                $destination_path = public_path('images/category');
                // $destination_path = public_path('listImg');
                $image->move($destination_path, $new_image_name);

                // save to database
                $master = new CategoryImg();
                // $master->name_thumbnail = $new_image_name;
                $master->url =  'images/category/' . $new_image_name;
                $master->category_id = $categoryImg->category_id;
                $master->save();

                DB::commit();
                return Json::response($master);
            }
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
    public function thumbnail(Request $request)
    {
        try {
            if ($request->hasfile('img')) {
                //getting the file from view
                $image = $request->file('img');
                $image_size = $image->getSize();

                //getting the extension of the file
                $image_ext = $image->getClientOriginalExtension();

                //changing the name of the file
                $new_image_name = rand(123456, 999999) . "." . $image_ext;

                $destination_path = public_path('images/category');
                // $destination_path = public_path('listImg');
                $image->move($destination_path, $new_image_name);

                // save to database
                $master = new CategoryImg();
                // $master->name_thumbnail = $new_image_name;
                $master->url =  'images/category/' . $new_image_name;
                $master->category_id = $request->category_id;
                $master->save();


                return Json::response($master);
            }
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