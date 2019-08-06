<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 10:47 PM
 */

require "WorkSample.php";
require "../../user/UserPresenter.php";

class WorkSamplePresenter
{

    public function add($data, $files)
    {
        $code = 200;
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new WorkSample())->add($data['abilityId'], $data['subject'], $data['description'], getJDate(), sizeof($files['img']));
            if ($result) {
                $code = 100;
                $id = (new WorkSample())->getLastId($data['abilityId']);
                for ($i = 0; $i < sizeof($files['img']); $i++) {
                    if ($files['img'][$i]->getError() === UPLOAD_ERR_OK)
                        $files['img'][$i]->moveTo("../../../files/img/workSample/" . $id . $i . ".jpg");
                }
            }

        } else
            $code = 400;
        $res = array("code" => $code);
        return json_encode($res);
    }

    public function getMyList($data)
    {
        $list = array();
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new WorkSample())->getMyList($data['abilityId']);
            while ($row = $result->fetch_assoc()) $list[] = json_encode($row);
            $code = 100;
        } else
            $code = 400;
        $res = array("code" => $code, "data" => $list);
        return json_encode($res);
    }

    public function getList($data)
    {
        $list = array();
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new WorkSample())->getList($data['abilityId']);
            while ($row = $result->fetch_assoc()) $list[] = json_encode($row);
            $code = 100;
        } else
            $code = 400;
        $res = array("code" => $code, "data" => $list);
        return json_encode($res);
    }

    public function getMySingle($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new WorkSample())->getMySingle($data['workSampleId']);
            $code = 100;
        } else
            $code = 400;
        $res = array("code" => $code, "data" => array(json_encode($result)));
        return json_encode($res);
    }

    public function getSingle($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new WorkSample())->getSingle($data['workSampleId']);
            $code = 100;
        } else
            $code = 400;
        $res = array("code" => $code, "data" => array(json_encode($result)));
        return json_encode($res);
    }

    public function changeStatus($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            (new WorkSample())->changeStatus($data['workSampleId'], $data['status']);
            $code = 100;
        } else
            $code = 400;
        $res = array("code" => $code);
        return json_encode($res);
    }

    public function getImg($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode']))
            return @file_get_contents("../../../files/img/workSample/$data[imgId].jpg");
        return @file_get_contents("../../../files/img/denied.png");
    }

    public function edit($data, $files)
    {
        $code = 200;
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new WorkSample())->edit($data['workSampleId'], $data['subject'], $data['description'], sizeof($files['img']));
            if ($result) {
                $code = 100;
                $id = $data['workSampleId'];
                for ($j = 0; $j < 3; $j++)
                    unlink("../../../files/img/workSample/" . $id . $j . ".jpg");

                for ($i = 0; $i < sizeof($files['img']); $i++) {
                    if ($files['img'][$i]->getError() === UPLOAD_ERR_OK)
                        $files['img'][$i]->moveTo("../../../files/img/workSample/" . $id . $i . ".jpg");
                }
            }

        } else
            $code = 400;
        $res = array("code" => $code);
        return json_encode($res);
    }

}