<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 20/07/2019
 * Time: 11:47 PM
 */

require_once "model/Student.php";

class StudentPresenter
{

    public function addStudent($phone, $sId, $name){
        (new Student())->addStudent($phone, $sId, $name, "454", "1397/02/01:22:30");
    }

}