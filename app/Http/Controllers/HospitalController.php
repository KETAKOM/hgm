<?php

namespace App\Http\Controllers;

use App\Repositories\Hospital\HospitalRepositoryInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HospitalController extends Controller
{
    
    public function __construct
    (
        HospitalRepositoryInterface $hospital_repository
    ) {
        $this->hospital = $hospital_repository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentDateTime = Carbon::now();

        $hospitals = $this->hospital->getHospitals($currentDateTime);

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
        $sections = $this->hospital->getSections();

        return view('hospitals.create', [
            'sections' => $sections
        ]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert()
    {
        $this->hospital->createHospital($request);
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
        $hospital = $this->hospital->getHospitalById($request->id);
        $links = $this->hospital->getSectionLinksByHospitalId($hospital->id);

        $link_arr = [];
        foreach ($links as $link) {
            array_push($link_arr, $link->section_id);
        }

        $sections = $this->hospital->getSections();

        return view ('hospitals.edit', [
            'hospital' => $hospital,
            'sections' => $sections,
            'links' => $link_arr
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
        $this->hospital->updateHospital($request);

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
        //病院情報の削除
        $this->hospital->deleteHospitalByHospitalId($request->id);
        
        //診療科リンク情報の削除
        $this->hospital->deleteSectionLinksById($request->id);

        return redirect ('/');
    }
    
     /**
     * 診療科から該当する病院を検索する
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchHospitalsBySectionIds(Request $request)
    {
        $currentDateTime = Carbon::now();
        //診療科ID
        return $this->hospital->getHospitalsBySectionIds($request->id, $currentDateTime);
    }
}
