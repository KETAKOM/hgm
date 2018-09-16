<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\SectionLink;
use App\Models\Section;
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
            ->select('hospitals.*')
            ->where('publish_flg', '0')
            ->where('publish_start', '<=' , $currentDateTime)
            ->where('publish_last', '>=', $currentDateTime)
            ->get();
            
        foreach ($hospitals as $key => $value) {
            
            $sections = SectionLink::query()
                ->join('sections', 'section_links.section_id', '=', 'sections.id')
                ->select('sections.id')
                ->addSelect('sections.section_name')
                ->where('section_links.hospital_id', $value->id)
                ->get();
                
            $hospitals[$key]->sections = $sections;
        }

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
        return view('hospitals.create', [
            'sections' => $this->getSections(),
        ]);
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
        $hospital->publish_flg = $request->publish_flg;
        $hospital->publish_start = $request->publish_start;
        $hospital->publish_last = $request->publish_last;
        
        if ($request->section && $hospital->save()) {
            foreach ($request->section as $key => $value) {
                $sections = new SectionLink;
                $sections->hospital_id = $hospital->id;
                $sections->section_id = $value;
                $sections->save();
            }
        }
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
        
        $link_arr = [];
        
        $links = SectionLink::query()
            ->select('section_id')
            ->where('hospital_id', $id)
            ->get();
            
        foreach ($links as $value) {
            array_push($link_arr, $value->section_id);
        }

        return view ('hospitals.edit', [
            'hospital' => $hospital,
            'sections' => $this->getSections(),
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
        $id = $request->id;

        $hospital = Hospital::find($id);
        $hospital->name = $request->name;
        $hospital->publish_flg = $request->publish_flg;
        $hospital->publish_start = $request->publish_start;
        $hospital->publish_last = $request->publish_last;

        if ($request->section && $hospital->save()) {
            //リンク情報を削除
            SectionLink::where('hospital_id', $request->id)->delete();
            
            foreach ($request->section as $key => $value) {
                $sections = new SectionLink;
                $sections->hospital_id = $hospital->id;
                $sections->section_id = $value;
                $sections->save();
            }
        }
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
        //病院情報を削除
        Hospital::find($request->id)->delete();
        
        //診療科リンク情報の削除
        SectionLink::where('hospital_id', $request->id)->delete();

        return redirect ('/');
    }
    
     /**
     * 診療科から該当する病院を検索する
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchHospitalsBySectionId(Request $request)
    {
        //診療科ID
        return $this->getHospitalsBySectionId($request->id);
    }
    
    //診療科一覧の取得処理
    private function getSections($id = null) {
        $sections = Section::query()
            ->select('sections.id')
            ->addSelect('sections.section_name')
            ->get();
            
        return $sections;
    }
    
    //診療科IDからその診療科を保持する病院一覧を取得する
    private function getHospitalsBySectionId($id) {
        $currentDateTime = Carbon::now();

        $hospitals = Section::query()
            ->join('section_links as links', 'sections.id', 'links.section_id')
            ->join('hospitals as hos', 'links.hospital_id', 'hos.id')
            ->select('hos.*')
            ->where('sections.id', $id)
            ->where('hos.publish_flg', '0')
            ->where('hos.publish_start', '<=' , $currentDateTime)
            ->where('hos.publish_last', '>=', $currentDateTime)
            ->orderBy('hos.id')
            ->get();
            
        foreach ($hospitals as $key => $value) {
            
            $sections = SectionLink::query()
                ->join('sections', 'section_links.section_id', '=', 'sections.id')
                ->select('sections.id')
                ->addSelect('sections.section_name')
                ->where('section_links.hospital_id', $value->id)
                ->get();
                
            $hospitals[$key]->sections = $sections;
        }
            
        return $hospitals;
    }
}
