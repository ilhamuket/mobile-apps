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
    public function summary(Request $request)
    {
        try {
            $summary = Classes::selectRaw(
                '
                    count(id) as total,
                    (select count(*) from classes INNER JOIN posts on classes.id = posts.class_id where posts.type = \'intermediate\') as intermediate,
                    (select count(*) from classes INNER JOIN posts on classes.id = posts.class_id where posts.type = \'beginner\') as beginner,
                    (select count(*) from classes INNER JOIN posts on classes.id = posts.class_id where posts.type = \'advanced\') as advanced,
                    (select count(*) from classes where isVerified = \'1\') as verified,
                    (select count(*) from classes where isVerified = \'0\') as unverified,
                    (select count(*) from classes where deleted_at is not null) as deleted
                '
            )->first();

            return Json::response($summary);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = nev('APP_DEBUG', false) == true ? $e : '');
        }
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        try {
            $master = Classes::with('teacher', 'posts')
                ->summary($request->summary)
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
            $post->type = $request->typeLevelsPost;
            $yid = explode('v=', $request->url);
            if (isset($yid[1])) {
                $content_id = $yid[1];
                $split = explode('&', $yid[1]);
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
            $classes->responses = $res;
            $classes->save();
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
        try {
            DB::beginTransaction();
            $master = Classes::find($id);
            $master->name = $request->input('name', $master->name);
            $master->display_name = $request->input('display_name', $master->display_name);
            $master->teacher_id = $request->input('teacher_id', $master->teacher_id);
            $master->status = $request->input('status', $master->status);
            $master->type = $request->input('type', $master->type);
            $master->save();
            $master->teacher;

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
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $master = Classes::find($id);
            $master->delete();

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = nev('APP_DEBUG', false) == true ? $e : '');
        }
    }
}