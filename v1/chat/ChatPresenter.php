<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 06/08/2019
 * Time: 04:58 PM
 */
require_once "Chat.php";
require_once dirname(__FILE__)."/../user/UserPresenter.php";
require_once dirname(__FILE__)."/../student/profile/StudentProfilePresenter.php";
require_once dirname(__FILE__)."/../file/FilePresenter.php";
require_once dirname(__FILE__)."/groupChat/GroupChat.php";
require_once dirname(__FILE__)."/invite/Invite.php";

class ChatPresenter
{
    public function sendMessage($data)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = $this->saveMessage($userId, $data['chatId'], $data['message'], 0, 0);
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    public function sendFileMessage($data, $file)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $fileId = $this->saveFile($userId, $file);
            if ($fileId === 0)
                $code = 300;
            else
                $code = $this->saveMessage($userId, $data['chatId'], array($data['message']), $data['pathId'], $fileId);
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    private function saveFile($userId, $file): int
    {
        return (new FilePresenter())->saveFile($userId, $file['mostafa'], 0);
    }

    public function saveMessage($userId, $otherId, $messageList, $pathId, $fileId, $inviteId = 0): int
    {
        $code = 200;
        $min = min($userId, $otherId);
        $max = max($userId, $otherId);
        foreach ($messageList as $m) {
            $result = (new Chat($min."s".$max))->saveMessage($userId, getJDate(), Date("H:i"), $m, $fileId, $pathId, $inviteId);
            if ($result)
                $code = 100;
            else {
                $this->createTable($min, $max);
                $result = (new Chat($min."s".$max))->saveMessage($userId, getJDate(), Date("H:i"), $m, $fileId, $pathId, $inviteId);
                if ($result)
                    $code = 100;
            }
        }
        return $code;
    }

    public function createTable($min, $max)
    {
        (new Chat($min."s".$max))->createTable();
        (new StudentProfilePresenter())->addChat($min, $max);

    }

    public function getLastMessage($data)
    {
        $messageList = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $min = min($userId, $data['chatId']);
            $max = max($userId, $data['chatId']);
            $result = (new Chat($min."s".$max))->getLastMessage(getAgoDaysJDate(3));
            while ($row = $result->fetch_assoc()) {
                if($row['i_id'] != 0)
                {
                    $gId = (new Invite())->getGroupId($userId, $row['i_id']);
                    $row['m_text'] = (new GroupChat())->getName($gId);
                }
                $messageList[] = json_encode($row);
            }
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $messageList));
    }

    public function getOldMessage($data)
    {
        $messageList = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $min = min($userId, $data['chatId']);
            $max = max($userId, $data['chatId']);
            $result = (new Chat($min."s".$max))->getOldMessage($data['lastId']);
            while ($row = $result->fetch_assoc()) {
                if($row['i_id'] != 0)
                {
                    $gId = (new Invite())->getGroupId($userId, $row['i_id']);
                    $row['m_text'] = (new GroupChat())->getName($gId);
                }
                $messageList[] = json_encode($row);
            }
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $messageList));
    }

    public function getNewMessage($data)
    {
        $resArray = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            foreach ($data['reqData'] as $chatReq) {
                $chatReq = json_decode($chatReq);
                $otherId = $chatReq -> chat_id;
                $lastId = $chatReq -> lastId;
                $min = min($userId, $otherId);
                $max = max($userId, $otherId);
                $chatRes = array();
                $chatRes['chat_id'] = $otherId;
                $chatRes['kind_id'] = "s";
                if ($lastId == -1) {
                    $chatRes['lastSeenId'] = -1;
                    $result = (new Chat($min."s".$max))->getLastMessage(getAgoDaysJDate(3));
                } else {
                    $chatRes['lastSeenId'] = ((new Chat($min."s".$max))->lastSeenId($userId));
                    $result = (new Chat($min."s".$max))->getNewMessage($lastId);
                }

                $messageList = array();
                while ($row = $result->fetch_assoc()) {
                    $row['its_my'] = $userId == $row['user_id'];
                    if($row['i_id'] !== 0)
                    {
                        $gId = (new Invite())->getGroupId($userId, $row['i_id']);
                        $row['m_text'] = (new GroupChat())->getName($gId);
                    }
                    $messageList[] = $row;
                }
                $chatRes['messageList'] = $messageList;
                $resArray[] = json_encode($chatRes);
                $code = 100;
            }
        } else
            $code = 400;
        //array_unshift($resArray, "s");
        return json_encode(array("code" => $code, "data" => $resArray));
    }

    public function seen($data)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $min = min($userId, $data['chatId']);
            $max = max($userId, $data['chatId']);
            (new Chat($min."s".$max))->seen($data['chatId']);
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

}