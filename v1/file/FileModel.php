<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 15/08/2019
 * Time: 10:58 PM
 */

class FileModel
{

    private $con;
    private $tbName = "file_inf";

    public function __construct()
    {
        $this->con = (new DBConnection())->connect();
    }

    public function saveFile($user_id, $up_date, $up_time, $dir_name, $eye_level, $fileType):bool
    {
        $sql = "INSERT INTO $this->tbName (user_id, up_date, up_time, dir_name, eye_level, f_type) VALUES (?,?,?,?,?,?)";
        $result = $this->con->prepare($sql);
        $result->bind_param('isssis', $user_id, $up_date, $up_time, $dir_name, $eye_level, $fileType);
        $data = $result->execute();
        $result->close();
        return $data;

    }

    public function getLastId($userId)
    {
        $sql = "SELECT f_id FROM $this->tbName WHERE user_id = ? ORDER BY f_id DESC LIMIT 1";
        $result = $this->con->prepare($sql);
        $result->bind_param('i',$userId);
        $result->execute();
        $data = $result->get_result();
        if($data->num_rows > 0)
            $data = $data->fetch_assoc()['f_id'];
        else
            $data = 0;
        $result->close();
        return $data;
    }

    public function getData($fileId):array
    {
        $sql = "SELECT dir_name, f_type FROM $this->tbName WHERE f_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i',$fileId);
        $result->execute();
        $data = $result->get_result();
        if($data->num_rows > 0)
            $data = $data->fetch_assoc();
        else
            $data = array();
        $result->close();
        return $data;
    }

}