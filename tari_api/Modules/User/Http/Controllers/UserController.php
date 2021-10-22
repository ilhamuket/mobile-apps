<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Role;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('superadministrator') ? true : null;
        });
    }

    public function summary(Request $request)
    {
        try {
            $master = User::selectRaw(
                '
                    count(id) as total,
                    (SELECT COUNT(*) from users inner join model_has_roles on users.id = model_has_roles.model_id where model_has_roles.role_id = 1) as superadmin,
                    (SELECT COUNT(*) from users inner join model_has_roles on users.id = model_has_roles.model_id where model_has_roles.role_id = 2) as admin,
                    (SELECT COUNT(*) from users inner join model_has_roles on users.id = model_has_roles.model_id where model_has_roles.role_id = 3) as instructor,
                    (SELECT COUNT(*) from users inner join model_has_roles on users.id = model_has_roles.model_id where model_has_roles.role_id = 4) as student
                '
            )->first();

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function indexAll(Request $request)
    {
        try {
            $master = User::with('roles')->summary($request->type)->get();

            return Json::response($master);
        } catch (\Spatie\Permission\Exceptions\UnauthorizedException $e) {
            return Json::response($e);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function me(Request $request)
    {
        try {
            $me = $request->user();
            $user = User::join('model_has_roles', 'model_has_roles.model_id', "=", "users.id")
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->entities($request->entities)
                // ->with('followingStudio.followers', 'followingStudio.likes', 'img', "followingStudio.img")
                ->select('users.*', 'roles.name as role_name')
                ->findOrFail($me->id);

            return Json::response($user);
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
            $role_id = $request->role_id;
            $master = User::whereHas('roles', function (Builder $query) use ($role_id) {
                $query->where('id', $role_id);
            })->with('roles')->get();

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
        return view('user::create');
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
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('user::edit');
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
            $master = User::findOrFail($id);

            $master->firstName = $request->input('firstName', $master->firstName);
            $master->lastName = $request->input('lastName', $master->lastName);
            $master->email = $request->input('email', $master->email);
            $master->homeAddress = $request->input('homeAddress', $master->homeAddress);
            $master->dateOfBirth = $request->input('dateOfBirth', $master->dateOfBirth);
            $master->nickName = $request->input('nickname', $master->nickName);
            $master->noHp = $request->input('noHp', $master->noHp);
            $master->about = $request->input('about', $master->about);
            $master->username_ig = $request->input('ig', $master->username_ig);
            $master->username_fb = $request->input('fb', $master->username_fb);
            $master->username_tw = $request->input('tw', $master->username_tw);
            $master->save();

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
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}