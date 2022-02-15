<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use App\Modules\User\Notifications\PasswordResetSuccess;
use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\User\Notifications\VerifiedAccount;
use Modules\User\Notifications\VerifiedStudio;

class VerificationEmailController extends Controller
{
    public function verificationsEmail(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!$request->user()->hasVerifiedEmail()) {
                $me = $request->user();
                $master = User::findOrFail($me->id);
                $master->email_verified_at = now();
                $master->isVerified = true;
                $master->save();
                DB::commit();
                return Json::response($master, 'Your Accaount has been Verified And Enjoy Ensiklotari Website :)');
            }
            return Json::exception('err');
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

    public function resend(Request $request)
    {
        // $request->user()->sendEmailVerificationNotification();
        $request->user()->notify(new VerifiedAccount($request->user()));
        return Json::response('Send Notifications Successfull');
    }

    public function resendStudio(Request $request)
    {
        $request->user()->notify(new VerifiedStudio());
        return Json::response('Send Notification Successfull');
    }
}
