<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 28/09/2019
 * Time: 09:47 PM
 */

class StudentFiled
{

    private $tbName = "field";
    private $con;

    public function __construct()
    {
        $this->con = (new DBConnection())->connect();
    }

    public function get()
    {
        $sql = "SELECT * FROM $this->tbName";
        $result = $this->con->prepare($sql);
        $result->execute();
        $data = $result->get_result();
        $result->close();
        return $data;
    }

    public function getName($fieldId)
    {
        $sql = "SELECT name_text FROM $this->tbName WHERE field_id = ?";
        $result = $this->con->prepare($sql);
        $result->bind_param('i',$fieldId);
        $result->execute();
        $data = $result->get_result();
        if ($data->num_rows > 0)
            $data = $data->fetch_assoc()['name_text'];
        else

            $data = "";
        $result->close();
        return $data;
    }

}