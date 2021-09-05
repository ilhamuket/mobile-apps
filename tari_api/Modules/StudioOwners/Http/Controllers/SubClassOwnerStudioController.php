<?php

namespace Modules\StudioOwners\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\StudioOwners\Entities\ClassesOwnerStudio;
use Modules\StudioOwners\Entities\OwnerStudio;
use Modules\StudioOwners\Entities\SubClassOwnerStudio;

class SubClassOwnerStudioController extends Controller
{
    public function approvedBroadcast(Request $request)
    {
        try {
            if (is_array($request->id)) {
                $id = [];
                $id = $request->id;
                foreach ($id as $class_id) {
                    $master = SubClassOwnerStudio::findOrFail($class_id);
                    $master->is_verified = true;
                    $master->status = "Publish";
                    $master->save();
                }
            } else {
                return Json::exception('Not Found');
            }
            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function delBroadcast(Request $request)
    {
        try {
            if (is_array($request->id)) {
                $id = [];
                $id = $request->id;
                foreach ($id as $studio_id) {
                    $master = SubClassOwnerStudio::findOrFail($studio_id);
                    $master->delete();
                }
            } else {
                return Json::exception('Not Found');
            }
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
            $data = [
                "all" => 0,
                'approved' => 0,
                'non_approved' => 0,
                "new" => 0,
            ];
            $me = $request->user();
            $studio = OwnerStudio::where('author_id', $me->id)->first();

            $data['all'] = SubClassOwnerStudio::join('studioclasses', 'studioclasses.id', '=', 'classes_schedule_studio.class_id')
                ->join('users', 'users.id', '=', 'studioclasses.author_id')
                ->select('classes_schedule_studio.*')
                ->where('studioclasses.studio_id', $studio->id)
                ->count();
            $data['approved'] = SubClassOwnerStudio::join('studioclasses', 'studioclasses.id', '=', 'classes_schedule_studio.class_id')
                ->join('users', 'users.id', '=', 'studioclasses.author_id')
                ->select('classes_schedule_studio.*')
                ->where('studioclasses.studio_id', $studio->id)
                ->where('classes_schedule_studio.is_verified', 1)
                ->count();
            $data['non_approved'] = SubClassOwnerStudio::join('studioclasses', 'studioclasses.id', '=', 'classes_schedule_studio.class_id')
                ->join('users', 'users.id', '=', 'studioclasses.author_id')
                ->select('classes_schedule_studio.*')
                ->where('studioclasses.studio_id', $studio->id)
                ->where('classes_schedule_studio.is_verified', 0)
                ->count();
            $data['new'] = SubClassOwnerStudio::join('studioclasses', 'studioclasses.id', '=', 'classes_schedule_studio.class_id')
                ->join('users', 'users.id', '=', 'studioclasses.author_id')
                ->select('classes_schedule_studio.*')
                ->where('studioclasses.studio_id', $studio->id)
                ->whereDate('classes_schedule_studio.created_at', now())
                ->count();

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
    public function index(Request $request)
    {
        try {
            $me = $request->user();
            $studio = OwnerStudio::where('author_id', $me->id)->first();
            $master = SubClassOwnerStudio::join('studioclasses', 'studioclasses.id', '=', 'classes_schedule_studio.class_id')
                ->join('users', 'users.id', '=', 'studioclasses.author_id')
                ->select('classes_schedule_studio.*')
                ->where('studioclasses.studio_id', $studio->id)
                ->entities($request->entities)
                ->summary($request->summary, $studio->id)
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
            $me = $request->user();
            $studio = OwnerStudio::where('author_id', $me->id)->first();
            $class = ClassesOwnerStudio::where('studio_id', $studio->id)->first();

            $master = new SubClassOwnerStudio();
            $master->title = $request->title;
            $master->about = $request->about;
            $master->status = $request->status;
            $master->time_start = $request->time_start;
            $master->time_end = $request->time_end;
            $master->icon = $request->icon;
            $master->color = $request->color;
            $master->duration = $request->duration;
            $master->class_id = $request->class_id;
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
        try {
            $master = SubClassOwnerStudio::findOrFail($id);
            $master->title = $request->input('title', $master->title);
            $master->status = $request->input('status', $master->status);
            $master->about = $request->input('about', $master->about);
            $master->time_start = $request->input('time_start', $master->time_start);
            $master->time_end = $request->input('time_end', $master->time_end);
            $master->color = $request->input('color', $master->color);
            $master->save();
            $master->classes();

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
        try {
            $master = SubClassOwnerStudio::findOrFail($id);
            $master->delete();

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
}