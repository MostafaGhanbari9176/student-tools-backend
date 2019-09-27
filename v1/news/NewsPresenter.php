<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 15/09/2019
 * Time: 02:42 AM
 */
require_once dirname(__FILE__) . "/../user/UserPresenter.php";
require_once "News.php";

class NewsPresenter
{
    public function getFirstData($data)
    {
        $resArray = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            $result = (new News())->getGroupList();
            $groupList = array();
            while ($row = $result->fetch_assoc()) $groupList[] = $row;

            foreach ($groupList as $groupData) {
                $listData = array();
                $newsData = array();
                $result =  (new News())->getByGroupId($groupData['g_id'], 10, 1);
                while ($row = $result->fetch_assoc()) $newsData[] = $row;
                $listData['newsData'] = $newsData;
                $listData['g_id'] = $groupData['g_id'];
                $listData['g_name'] = $groupData['g_name'];
                $resArray[] = json_encode($listData);

            }
            $agencyData = array();
            $result = (new News())->getAgencyList();
            $listData = array();
            while ($row = $result->fetch_assoc()) $agencyData[] = $row;
            $listData['agencyData'] = $agencyData;
            array_unshift($resArray, json_encode($listData));

        } else
            $code = 400;

        return json_encode(array("code" => $code, "data" => $resArray));
    }

    public function getListData($data)
    {
        $dataArray = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new News())->getByGroupId($data['groupId'], $data['num'], $data['step']);
            while ($row = $result->fetch_assoc()) $dataArray[] = json_encode($row);
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $dataArray));
    }

    public function getSpecial($data)
    {
        $dataArray = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new News())->getSpecial();
            while ($row = $result->fetch_assoc()) $dataArray[] = json_encode($row);
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $dataArray));
    }

    public function get($data)
    {
        $code = 200;
        $dataArray = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new News())->get($data['newsId']);
            if ($result !== false) {
                $code = 100;
                $agencyData = (new News())->getAgencyData($result['agency_id']);
                $result['agencyName'] = $agencyData['a_sub'];
                $result['agencyLink'] = $agencyData['a_link'];
                $dataArray[] = json_encode($result);
            }
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $dataArray));
    }

    public function getImg($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode']))
            return @file_get_contents("../../files/img/news/$data[imgId].jpg");
        return @file_get_contents("../../files/img/denied.png");
    }
}