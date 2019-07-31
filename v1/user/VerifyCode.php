<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 02:09 PM
 */

class VerifyCode
{
    private $tbName = "verify_code";
    private $con;

    public function __construct()
    {
        $this->con = (new DBConnection())->connect();
    }

    public function add($phone, $code, $send_date, $send_time):bool
    {
        $sql = "INSERT INTO $this->tbName (code, phone, send_date, send_time) VALUES (?,?,?,?)";
        $result = $this->con->prepare($sql);
        $result->bind_param('ssss', $code, $phone, $send_date, $send_time);
        $data = $result->execute();
        $result->close();
        return $data;

    }

    public function update($phone, $code, $send_date, $send_time):bool
    {
        $sql = "UPDATE $this->tbName SET code = ?, send_date = ? , send_time = ? WHERE phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ssss',$code, $send_date, $send_time, $phone);
        $data = $result->execute();
        $result->close();
        return $data;
    }

    public function getCode($phone):String
    {
        $sql = "SELECT t.code FROM $this->tbName t WHERE t.phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('s', $phone);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['code'];
        $result->close();
        return $data;
    }

    public function remove($phone)
    {
        $sql = "DELETE FROM $this->tbName WHERE phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('s', $phone);
        $result->execute();
        $result->close();
    }

}