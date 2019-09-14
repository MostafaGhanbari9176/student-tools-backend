<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 14/09/2019
 * Time: 04:57 PM
 */

require_once dirname(__FILE__)."/../user/UserPresenter.php";
require_once "Ads.php";

class AdsPresenter
{

    public function getFirstData($data)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {

        }
    }

}