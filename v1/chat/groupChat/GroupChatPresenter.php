<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 02/09/2019
 * Time: 03:42 PM
 */

require_once dirname(__FILE__) . "/../Chat.php";
require_once "GroupChat.php";
require_once dirname(__FILE__) . "/../../user/UserPresenter.php";
require_once dirname(__FILE__) . "/../../student/profile/StudentProfilePresenter.php";
require_once dirname(__FILE__) . "/../../file/FilePresenter.php";

class GroupChatPresenter
{

    public function create($data)
    {
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new GroupChat())->save($userId, $data['groupName'], getJDate(), Date("H:i"), $data['joinMode'], $data['inviteMode'], $data['info']);
            if ($result) {
                $id = (new GroupChat())->lastId($userId);
                $result = (new Chat("g" . $id))->createTable();
                if ($result) {
                    (new StudentProfilePresenter())->addToGroupChat($userId, $id);
                    $this->addToMemberList($id, $userId);
                    $code = 100;
                }
            }
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    public function get($data)
    {
        $resultData = array();
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new GroupChat())->get($data['groupId']);
            if ($result !== false) {
                $code = 100;
                $result['admin'] = (bool)($userId == $result['owner_id']);
                $resultData[] = json_encode($result);
            }

        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $resultData));
    }

    public function getImg($data)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode']))
            if ((new GroupChat())->isMember($data['imgId'], $userId))
                return @file_get_contents("../../../files/groupChat/$data[imgId].jpg");
            else
                return @file_get_contents("../../../files/groupChat/denied.png");
        return @file_get_contents("../../../files/img/denied.png");
    }

    public function memberList($data)
    {
        $resultData = array();
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $modelData = (new GroupChat())->getMemberList($data['groupId'], $userId, false);
            if ($modelData !== false) {
                $memberData = $modelData['member_list'];
                $ownerId = $modelData['owner_id'];
                $groupIdList = implode(',', array_map('intval', json_decode($memberData) ?: array("-1")));
                $result = (new StudentProfile())->getManySId($groupIdList);

                while ($row = $result->fetch_assoc()) {
                    $row['account'] = (bool)($userId == $row['user_id']);
                    $row['owner'] = (bool)($ownerId == $row['user_id']);
                    $resultData[] = json_encode($row);
                }
                $code = 100;
            }
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $resultData));
    }

    public function addToMemberList($groupId, $userId)
    {
        if (($lastData = ((new GroupChat())->getMemberList($groupId, $userId, true))['member_list']) !== false) {
            $lastData = json_decode($lastData) ?: array(-1);
            if ((array_search((String)$userId, $lastData)) === false)
                $lastData[] = (String)$userId;
            $newData = json_encode($lastData);
        } else
            $newData = json_encode(array((String)$userId));
        (new GroupChat())->updateMemberList($groupId, $newData, $userId, true);
    }

    public function removeFromMemberList($groupId, $userId)
    {
        if (($lastData = ((new GroupChat())->getMemberList($groupId, $userId, false))['member_list']) !== false) {
            $lastData = json_decode($lastData) ?: array(-1);
            if (($index = array_search((String)$userId, $lastData)) !== false)
                unset($lastData[$index]);
            $newData = json_encode($lastData);
            (new GroupChat())->updateMemberList($groupId, $newData, $userId, false);
        }
    }

    public function left($data)
    {

        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $this->removeFromMemberList($data['groupId'], $userId);
            (new StudentProfilePresenter())->removeFromGroupChat($userId, $data['groupId']);
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    public function deleteMember($data)
    {
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            if ((new GroupChat())->isOwner($userId, $data['groupId'])) {
                $this->removeFromMemberList($data['groupId'], $data['otherId']);
                (new StudentProfilePresenter())->removeFromGroupChat($data['otherId'], $data['groupId']);
                $code = 100;
            }
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    public function uploadImage($data, $file)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            if ((new GroupChat())->isOwner($userId, $data['groupId'])) {
                $file = $file['img'];
                if ($file->getError() === UPLOAD_ERR_OK) {
                    $code = 100;
                    $file->moveTo("../../../files/groupChat/$data[groupId].jpg");
                }
            } else
                $code = 200;
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    /*                    ----                     */

    public function sendMessage($data)
    {
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            if ((new GroupChat())->isMember($data['chatId'], $userId))
                $code = $this->saveMessage($data['chatId'], $userId, $data['message'], 0, 0);
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    public function sendFileMessage($data, $file)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            if ((new GroupChat())->isMember($data['chatId'], $userId)) {
                $fileId = $this->saveFile($userId, $file);
                if ($fileId === 0)
                    $code = 300;
                else
                    $code = $this->saveMessage($data['chatId'], $userId, array($data['message']), $data['pathId'], $fileId);
            }
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    private function saveFile($userId, $file): int
    {
        return (new FilePresenter())->saveFile($userId, $file['mostafa'], 0);
    }

    private function saveMessage($chatId, $userId, $messageList, $pathId, $fileId): int
    {
        $code = 200;
        foreach ($messageList as $m) {
            $result = (new Chat("g" . $chatId))->saveMessage($userId, getJDate(), Date("H:i"), $m, $fileId, $pathId, 0);
            if ($result)
                $code = 100;
        }
        return $code;
    }

    public function getLastMessage($data)
    {
        $messageList = array();
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            if ((new GroupChat())->hasAccess($data['chatId'], $userId)) {
                $result = (new Chat("g" . $data['chatId']))->getLastMessage(getAgoDaysJDate(3));
                while ($row = $result->fetch_assoc()) $messageList[] = json_encode($row);
                $code = 100;
            }
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $messageList));
    }

    public function getOldMessage($data)
    {
        $messageList = array();
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            if ((new GroupChat())->hasAccess($data['chatId'], $userId)) {
                $result = (new Chat("g" . $data['chatId']))->getOldMessage($data['lastId']);
                while ($row = $result->fetch_assoc()) $messageList[] = json_encode($row);
                $code = 100;
            }
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $messageList));
    }

    public function getNewMessage($data)
    {
        $resArray = array();
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            foreach ($data['reqData'] as $chatReq) {
                $chatReq = json_decode($chatReq);
                $chatId = $chatReq->chat_id;
                if (!((new GroupChat())->hasAccess($chatId, $userId)))
                    continue;
                $lastId = $chatReq->lastId;
                $chatRes = array();
                $chatRes['chat_id'] = $chatId;
                $chatRes['kind_id'] = "g";
                if ($lastId == -1) {
                    $chatRes['lastSeenId'] = -1;
                    $result = (new Chat("g" . $chatId))->getLastMessage(getAgoDaysJDate(3));
                } else {
                    $chatRes['lastSeenId'] = ((new Chat("g" . $chatId))->lastSeenId($userId));
                    $result = (new Chat("g" . $chatId))->getNewMessage($lastId);
                }

                $messageList = array();
                while ($row = $result->fetch_assoc()) {
                    $row['its_my'] = $userId == $row['user_id'];
                    $messageList[] = $row;
                }
                $chatRes['messageList'] = $messageList;
                $resArray[] = json_encode($chatRes);
                $code = 100;
            }
        } else
            $code = 400;
        //array_unshift($resArray, "g");
        return json_encode(array("code" => $code, "data" => $resArray));
    }

    public function seen($data)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {

            (new Chat("g" . $data['chatId']))->seen($data['chatId']);
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }


}