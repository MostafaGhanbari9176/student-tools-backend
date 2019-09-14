<?php

use Slim\Http\UploadedFile;

/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 09:54 PM
 */

require_once "StudentProfile.php";
require_once dirname(__FILE__) . "/../../user/UserPresenter.php";
require_once dirname(__FILE__) . "/../ability/AbilityPresenter.php";
require_once dirname(__FILE__) . "/../../chat/groupChat/GroupChat.php";

class StudentProfilePresenter
{
    public function add($data)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            (new StudentProfile())->add($data['sId'], $userId, $data['user_name'], getJDate(), Date("H:i"));
            (new UserPresenter())->changePass($data);
        } else
            $code = 400;
        $res = array("code" => $code);
        return json_encode($res);

    }

    public function getMyData($data)
    {
        $result = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            $result = (new StudentProfile())->getMyData($userId);
        } else
            $code = 400;

        $res = array("code" => $code);
        $res['data'] = array(json_encode($result));
        return json_encode($res);
    }

    public function downMyImg($data)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode']))
            return @file_get_contents("../../../files/img/student/$userId.jpg");
        return @file_get_contents("../../../files/img/denied.png");

    }

    public function downImg($data)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode']))
            if ((new StudentProfile())->checkImgAccess($data['imgId'], $userId))
                return @file_get_contents("../../../files/img/student/$data[imgId].jpg");
            else
                return @file_get_contents("../../../files/img/student/denied.png");
        return @file_get_contents("../../../files/img/denied.png");
    }

    public function upImg($data, $files)
    {

        $uploadedFile = $files['img'];
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                $code = 100;
                $uploadedFile->moveTo("../../../files/img/student/" . $userId . ".jpg");
            } else
                $code = 200;
        } else
            $code = 400;
        $res = array("code" => $code);
        return json_encode($res);
    }

    public function saveAboutMe($data)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            (new StudentProfile())->upDateAboutMe($userId, $data['text']);
        } else
            $code = 400;
        $res = array("code" => $code);
        return json_encode($res);
    }

    public function aboutMe($data)
    {
        $result = "";
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            $result = (new StudentProfile())->getAboutMe($userId);
        } else
            $code = 400;
        $res = array("code" => $code, "data" => array($result));
        return json_encode($res);
    }

    public function elName($data)
    {
        $result = 1;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            if ($data['code'] == -1) {
                $result = (new StudentProfile())->getNameEl($userId);
            } else {
                (new StudentProfile())->changeNameEl($userId, $data['code']);
            }
        } else
            $code = 400;
        $res = array("code" => $code, "data" => array($result));
        return json_encode($res);
    }

    public function eLPhone($data)
    {
        $result = 1;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            if ($data['code'] == -1) {
                $result = (new StudentProfile())->getPhoneEl($userId);
            } else {
                (new StudentProfile())->changePhoneEl($userId, $data['code']);
            }
        } else
            $code = 400;
        $res = array("code" => $code, "data" => array($result));
        return json_encode($res);
    }

    public function eLImg($data)
    {
        $result = 1;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            if ($data['code'] == -1) {
                $result = (new StudentProfile())->getImgEl($userId);
            } else {
                (new StudentProfile())->changeImgEl($userId, $data['code']);
            }
        } else
            $code = 400;
        $res = array("code" => $code, "data" => array($result));
        return json_encode($res);
    }

    public function getFriendList($data)
    {
        $code = 100;
        $friendList = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            if ($friendIdList = (new StudentProfile())->getFriendList($userId)) {
                $friendIdList = json_decode($friendIdList);
                foreach ($friendIdList as $id) {
                    $userName = (new StudentProfile())->getName($id, $userId);
                    $sId = (new StudentProfile())->getSId($id);
                    if (strlen($sId) > 0)
                        $friendList[] = json_encode(array("s_id" => $sId, "user_name" => $userName, "user_id" => $id));
                }
            }
        }
        return json_encode(array("code" => $code, "data" => $friendList));
    }

    public function addFriend($data)
    {
        $code = 100;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            if ($lastData = (new StudentProfile())->getFriendList($userId)) {
                $lastData = json_decode($lastData);
                if (array_search((String)$data['otherId'], $lastData) !== false)
                    $code = 300;
                else
                    $lastData[] = (String)$data['otherId'];
                $newData = json_encode($lastData);
            } else
                $newData = json_encode(array((String)$data['otherId']));
            if ($code != 300)
                (new StudentProfile())->upDateFriendList($userId, $newData);
        } else
            $code = 400;
        $res = array("code" => $code);
        return json_encode($res);
    }

    public function deleteFriend($data)
    {
        $code = 100;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            if ($lastData = (new StudentProfile())->getFriendList($userId)) {
                $lastData = json_decode($lastData);
                $index = array_search($data['otherId'], $lastData);
                if ($index !== false) {
                    $newData = array();
                    for ($i = 0; $i < sizeof($lastData); $i++) {
                        if ($i == $index)
                            continue;
                        $newData[] = (String)$lastData[$i];

                    }
                    $newData = json_encode($newData);
                    (new StudentProfile())->upDateFriendList($userId, $newData);
                }
            }

        } else
            $code = 400;
        $res = array("code" => $code);
        return json_encode($res);
    }

    public function getChatList($data)
    {
        $code = 100;
        $singleNum = 0;
        $chatLists = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            if ($allChatsId = (new StudentProfile())->getAllChatList($userId)) {

                $singleIdList = implode(',', array_map('intval', json_decode($allChatsId['chat_list']) ?: array("-1")));
                $groupIdList = implode(',', array_map('intval', json_decode($allChatsId['group_list']) ?: array("-1")));

                $result = (new StudentProfile())->getManySId($singleIdList);
                while ($row = $result->fetch_assoc()) {
                    $singleNum++;
                    $chatList = array();
                    $chatList['chat_id'] = $row['user_id'];
                    $chatList['chat_subject'] = $row['s_id'];
                    $chatList['kind_id'] = "s";
                    $chatLists[] = json_encode($chatList);
                }

                $result = (new GroupChat())->getManyId($groupIdList);
                while ($row = $result->fetch_assoc()) {
                    $chatList = array();
                    $chatList['chat_id'] = $row['g_id'];
                    $chatList['chat_subject'] = $row['g_name'];
                    $chatList['kind_id'] = "g";
                    $chatLists[] = json_encode($chatList);
                }

            }
        } else
            $code = 400;
        array_unshift($chatLists, (String)$singleNum);
        return json_encode(array("code" => $code, "data" => $chatLists));
    }

    public function addChat($user1Id, $user2Id)
    {

        if (($lastData = (new StudentProfile())->getChatList($user1Id)) !== false) {
            $lastData = json_decode($lastData);
            if (array_search((String)$user2Id, $lastData) === false)
                $lastData[] = (String)$user2Id;
            $newData = json_encode($lastData);
        } else
            $newData = json_encode(array((String)$user2Id));
        (new StudentProfile())->upDateChatList($user1Id, $newData);

        if (($lastData = (new StudentProfile())->getChatList($user2Id)) !== false) {
            $lastData = json_decode($lastData);
            if (array_search((String)$user1Id, $lastData) === false)
                $lastData[] = (String)$user1Id;
            $newData = json_encode($lastData);
        } else
            $newData = json_encode(array((String)$user1Id));
        (new StudentProfile())->upDateChatList($user2Id, $newData);

    }

    public function getProfile($data)
    {
        $phone = "شماره تماس:پنهان شده";
        $student = array();
        $ability = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $name = (new StudentProfile())->getName($data['otherId'], $userId);
            $student = (new StudentProfile())->getData($data['otherId']);
            if ($student['its_friend'] = (new StudentProfile())->itsFriend($userId, $data['otherId']))
                $phone = (new User())->getPhone($data['otherId']);
            else if ((new StudentProfile())->checkPhoneAccess($data['otherId'], $userId))
                $phone = (new User())->getPhone($data['otherId']);
            $student['user_name'] = $name;
            $student['phone'] = $phone;
            $ability = (new AbilityPresenter())->getList($data);
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => array_merge(array(json_encode($student)), $ability)));
    }

    public function searchBySId($data)
    {
        $list = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new StudentProfile())->searchBySId($data['key'], $data['step'], $data['num']);
            while ($row = $result->fetch_assoc()) {
                $student = array();
                $student['s_id'] = $row['s_id'];
                $student['user_id'] = $row['user_id'];
                $student['user_name'] = (new StudentProfile())->getName($row['user_id'], $userId);
                $list[] = json_encode($student);
            }
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $list));
    }

    public function addToGroupChat($userId, $groupId)
    {
        if ($lastData = (new StudentProfile())->getGroupList($userId)) {
            $lastData = json_decode($lastData);
            if ((array_search((String)$groupId, $lastData)) === false)
                $lastData[] = (String)$groupId;
            $newData = json_encode($lastData);
        } else
            $newData = json_encode(array((String)$groupId));
        (new StudentProfile())->upDateGroupList($userId, $newData);
    }

    public function removeFromGroupChat($userId, $groupId)
    {
        if ($lastData = (new StudentProfile())->getGroupList($userId)) {
            $lastData = json_decode($lastData);
            if (($index = array_search((String)$groupId, $lastData)) !== false)
                unset($lastData[$index]);
            $newData = json_encode($lastData);
            (new StudentProfile())->upDateGroupList($userId, $newData);
        }
    }

    public function changeOnline($data, $value)
    {
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            (new StudentProfile())->changeOnline($userId, $value, getJDate(), Date("H:i"));
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    public function getLastSeen($data)
    {
        $message = "";
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new StudentProfile())->getLastSeen($data['otherId']);
            if ($result !== false) {
                if ($result['on_line'] == 1)
                    $message = "online";
                else
                    $message = $result['last_time'] . " " . $result['last_date'];
                $code = 100;
            } else
                $message = "offline";

        } else
            $code = 400;

        return json_encode(array("code" => $code, "message" => $message));
    }

    public function itsFriend($data)
    {
        $message = "";
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            if ((new StudentProfile())->itsFriend($userId, $data['otherId']))
                $message = "1";
            else
                $message = "0";
            $code = 100;
        } else
            $code = 400;

        return json_encode(array("code" => $code, "message" => $message));
    }


}