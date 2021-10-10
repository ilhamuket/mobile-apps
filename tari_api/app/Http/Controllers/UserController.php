<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brryfrmnn\Transformers\Json;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $master = User::get();
        return Json::response($master);
    }
}