<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 15/09/2019
 * Time: 02:41 AM
 */

class News
{
    private $newsTable = "news_table";
    private $groupTable = "news_group";
    private $agencyTable = "news_agency";
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
        $sql = "SELECT n_id, n_sub, n_date, lead, agency_id, group_id, status, seen FROM $this->newsTable WHERE group_id = ? AND status = 0 ORDER BY n_id DESC LIMIT ?,?";
        $result = $this->con->prepare($sql);
        $result->bind_param('iii', $groupId, $offset, $num);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function get($newsId)
    {
        $sql = "SELECT * FROM $this->newsTable WHERE n_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $newsId);
        $result->execute();
        $data = $result->get_result();
        if ($data->num_rows > 0)
            $data = $data->fetch_assoc();
        else
            $data = false;
        $this->incrementSeen($newsId);
        return $data;
    }

    public function incrementSeen($newsId)
    {
        $sql = "UPDATE $this->newsTable SET seen = seen+1 WHERE n_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $newsId);
        $result->execute();
        $result->close();
    }

    public function getSpecial(): mysqli_result
    {
        $sql = "SELECT n_id, n_sub, agency_id FROM $this->newsTable WHERE status = 1 OR status = 2 ORDER BY n_id DESC LIMIT 10";
        $result = $this->con->prepare($sql);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function getAgencyList(): mysqli_result

    {
        $sql = "SELECT a_id, a_sub FROM $this->agencyTable";
        $result = $this->con->prepare($sql);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function getAgencyData($agencyId)
    {
        $sql = "SELECT * FROM $this->agencyTable WHERE a_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $agencyId);
        $result->execute();
        $data = $result->get_result();
        if ($data->num_rows > 0)
            $data = $data->fetch_assoc();
        else
            $data = false;
        $result->close();
        return $data;
    }

}