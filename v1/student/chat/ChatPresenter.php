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

class ChatPresenter
{
    public function sendMessage($data)
    {
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $min = min($userId, $data['otherId']);
            $max = max($userId, $data['otherId']);
            $result = (new Chat($min, $max))->saveMessage($userId, getJDate(), Date("H:i"), $data['text'], 1);
            if ($result)
                $code = 100;
            else {
                $this->createTable($min, $max);
                $result = (new Chat($min, $max))->saveMessage($userId, getJDate(), Date("H:i"), $data['text'], 1);
                if ($result)
                    $code = 100;
            }
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    public function createTable($min, $max)
    {
        (new Chat($min, $max))->createTable();
        (new StudentProfilePresenter())->addChat($min, $max);

    }

    public function getMessageList($data)
    {
        $messageList = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $min = min($userId, $data['otherId']);
            $max = max($userId, $data['otherId']);
            $result = (new Chat($min, $max))->getMessageList($data['step'], $data['num']);
            while ($row = $result->fetch_assoc()) $messageList[] = json_encode($row);
            $code = 100;
        }else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $messageList));
    }

    public function getLastMessage($data)
    {
        $messageList = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $min = min($userId, $data['otherId']);
            $max = max($userId, $data['otherId']);
            $result = (new Chat($min, $max))->getLastMessage($data['lastId']);
            while ($row = $result->fetch_assoc()) $messageList[] = json_encode($row);
            $code = 100;
        }else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $messageList));
    }

}