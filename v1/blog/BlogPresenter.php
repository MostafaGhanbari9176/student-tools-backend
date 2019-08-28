<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 27/08/2019
 * Time: 03:30 PM
 */

require_once dirname(__FILE__, 2) . "/user/UserPresenter.php";
require_once dirname(__FILE__, 2) . "/student/profile/StudentProfile.php";
require_once dirname(__FILE__) . "/Blog.php";


class BlogPresenter
{
    public function add($data)
    {
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new Blog())->add($data['mText'], getJDate(), Date("H:i"), $userId, 0);
            if ($result)
                $code = 100;
        } else$code = 400;
        return json_encode(array("code" => $code));
    }

    public function addWithImg($data, $file)
    {
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new Blog())->add($data['mText'], getJDate(), Date("H:i"), $userId, 1);
            if ($result) {
                $id = (new Blog())->getLastId($userId);
                $code = 100;
                if ($file['img']->getError() === UPLOAD_ERR_OK)
                    $file['img']->moveTo("../../files/img/blog/" . $id . ".jpg");
            }
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    public function getImg($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode']))
            return @file_get_contents("../../files/img/blog/$data[imgId].jpg");
        return @file_get_contents("../../files/img/denied.png");
    }

    public function getPerLike($data)
    {
        $list = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            $result = (new Blog())->getPerLike($data['num'], $data['step']);
            while ($row = $result->fetch_assoc()) {
                $row['like_num'] = $this->likeNum($row['m_id']);
                $row['liked'] = $this->liked($userId, $row['m_id']);
                $row['s_id'] = (new StudentProfile())->getSId($row['user_id']);
                $list[] = json_encode($row);
            }
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $list));
    }

    public function getAll($data)
    {
        $list = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            $result = (new Blog())->getPerDate($data['num'], $data['step']);
            while ($row = $result->fetch_assoc()) {
                $row['like_num'] = $this->likeNum($row['m_id']);
                $row['liked'] = $this->liked($userId, $row['m_id']);
                $row['s_id'] = (new StudentProfile())->getSId($row['user_id']);
                $list[] = json_encode($row);
            }
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $list));
    }

    public function changeLike($data)
    {
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $dbResult = (new Blog())->getLike($data['mId']);
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
                (new Blog())->updateLike($data['mId'], $newData);

            }
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    public function liked($userId, $mId): bool
    {
        return ((new Blog())->liked($mId, $userId) > 0);
    }

    public function likeNum($mId): int
    {
        $dbResult = (new Blog())->getLike($mId);
        if ($dbResult->num_rows > 0) {
            $likeList = $dbResult->fetch_assoc()['like_list'];
            if (strlen($likeList) < 5)
                return 0;
            $likeList = json_decode($likeList);
            return sizeof($likeList);
        }
        return 0;
    }

    public function report($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            (new Blog())->changeStatus($data['mId'], $data['status']);
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

}