<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Helpers\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * returns a list of Events and the linked Participants
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $validator = Validator::make($request->all(), Event::validationRulesIndex());
        if ($validator->passes()) {
            
            //Get items from the request and add to filter where
            $where = [];
            //get the passed start date, or use the current date
            if($request->has('start_date')) {
                $startDate = Carbon::createFromFormat('Y M j', $request->start_date)->format('Y-m-d');
                $where[] = ['event_date', '>=', $startDate ];
            }

            //Get the end date passed in the request, or use the date  6 months from now
            if($request->has('end_date'))   {
                $endDate = Carbon::createFromFormat('Y M j', $request->end_date)->format('Y-m-d');
                $where[] = ['event_date', '<=', $endDate ];
            }

            //If a query was passed in the URL, filter on it.
            if($request->has('query'))      {
                $escapedInput = (config('database.default') == 'mysql')? Util::escapeLike($request->input('query')) : $request->input('query') ; //% and _ characters are not escaped automatically. So escape them if using mysql.
                $where[] = ['name', 'like', '%'.$escapedInput."%" ];
            }

            //If no where variables are already set, return results for the last 6 months
            if(empty($where)) {
                $startDate = Carbon::now('America/Vancouver')->format('Y-m-d');
                $where[] = ['event_date', '>=', $startDate ];
                $endDate = Carbon::now('America/Vancouver')->addMonth(3)->format('Y-m-d');;
                $where[] = ['event_date', '<=', $endDate ];

            }

            //Get the appropriate events and participants
            $events = Event::where($where)->with(['participants' => function ($query) {
                return $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->limit(200); //Sanity check! We don't know the limit of the number of people who can attend an event, so don't allow more than 200 to be returned at once
            }])->orderBy('event_date', 'asc')->get();
            return $events;
        } else {
            //return the validator errors
            return response()->json(['error' => $validator->errors() ], 422);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
