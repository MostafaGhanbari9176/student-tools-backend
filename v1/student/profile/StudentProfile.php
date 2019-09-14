<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 09:53 PM
 */

/*require_once('../../../vendor/excel/php-excel-reader/excel_reader2.php');
require_once('../../../vendor/excel/SpreadsheetReader_XLSX.php');
require_once('../../../vendor/excel/SpreadsheetReader.php');*/

class StudentProfile
{
    private $tbName = "student_profile";
    private $con;

    public function __construct()
    {
        $this->con = (new DBConnection())->connect();
    }

    public function add($sId, $userId, $name, $last_date, $last_time): bool
    {
        $sql = "INSERT INTO $this->tbName (s_id, user_id, user_name, last_date, last_time) VALUES (?,?,?,?,?)";
        $result = $this->con->prepare($sql);
        $result->bind_param('sisss', $sId, $userId, $name, $last_date, $last_time);
        $data = $result->execute();
        $result->close();
        return $data;

    }

    public function getMyData($userId): Array
    {
        $sql = "SELECT t.user_name , t.s_id FROM $this->tbName t WHERE t.user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc();
        $result->close();
        return $data;
    }

    public function getName($userId, $otherId): String
    {
        $otherId = '"' . $otherId . '"';
        $sql = "SELECT t.user_name FROM $this->tbName t WHERE t.user_id = ? AND (t.name_el = 0 OR t.friend_list LIKE '%$otherId%')";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc();
        if ($data != null)
            $data = $data['user_name'];
        else
            $data = "نام:پنهان شده";
        $result->close();
        return $data;
    }

    public function checkPhoneAccess($userId, $otherId): bool
    {
        $otherId = '"' . $otherId . '"';
        $sql = "SELECT t.user_name FROM $this->tbName t WHERE t.user_id = ? AND (t.phone_el = 0 OR t.friend_list LIKE '%$otherId%')";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc();
        $result->close();
        return $data != null;
    }

    public function itsFriend($userId, $otherId): bool
    {
        $otherId = '"' . $otherId . '"';
        $sql = "SELECT t.user_name FROM $this->tbName t WHERE t.user_id = ? AND (t.friend_list LIKE '%$otherId%')";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc();
        $result->close();
        return $data != null;
    }

    public function checkImgAccess($userId, $otherId): bool
    {
        $otherId = '"' . $otherId . '"';
        $sql = "SELECT t.user_name FROM $this->tbName t WHERE t.user_id = ? AND (t.img_el = 0 OR t.friend_list LIKE '%$otherId%')";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc();
        $result->close();
        return $data != null;
    }

    public function getSId($userId): String
    {
        $sql = "SELECT t.s_id FROM $this->tbName t WHERE t.user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result();
        if ($data->num_rows > 0)
            $data = $data->fetch_assoc()['s_id'];
        else
            $data = "";
        $result->close();
        return $data;
    }

    public function getManySId($userIdList)
    {
        $sql = "SELECT t.s_id, t.user_id FROM $this->tbName t WHERE t.user_id IN ($userIdList)";
        $result = $this->con->prepare($sql);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function getFriendList($userId)
    {
        $sql = "SELECT t.friend_list FROM $this->tbName t WHERE t.user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        if ($data = $result->get_result())
            $data = $data->fetch_assoc()['friend_list'];
        $result->close();
        return $data;
    }

    public function upDateFriendList($userId, $friendList): bool
    {
        $sql = "UPDATE $this->tbName SET friend_list = ? WHERE user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('si', $friendList, $userId);
        $data = $result->execute();
        $result->close();
        return $data;
    }

    public function getChatList($userId)
    {
        $sql = "SELECT t.chat_list FROM $this->tbName t WHERE t.user_id = ? AND t.chat_list IS NOT NULL";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result();
        if ($data->num_rows > 0)
            $data = $data->fetch_assoc()['chat_list'];
        else
            $data = false;
        $result->close();
        return $data;
    }

    public function getAllChatList($userId)
    {
        $sql = "SELECT t.chat_list, t.group_list, t.channel_list FROM $this->tbName t WHERE t.user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result();
        if ($data->num_rows > 0)
            $data = $data->fetch_assoc();
        else
            $data = false;
        $result->close();
        return $data;
    }

    public function upDateChatList($userId, $chat_list): bool
    {
        $sql = "UPDATE $this->tbName SET chat_list = ? WHERE user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('si', $chat_list, $userId);
        $data = $result->execute();
        $result->close();
        return $data;
    }

    public function upDateAboutMe($userId, $about_me)
    {
        $sql = "UPDATE $this->tbName SET about_me = ? WHERE user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('si', $about_me, $userId);
        $result->execute();
        $result->close();
    }

    public function getAboutMe($userId): String
    {
        $sql = "SELECT t.about_me FROM $this->tbName t WHERE t.user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['about_me'];
        $result->close();
        return $data;
    }

    public function getPhoneEl($userId): Int
    {
        $sql = "SELECT t.phone_el FROM $this->tbName t WHERE t.user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['phone_el'];
        $result->close();
        return $data;
    }

    public function changePhoneEl($userId, $code)
    {
        $sql = "UPDATE $this->tbName SET phone_el = ? WHERE user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ii', $code, $userId);
        $result->execute();
        $result->close();
    }

    public function getNameEl($userId): Int
    {
        $sql = "SELECT t.name_el FROM $this->tbName t WHERE t.user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['name_el'];
        $result->close();
        return $data;
    }

    public function changeNameEl($userId, $code)
    {
        $sql = "UPDATE $this->tbName SET name_el = ? WHERE user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ii', $code, $userId);
        $result->execute();
        $result->close();
    }

    public function getImgEl($userId): Int
    {
        $sql = "SELECT t.img_el FROM $this->tbName t WHERE t.user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()['img_el'];
        $result->close();
        return $data;
    }

    public function changeImgEl($userId, $code)
    {
        $sql = "UPDATE $this->tbName SET img_el = ? WHERE user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ii', $code, $userId);
        $result->execute();
        $result->close();
    }

    public function getData($userId): Array
    {
        $sql = "SELECT t.s_id , t.email , t.about_me , t.last_date , t.last_time FROM $this->tbName t WHERE t.user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc();
        $result->close();
        return $data;
    }

    public function searchBySId($key, $step, $num)
    {
        $offset = ($step - 1) * $num;
        $key = "$key%";
        //$sql = "SELECT * FROM $this->tbName t WHERE MATCH (t.s_id) AGAINST ('$key' IN BOOLEAN MODE)";
        $sql = "SELECT t.s_id, t.user_id FROM $this->tbName t WHERE t.s_id LIKE ? LIMIT ?, ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('sii', $key, $offset, $num);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function getGroupList($userId)
    {
        $sql = "SELECT group_list FROM $this->tbName WHERE user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result();
        if ($data->num_rows > 0)
            $data = $data->fetch_assoc()['group_list'];
        else
            $data = "";
        $result->close();
        return $data;
    }

    public function upDateGroupList($userId, $newData)
    {
        $sql = "UPDATE $this->tbName SET group_list = ? WHERE user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('si', $newData, $userId);
        $data = $result->execute();
        $result->close();
        return $data;
    }

    public function changeOnline($userId, $value, $d, $t)
    {
        if ($value == 1)
            $sql = "UPDATE $this->tbName SET on_line = $value WHERE user_id = ?";
        else
            $sql = "UPDATE $this->tbName SET on_line = $value , last_time = '$t' , last_date = '$d' WHERE user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $data = $result->execute();
        $result->close();
        return $data;
    }

    public function getLastSeen($userId)
    {
        $sql = "SELECT last_time , last_date, on_line FROM $this->tbName WHERE user_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $userId);
        $result->execute();
        $data = $result->get_result();
        if ($data->num_rows > 0)
            $data = $data->fetch_assoc();
        else
            $data = false;
        $result->close();
        return $data;

    }

    public function insertSql()
    {
        try {
            $Reader = new SpreadsheetReader('../../../files/list2.xlsx');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $count = 1;
        //$Reader = $Reader->SharedStringCache;
        foreach ($Reader as $Row) {
            $this->add($Row[4], $count++, $Row[2] . " " . $Row[3], "1397-02-05", "20:25");
        }
    }


}