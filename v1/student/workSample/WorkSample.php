<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 10:47 PM
 */

class WorkSample
{
    private $con;
    private $tbName = "work_sample";

    public function __construct()
    {
        $this->con = (new DBConnection())->connect();
    }

    public function add($abilityId, $subject, $description, $addDate, $imgNum): bool
    {
        $sql = "INSERT INTO $this->tbName (ability_id, subject, description, add_date, img_num) VALUES (?,?,?,?,?)";
        $result = $this->con->prepare($sql);
        $result->bind_param('isssi', $abilityId, $subject, $description, $addDate, $imgNum);
        $data = $result->execute();
        $result->close();
        return $data;
    }

    public function edit($workSampleId, $subject, $description, $imgNum, $status): bool
    {
        $sql = "UPDATE $this->tbName SET subject = ?, description = ?, img_num = ?, status = ? WHERE work_sample_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ssiii', $subject, $description, $imgNum, $status, $workSampleId);
        $data = $result->execute();
        $result->close();
        return $data;
    }

    public function getLastId($abilityId): Int
    {
        $sql = "SELECT t.work_sample_id FROM $this->tbName t WHERE t.ability_id = ? ORDER BY t.work_sample_id DESC LIMIT 1";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $abilityId);
        $result->execute();
        $result->error;
        $data = $result->get_result()->fetch_assoc()['work_sample_id'];
        $result->close();
        return $data;
    }

    public function getMyList($abilityId): mysqli_result
    {
        $sql = "SELECT t.seen_num , t.like_list , t.work_sample_id FROM $this->tbName t WHERE t.ability_id = ? AND NOT t.status = 4";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $abilityId);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;

    }

    public function getList($abilityId): mysqli_result
    {
        $sql = "SELECT t.seen_num , t.like_list , t.work_sample_id FROM $this->tbName t WHERE t.ability_id = ? AND t.status = 1";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $abilityId);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function getMySingle($workSampleId): array
    {
        $sql = "SELECT * FROM $this->tbName t WHERE t.work_sample_id = ? AND NOT t.status = 4";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $workSampleId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc();
        $result->close();
        return $data;
    }

    public function getSingle($workSampleId): array
    {
        $sql = "SELECT t.img_num , t.seen_num , t.like_list , t.work_sample_id , t.subject , t.description , t.add_date FROM $this->tbName t WHERE t.work_sample_id = ? AND t.status = 1";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $workSampleId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc();
        $result->close();
        return $data;
    }

    public function changeStatus($workSampleId, $status)
    {
        $sql = "UPDATE $this->tbName t SET t.status = ? WHERE t.work_sample_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('ii', $status, $workSampleId);
        $result->execute();
        $result->close();
    }

    public function seen($workSampleId)
    {
        $sql = "UPDATE $this->tbName t SET t.seen_num = t.seen_num + 1 WHERE t.work_sample_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $workSampleId);
        $result->execute();
        $result->close();
    }

    public function getLike($workSampleId):mysqli_result
    {
        $sql = "SELECT like_list FROM $this->tbName WHERE work_sample_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i', $workSampleId);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;

    }

    public function updateLike($workSampleId, $likeList):bool
    {
        $sql = "UPDATE $this->tbName SET like_list = ? WHERE work_sample_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('si', $likeList, $workSampleId);
        $data = $result->execute();
        $result->close();
        return $data;

    }

    public function liked($workSampleId, $userId):int
    {
        $userId = '%"'.$userId.'"%';
        $sql = "SELECT COUNT(*) FROM $this->tbName WHERE work_sample_id = ? AND like_list LIKE ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('is', $workSampleId, $userId);
        $result->execute();
        $data = $result->get_result()->fetch_assoc()["COUNT(*)"];
        $result->close();
        return $data;

    }

}