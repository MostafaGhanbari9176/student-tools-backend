<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 02/09/2019
 * Time: 03:46 PM
 */


class GroupChat
{
    private $tbName = "group_chat";
    private $con;

    public function __construct()
    {
        $this->con = (new DBConnection())->connect();
    }

    public function save($owner_id, $g_name, $c_date, $c_time, $join_mode, $invite_mode, $g_info): bool
    {
        $sql = "INSERT INTO $this->tbName (owner_id , g_name , c_date , c_time , join_mode , invite_mode , g_info) VALUES (?,?,?,?,?,?,?)";
        $result = $this->con->prepare($sql);
        $result->bind_param('isssiis', $owner_id, $g_name, $c_date, $c_time, $join_mode, $invite_mode, $g_info);
        $data = $result->execute();
        $result->close();
        return $data;
    }

    public function lastId($ownerId): int
    {
        $sql = "SELECT g_id FROM $this->tbName WHERE owner_id = ? ORDER BY g_id DESC LIMIT 1";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $ownerId);
        $result->execute();
        $data = $result->get_result();
        if ($data->num_rows > 0)
            $data = $data->fetch_assoc()['g_id'];
        else
            $data = -1;
        $result->close();
        return $data;
    }

    public function isMember($gId, $userId): bool
    {
        $userId = '%"' . $userId . '"%';
        $sql = "SELECT COUNT(g_id) FROM $this->tbName WHERE g_id = ? AND member_list LIKE ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('is', $gId, $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['COUNT(g_id)'];
        $result->close();
        return $data > 0;
    }

    public function hasAccess($gId, $userId): bool
    {
        $userId = '%"' . $userId . '"%';
        $sql = "SELECT COUNT(g_id) FROM $this->tbName WHERE g_id = ? AND (join_mode = 1 OR member_list LIKE ?)";
        $result = $this->con->prepare($sql);
        $result->bind_param('is', $gId, $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['COUNT(g_id)'];
        $result->close();
        return $data > 0;
    }

    public function getMemberList($gId, $userId, bool $access)
    {
        $userId = '%"' . $userId . '"%';
        if ($access)
            $sql = "SELECT member_list, owner_id FROM $this->tbName WHERE g_id = ? ";
        else
            $sql = "SELECT member_list, owner_id FROM $this->tbName WHERE g_id = ? AND (join_mode = 1 OR member_list LIKE ?)";
        $result = $this->con->prepare($sql);
        if ($access)
            $result->bind_param('i', $gId);
        else
            $result->bind_param('is', $gId, $userId);
        $result->execute();
        $data = $result->get_result();
        if ($data->num_rows > 0)
            $data = $data->fetch_assoc();
        else
            $data = false;
        $result->close();
        return $data;
    }

    public function updateMemberList($gId, $memberList, $userId, bool $access): bool
    {
        $userId = '%"' . $userId . '"%';
        if($access)
        $sql = "UPDATE $this->tbName SET member_list = ? WHERE g_id = ?";
        else
        $sql = "UPDATE $this->tbName SET member_list = ? WHERE g_id = ? AND member_list LIKE ?";
        $result = $this->con->prepare($sql);
        if($access)
        $result->bind_param('si', $memberList, $gId);
        else
        $result->bind_param('sis', $memberList, $gId, $userId);
        $data = $result->execute();
        $result->close();
        return $data;
    }

    public function getManyId($idList)
    {

        $sql = "SELECT t.g_id, t.g_name FROM $this->tbName t WHERE t.g_id IN ($idList)";
        $result = $this->con->prepare($sql);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;

    }

    public function get($groupId)
    {
        $sql = "SELECT owner_id, g_name, g_info, join_mode, invite_mode, c_date, c_time FROM $this->tbName WHERE g_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $groupId);
        $result->execute();
        $data = $result->get_result();
        if ($data->num_rows > 0)
            $data = $data->fetch_assoc();
        else
            $data = false;
        $result->close();
        return $data;
    }

    public function getName($groupId):String
    {
        $sql = "SELECT g_name FROM $this->tbName WHERE g_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $groupId);
        $result->execute();
        $data = $result->get_result();
        if($data->num_rows > 0)
            $data = $data->fetch_assoc()['g_name'];
        else
            $data = "";
        $result->close();
        return$data;
    }

    public function isOwner($userId, $groupId):bool
    {
        $sql = "SELECT COUNT(g_id) FROM $this->tbName WHERE owner_id = ? AND g_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ii', $userId, $groupId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['COUNT(g_id)'];
        $result->close();
        return $data > 0;
    }

}