<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospitals = Hospital::get();
        
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
        $hospital = Hospital::where('id', $request->id)->delete();
        
        return redirect ('/');
    }
}
