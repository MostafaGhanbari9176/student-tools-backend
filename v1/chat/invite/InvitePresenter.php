<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 06/09/2019
 * Time: 10:08 PM
 */

require_once dirname(__FILE__)."/../ChatPresenter.php";
require_once dirname(__FILE__)."/../../student/profile/StudentProfilePresenter.php";
require_once dirname(__FILE__)."/../groupChat/GroupChatPresenter.php";
require_once "Invite.php";

class InvitePresenter
{
    public function inviteMessage($data)
    {
        $code = 200;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new Invite())->add($data['groupId'], $data['otherId'], $userId);
            if ($result !== false) {
                $id = (new Invite())->lastId($userId);
                $code = (new ChatPresenter())->saveMessage($userId, $data['otherId'], array("message"), 0, 0, $id);
            }
        } else
            $code = 400;
        return json_encode(array("code" => $code));
    }

    public function accept($data)
    {
        $code = 200;
        $groupId = "-1";
        $message = null;
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $result = (new Invite())->getGroupId($userId, $data['inviteId'], true);
                $message = "قبلا انجام شده";
            if ($result !== false) {
                $message = null;
                $groupId = $result;
                (new Invite())->expired($data['inviteId']);
                (new StudentProfilePresenter())->addToGroupChat($userId, $groupId);
                (new GroupChatPresenter())->addToMemberList($groupId, $userId);
                $code = 100;
            }

        } else
            $code = 400;
        return json_encode(array("code" => $code, "message" => $message, "data" => array((String)$groupId)));

    }

}