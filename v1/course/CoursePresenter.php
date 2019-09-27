<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 16/09/2019
 * Time: 07:49 PM
 */

require_once "Course.php";
require_once dirname(__FILE__)."/../user/UserPresenter.php";

class CoursePresenter
{
    public function getFirstData($data)
    {
        $resArray = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            $result = (new Course())->getGroupList();
            $groupList = array();
            while ($row = $result->fetch_assoc()) $groupList[] = $row;

            foreach ($groupList as $groupData) {
                $listData = array();
                $newsData = array();
                $result =  (new Course())->getByGroupId($groupData['g_id'], 10, 1);
                while ($row = $result->fetch_assoc()) $newsData[] = $row;
                $listData['courseData'] = $newsData;
                $listData['g_id'] = $groupData['g_id'];
                $listData['g_name'] = $groupData['g_name'];
                $resArray[] = json_encode($listData);

            }

        } else
            $code = 400;

        return json_encode(array("code" => $code, "data" => $resArray));
    }

    public function getListData($data)
    {
        $dataArray = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new Course())->getByGroupId($data['groupId'], $data['num'], $data['step']);
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
            $result = (new Course())->getSpecial();
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
            $result = (new Course())->get($data['courseId']);
            if ($result !== false) {
                $code = 100;
                $dataArray[] = json_encode($result);
            }
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $dataArray));
    }

    public function getImg($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode']))
            return @file_get_contents("../../files/img/course/$data[imgId].jpg");
        return @file_get_contents("../../files/img/denied.png");
    }
}