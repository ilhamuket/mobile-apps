<?php

namespace Modules\StudioOwners\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\StudioOwners\Entities\StudioClassVidio;
use GuzzleHttp\Client;
use Modules\StudioOwners\Entities\OwnerStudio;

class StudioClassVidioController extends Controller
{
    public function summary(Request $request)
    {
        try {
            $data = [
                "all" => 0,
                "publish" => 0,
                "draft" => 0,
                "new" => 0
            ];

            $data["all"] = StudioClassVidio::get();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function deleteBroadcast(Request $request)
    {
        try {
            if (is_array($request->id)) {
                foreach ($request->id as $id) {
                    $master = StudioClassVidio::findOrFail($id);
                    $master->delete();
                }

                return Json::response($master);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function setPublish(Request $request)
    {
        try {
            if (is_array($request->id)) {
                foreach ($request->id as $id) {
                    $master = StudioClassVidio::findOrFail($id);
                    $master->status = 'publish';
                    $master->is_verified = 1;
                    $master->save();
                }

                return Json::response($master);
            }
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
            $studio = OwnerStudio::where('author_id', $request->user()->id)->first();
            $master = StudioClassVidio::entities($request->entities)
                ->where('studio_id', $studio->id)
                ->get();

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
            $me = $request->user();
            $studio = OwnerStudio::where('author_id', $me->id)->first();
            // dd($studio);
            $master = new StudioClassVidio();
            // url youtebe
            $ytId = explode('v=', $request->url);
            if (isset($ytId)) {
                $content_id = $ytId[1];
                $split = explode('&', $ytId[1]);
                $content_id = $split[0];
            } else {
                $content_id = $request->url;
            }
            $id_yt = $content_id;
            $full_url = 'https://www.youtube.com/watch?v=' . $content_id;
            $url_embed = 'https://www.youtube.com/embed/' . $content_id;
            $client = new Client();
            $response = $client->get('https://www.youtube.com/oembed?url=' . $full_url);
            $res = json_decode($response->getBody(), true);

            $master->url = $url_embed;
            $master->name = $res["title"];
            $master->levels = $request->levels;
            $master->duration = $request->duration;
            $master->about = $request->about;
            $master->price = $request->price;
            $master->status = $request->status;
            $master->slug = \Str::slug($master->name);
            $master->note = $request->note;
            $master->url_thumbnail = $res['thumbnail_url'];
            $master->type = $request->input('type', 'vidio');
            $master->is_verified = false;
            $master->author_id = $request->user()->id;
            $master->category_id = $request->category_id;
            $master->studio_id = $studio->id;
            $master->playlist_id = $request->playlist_id;
            $master->save();

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
            $master = StudioClassVidio::findOrFail($id);
            $master->name = $request->input('name', $master->name);
            $master->levels = $request->input('levels', $master->levels);
            $master->duration = $request->input('duration', $master->duration);
            $master->about = $request->input('about', $master->about);
            $master->price = $request->input('price', $master->price);
            $master->status = $request->input('status', $master->status);
            $master->note = $request->input('note', $master->note);
            $master->is_verified = $request->input('is_verified', $master->is_verified);
            $master->category_id = $request->input('category_id', $master->category_id);
            // $master->playlist = $request->input('playlist_id', $master->playlist);
            $master->save();
            $master->category;

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
            $master = StudioClassVidio::findOrFail($id);
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