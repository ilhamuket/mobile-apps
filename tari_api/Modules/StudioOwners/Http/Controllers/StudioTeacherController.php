<?php

namespace Modules\StudioOwners\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Modules\StudioOwners\Entities\ImgInstructor;
use Modules\StudioOwners\Entities\OwnerStudio;
use Modules\StudioOwners\Entities\StudioTeacher;
use Symfony\Component\VarDumper\Caster\ImgStub;

class StudioTeacherController extends Controller
{
    public function uploadImg(Request $request)
    {
        try {
            $master = new ImgInstructor();
            $path = $request->img->store('images/user');
            $master->url = $path;
            $master->instructor_id = $request->instructor_id;
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

    public function changeImg(Request $request, $instructor_id)
    {
        try {
            DB::beginTransaction();
            $img = ImgInstructor::where('instructor_id', $instructor_id)->first();
            $newArr = explode('/', $img->url);

            $image_path = $newArr[3] . '/' . $newArr[4] . '/' . $newArr[5];


            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $img->delete();

            $master = new ImgInstructor();
            $master->url = $request->img->store('images/user');
            $master->instructor_id = $instructor_id;
            $master->save();

            DB::commit();
            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            DB::rollBack();
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    public function deletedBroadCast(Request $request)
    {
        if (is_array($request->id)) {
            $id = [];
            $id = $request->id;
            foreach ($id as $teacher_id) {
                $master = StudioTeacher::findOrFail($teacher_id);
                $master->delete();
            }
            return Json::response($master);
        } else {
            return Json::exception("Not Found");
        }
    }
    public function approvedBroadcast(Request $request)
    {
        try {
            if (is_array($request->id)) {
                $id = [];
                $id = $request->id;
                foreach ($id as $teacher_id) {
                    $master = StudioTeacher::findOrFail($teacher_id);
                    $master->is_verified = true;
                    $master->save();
                }
                return Json::response($master);
            } else {
                return Json::exception("Not Found");
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function approved(Request $request, $id)
    {
        try {
            $master = StudioTeacher::findOrFail($id);
            $master->is_verified = true;
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
    public function deactive(Request $request, $id)
    {
        try {
            $master = StudioTeacher::findOrFail($id);
            $master->is_verified = false;
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
    public function summary(Request $request)
    {
        try {
            $data = [
                "all" => 0,
                'approved' => 0,
                "non_approved" => 0,
                "new" => 0,
            ];
            $me = $request->user();
            $studio = OwnerStudio::where('author_id', $me->id)->first();

            $data['all'] = StudioTeacher::where('studio_id', $studio->id)->count();
            $data['approved'] = StudioTeacher::where([
                ['studio_id', $studio->id],
                ['is_verified', 1]
            ])->count();
            $data['non_approved'] = StudioTeacher::where([
                ['studio_id', $studio->id],
                ['is_verified', 0]
            ])->count();
            $data["new"] = StudioTeacher::where([
                ['studio_id', $studio->id],
            ])->whereDate('created_at', now())
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
            $master = StudioTeacher::entities($request->entities)
                ->where('studio_id', $studio->id)
                ->summary($request->summary, $studio)
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
            $master = new StudioTeacher();
            $master->name = $request->name;
            $master->email = $request->email;
            $master->region = $request->region;
            $master->contact = $request->contact;
            $master->profession = $request->profession;
            $master->about = $request->about;
            $master->studio_id = $studio->id;
            $master->slug =
                \Str::slug($request->name);
            $master->save();
            $master->studio;

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
    public function show(Request $request, $slug)
    {
        try {
            $master = StudioTeacher::entities($request->entities)
                ->where('slug', $slug)
                ->first();


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
            $teacher = StudioTeacher::findOrFail($id);
            $teacher->name = $request->input('name', $teacher->name);
            $teacher->email = $request->input('email', $teacher->email);
            $teacher->region = $request->input('region', $teacher->region);
            $teacher->contact = $request->input('contact', $teacher->contact);
            $teacher->profession = $request->input('profession', $teacher->profession);
            $teacher->about = $request->input('about', $teacher->about);
            $teacher->username_fb = $request->input('username_fb', $teacher->username_fb);
            $teacher->username_ig = $request->input('username_ig', $teacher->username_ig);
            $teacher->username_tw = $request->input('username_tw', $teacher->username_tw);
            $teacher->save();

            return Json::response($teacher);
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
            $studio = StudioTeacher::findOrFail($id);
            $studio->delete();
            return Json::response($studio);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
}
