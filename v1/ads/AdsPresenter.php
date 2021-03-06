<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 14/09/2019
 * Time: 04:57 PM
 */

require_once dirname(__FILE__)."/../user/UserPresenter.php";
require_once "Ads.php";

class AdsPresenter
{

    public function getFirstData($data)
    {
        $resArray = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            $result = (new Ads())->getGroupList();
            $groupList = array();
            while ($row = $result->fetch_assoc()) $groupList[] = $row;

            foreach($groupList as $groupData)
            {
                $listData = array();
                $adsData = array();
                while($row = (new Ads())->getByGroupId($groupData['g_id'], 10, 0)) $adsData[] = $row;
                $listData['adsData'] = $adsData;
                $listData['g_id'] = $groupData['g_id'];
                $listData['g_name'] = $groupData['g_name'];
                $resArray[] = json_encode($listData);

            }

        }else
            $code = 400;

        return json_encode(array("code" => $code, "data" => $resArray));
    }

    public function getListData($data)
    {
        $dataArray = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new Ads())->getByGroupId($data['groupId'], $data['num'], $data['step']);
            while ($row = $result->fetch_assoc()) $dataArray[] = json_encode($row);
            $code = 100;
        }
        else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $dataArray));
    }

    public function getSpecial($data)
    {
        $dataArray = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new Ads())->getSpecial();
            while ($row = $result->fetch_assoc()) $dataArray[] = json_encode($row);
            $code = 100;
        }
        else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $dataArray));
    }

    public function get($data)
    {
        $code = 200;
        $dataArray = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new Ads())->get($data['adsId']);
            if($result !== false) {
                $code = 100;
                $dataArray[] = json_encode($result);
            }
        }
        else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $dataArray));
    }

    //public function getByFieldId

}