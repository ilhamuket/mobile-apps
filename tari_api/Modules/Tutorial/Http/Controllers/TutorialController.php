<?php

namespace Modules\Tutorial\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use GuzzleHttp\Client;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Tutorial\Entities\Tutorial;
use Illuminate\Support\Facades\Http;
// use SimpleSoftwareIO\QrCode\QrCodeServiceProvider;

class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function autoPlay(Request $request)
    {
        try {

            $video = Tutorial::first();
            if (is_object($video)) {
                $master = Tutorial::entities($request->entities)
                    ->where('id', $request->input("id", $video->id))
                    ->first();
                return Json::response($master);
            } else {
                return Json::exception("Data Not Found");
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
        return view('tutorial::create');
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
                    $ytId = explode("v=", $url);
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
                    // dd($res);
                    $master = new Tutorial();
                    $master->title = $res['title'];
                    $master->url = $url_embed;
                    $master->note = $request->note;
                    $master->descriptions = $request->descriptions;
                    $master->url_thumbnail = $res['thumbnail_url'];
                    $master->is_verified = false;
                    $master->status = 'draft';
                    $master->user_id = $request->user()->id;
                    $master->save();
                }
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
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function listTutorialVideo(Request $request)
    {
        try {
            $master = Tutorial::entities($request->entities)
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
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    // public function scanMe(Request $request)
    // {
    //     // try {
    //     $response = Http::post(
    //         'https://qrickit.com/api/qr.php?d=https://ensiklotari.com'
    //     );

    //     return Json::response($response);
    //     // } catch (\Throwable $th) {
    //     //     //throw $th;
    //     // }
    // }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        try {
            $master = Tutorial::findOrFail($id);
            $master->descriptions = $request->input('descriptions', $master->descriptions);
            $master->save();
            // QrCodeServiceProvider

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
        //
    }
}
