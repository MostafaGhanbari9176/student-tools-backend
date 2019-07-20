<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 20/07/2019
 * Time: 09:45 PM
 */

require_once "model/User.php";

class UserPresenter
{

    public function addUser($phone, $sId, $name)
    {
        (new User())->addUser($phone, $sId, $name, 25,"1397/01/01");
    }

}