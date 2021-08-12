<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use Brryfrmnn\Transformers\Json;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

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
                return Json::response($master, 'Your Accaoun has been Verified And Enjoy Ensiklotari Website :)');
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
        $request->user()->sendEmailVerificationNotification();
        return Json::response('resend Token');
    }
}