<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 06/09/2019
 * Time: 10:07 PM
 */

class Invite
{

    private $con;
    private $tbName = "invite";

    public function __construct()
    {
        $this->con = (new DBConnection())->connect();
    }

    public function add($groupId, $userId, $ownerId):bool
    {
        $sql = "INSERT INTO $this->tbName (group_id, user_id, owner_id) VALUES (?,?,?)";
        $result = $this->con->prepare($sql);
        $result->bind_param('iii', $groupId, $userId, $ownerId);
        $data = $result->execute();
        $result->close();
        return $data;
    }

    public function lastId($ownerId)
    {
        $sql = "SELECT i_id FROM $this->tbName WHERE owner_id = ? ORDER BY i_id DESC LIMIT 1";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $ownerId);
        $result->execute();
        $data = $result->get_result();
        if($data->num_rows >0)
            $data = $data->fetch_assoc()['i_id'];
        else
            $data = false;
        $result->close();
        return $data;
    }

    public function getGroupId($userId, $inviteId, $checkExpired = false)
    {
        if($checkExpired)
        $sql = "SELECT group_id FROM $this->tbName WHERE user_id = ? AND i_id = ? AND expired = 0";
        else
        $sql = "SELECT group_id FROM $this->tbName WHERE user_id = ? AND i_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ii',$userId, $inviteId);
        $result->execute();
        $data = $result->get_result();
        if($data -> num_rows > 0)
            $data = $data->fetch_assoc()['group_id'];
        else
            $data = false;
        $result->close();
        return $data;
    }

    public function expired ($inviteId)
    {
        $sql = "UPDATE $this->tbName SET expired = 1 WHERE i_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $inviteId);
        $result->execute();
        $result->close();
    }

}