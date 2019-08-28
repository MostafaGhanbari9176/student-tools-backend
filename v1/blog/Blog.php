<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 27/08/2019
 * Time: 03:30 PM
 */

class Blog
{
    private $con;
    private $tbName = "blog";

    public function __construct()
    {
        $this->con = (new DBConnection())->connect();
    }

    public function add($m_text, $m_date, $m_time, $user_id, $file_id):bool{
        $sql = "INSERT INTO $this->tbName (m_text, m_date, m_time, user_id, file_id) VALUES (?,?,?,?,?)";
        $result = $this->con->prepare($sql);
        $result->bind_param('sssii', $m_text, $m_date, $m_time, $user_id, $file_id);
        $data = $result->execute();
        $result->close();
        return $data;
    }

    public function getPerLike($num, $step):mysqli_result{
        $offset = ($step -1) *$num;
        $sql = "SELECT m_id, m_text, m_date, m_time, user_id, file_id, seen_num FROM $this->tbName WHERE status = 0 ORDER BY CHAR_LENGTH(like_list) DESC LIMIT ? , ? ";
        $result = $this->con->prepare($sql);
        $result->bind_param('ii', $offset, $num);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function getPerDate($num, $step):mysqli_result{
        $offset = ($step -1) *$num;
        $sql = "SELECT m_id, m_text, m_date, m_time, user_id, file_id, seen_num FROM $this->tbName WHERE status = 0 ORDER BY m_id DESC LIMIT ? , ? ";
        $result = $this->con->prepare($sql);
        $result->bind_param('ii', $offset, $num);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function getByUserId($num, $step):mysqli_result{
        $offset = ($step -1) *$num;
        $sql = "SELECT m_text, m_date, m_time, user_id, file_id, seen_num FROM $this->tbName WHERE status = 0 ORDER BY like_list ASC LIMIT ? , ? ";
        $result = $this->con->prepare($sql);
        $result->bind_param('ii', $offset, $num);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function seen($mId)
    {
        $sql = "UPDATE $this->tbName t SET t.seen_num = t.seen_num + 1 WHERE t.m_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $mId);
        $result->execute();
        $result->close();
    }

    public function getLike($mId):mysqli_result
    {
        $sql = "SELECT like_list FROM $this->tbName WHERE m_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $mId);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;

    }

    public function updateLike($mId, $likeList):bool
    {
        $sql = "UPDATE $this->tbName SET like_list = ? WHERE m_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('si', $likeList, $mId);
        $data = $result->execute();
        $result->close();
        return $data;

    }

    public function liked($mId, $userId):int
    {
        $userId = '%"'.$userId.'"%';
        $sql = "SELECT COUNT(*) FROM $this->tbName WHERE m_id = ? AND like_list LIKE ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('is', $mId, $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()["COUNT(*)"];
        $result->close();
        return $data;

    }

    public function changeStatus($mId, $status)
    {
        $sql = "UPDATE $this->tbName t SET t.status = ? WHERE t.m_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ii', $status, $mId);
        $result->execute();
        $result->close();
    }

    public function getLastId($userId): Int
    {
        $sql = "SELECT t.m_id FROM $this->tbName t WHERE t.user_id = ? ORDER BY t.m_id DESC LIMIT 1";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['m_id'];
        $result->close();
        return $data;
    }


}