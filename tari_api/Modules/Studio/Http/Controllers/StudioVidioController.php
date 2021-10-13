<?php

namespace Modules\Studio\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Studio\Entities\Studio;
use Modules\Studio\Entities\StudioVidio;

class StudioVidioController extends Controller
{
    public function autoPlay(Request $request)
    {
        try {
            $studio = Studio::where('slug', $request->studio_slug)->first();
            if (is_object($studio)) {
                $vidio = StudioVidio::where('studio_id', $studio->id)->whereNull('deleted_at')->first();
                if (is_object($vidio)) {
                    $master = StudioVidio::with('studio', 'author')
                        ->where('id', $request->input('vidio_id', $vidio->id))
                        ->first();
                    return Json::response($master);
                } else {
                    return Json::exception('Error Vidio Not Found');
                }
            } else {
                return Json::exception('Error Studio Not Found');
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    public function listVidio(Request $request)
    {
        try {
            $studio = Studio::where('slug', $request->slug)->first();

            if (is_object($studio)) {
                $master = StudioVidio::with('studio', 'author')
                    ->filterStatus($request->status)
                    ->search($request->search)
                    ->where('studio_id', $studio->id)
                    ->whereNull('deleted_at')
                    ->get();
                return Json::response($master);
            } else {
                return Json::exception('Error Studio Not Found');
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
        try {
            $master = StudioVidio::with('author', 'studio')->get();

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
            DB::beginTransaction();

            $ytId = explode('v=', $request->url);
            if (isset($ytId[1])) {
                $content_id = $ytId[1];
                $split = explode('&', $ytId[1]);
                $content_id = $split[0];
            } else {
                $content_id = $url;
            }
            $id_yt = $content_id;
            $full_Url = 'https://www.youtube.com/watch?v=' . $content_id;
            $url_embed = 'https://www.youtube.com/embed/' . $content_id;
            $client = new Client();
            $response = $client->get('https://www.youtube.com/oembed?url=' . $full_Url);
            $res = json_decode($response->getBody(), true);

            $master = new StudioVidio();
            $master->name = $res['title'];
            $master->url = $url_embed;
            $master->url_thumbnail_youtube = $res['thumbnail_url'];
            $master->slug = \Str::slug($res['title']);
            $master->status = $request->status;
            $master->author_id = $request->user()->id;
            $master->studio_id = $request->studio_id;
            $master->save();

            DB::commit();
            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
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