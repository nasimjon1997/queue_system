<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveCabinetRequest;
use App\Models\Cabinet;
use App\Models\QueueCabinet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QueueCabinetController extends Controller
{
    /**
     * Display a in queue page.
     *
     * @return Response
     */
    public function index()
    {
        $cabinets = Cabinet::all();
        return view('index',compact('cabinets'));
    }

    /**
     * Reserve cabinet.
     *
     * @return Response
     */
    public function reserve_cabinet(ReserveCabinetRequest $request)
    {
        $user = User::updateOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ],[
            'email' => $request->email,
        ]);
        $request['user_id'] = $user->id;
        $from_date_time = $request->from_date_time;
        $to_date_time = $request->to_date_time;
        $queue_cabinet = QueueCabinet::where('cabinet_id',$request->cabinet_id)
            ->where(function($query) use ($from_date_time,$to_date_time) {
                $query->where('from', '>=', $from_date_time)
                    ->where('from', '<=', $to_date_time);
                    })
            ->orWhere(function($query) use ($from_date_time,$to_date_time) {
                $query->where('to', '>=', $from_date_time)
                    ->where('to', '<=', $to_date_time);
                    })
           ->first();
        if ($queue_cabinet){
            $user_name = $queue_cabinet->user->name;
            $from_datetime = Carbon::parse($queue_cabinet->from)->format('Y-m-d H:i');
            $to_datetime = Carbon::parse($queue_cabinet->to)->format('Y-m-d H:i');
            return redirect()->route('home')->withInput()->with(['msg' => "Кабинет занят со стороны $user_name от $from_datetime до $to_datetime", 'class' => 'danger']);
        }
         QueueCabinet::create([
             'cabinet_id' => $request->cabinet_id,
             'user_id' => $user->id,
             'from' => $request->from_date_time,
             'to' => $request->to_date_time,
         ]);
        return redirect()->route('home')->withInput()->with(['msg' => 'Кабинет успешно бронирован', 'class' => 'success']);
    }
}
