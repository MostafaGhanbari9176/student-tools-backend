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
        $this->con = (new DBConnection())->connect() ;
    }

    public function add($ability_id, $subject, $description, $add_date, $img_id)
    {

    }

}