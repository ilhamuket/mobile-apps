<?php

namespace Modules\Studio\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\UploadedFile;
use Modules\Studio\Entities\ImagesStudio;

class ImagesStudioController extends Controller
{
    public function thumbnail(Request $request)
    {
        try {
            // $namaFile = $_FILES["gambar"]["name"];
            // $ukuranFile = $_FILES["gambar"]["size"];
            // $error = $_FILES["gambar"]["error"];
            // $tmpName = $_FILES["gambar"]["tmp_name"];

            // // cek is there a pict or not ? 
            // if ($error == 4) {
            //     return Json::exception('pict not found');
            // }

            // //cek 
            // $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
            // $ekstensiGambar = explode('.', $namaFile);
            // $ekstensiGambar = strtoLower(end($ekstensiGambar));;

            // if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            //     return Json::exception('extention not found');
            // }
            // if ($ukuranFile > 10000000) {
            //     return Json::exception('too big
            // ');
            // }

            // // new Name
            // $newNameFile = uniqid();
            // $newNameFile .= '.';
            // $newNameFile .= $ekstensiGambar;
            // $isi = move_uploaded_file($tmpName, 'images/' . $newNameFile);


            // $master = new ImagesStudio();
            // $master->name_thumbnail = $request->name_thumbnail;
            // // $path = $request->photo->store('images');
            // // $publicPath = \Storage::url($path);
            // $master->url =  'images/' . $newNameFile;
            // $master->studio_id = $request->studio_id;
            // $master->type = $request->type;
            // $master->save();
            // dd($request->hasfile('img'));
            if ($request->hasfile('img')) {
                //getting the file from view
                $image = $request->file('img');
                $image_size = $image->getSize();

                //getting the extension of the file
                $image_ext = $image->getClientOriginalExtension();

                //changing the name of the file
                $new_image_name = rand(123456, 999999) . "." . $image_ext;

                $destination_path = public_path('images');
                $image->move($destination_path, $new_image_name);

                // save to database
                $master = new ImagesStudio();
                $master->name_thumbnail = $new_image_name;
                // $path = $request->photo->store('images');
                // $publicPath = \Storage::url($path);
                $master->url =  'images/' . $new_image_name;
                $master->studio_id = $request->studio_id;
                $master->type = 'thumbnail';
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
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $master = ImagesStudio::with('studio')->get();

        return Json::response($master);

        // echo asset("‘storage / file . txt’");
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
        try {
            $master = new ImagesStudio();
            $master->name_thumbnail = $request->name_thumbnail;
            $path = $request->photo->store('listImg');
            // $publicPath = \Images::url($path);
            dd($path);
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