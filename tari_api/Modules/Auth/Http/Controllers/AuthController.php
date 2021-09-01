<?php

namespace Modules\Auth\Http\Controllers;

use App\Models\User;
use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Entities\ModelHasRoles;
use Illuminate\Auth\Events\Registered;
use Modules\User\Http\Controllers\VerificationEmailController;
use Modules\User\Notifications\VerifiedAccount;

class AuthController extends Controller
{
    public function registerForUser(Request $request)
    {
        try {
            $master = new User();
            $master->email = $request->email;
            $master->firstName = $request->firstName;
            $master->lastName = $request->lastName;
            $master->password = Hash::make($request->password);
            $master->nickName = $request->nickName;
            $master->noHp = $request->noHp;
            $master->save();
            $master->assignRole('user');

            $master->notify(new VerifiedAccount($master));

            // $verification = new VerificationEmailController();
            // $verification->verificationsEmail();
            $accessToken = $master->createToken('auth')->plainTextToken;

            return Json::response($accessToken);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? e : '');
        }
    }
    public function registerAsInstructor(Request $request)
    {
        try {
            DB::beginTransaction();
            $master = new User();
            $master->email = $request->email;
            $master->firstName = $request->firstName;
            $master->lastName = $request->lastName;
            $master->password = Hash::make($request->password);
            $master->dateOfBirth = $request->input('dateOfBirth', now());
            $master->homeAddress = $request->homeAddress;
            $master->nickName = $request->nickName;
            $master->noHp = $request->noHp;
            $master->save();
            $master->assignRole('instructor');

            event(new Registered($master));
            $accessToken = $master->createToken('auth')->plainTextToken;
            DB::commit();
            return Json::response($accessToken);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return  Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            DB::rollBack();
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function registerAsAdmin(Request $request)
    {
        try {
            DB::beginTransaction();
            $master = new User();
            $master->email = $request->email;
            $master->firstName = $request->firstName;
            $master->lastName = $request->lastName;
            $master->password = Hash::make($request->password);
            $master->dateOfBirth = $request->input('dateOfBirth', now());
            $master->homeAddress = $request->homeAddress;
            $master->nickName = $request->nickName;
            $master->noHp = $request->noHp;
            $master->save();
            $master->assignRole('superadmin');
            DB::commit();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return  Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            DB::rollBack();
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }
    public function changePassword(Request $request)
    {
        try {
            $user = $request->user();

            $checkPassword = Hash::check($request->password, $user->password);

            if (!$checkPassword) {
                return Json::exception('Your Password Not Found And Filled Again');
            }
            $master = User::find($user->id);
            $master->password = $request->new_password ? Hash::make($request->new_password) : $master->password;

            $master->save();

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? e : '');
        }
    }
    public function registerAsSuperAdmin(Request $request)
    {
        try {
            DB::beginTransaction();
            $master = new User();
            $master->email = $request->email;
            $master->firstName = $request->firstName;
            $master->lastName = $request->lastName;
            $master->password = Hash::make($request->password);
            $master->dateOfBirth = $request->input('dateOfBirth', now());
            $master->homeAddress = $request->homeAddress;
            $master->nickName = $request->nickName;
            $master->noHp = $request->noHp;
            $master->save();
            $master->assignRole('admin');
            DB::commit();
            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return  Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            DB::rollBack();
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }


    public function register(Request $request)
    {
        try {
            $master = new User();
            $master->firstName = $request->firstName;
            $master->lastName = $request->lastName;
            $master->email = $request->email;
            $master->password = Hash::make($request->password);
            $master->dateOfBirth = $request->dateOfBirth;
            $master->homeAddress = $request->homeAddress;
            $master->save();

            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Model ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? e : '');
        }
    }

    public function login(Request $request)
    {
        try {
            $check = User::where('email', $request->email)->orWhere('nickName', $request->email)->first();

            if (!$check || !Hash::check($request->password, $check->password)) {
                return Json::exception('Password Anda salah');
            }
            $check->last_login = now();
            $check->save();

            $master = $check->createToken('auth')->plainTextToken;
            return Json::response($master);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    public function studioLogin(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->orWhere('nickName', $request->email)->first();


            if ($user) {
                if ($user->hasRole('studio')) {
                    if (!$user || !Hash::check($request->password, $user->password)) {
                        return Json::exception('Password Anda salah');
                    }
                    $user->last_login = now();
                    $user->save();
                    $master = $user->createToken('auth')->plainTextToken;
                    return Json::response($master);
                } else {
                    return Json::exception('Password atau email anda salah');
                }
            } else {
                return Json::exception('Akun Anda tidak terdaftar');
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Json::exception('Error Exceptions ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\Illuminate\Database\QueryException $e) {
            return Json::exception('Error Query ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        } catch (\ErrorException $e) {
            return Json::exception('Error Exception ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
        }
    }

    public function logout(Request $request)
    {
        $data = $request->user()->currentAccessToken()->delete();
        return Json::response($data);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('auth::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('auth::create');
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
        return view('auth::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('auth::edit');
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