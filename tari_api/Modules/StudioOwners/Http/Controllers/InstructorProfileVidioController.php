<?php

namespace Modules\StudioOwners\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use GuzzleHttp\Client;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\StudioOwners\Entities\InstructorProfieVidio;
use Modules\StudioOwners\Entities\InstructorProfileVidio;

class InstructorProfileVidioController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     * @param $slug
     */
    public function index(Request $request, $slug)
    {
        try {
            $master = InstructorProfieVidio::whereHas('instructor', function (Builder $query) use ($slug) {
                $query->where('slug', $slug);
            })->entities($request->entities)
                ->verified($request->is_verified)
                ->get();

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
            if (is_array($request->url)) {
                foreach ($request->url as $url) {
                    $ytId = explode('v=', $url);
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
                    // dd($res['title']);

                    $master = new InstructorProfileVidio();
                    $master->title = $res['title'];
                    $master->slug = \Str::slug($res["title"]);
                    $master->url_thumbnail = $res["thumbnail_url"];
                    $master->url = $url_embed;
                    $master->instructor_id = $request->instructor_id;
                    $master->is_verified = false;
                    $master->status = 'draft';
                    $master->save();
                }
            }

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
