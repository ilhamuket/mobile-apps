<?php

namespace Modules\Studio\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Studio\Entities\StudioClass;

class StudioClassController extends Controller
{
    public function recomendation(Request $request, $studio_slug)
    {
        try {
            $master = StudioClass::whereHas('studio', function (Builder $query) use ($studio_slug) {
                $query->where('slug', $studio_slug);
            })->entities($request->entities)
                ->orderBy('views', 'asc')
                ->orderBy('id')
                ->paginate(3);

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function populer(Request $request)
    {
        try {
            $master = StudioClass::entities($request->entities)
                ->filterBy($request->filter)
                ->search($request->q)
                ->orderBy('views', 'desc')
                ->orderBy('id')
                ->paginate(3);

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function getClientIps()
    {
        $clientIps = array();
        $ip = $this->server->get('REMOTE_ADDR');
        if (!$this->isFromTrustedProxy()) {
            return array($ip);
        }
        if (self::$trustedHeaders[self::HEADER_FORWARDED] && $this->headers->has(self::$trustedHeaders[self::HEADER_FORWARDED])) {
            $forwardedHeader = $this->headers->get(self::$trustedHeaders[self::HEADER_FORWARDED]);
            preg_match_all('{(for)=("?\[?)([a-z0-9\.:_\-/]*)}', $forwardedHeader, $matches);
            $clientIps = $matches[3];
        } elseif (self::$trustedHeaders[self::HEADER_CLIENT_IP] && $this->headers->has(self::$trustedHeaders[self::HEADER_CLIENT_IP])) {
            $clientIps = array_map('trim', explode(',', $this->headers->get(self::$trustedHeaders[self::HEADER_CLIENT_IP])));
        }
        $clientIps[] = $ip; // Complete the IP chain with the IP the request actually came from
        $ip = $clientIps[0]; // Fallback to this when the client IP falls into the range of trusted proxies
        foreach ($clientIps as $key => $clientIp) {
            // Remove port (unfortunately, it does happen)
            if (preg_match('{((?:\d+\.){3}\d+)\:\d+}', $clientIp, $match)) {
                $clientIps[$key] = $clientIp = $match[1];
            }
            if (IpUtils::checkIp($clientIp, self::$trustedProxies)) {
                unset($clientIps[$key]);
            }
        }
        // Now the IP chain contains only untrusted proxies and the client IP
        return $clientIps ? array_reverse($clientIps) : array($ip);
    }
    public function indexBySlug(Request $request, $studio_slug, $slug)
    {
        try {
            $me = $request->user();
            $master = StudioClass::whereHas('studio', function (Builder $query) use ($studio_slug) {
                $query->where('slug', $studio_slug);
            })->where('slug', $slug)
                ->entities($request->entities)
                ->first();

            // dd(Carbon::now()->isoFormat('dddd, MMMM Do YYYY, h:mm'));
            $bool = false;
            // dd(Carbon::now()->addMinutes(1)->toDateTimeString() === Carbon::now()->toDateTimeString());
            // dd(Carbon::now()->subMinutes(1)->toDateTimeString());

            $master->lastSee()->sync($request->user()->id);


            if (Carbon::now()->toDateTimeString() && $bool == false) {
                $master->increment('views');
                $bool = true;
            }

            // $new = new StudioClassController();
            // dd($new);

            if (Carbon::now()->isWeekend()) {
                $master->views = 0;
                // $master->lastSee()->update(['user_activity_id' => null]);
            }

            // $user = User::findOrFail($me->id)->whereDate('last_login', '<=', now());
            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function indexClasses(Request $request)
    {
        try {
            $master = StudioClass::entities($request->entities)
                ->filterBy($request->filter)
                ->search($request->q)
                ->statusClass($request->status_kelas)
                ->sort($request->sort)
                ->filterByDate($request->date)
                ->category($request->category_name)
                ->paginate($request->input('paginate', 3));
            // $master->appends(['search' => $search]);

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function indexSearch(Request $request)
    {
        try {
            $master = StudioClass::entities($request->entities)
                ->filterBy($request->filter)
                ->search($request->q)
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
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request, $slug)
    {
        try {
            $studio_slug = $slug;
            $master = StudioClass::entities($request->entities)
                ->search($request->q)
                ->findSLug($slug)
                ->filterBy($request->filter)
                ->filterByDate($request->date)
                ->paginate(3);

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    public function date(Request $request)
    {
        try {
            $slug_studio = $request->slug;
            $master = StudioClass::whereHas('studio', function (Builder $query) use ($slug_studio) {
                $query->where('slug', $slug_studio);
            })->get();

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
            $master = new StudioClass();
            $master->name = $request->name;
            $master->status = $request->status;
            $master->levels = $request->levels;
            $master->about = $request->about;
            $master->slug = \Str::slug($master->name);
            $master->author_id = $request->user()->id;
            $master->studio_id = $request->studio_id;
            $master->save();
            $master->instructor_v2()->attach($request->instructur_id);

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