<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\PasswordReset;
use Modules\User\Notifications\PasswordResetRequest;
use Modules\User\Notifications\PasswordResetSuccess;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;

class PasswordResetController extends Controller
{
    public function create(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) return Json::exception("We cant find a user with that e-mail address.", null, false, 404);
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(40)
            ]
        );
        if ($user && $passwordReset) {
            $user->notify(
                new PasswordResetRequest($passwordReset->token)
            );
        }
        return Json::response(null, 'We have e-mailed your password reset link!');
    }

    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset)
            return Json::exception("This password reset token is invalid.", null, false, 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return Json::exception("This password reset token is invalid.", null, false, 404);
        }
        return Json::response($passwordReset);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'token' => 'required|string'
        ]);
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();
        if (!$passwordReset)
            return Json::exception("This password reset token is invalid.", null, false, 404);
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)
            return Json::exception("This password reset token is invalid.", null, false, 404);
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->where([
            ['token', $request->token],
            ['email', $request->email]
        ])->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));

        return Json::response(null, 'We have reset your password');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('user::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    // public function create()
    // {
    //     return view('user::create');
    // }

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