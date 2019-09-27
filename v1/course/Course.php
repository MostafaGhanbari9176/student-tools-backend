<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 16/09/2019
 * Time: 07:49 PM
 */

class Course
{

    private $courseTable = "course_table";
    private $groupTable = "course_group";

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
        $sql = "SELECT c_id, c_name, c_date, owner_name, group_id, seen FROM $this->courseTable WHERE group_id = ? AND special = 0 ORDER BY c_id DESC LIMIT ?,?";
        $result = $this->con->prepare($sql);
        $result->bind_param('iii', $groupId, $offset, $num);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function get($courseId)
    {
        $sql = "SELECT * FROM $this->courseTable WHERE c_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $courseId);
        $result->execute();
        $data = $result->get_result();
        if ($data->num_rows > 0)
            $data = $data->fetch_assoc();
        else
            $data = false;
        $this->incrementSeen($courseId);
        return $data;
    }

    public function incrementSeen($courseId)
    {
        $sql = "UPDATE $this->courseTable SET seen = seen+1 WHERE c_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $courseId);
        $result->execute();
        $result->close();
    }

    public function getSpecial(): mysqli_result
    {
        $sql = "SELECT c_id, c_name, owner_name FROM $this->courseTable WHERE special = 1 ORDER BY c_id DESC LIMIT 10";
        $result = $this->con->prepare($sql);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

}