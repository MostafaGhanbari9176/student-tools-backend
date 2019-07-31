<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 07:59 PM
 */

class Ability
{
    private $tbName = "ability";
    private $con;

    public function __construct()
    {
        $this->con = (new DBConnection())->connect();
    }

    public function add($phone, $subject, $resume, $description, $add_date):bool
    {
        $sql = "INSERT INTO $this->tbName (phone, subject, resume, description, add_date) VALUES (?,?,?,?,?)";
        $result = $this->con->prepare($sql);
        $result->bind_param('sssss', $phone, $subject, $resume, $description, $add_date);
        $data = $result->execute();
        $result->close();
        return $data;

    }

    public function getList($phone):mysqli_result
    {
        $sql = "SELECT t.ability_id , t.subject From $this->tbName t WHERE t.phone = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('s',$phone );
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;

    }

    public function getSingle($ability_id):Array
    {
        $sql = "SELECT t.ability_id , t.subject From $this->tbName t WHERE t.ability_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('s',$ability_id );
        $result->execute();
        $data = $result->get_result()->fetch_assoc();
        $result->close();
        return $data;

    }

    public function edit($ability_id, $subject, $resume, $description, $status)
    {
        $sql = "UPDATE $this->tbName SET subject = ? , resume = ? , description = ? , status = ? WHERE ability_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('sssis', $subject, $resume, $description, $status, $ability_id);
        $result->execute();
        $result->close();
    }

    public function changeStatus($ability_id, $status)
    {
        $sql = "UPDATE $this->tbName SET status = ? WHERE ability_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('is', $status, $ability_id);
        $result->execute();
        $result->close();
    }

}