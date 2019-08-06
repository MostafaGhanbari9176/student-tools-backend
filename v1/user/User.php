<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 07:18 AM
 */

class User
{

    private $con;
    private $tbName = "user";

    public function __construct()
    {
        $this->con = (new DBConnection())->connect();
    }

    public function add($phone, $api_code, $kind, $join_date):bool
    {
        $sql = "INSERT INTO $this->tbName (phone, api_code, kind, join_date) VALUES (?,?,?,?)";
        $result = $this->con->prepare($sql);
        $result->bind_param('ssis', $phone, $api_code, $kind, $join_date);
        $data = $result->execute();
        $result->close();
        return $data;
    }

    public function get($phone):Array
    {
        $sql="SELECT t.api_code , t.kind, t.phone FROM $this->tbName t WHERE t.phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('s', $phone);
        $result->execute();
        $data = $result->get_result()->fetch_assoc();
        $result->close();
        return $data;
    }

    public function upDateApiCode($phone, $api_code):bool
    {
        $sql = "UPDATE $this->tbName SET api_code = ? WHERE phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ss', $api_code, $phone);
        $data = $result->execute();
        $result->close();
        return $data;
    }

    public function getApiCode($phone):String
    {
        $sql="SELECT t.api_code FROM $this->tbName t WHERE t.phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('s', $phone);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['api_code'];
        $result->close();
        return $data;
    }

    public function getUserId($phone, $apiCode):mysqli_result
    {
        $sql="SELECT t.user_id FROM $this->tbName t WHERE t.phone = ? AND t.api_code = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ss', $phone, $apiCode);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function getKind($phone):Int
    {
        $sql = "SELECT t.kind FROM $this->tbName WHERE t.phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('s',$phone);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['kind'];
        $result->close();
        return $data;
    }

    public function getPass($phone): mysqli_result
    {
        $sql = "SELECT t.pass FROM $this->tbName t WHERE t.phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('s', $phone);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function changePass($phone, $pass)
    {
        $sql = "UPDATE $this->tbName SET pass = ? WHERE phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ss', $pass, $phone);
        $result->execute();
        $result->close();
    }

    public function getPhone($userId)
    {
        $sql = "SELECT t.phone FROM $this->tbName t WHERE t.user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['phone'];
        $result->close();
        return $data;
    }

}