<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use Illuminate\Support\Facades\Auth;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        //$events = Event::where('user_id', $user->id);
        $events = Event::get()->where('user_id', $user->id);
        $event_list = [];
        foreach($events as $event){
            $event_list[] = Calendar::event(
            $event->event_name,
            true,
            new \DateTime($event->start_date),
            new \DateTime($event->end_date.' +1 day')
            );
        }
        $calendar_details = Calendar::addEvents($event_list);
        return view('/calendar/events')->with('calendar_details', $calendar_details);
        
    }

    public function addEvent(Request $request)
    {
        $this->validate($request, [
            'event_name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        
        //Change date fromat for DB
        $originalDate = $request->start_date;
        $newDate = date("Y-m-d", strtotime($originalDate));
        $originalDateEnd = $request->end_date;
        $newDateEnd = date("Y-m-d", strtotime($originalDateEnd));

        $event = new Event;
        $event->event_name = $request->input('event_name');
        $event->start_date = $newDate;
        $event->end_date = $newDateEnd;
        $event->user_id = auth()->user()->id;

        $event->save();

        return redirect('/calendar')->with('success', 'Entry Created');

    }
}
