<?php

namespace Modules\Administrator\Http\Controllers;

use Brryfrmnn\Transformers\Json;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Payment\Entities\Payment;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        try {
            $inputDate = $request->date;
            // dd($inputDate);
            $date = new Carbon($request->input('date', now()));
            // dd($date->addDay(2)->format('y-m-d'));
            // dd(now()); 

            // $weekNumber = $date->weekNumberInMonth;
            // $start = $date->startOfWeek()->toDateString();
            // $end = $date->endOfWeek()->toDateString();

            // dump($weekNumber);
            // dump($start);
            // dump($end);

            // dump('today : ' . $date->toDateString() . ' week : ' .  $date->addDays(7)->toDateString());
            // dump("now " . now()->toDateString());
            $payment = 0;
            $data = [
                0 => 0,
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0
            ];

            // $weekNumber = $date->weekNumberInMonth;
            // $start = $date->startOfWeek()->toDateString();

            // $curent = $date->startOfWeek();
            // dump($weekNumber);
            // dump($start . ' - ' . $date->endOfWeek()->toDateString());
            // dump('start day :  ' . $date->startOfWeek()->format('l'));
            // dump("tomoronw : " . $date->addDays(1)->format('l'));

            // $data[0] = Payment::whereBetween('created_at', [Carbon::now(), Carbon::now()->addDays()])->count();
            // $data[1] = Payment::whereBetween('created_at', [Carbon::now()->addDays(7), Carbon::now()->addDays(14)])->count();

            $data[0] = Payment::whereDate('created_at', now())->count();
            // $data[1] = Payment::whereDate('created_at', '==', $date->addDays(1)->format('y-m-d'))->count();
            // $data[2] = Payment::whereDate('created_at', '==', $date->addDays(2)->format('y-m-d'))->count();
            // $data[3] = Payment::whereDate('created_at', '==', $date->addDays(3)->format('y-m-d'))->count();
            // $data[4] = Payment::whereDate('created_at', '==', $date->addDays(4)->format('y-m-d'))->count();
            // $data[5] = Payment::whereDate('created_at', '==', $date->addDays(5)->format('y-m-d'))->count();
            // $data[6] = Payment::whereDate('created_at', '==', $date->addDays(6)->format('y-m-d'))->count();
            // dd($data[6]);
            // $data[6  ] = Payment::where('created_at', $date->addDays(6))->count();
            // dd($);

            return Json::response($data);
        } catch (\Spatie\Permission\Exceptions\UnauthorizedException $e) {
            return Json::exception('Error UnauthorizedException ' . $debug = env('APP_DEBUG', false) == true ? $e : '');
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
        return view('administrator::create');
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
        return view('administrator::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('administrator::edit');
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
