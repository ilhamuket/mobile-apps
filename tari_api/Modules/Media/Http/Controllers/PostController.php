<?php

namespace Modules\Media\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Media\Entities\Post;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            $master = Post::with('classes', 'category')->get();

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
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
        return view('media::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'url' => 'required'
            ]);
            $post = new Post();
            $post->title = $request->title;
            $post->author_id = $request->user()->id;
            $post->status = $request->input('status', 'priview');
            $post->category_id = $request->category_id;
            $post->class_id = $request->class_id;
            $post->isVerified = false;
            $post->type = $request->type;
            if (is_array($request->url)) {
                foreach ($request->url as $url) {
                    $yid = explode('v=', $url);
                    if (isset($yid[1])) {
                        $content_id = $yid[1];
                        $split = explode('&', $yid[1]);
                        $content_id = $split[0];
                    } else {
                        $content_id = $url;
                    }
                    $full_Url = 'https://www.youtube.com/watch?v=' . $content_id;
                    $url_embed = 'https://www.youtube.com/embed/' . $content_id;
                    // 
                    $client = new Client();
                    $response = $client->get('https://www.youtube.com/oembed?url=' . $full_Url);
                    $res = json_decode($response->getBody(), true);
                    $post->url = $url_embed;
                    $post->title_yt = $res['title'];
                    $post->slug = \Str::slug($res['title']);
                    $post->thumbnail_url = $res['thumbnail_url'];
                }
            }
            $post->save();

            return Json::response($post);
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
        return view('media::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('media::edit');
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