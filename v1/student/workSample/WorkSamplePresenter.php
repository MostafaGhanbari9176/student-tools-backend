<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 10:47 PM
 */

require_once "WorkSample.php";
require_once "../../user/UserPresenter.php";

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
            while ($row = $result->fetch_assoc()) {
                $row['like_num'] = $this->likeNum($row['work_sample_id']);
                $list[] = json_encode($row);
            }
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
            while ($row = $result->fetch_assoc()) {
                $row['like_num'] = $this->likeNum($row['work_sample_id']);
                $list[] = json_encode($row);
            }
            $code = 100;
        } else
            $code = 400;
        $res = array("code" => $code, "data" => $list);
        return json_encode($res);
    }

    public function getMySingle($data)
    {
        $result = array();
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new WorkSample())->getMySingle($data['workSampleId']);
            $result['like_num'] = $this->likeNum($data['workSampleId']);
            $code = 100;
        } else
            $code = 400;
        $res = array("code" => $code, "data" => array(json_encode($result)));
        return json_encode($res);
    }

    public function getSingle($data)
    {
        $result = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new WorkSample())->getSingle($data['workSampleId']);
            $result['like_num'] = $this->likeNum($data['workSampleId']);
            $result['liked'] = $this->liked($userId, $data['workSampleId']);
            $code = 100;
        } else
            $code = 400;
        $res = array("code" => $code, "data" => array(json_encode($result)));
        return json_encode($res);
    }

    public function delete($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            (new WorkSample())->changeStatus($data['workSampleId'], 4);
            $code = 100;
        } else
            $code = 400;
        $res = array("code" => $code);
        return json_encode($res);
    }

    public function seen($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            (new WorkSample())->seen($data['workSampleId']);
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
            $result = (new WorkSample())->edit($data['workSampleId'], $data['subject'], $data['description'], sizeof($files['img']), 0);
            if ($result) {
                $code = 100;
                $id = $data['workSampleId'];
                for ($j = 0; $j < 3; $j++) {
                 if(file_exists("../../../files/img/workSample/" . $id . $j . ".jpg"))
                    unlink("../../../files/img/workSample/" . $id . $j . ".jpg");
                }

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

    public function changeLike($data)
    {
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $dbResult = (new WorkSample())->getLike($data['workSampleId']);
            if ($dbResult->num_rows > 0) {
                $code = 100;
                $likeList = $dbResult->fetch_assoc()['like_list'];
                if (strlen($likeList) < 5)
                    $likeList = "[]";
                $likeList = json_decode($likeList);
                $search = array_search((String)$userId, $likeList);
                if ($search !== false) {
                    $newData = array();
                    for ($i = 0; $i < sizeof($likeList); $i++) {
                        if ($i == $search)
                            continue;
                        $newData[] = (String)$likeList[$i];
                    }
                    $newData = json_encode($newData);
                } else {
                    $likeList[] = (String)$userId;
                    $newData = json_encode($likeList);
                }
                (new WorkSample())->updateLike($data['workSampleId'], $newData);

            }
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    public function likeNum($workSampleId): int
    {
        $dbResult = (new WorkSample())->getLike($workSampleId);
        if ($dbResult->num_rows > 0) {
            $likeList = $dbResult->fetch_assoc()['like_list'];
            if (strlen($likeList) < 5)
                return 0;
            $likeList = json_decode($likeList);
            return sizeof($likeList);
        }
        return 0;
    }

    public function liked($userId, $workSampleId):bool
    {
        return ((new WorkSample())->liked($workSampleId, $userId) > 0);
    }

}