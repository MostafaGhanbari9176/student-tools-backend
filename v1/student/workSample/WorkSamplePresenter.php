<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 10:47 PM
 */

require "WorkSample.php";
require "../../user/UserPresenter.php";

class WorkSamplePresenter
{

    public function add($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
        $code = 100;
            //(new WorkSample())->
        }
    }
}