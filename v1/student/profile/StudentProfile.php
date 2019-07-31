<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 09:53 PM
 */

class StudentProfile
{
    private $tbName = "student_profile";
    private $con;

    public function __construct()
    {
        $this->con = (new DBConnection())->connect();
    }

    public function add($s_id, $phone, $name, $last_date, $last_time): bool
    {
        $sql = "INSERT INTO $this->tbName (s_id, phone, name, last_date, last_time) VALUES (?,?,?,?,?)";
        $result = $this->con->prepare($sql);
        $result->bind_param('sssss', $s_id, $phone, $name, $last_date, $last_time);
        $data = $result->execute();
        $result->close();
        return $data;

    }

    public function get($phone): Array
    {
        $sql = "SELECT t.name , t.s_id FROM $this->tbName WHERE t.phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('s', $phone);
        $result->execute();
        $data = $result->get_result()->fetch_assoc();
        $result->close();
        return $data;
    }

    public function upDateAboutMe($phone, $about_me)
    {
        $sql = "UPDATE $this->tbName SET about_me = ? WHERE phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ss', $about_me, $phone);
        $result->execute();
        $result->close();
    }

    public function getAboutMe($phone): String
    {
        $sql = "SELECT t.about_me FROM $this->tbName t WHERE t.phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('s', $phone);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['about_me'];
        $result->close();
        return $data;
    }

    public function getPhoneEl($phone): Int
    {
        $sql = "SELECT t.phone_el FROM $this->tbName t WHERE t.phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('s', $phone);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['phone_el'];
        $result->close();
        return $data;
    }

    public function changePhoneEl($phone, $code)
    {
        $sql = "UPDATE $this->tbName SET phone_el = ? WHERE phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ss', $code, $phone);
        $result->execute();
        $result->close();
    }

    public function getNameEl($phone): Int
    {
        $sql = "SELECT t.name_el FROM $this->tbName t WHERE t.phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('s', $phone);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['name_el'];
        $result->close();
        return $data;
    }

    public function changeNameEl($phone): Int
    {
        $sql = "UPDATE $this->tbName SET name_el = ? WHERE phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ss', $code, $phone);
        $result->execute();
        $result->close();
    }

    public function getImgEl($phone): Int
    {
        $sql = "SELECT t.img_el FROM $this->tbName t WHERE t.phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('s', $phone);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['img_el'];
        $result->close();
        return $data;
    }

    public function changeImgEl($phone): Int
    {
        $sql = "UPDATE $this->tbName SET img_el = ? WHERE phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ss', $code, $phone);
        $result->execute();
        $result->close();
    }
}