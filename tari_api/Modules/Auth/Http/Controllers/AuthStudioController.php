<?php

namespace Modules\Auth\Http\Controllers;

use App\Models\User;
use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Studio\Entities\Studio;
use Modules\Studio\Entities\StudioVidio;
use GuzzleHttp\Client;
use Modules\Studio\Entities\ImagesStudio;
use Modules\User\Entities\Otp;
use Modules\User\Notifications\VerifiedAccount;
use Modules\User\Notifications\VerifiedOtp;
use Modules\User\Notifications\VerifiedStudio;

class AuthStudioController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function registerAsStudio(Request $request)
    {
        try {
            DB::beginTransaction();
            $users = new User();
            $users->firstName = $request->firstName;
            $users->lastName = $request->lastName;
            $users->email = $request->email;
            $users->nickName = $request->nickName;
            $users->noHp = $request->noHp;
            $users->password = Hash::make($request->password);
            $users->save();
            $users->assignRole('studio');

            // dd($users->id);

            $studios = new Studio();
            $studios->name = $request->input('name_studio', $users->firstName . ' ' . $users->lastName);
            $studios->slug = \Str::slug($studios->name);
            $studios->prefix = $request->input('prefix', 'std');
            $studios->username = $request->input('username', $users->nickName);
            $studios->contact = $request->input('contact', $users->noHp);
            $studios->email = $request->input('email_studio', $users->email);
            $studios->about = $request->input("about", "About");
            $studios->author_id = $users->id;
            $studios->type = 'studio';
            $studios->isVerified = true;
            // $studios->username_ig = 'mahardikakdenie';
            // $studios->username_fb = 'mahardika.kessuma';
            // $studios->username_tw = 'kessumaD';
            $studios->views = 0;

            $studios->save();

            // dd($users->id);

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

                        $studiosVidios = new StudioVidio();
                        $studiosVidios->name = $res['title'];
                        $studiosVidios->url = $url_embed;
                        $studiosVidios->url_thumbnail_youtube = $res['thumbnail_url'];
                        $studiosVidios->slug = \Str::slug($res['title']);
                        $studiosVidios->status = 'publish';
                        $studiosVidios->author_id = $users->id;
                        $studiosVidios->studio_id = $studios->id;
                        $studiosVidios->save();
                    }
                }
            } else {
                $ytId = explode('v=', $request->url['option']);
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

                $studiosVidios = new StudioVidio();
                $studiosVidios->name = $res['title'];
                $studiosVidios->url = $url_embed;
                $studiosVidios->url_thumbnail_youtube = $res['thumbnail_url'];
                $studiosVidios->slug = \Str::slug($res['title']);
                $studiosVidios->status = $request->status;
                $studiosVidios->author_id = $users->id;
                $studiosVidios->studio_id = $studios->id;
                $studiosVidios->save();
            }

            $expectedOtp = strval(random_int(100000, 999999));
            $otp = new Otp();
            $otp->otp = $expectedOtp;
            $otp->user_id = $request->input('user_id', $users->id);
            $otp->save();

            $users->notify(new VerifiedOtp($expectedOtp, $users));

            // $users->notify(new VerifiedStudio());
            $accessToken = $users->createToken('auth')->plainTextToken;

            $result = [
                'access_token' => $accessToken,
                'otp' => $otp->otp,
            ];

            DB::commit();
            return Json::response($result, 'Waiting For Verfications');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollback();
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            DB::rollback();
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('auth::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('auth::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('auth::edit');
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
