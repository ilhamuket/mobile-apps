<?php

namespace Modules\StudioOwners\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Studio\Entities\Reviews;
use Modules\StudioOwners\Entities\OwnerStudio;
use Modules\StudioOwners\Entities\ReviewOwner;

class ReviewOwnerController extends Controller
{
    public function replyReviewsClassVidio(Request $request, $class_id)
    {
        try {
            $master = new Reviews();
            $master->body = $request->body;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function showReviewsClassVidio(Request $request, $class_slug)
    {
        try {
            $master = ReviewOwner::whereHas('classVidio', function (Builder $query) use ($class_slug) {
                $query->where('slug', $class_slug);
            })
                ->where('status', '!=', "sembunyikan")
                ->where('ratings', '!=', null)
                ->entities($request->entities)
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
    public function summaryByClass(Request $request, $class_id)
    {
        try {
            $data = [
                "five" => 0,
                "four" => 0,
                "third" => 0,
                "two" => 0,
                "one" => 0,
                "all" => 0,
            ];
            $data["five"] = ReviewOwner::whereHas('classVidio', function (Builder $query) use ($class_id) {
                $query->where('slug', $class_id);
            })
                ->where('ratings', '!=', null)
                ->where("ratings", 5)
                ->count();
            $data["four"] = ReviewOwner::whereHas('classVidio', function (Builder $query) use ($class_id) {
                $query->where('slug', $class_id);
            })
                ->where('ratings', '!=', null)
                ->where("ratings", 4)
                ->count();
            $data["third"] = ReviewOwner::whereHas('classVidio', function (Builder $query) use ($class_id) {
                $query->where('slug', $class_id);
            })
                ->where('ratings', '!=', null)
                ->where("ratings", 3)
                ->count();
            $data["two"] = ReviewOwner::whereHas('classVidio', function (Builder $query) use ($class_id) {
                $query->where('slug', $class_id);
            })
                ->where('ratings', '!=', null)
                ->where("ratings", 2)
                ->count();
            $data["one"] = ReviewOwner::whereHas('classVidio', function (Builder $query) use ($class_id) {
                $query->where('slug', $class_id);
            })
                ->where('ratings', '!=', null)
                ->where("ratings", 1)
                ->count();
            $data["all"] = ReviewOwner::whereHas('classVidio', function (Builder $query) use ($class_id) {
                $query->where('slug', $class_id);
            })
                ->where('ratings', '!=', null)
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
    public function deleteAll(Request $request)
    {
        try {
            if (is_array($request->id)) {
                foreach ($request->id as $id) {
                    $master = ReviewOwner::findOrFail($id);
                    $master->delete();
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
    public function hide(Request $request)
    {
        try {
            // dd(is_array($request->id));
            if (is_array($request->id)) {
                foreach ($request->id as $id) {
                    $master = ReviewOwner::findOrFail($id);
                    $master->status = 'sembunyikan';
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

    public function show(Request $request)
    {
        try {
            if (is_array($request->id)) {
                foreach ($request->id as $id) {
                    $master = ReviewOwner::findOrFail($id);
                    if ($master['status'] === 'sembunyikan') {
                        if ($master['is_response'] === 1) {
                            $master->status = 'ditanggapi';
                            $master->save();
                        } else {
                            $master->status = 'belum ditanggapi';
                            $master->save();
                        }

                        return Json::response($master);
                    } else {
                        return Json::exception('data not found');
                    }
                }
            } else {
                return Json::exception('data must be array');
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
     */
    public function index(Request $request)
    {
        try {
            $studios = OwnerStudio::where('author_id', $request->user()->id)->first();
            $master = ReviewOwner::where('studio_id', $studios->id)
                ->entities($request->entities)
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
            $master = new ReviewOwner();
            $master->body = $request->body;
            $master->ratings = $request->ratings;
            $master->class_id = $request->class_id;
            $master->status = 'studio';
            $master->studio_id = $request->studio_id;
            $master->user_id = $request->user()->id;
            $master->save();
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
    // public function show($id)
    // {
    //     return view('studioowners::show');
    // }

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
        try {
            $master = ReviewOwner::findOrFail($id);
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
}