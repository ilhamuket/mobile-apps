<?php

namespace Modules\StudioOwners\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Modules\StudioOwners\Entities\OwnerStudio;
use Modules\StudioOwners\Entities\StudioOwnerVidio;

class StudioOwnerVidioController extends Controller
{
    public function delBroadcast(Request $request)
    {
        try {
            if (is_array($request->id)) {
                foreach ($request->id as $id) {
                    $master = StudioOwnerVidio::findOrFail($id);
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
    public function goPublish(Request $request)
    {
        try {
            if (is_array($request->id)) {
                foreach ($request->id as $id) {
                    $master = StudioOwnerVidio::findOrFail($id);
                    $master->status = 'publish';
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
    public function summary(Request $request)
    {
        try {
            $data = [
                "all" => 0,
                "publish" => 0,
                "new" => 0,
                // "deleted" => 0,
            ];
            $me = $request->user();
            $studio = OwnerStudio::where('author_id', $me->id)->first();
            $data['all'] = StudioOwnerVidio::where('studio_id', $studio->id)->count();
            $data["publish"] = StudioOwnerVidio::where([
                ['studio_id', $studio->id],
                ['status', "publish"]
            ])->count();
            $data['new'] = StudioOwnerVidio::where('studio_id', $studio->id)->whereDate('created_at', now())->count();
            // $data["deleted"] = StudioOwnerVidio::where('studio_id', $studio->id)->where('deleted_at', '!=', null)->count();

            return Json::response($data);
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
            $master = StudioOwnerVidio::entities($request->entities)
                ->filterStatus($request->status)
                ->where('studio_id', $studio->id)
                ->summary($request->summary, $studio->id)
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
            DB::beginTransaction();
            $me = $request->user();
            $studio = OwnerStudio::where('author_id', $me->id)->first();
            if (is_array($request->url)) {
                foreach ($request->url as $url) {
                    if ($url['option'] != null) {
                        $urls = $url['option'];
                        $ytId = explode('v=', $urls);
                        // dd($ytId);
                        if (isset($ytId)) {
                            $content_id = $ytId[1];
                            $split = explode('&', $ytId[1]);
                            $content_id = $split[0];
                        } else {
                            $content_id = $url;
                        }
                        $id_yt = $content_id;
                        $full_url = 'https://www.youtube.com/watch?v=' . $content_id;
                        $url_embed = 'https://www.youtube.com/embed/' . $content_id;
                        $client = new Client();
                        $response = $client->get('https://www.youtube.com/oembed?url=' . $full_url);
                        $res = json_decode($response->getBody(), true);

                        $studiosVidios = new StudioOwnerVidio();
                        $studiosVidios->name = $res['title'];
                        $studiosVidios->url = $url_embed;
                        $studiosVidios->url_thumbnail_youtube = $res['thumbnail_url'];
                        $studiosVidios->slug = \Str::slug($res['title']);
                        $studiosVidios->status = $request->status;
                        $studiosVidios->author_id = $request->user()->id;
                        $studiosVidios->studio_id = $studio->id;
                        $studiosVidios->save();
                        $studiosVidios->studio;
                        $studiosVidios->author;
                    }
                }
            }

            DB::commit();
            return Json::response($studiosVidios);
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
            $master = StudioOwnerVidio::findOrFail($id);
            $master->name = $request->input('name', $master->name);
            $master->slug = \Str::slug($master->name);
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
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $master = StudioOwnerVidio::findOrFail($id);
            $master->delete();

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
}