<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveCabinetRequest;
use App\Mail\SendMail;
use App\Models\Cabinet;
use App\Models\QueueCabinet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            'email' => $request->email,
        ],[
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        $request['user_id'] = $user->id;
        $from_date_time = $request->from_date_time;
        $to_date_time = $request->to_date_time;
        $cabinet_id = $request->cabinet_id;
        $queue_cabinet = QueueCabinet::
            where(function($query) use ($from_date_time,$to_date_time,$cabinet_id) {
                $query->where('from', '>=', $from_date_time)
                    ->where('from', '<=', $to_date_time)
                    ->where('cabinet_id',$cabinet_id);
                    })
            ->orWhere(function($query) use ($from_date_time,$to_date_time,$cabinet_id) {
                $query->where('to', '>=', $from_date_time)
                    ->where('to', '<=', $to_date_time)
                    ->where('cabinet_id',$cabinet_id);
                    })
           ->first();
        if ($queue_cabinet){
            $user_name = $queue_cabinet->user->name;
            $from_datetime = Carbon::parse($queue_cabinet->from)->format('Y-m-d H:i');
            $to_datetime = Carbon::parse($queue_cabinet->to)->format('Y-m-d H:i');
            return redirect()->route('home')->withInput()->with(['msg' => "Кабинет занят со стороны $user_name от $from_datetime до $to_datetime", 'class' => 'danger']);
        }
         $queue_cabinet =QueueCabinet::create([
             'cabinet_id' => $request->cabinet_id,
             'user_id' => $user->id,
             'from' => $request->from_date_time,
             'to' => $request->to_date_time,
         ]);
        $toEmail = "получатель@yandex.ru";


        // Generate message for mail
        $from_datetime = Carbon::parse($queue_cabinet->from)->format('Y-m-d H:i');
        $to_datetime = Carbon::parse($queue_cabinet->to)->format('Y-m-d H:i');
        $cabinet = $queue_cabinet->cabinet->name;
        $message = "$cabinet успешно бронирован от $from_datetime до $to_datetime";
        //Send message to mail
        Mail::to($toEmail)->send(new SendMail($message));
        return redirect()->route('home')->with(['msg' => "Кабинет успешно бронирован", 'class' => 'success']);
    }
}
