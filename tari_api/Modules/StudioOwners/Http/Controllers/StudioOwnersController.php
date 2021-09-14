<?php

namespace Modules\StudioOwners\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\StudioOwners\Entities\ClassesOwnerStudio;
use Modules\StudioOwners\Entities\OwnerStudio;
use Modules\StudioOwners\Entities\StudioTeacher;

class StudioOwnersController extends Controller
{
    public function summary(Request $request)
    {
        try {
            $me = $request->user();
            $studio = OwnerStudio::where('author_id', $studio->id)->first();
            $data = [
                'classes' => 0,
                'instructor' => 0,
                'vidio_classes' => 0,
                'vidio_profile' => 0,
            ];

            $data['classes'] = ClassesOwnerStudio::whereHas('studio', function (Blueprint $query) use ($studio) {
                $query->where('id', $studio->id);
            })->count();
            $data['instructor'] = StudioTeacher::whereHas('studio', function (Blueprint $query) use ($studio) {
                $query->where('id', $studio);
            })->count();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('studioowners::index');
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