<?php

namespace App\Repositories\Hospital;

interface HospitalRepositoryInterface
{
    /**
     * IDから病院情報(1レコード)を取得
     *
     * @return object
     */
    public function getHospitalById($id);
    
    /**
     * 病院一覧を取得
     *
     * @return object
     */
    public function getHospitals($currentDateTime);
    
    /**
     * 診療科一覧を取得
     *
     * @return object
     */
    public function getSections();
    
    /**
     * 病院情報登録処理
     *
     * @return object
     */
    public function createHospital($request);
    
    /**
     * IDによる病院情報編集処理
     *
     * @return object
     */
    public function updateHospital($request);
    
    /**
     * IDによる病院情報削除処理
     *
     * @return object
     */
    public function deleteHospitalByHospitalId($id);

    /**
     * セクションリンク情報を取得
     *
     * @return object
     */
    public function getSectionLinksByHospitalId($id);
    
    /**
     * セクションリンク情報の削除処理
     *
     * @return object
     */
    public function deleteSectionLinksById($id);

    /**
     * 診療科IDからそのIDを保持する病院一覧を取得する
     *
     * @return object
     */
    public function getHospitalsBySectionIds($id, $currentDateTime);
}