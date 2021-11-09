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
use Modules\StudioOwners\Entities\StudioTeacher;

class InstructorProfileVidioController extends Controller
{
    public function summary(Request $request, $slug)
    {
        try {
            $data = [
                "all" => 0,
                "publish" => 0,
                "draft" => 0,
                "new" => 0
            ];

            $data['all'] = InstructorProfileVidio::whereHas('instructor', function (Builder $query) use ($slug) {
                $query->where('slug', $slug);
            })->count();
            $data['publish'] = InstructorProfileVidio::whereHas('instructor', function (Builder $query) use ($slug) {
                $query->where('slug', $slug);
            })
                ->where('status', 'publish')
                ->count();
            $data['draft'] = InstructorProfileVidio::whereHas('instructor', function (Builder $query) use ($slug) {
                $query->where('slug', $slug);
            })
                ->where('status', 'draft')
                ->count();
            $data['new'] = InstructorProfileVidio::whereHas('instructor', function (Builder $query) use ($slug) {
                $query->where('slug', $slug);
            })
                ->whereDate('created_at', now())
                ->count();

            return Json::response($data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    public function deactive(Request $request, $id)
    {
        try {
            $master = InstructorProfileVidio::findOrFail($id);
            $master->is_verified = false;
            $master->status = "sembunyikan";
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

    public function destroyArr(Request $request)
    {
        try {
            if (is_array($request->id)) {
                foreach ($request->id as $id) {
                    $master = InstructorProfileVidio::findOrFail($id);
                    $master->delete();
                }
            } else {
                return Json::exception('data not array');
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
    public function approvedById(Request $request, $id)
    {
        try {
            $master = InstructorProfileVidio::findOrFail($id);
            $master->status = 'publish';
            $master->is_verified = true;
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
    public function approvedItems(Request $request)
    {
        try {
            if (is_array($request->id)) {
                foreach ($request->id as $id) {
                    $master = InstructorProfileVidio::findOrFail($id);
                    $master->is_verified = true;
                    $master->status = 'publish';
                    $master->save();
                }

                return Json::response($master);
            } else {
                return Json::exception('Data Not Array');
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
     * @param $slug
     */
    public function index(Request $request, $slug)
    {
        try {
            $master = InstructorProfileVidio::whereHas('instructor', function (Builder $query) use ($slug) {
                $query->where('slug', $slug);
            })->entities($request->entities)
                ->summary($request->summary)
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
    public function storeVidioProfile(Request $request)
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

                    $instructor = StudioTeacher::where('slug', $request->slug)->first();

                    $master = new InstructorProfileVidio();
                    $master->title = $res['title'];
                    $master->slug = \Str::slug($res["title"]);
                    $master->url_thumbnail = $res["thumbnail_url"];
                    $master->url = $url_embed;
                    $master->instructor_id = $instructor->id;
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
        // 
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
            $master = InstructorProfileVidio::findOrFail($id);
            $master->title = $request->title;
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
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $master = InstructorProfileVidio::findOrFail($id);
            $master->delete();

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
}
