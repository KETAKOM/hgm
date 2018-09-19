<?php

namespace App\Repositories\Hospital;
use App\Models\Hospital;
use App\Models\Section;
use App\Models\SectionLink;

class HospitalRepository implements HospitalRepositoryInterface
{
    protected $hospital;
    /**
    * @param object $hospital
    */
    public function __construct(Hospital $hospital)
    {
        $this->hospital = $hospital;
    }
    /**
     * 病院一覧を取得
     *
     * @var $id
     * @return object
     */
    public function getHospitalById($id)
    {
        return Hospital::find($id);
    }
    
    /**
     * 病院一覧を取得
     *
     * @var $id
     * @return object
     */
    public function getHospitals($currentDateTime)
    {
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
        
        return $hospitals;
    }
    
    //診療科一覧の取得処理
    public function getSections() {
        return Section::query()
            ->select('sections.id')
            ->addSelect('sections.section_name')
            ->get();
    }
    
    //病院情報登録処理
    public function createHospital($request) {
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
    }
    
    //病院情報編集処理
    public function updateHospital($request) {
        $hospital = Hospital::find($request->id);
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
    }
    
    /**
     * IDによる病院情報削除処理
     *
     * @return object
     */
    public function deleteHospitalByHospitalId($id) {
        
        //病院情報を削除
        Hospital::find($id)->delete();
    }
    
    /**
     * セクションリンク情報を取得
     *
     * @return object
     */
    public function getSectionLinksByHospitalId($id) {
        return SectionLink::query()
            ->select('section_id')
            ->where('hospital_id', $id)
            ->get();
    }
    
    /**
     * セクションリンク情報の削除処理
     *
     * @return object
     */
    public function deleteSectionLinksById($id) {
        return SectionLink::where('hospital_id', $id)->delete();
    }
    
    /**
     * 診療科IDからそのIDを保持する病院一覧を取得する
     *
     * @return object
     */
    public function getHospitalsBySectionIds($id, $currentDateTime) {
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