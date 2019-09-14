<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 14/09/2019
 * Time: 04:57 PM
 */

class Ads
{

    private $adsTable = "ads_table";
    private $groupTable = "ads_group";
    private $con;

    public function __construct()
    {
        $this->con = (new DBConnection())->connect();
    }

    public function getGroupList(): mysqli_result
    {

        $sql = "SELECT * FROM $this->groupTable";
        $result = $this->con->prepare($sql);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function getByGroupId($groupId, $num, $step)
    {
        $offset = ($step - 1) * $num;
        $sql = "SELECT * FROM $this->adsTable WHERE group_id = ? LIMIT ?,?";
        $result = $this->con->prepare($sql);
        $result->bind_param('iii', $groupId, $offset, $num);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function get($adsId)
    {
        $sql = "SELECT * FROM $this->adsTable WHERE a_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $adsId);
        $result->execute();
        $data = $result->get_result();
        if ($data->num_rows > 0)
            $data = $data->fetch_assoc();
        else
            $data = false;
        $result->close();
        return $data;
    }

    public function incrementSeen($adsId)
    {
        $sql = "UPDATE $this->adsTable SET seen = seen+1 WHERE a_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $adsId);
        $result->execute();
        $result->close();
    }

    public function getSpecial(): mysqli_result
    {
        $sql = "SELECT * FROM $this->adsTable WHERE special = 1";
        $result = $this->con->prepare($sql);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function getByFieldId($fieldId, $lastId, $date)
    {
        $sql = "SELECT * FROM $this->adsTable WHERE $fieldId = ? AND a_id > ? AND a_date > ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('iis', $fieldId, $lastId, $date);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

}