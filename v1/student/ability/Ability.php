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

    public function add($userId, $subject, $resume, $description, $add_date):bool
    {
        $sql = "INSERT INTO $this->tbName (user_id, subject, resume, description, add_date) VALUES (?,?,?,?,?)";
        $result = $this->con->prepare($sql);
        $result->bind_param('issss', $userId, $subject, $resume, $description, $add_date);
        $data = $result->execute();
        $result->close();
        return $data;

    }

    public function getMyList($userId):mysqli_result
    {
        $sql = "SELECT t.ability_id , t.subject From $this->tbName t WHERE t.user_id = ? AND NOT t.status = 4";
        $result = $this->con->prepare($sql);
        $result->bind_param('i',$userId );
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;

    }

    public function getList($userId):mysqli_result
    {
        $sql = "SELECT t.ability_id , t.subject From $this->tbName t WHERE t.user_id = ? AND t.status = 1";
        $result = $this->con->prepare($sql);
        $result->bind_param('i',$userId );
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;

    }

    public function getMySingle($userId, $ability_id):Array
    {
        $sql = "SELECT * From $this->tbName t WHERE t.ability_id = ? AND t.user_id = ? AND NOT t.status = 4";
        $result = $this->con->prepare($sql);
        $result->bind_param('ii',$ability_id, $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc();
        $result->close();
        return $data;

    }

    public function getSingle($ability_id):Array
    {
        $sql = "SELECT * From $this->tbName t WHERE t.ability_id = ? AND t.status = 1";
        $result = $this->con->prepare($sql);
        $result->bind_param('i',$ability_id );
        $result->execute();
        $data = $result->get_result()->fetch_assoc();
        $result->close();
        return $data;

    }

    public function edit($ability_id, $subject, $resume, $description, $status)
    {
        $sql = "UPDATE $this->tbName SET subject = ? , resume = ? , description = ? , status = ? WHERE ability_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('sssii', $subject, $resume, $description, $status, $ability_id);
        $result->execute();
        $result->close();
    }

    public function changeStatus($userId, $ability_id, $status)
    {
        $sql = "UPDATE $this->tbName SET status = ? WHERE ability_id = ? AND user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('iii', $status, $ability_id, $userId);
        $result->execute();
        $result->close();
    }

}