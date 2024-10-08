<?php

namespace Modules\Studio\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Studio\Entities\Reviews;

class ReviewController extends Controller
{
    public function summaryReviewStudio(Request $request, $slug_studio)
    {
        try {
            $data = [
                "five" => 0,
                "four" => 0,
                "third" => 0,
                "two" => 0,
                "one" => 0
            ];

            $data["five"] = Reviews::whereHas("studio", function (Builder $query) use ($slug_studio) {
                $query->where('slug', $slug_studio);
            })->where('ratings', '!=', null)
                ->where("ratings", 5)->count();
            $data["four"] = Reviews::whereHas("studio", function (Builder $query) use ($slug_studio) {
                $query->where('slug', $slug_studio);
            })->where('ratings', '!=', null)
                ->where("ratings", 4)->count();
            $data["third"] = Reviews::whereHas("studio", function (Builder $query) use ($slug_studio) {
                $query->where('slug', $slug_studio);
            })->where('ratings', '!=', null)
                ->where("ratings", 3)->count();
            $data["two"] = Reviews::whereHas("studio", function (Builder $query) use ($slug_studio) {
                $query->where('slug', $slug_studio);
            })->where('ratings', '!=', null)
                ->where("ratings", 2)->count();
            $data["one"] = Reviews::whereHas("studio", function (Builder $query) use ($slug_studio) {
                $query->where('slug', $slug_studio);
            })->where('ratings', '!=', null)
                ->where("ratings", 1)->count();
            $data["all"] = Reviews::whereHas("studio", function (Builder $query) use ($slug_studio) {
                $query->where('slug', $slug_studio);
            })->where('ratings', '!=', null)
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
    public function avarage(Request $request, $studio_slug)
    {
        try {
            $data = [
                "float" => 0,
                "avarage" => 0,
                "sum" => 0,
            ];
            $avarage = Reviews::whereHas('studio', function (Builder $query) use ($studio_slug) {
                $query->where('slug', $studio_slug);
            })->where('ratings', '!=', null)->pluck('ratings')->avg();

            $sum = Reviews::whereHas('studio', function (Builder $query) use ($studio_slug) {
                $query->where('slug', $studio_slug);
            })->where('ratings', '!=', null)->pluck('ratings')->sum();

            $data["float"] = number_format($avarage, 2, ',', ' ');
            $data["avarage"] = $avarage;
            $data['sum'] = $sum;

            return Json::response($data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function reviewsStudio(Request $request, $studio_slug)
    {
        try {
            $reviews = Reviews::whereHas('studio', function (Builder $query) use ($studio_slug) {
                $query->where('slug', $studio_slug);
            })->entities($request->entities)
                ->where('ratings', '!=', null)
                ->paginate($request->input("paginate", 3));

            // dd(array_sum(array($reviews['ratings'])));
            // $arr = array($reviews);
            // foreach ($reviews as $e) {
            //     $ratings = $e['ratings'];
            //     dd($ratings);
            //     $x += $ratings;
            // }

            return Json::response($reviews);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    public function dataReviewForRating(Request $request, $studio_slug)
    {
        try {
            $master = Reviews::whereHas('studio', function (Builder $query) use ($studio_slug) {
                $query->where('slug', $studio_slug);
            })->entities($request->entities)
                ->where('ratings', '!=', null)
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
    public function byClass(Request $request, $class_slug)
    {
        try {
            $master = Reviews::whereHas('class', function (Builder $query) use ($class_slug) {
                $query->where('slug', $class_slug);
            })
                ->where('ratings', '!=', null)
                ->entities($request->entities)
                ->orderBy('created_at', 'desc')
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
    public function myReviews(Request $request)
    {
        try {
            $master = Reviews::where('user_id', $request->user()->id)
                ->entities($request->entities)
                ->paginate($request->input("paginate", 2));

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
            $master = new Reviews();
            $master->body = $request->body;
            $master->ratings = $request->ratings;
            $master->class_id = $request->class_id;
            $master->status = 'belum ditanggapi';
            $master->studio_id = $request->studio_id;
            $master->user_id = $request->user()->id;
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
