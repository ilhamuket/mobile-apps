<?php

namespace Modules\Classes\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use GuzzleHttp\Client;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Classes\Entities\Classes;
use Modules\Media\Entities\Post;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            $master = Classes::with('teacher', 'posts')

                ->get();

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = nev('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('classes::create');
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

            $classes = new Classes();
            $classes->name = $request->name;
            $classes->display_name = $request->display_name;
            $classes->author_id = $request->user()->id;
            $classes->teacher_id = $request->teacher_id;
            $classes->status = $request->status;
            $classes->type = $request->type;
            $classes->save();

            $master = Classes::findOrFail($classes->id);

            $post = new Post();
            $post->title = $master->name;
            $post->author_id = $request->user()->id;
            $post->status = $request->input('statusCategory', 'priview');
            $post->category_id = $request->category_id;
            $post->class_id = $master->id;
            $post->isVerified = false;
            $post->type = $request->type;
            $yid = explode('v=', $request->url);
            if (isset($yid[1])) {
                $content_id = $yid[1];
                $split = explode('&', $yid[1]);
                $content_id = $split[0];
            } else {
                $content_id = $url;
            }
            $full_Url = 'https://www.youtube.com/watch?v=' . $content_id;
            $url_embed = 'https://www.youtube.com/embed/' . $content_id;
            $client = new Client();
            $response = $client->get('https://www.youtube.com/oembed?url=' . $full_Url);
            $res = json_decode($response->getBody(), true);
            $post->url = $url_embed;
            $post->title_yt = $res['title'];
            $post->slug = \Str::slug($res['title']);
            $post->thumbnail_url = $res['thumbnail_url'];
            $post->save();

            $master->teacher;
            $master->posts;

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
        return view('classes::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('classes::edit');
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