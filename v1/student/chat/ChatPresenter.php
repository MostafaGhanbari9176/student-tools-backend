<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 06/08/2019
 * Time: 04:58 PM
 */
require_once "Chat.php";
require_once "../../user/UserPresenter.php";
require_once "../profile/StudentProfilePresenter.php";
require_once "../../file/FilePresenter.php";

class ChatPresenter
{
    public function sendMessage($data)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $min = min($userId, $data['otherId']);
            $max = max($userId, $data['otherId']);
            $code = $this->saveMessage($min, $max, $userId, $data['message'], 0, 0);
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    public function sendFileMessage($data, $file)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $min = min($userId, $data['otherId']);
            $max = max($userId, $data['otherId']);
            $fileId = $this->saveFile($userId, $file);
            if ($fileId === 0)
                $code = 300;
            else
                $code = $this->saveMessage($min, $max, $userId, array($data['message']), $data['pathId'], $fileId);
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    private function saveFile($userId, $file): int
    {
        return (new FilePresenter())->saveFile($userId, $file['mostafa'], 0);
    }

    private function saveMessage($min, $max, $userId, $messageList, $pathId, $fileId): int
    {
        $code = 200;
        foreach ($messageList as $m) {
            $result = (new Chat($min, $max))->saveMessage($userId, getJDate(), Date("H:i"), $m, $fileId, $pathId);
            if ($result)
                $code = 100;
            else {
                $this->createTable($min, $max);
                $result = (new Chat($min, $max))->saveMessage($userId, getJDate(), Date("H:i"), $m, $fileId, $pathId);
                if ($result)
                    $code = 100;
            }
        }
        return $code;
    }

    public function createTable($min, $max)
    {
        (new Chat($min, $max))->createTable();
        (new StudentProfilePresenter())->addChat($min, $max);

    }

    public function getLastMessage($data)
    {
        $messageList = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $min = min($userId, $data['otherId']);
            $max = max($userId, $data['otherId']);
            $result = (new Chat($min, $max))->getLastMessage(getAgoDaysJDate(3));
            while ($row = $result->fetch_assoc()) $messageList[] = json_encode($row);
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $messageList));
    }

    public function getOldMessage($data)
    {
        $messageList = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $min = min($userId, $data['otherId']);
            $max = max($userId, $data['otherId']);
            $result = (new Chat($min, $max))->getOldMessage($data['lastId']);
            while ($row = $result->fetch_assoc()) $messageList[] = json_encode($row);
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $messageList));
    }

    public function getNewMessage($data)
    {
        $messageList = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $min = min($userId, $data['otherId']);
            $max = max($userId, $data['otherId']);
            $result = (new Chat($min, $max))->getNewMessage($data['lastId']);
            $messageList[] = (String)((new Chat($min, $max))->lastSeenId($userId));
            while ($row = $result->fetch_assoc()) $messageList[] = json_encode($row);
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $messageList));
    }

    public function seen($data)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $min = min($userId, $data['otherId']);
            $max = max($userId, $data['otherId']);
            (new Chat($min, $max))->seen($data['otherId']);
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

}