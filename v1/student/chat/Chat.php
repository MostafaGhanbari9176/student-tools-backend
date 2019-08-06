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
                 `m_seen` tinyint(1) NOT NULL DEFAULT '0',
                 `status` tinyint(1) NOT NULL DEFAULT '0',
                 `file_id` int(11) NOT NULL,
                 PRIMARY KEY (`m_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        $result = $this->con->prepare($sql);
        $data = $result->execute();
        $result->close();
        return $data;

    }

    public function saveMessage($user_id, $send_date, $send_time, $m_text, $file_id): bool
    {
        try {

            $sql = "INSERT INTO $this->tbName (user_id, send_date, send_time, m_text, file_id) VALUES (?,?,?,?,?)";
            $result = $this->con->prepare($sql);
            $result->bind_param('isssi', $user_id, $send_date, $send_time, $m_text, $file_id);

        } catch (Error $e) {
            return false;
        }
        $data = $result->execute();
        $result->close();
        return $data;
    }

    public function getMessageList($step, $num)
    {
        $offset = ($step - 1) * $num;
        $sql = "SELECT t.m_text, t.user_id, t.send_date, t.send_time, t.m_Seen FROM $this->tbName t WHERE t.status = 0 ORDER BY t.m_id DESC LIMIT ?, ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ii', $offset, $num);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;

    }

    public function getLastMessage($lastId)
    {
        $sql = "SELECT t.m_text, t.user_id, t.send_date, t.send_time, t.m_Seen FROM $this->tbName t WHERE t.status = 0 AND t.m_id > ? ORDER BY t.m_id DESC";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $lastId);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;

    }

}