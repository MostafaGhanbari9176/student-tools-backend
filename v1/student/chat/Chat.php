<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 06/08/2019
 * Time: 04:58 PM
 */

class Chat
{

    private $tbName;
    private $con;

    public function __construct($minUserId, $maxUserId)
    {
        $this->tbName = $minUserId . "s" . $maxUserId;
        $this->con = (new DBConnection())->connect();
    }

    public function createTable(): bool
    {
        $sql = "CREATE TABLE $this->tbName (
                 `m_id` int(11) NOT NULL AUTO_INCREMENT,
                 `user_id` int(11) NOT NULL,
                 `send_date` varchar(10) NOT NULL,
                 `send_time` varchar(5) NOT NULL,
                 `m_text` varchar(500) NOT NULL,
                 `status` tinyint(1) NOT NULL DEFAULT '1',
                 `file_id` int(11) NOT NULL DEFAULT '0',
                 `path_id` int(11) NOT NULL DEFAULT '0',
                 PRIMARY KEY (`m_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        $result = $this->con->prepare($sql);
        $data = $result->execute();
        $result->close();
        return $data;

    }

    public function saveMessage($user_id, $send_date, $send_time, $m_text, $file_id, $path_id): bool
    {
        try {

            $sql = "INSERT INTO $this->tbName (user_id, send_date, send_time, m_text, file_id, path_id) VALUES (?,?,?,?,?,?)";
            $result = $this->con->prepare($sql);
            $result->bind_param('isssii', $user_id, $send_date, $send_time, $m_text, $file_id, $path_id);

        } catch (Error $e) {
            return false;
        }
        $data = $result->execute();
        $result->close();
        return $data;
    }

    public function getLastMessage($startDate)
    {
        $sql = "SELECT t.m_id, t.m_text, t.user_id, t.send_date, t.send_time, t.path_id, t.status, t.file_id FROM $this->tbName t WHERE t.send_date > $startDate ORDER BY t.m_id DESC";
        $result = $this->con->prepare($sql);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;

    }

    public function getOldMessage($lastId)
    {
        $num = 20;
        $sql = "SELECT t.m_text, t.user_id, t.send_date, t.send_time, t.path_id, t.status, t.file_id FROM $this->tbName t WHERE t.m_id < ? ORDER BY t.m_id DESC LIMIT ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ii', $lastId, $num);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;

    }

    public function getNewMessage($lastId)
    {
        $sql = "SELECT t.m_id, t.m_text, t.user_id, t.send_date, t.send_time, t.path_id, t.status, t.file_id FROM $this->tbName t WHERE t.m_id > ? ORDER BY t.m_id ASC";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $lastId);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;

    }

    public function seen($userId):bool
    {
        $sql = "UPDATE $this->tbName SET status = 2 WHERE user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $data = $result->execute();
        $result->close();
        return $data;

    }

    public function lastSeenId($userId):int
    {
        $sql = "SELECT m_id FROM $this->tbName WHERE user_id = ? AND status = 2 ORDER BY m_id DESC LIMIT 1";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result();
        if($data->num_rows > 0)
            $data = $data->fetch_assoc()['m_id'];
        else
            $data = -1;
        $result->close();
        return $data;

    }

}