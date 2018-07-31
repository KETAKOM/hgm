<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use Carbon\Carbon;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentDateTime = Carbon::now();
        
        $hospitals = Hospital::query()
            ->where('publish_flg', '0')
            ->where('publish_start', '<=' , $currentDateTime)
            ->where('publish_last', '>=', $currentDateTime)
            ->get();
        
        return view('hospitals.index', [
            'hospitals' => $hospitals,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hospitals.create');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $hospital = new Hospital;
        
        $hospital->name = $request->name;
        $hospital->address = $request->address;
        $hospital->section = $request->section;
        $hospital->publish_flg = $request->publish_flg;
        $hospital->publish_start = $request->publish_start;
        $hospital->publish_last = $request->publish_last;
        $hospital->save();
        
        return redirect ('/');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;

        $hospital = Hospital::find($id);

        return view ('hospitals.edit', [
            'hospital' => $hospital,
        ]);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $hospital = Hospital::find($id);
        $hospital->name = $request->name;
        $hospital->address = $request->address;
        $hospital->section = $request->section;
        $hospital->publish_flg = $request->publish_flg;
        $hospital->publish_start = $request->publish_start;
        $hospital->publish_last = $request->publish_last;
        $hospital->save();

        return redirect ('/');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $hospital = Hospital::find($request->id)->delete();

        return redirect ('/');
    }
}
