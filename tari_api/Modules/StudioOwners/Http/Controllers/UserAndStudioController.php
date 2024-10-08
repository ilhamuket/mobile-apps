<?php

namespace Modules\StudioOwners\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\StudioOwners\Entities\UserHaveClass;

class UserAndStudioController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function studioHasUser(Request $request, $studio_id)
    {
        try {
            $master = UserHaveClass::whereHas('classes', function (Builder $query) use ($studio_id) {
                $query->where('studio_id', $studio_id);
            })
                ->entities(
                    $request->entities
                )
                ->summaryStudioHasUser($request->summary, $studio_id)
                ->get();

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
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function summary(Request $request, $studio_id)
    {
        try {
            $data = [
                "all" => 0,
                "paid" => 0,
                "pending" => 0,
                "new" => 0,
            ];

            $data["all"] = UserHaveClass::whereHas("classes", function (Builder $query) use ($studio_id) {
                $query->where('studio_id', $studio_id);
            })
                ->count();

            $data["paid"] = UserHaveClass::whereHas("classes", function (Builder $query) use ($studio_id) {
                $query->where("studio_id", $studio_id);
            })->whereHas('form.cart', function (Builder $query) {
                $query->where('status', 'paid');
            })->count();

            $data["pending"] = UserHaveClass::whereHas("classes", function (Builder $query) use ($studio_id) {
                $query->where("studio_id", $studio_id);
            })->whereHas('form.cart', function (Builder $query) {
                $query->where('status', 'pending');
            })->count();

            $data["new"] = UserHaveClass::whereDate("created_at", now())->count();

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
