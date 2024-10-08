<?php

namespace Modules\StudioOwners\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Studio\Entities\CartClass;
use Modules\StudioOwners\Entities\OwnerStudio;

class CartClassController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            $studio = OwnerStudio::where('author_id', $user->id)->first();
            $cart = CartClass::whereHas('class', function (Builder $query) use ($studio) {
                $query->where('studio_id', $studio->id);
            })
                ->entities($request->entities)
                ->summary($request->summary)
                ->get();

            return Json::response($cart);
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
    public function summary(Request $request)
    {
        try {
            $data = [
                "all" => 0,
                "paid" => 0,
                "waiting_confirmation" => 0,
                "waiting_payment" => 0,
            ];
            $user = $request->user();
            $studio = OwnerStudio::where('author_id', $user->id)->first();
            $data['all'] = CartClass::whereHas('class', function (Builder $query) use ($studio) {
                $query->where('studio_id', $studio->id);
            })->count();
            $data["paid"] = CartClass::whereHas('class', function (Builder $query) use ($studio) {
                $query->where('studio_id', $studio->id);
            })->where('status', 'paid')->count();
            $data["waiting_confirmation"] = CartClass::whereHas('class', function (Builder $query) use ($studio) {
                $query->where('studio_id', $studio->id);
            })->where('status', 'waiting_confirmation')->count();
            $data["waiting_payment"] = CartClass::whereHas('class', function (Builder $query) use ($studio) {
                $query->where('studio_id', $studio->id);
            })->where('status', 'waiting_payment')->count();

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
        //
    }
}
