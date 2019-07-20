<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 20/07/2019
 * Time: 09:45 PM
 */

require_once "uses/DBConnection.php";

class User
{

    private $con;
    private $tbName = "student";

    public function __construct()
    {
        $this->con = (new DBConnection())->connect();
    }

    public function addUser($phone, $sId, $name, $imgId, $lastSeen)
    {
        $sql = "INSERT INTO $this->tbName (`phone`, `student_id`, `name`, `img_id`, `last_seen`) VALUES (?,?,?,?,?)";
        $result = $this->con->prepare($sql);
        $result->bind_param('sssss',$phone,$sId, $name, $imgId, $lastSeen);
        $result->execute();

    }

}