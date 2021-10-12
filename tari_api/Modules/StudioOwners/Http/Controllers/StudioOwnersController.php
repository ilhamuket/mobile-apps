<?php

namespace Modules\StudioOwners\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Studio\Entities\Reviews;
use Modules\StudioOwners\Entities\BankAccount;
use Modules\StudioOwners\Entities\ClassesOwnerStudio;
use Modules\StudioOwners\Entities\DiscussOwner;
use Modules\StudioOwners\Entities\OwnerStudio;
use Modules\StudioOwners\Entities\StudioOwnerCategory;
use Modules\StudioOwners\Entities\StudioOwnerVidio;
use Modules\StudioOwners\Entities\StudioTeacher;

class StudioOwnersController extends Controller
{
    public function summaryRatings(Request $request)
    {
        try {
            $data = [
                "5" => 0,
                "4" => 0,
                "3" => 0,
                "2" => 0,
                "1" => 0,
            ];

            $studio = OwnerStudio::where('author_id', $request->user()->id)->first();

            $data["5"] = Reviews::where('studio_id', $studio->id)->where('ratings', 5)->count();
            $data["4"] = Reviews::where('studio_id', $studio->id)->where('ratings', 4)->count();
            $data["3"] = Reviews::where('studio_id', $studio->id)->where('ratings', 3)->count();
            $data["2"] = Reviews::where('studio_id', $studio->id)->where('ratings', 2)->count();
            $data["1"] = Reviews::where('studio_id', $studio->id)->where('ratings', 1)->count();

            return Json::response($data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function response(Request $request)
    {
        try {
            $studio = OwnerStudio::where('author_id', $request->user()->id)->first();
            $master = Reviews::where('studio_id', $studio->id)->get();

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function summary(Request $request)
    {
        try {
            $me = $request->user();
            $studio = OwnerStudio::where('author_id', $me->id)->first();
            $data = [
                'classes' => 0,
                'instructor' => 0,
                'category' => 0,
                'vidio_profile' => 0,
                'reviews' => 0,
                "discuss" => 0,
                "bank_account" => 0
            ];

            $data['classes'] = ClassesOwnerStudio::whereHas('studio', function (Builder $query) use ($studio) {
                $query->where('id', $studio->id);
            })->count();
            $data['instructor'] = StudioTeacher::whereHas('studio', function (Builder $query) use ($studio) {
                $query->where('id', $studio->id);
            })->count();
            $data['category'] = StudioOwnerCategory::whereHas('studio', function (Builder $query) use ($studio) {
                $query->where('id', $studio->id);
            })->count();
            $data['vidio_profile'] = StudioOwnerVidio::whereHas('studio', function (Builder $query) use ($studio) {
                $query->where('id', $studio->id);
            })->count();
            $data['discuss'] = DiscussOwner::whereHas('class', function (Builder $query) use ($studio) {
                $query->where('studio_id', $studio->id);
            })->count();
            $data['reviews'] = Reviews::whereHas('studio', function (Builder $query) use ($studio) {
                $query->where('id', $studio->id);
            })->count();
            $data["bank_account"] = BankAccount::whereHas('studio', function (Builder $query) use ($studio) {
                $query->where('id', $studio->id);
            })->count();

            return Json::response($data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function meStudio(Request $request)
    {
        try {
            $me = $request->user();
            $studios = OwnerStudio::where('author_id', $me->id)
                ->entities($request->entities)
                ->first();
            return Json::response($studios);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
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
        return view('studioowners::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {
        try {
            $me = $request->user();
            $master = OwnerStudio::where('author_id', $me->id)->first();
            $master->name = $request->input('name', $master->name);
            $master->isVerified = $request->input('isVerified', $master->isVerified);
            $master->prefix = $request->input('prefix', $master->prefix);
            $master->email = $request->input('email', $master->email);
            $master->contact = $request->input('contact', $master->contact);
            $master->about = $request->input('about', $master->about);
            $master->address = $request->input('address', $master->address);
            $master->username_ig = $request->input('ig', $master->username_ig);
            $master->username_fb = $request->input('fb', $master->username_fb);
            $master->username_tw = $request->input('tw', $master->username_tw);
            $master->save();

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
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