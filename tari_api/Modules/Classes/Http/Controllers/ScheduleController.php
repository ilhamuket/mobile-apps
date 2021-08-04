<?php

namespace Modules\Classes\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Classes\Entities\Schedule;
use Modules\Media\Entities\Category;

class ScheduleController extends Controller
{
    public function autoPlay(Request $request)
    {
        try {
            $me = $request->user();

            $start_at = now()->toString();
            // dd($start_at);
            $schedules = Schedule::where('student_id', $me->id)
                // ->with('classes', 'student')
                ->first();
            // dd(is_object($schedules));
            if (is_object($schedules)) {
                $master = Schedule::where('schedules.id', $request->input('schedule_id', $schedules->id))
                    ->join('classes', 'classes.id', '=', 'schedules.class_id')
                    ->join('posts', 'posts.class_id', '=', 'classes.id')
                    ->join('users', 'users.id', '=', 'posts.author_id')
                    ->select(
                        'schedules.*',
                        'posts.id as post_id',
                        'posts.url',
                        'posts.title_yt',
                        'posts.thumbnail_url',
                        'users.firstName as author_first_name',
                        'users.lastName as author_last_name',
                        'classes.type as class_type'
                    )->first();
            } else {
                return Json::response([]);
            }



            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function haveSchedules(Request $request)
    {
        try {
            $me = $request->user();

            // dd($me->id);
            // $schedules = Schedule::join('classes', 'classes.id', '=', 'schedules.class_id')
            //     ->select('schedules.*', 'classes.id as class_id')
            //     ->where('schedules.student_id', $me->id)
            //     // ->where('status', $request->status)
            //     ->with('classes', 'student', 'posts')
            //     ->search($request->search)
            //     ->get();

            $master = Schedule::join('classes', 'classes.id', '=', 'schedules.class_id')
                ->join('posts', 'posts.class_id', '=', 'classes.id')
                ->join('users', 'users.id', '=', 'posts.author_id')
                ->where('schedules.student_id', $me->id)
                ->select(
                    'schedules.*',
                    'posts.id as post_id',
                    'posts.url',
                    'posts.title_yt',
                    'posts.thumbnail_url',
                    'users.firstName as author_first_name',
                    'users.lastName as author_last_name',
                    'classes.type as class_type'
                )
                ->date($request->start_at)
                ->orderBy('schedules.id', 'asc')
                ->get();

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
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
            dd($me->hasRole('admin'));
            $master = Schedule::with('student', 'classes')->get();

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
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
        return view('classes::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {

            $schedule = new Schedule();
            $schedule->name = $request->name;
            $schedule->start_at = $request->start_at;
            $schedule->time_start = $request->time_start;
            $schedule->end_at = $request->end_at;
            $schedule->time_end = $request->time_end;
            $schedule->student_id = $request->user()->id;
            $schedule->save();
            $schedule->classes()->attach($request->class_id);
            $schedule->classes;

            $master = Schedule::join('class_schedules', 'schedules.id', '=', 'class_schedules.schedule_id')
                ->select('schedules.*', 'class_schedules.class_id as class_id')
                ->with('classes', 'student')
                ->findOrFail($schedule->id);

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
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
        return view('classes::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('classes::edit');
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