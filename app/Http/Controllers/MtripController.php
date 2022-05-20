<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Cache;

class MtripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$trip_arr = [];
		if(Cache::get("trip")){
			$trip_arr = Cache::get("trip");
		}
		if(count($trip_arr)>0)
		{
			
			$data = $trip_arr;
		}
		else
		{
			$data = $trip_arr;
			$data = Trip::latest()->get();
			Cache::put("trip",$data);
		}
		
		return response()->json(['result'=>$data]);
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
        $validator = Validator::make($request->all(), [

              'title' => 'required|min:3',
			  'where.origin' => 'required|min:3',
			  'where.destination' => 'required|min:3',
			  'type' => 'required|min:3',
			  'schedule.start'=>'required|date_format:Y-m-d H:i:s',
			  'schedule.end'=>'required|date_format:Y-m-d H:i:s',
        ]);
		
		
		if ($validator->passes()) {
			
			$trip = new Trip;
			$trip->title  = $request->title;
			$trip->origin = ($request->where)["origin"];
			$trip->destination  = ($request->where)["destination"];
			$trip->startDatetime  = ($request->schedule)["start"];
			$trip->endDatetime  = ($request->schedule)["end"];
			$trip->type  = $request->type;
			if($request->description){
				$trip->description  = $request->description;
			}
			$trip->save();
			$data = Trip::latest()->get();
			Cache::put("trip",$data);

            return response()->json(['success'=>'Added new record.']);

        }

     

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\mbarang  $mbarang
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mbarang  $mbarang
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mbarang  $mbarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

              'title' => 'required|min:3',
			  'where.origin' => 'required|min:3',
			  'where.destination' => 'required|min:3',
			  'type' => 'required|min:3',
			  'schedule.start'=>'required|date_format:Y-m-d H:i:s',
			  'schedule.end'=>'required|date_format:Y-m-d H:i:s',
        ]);
		
		
		if ($validator->passes()) {
			$trip = Trip::find($id);
			if(count((array) $trip) == 0){
				 return response()->json(['failed'=>'Data is not found.']); 
			}
			$trip->title  = $request->title;
			$trip->origin = ($request->where)["origin"];
			$trip->destination  = ($request->where)["destination"];
			$trip->startDatetime  = ($request->schedule)["start"];
			$trip->endDatetime  = ($request->schedule)["end"];
			$trip->type  = $request->type;
			if($request->description){
				$trip->description  = $request->description;
			}
			$trip->save();
			
			$data = Trip::latest()->get();
			Cache::put("trip",$data);

            return response()->json(['success'=>'Update existing record.']);

        }

     

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mbarang  $mbarang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(trip::destroy($id)){
			
			$trip_arr = [];
			if(Cache::get("trip")){
				$trip_arr = Cache::get("trip");
			} 
			$data = Trip::latest()->get();
			Cache::put("trip",$data);
			return response()->json(['success'=>'Delete existing record.']);
		}
 		 
		return response()->json(['failed'=>'Record not exists.']);
    }
}
