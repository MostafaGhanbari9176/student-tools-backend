<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 07:59 PM
 */

require_once "Ability.php";
require_once "../../user/UserPresenter.php";

class AbilityPresenter
{
    public function addAbility($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            (new Ability())->add($data['phone'], $data['subject'], $data['resume'], $data['description'], getJDate());

        } else
            $code = 400;//apiCodeError
        $res = array("code" => $code);
        return json_encode($res);


    }

    public function getList($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            $result = (new Ability())->getList($data['phone']);
            while ($row = $result->fetch_assoc()) $list[] = $row;
        } else
            $code = 400;//apiCodeError
        $res = array("code" => $code, "data" => $list);
        return json_encode($res);
    }

    public function getSingle($data)
    {
        $result = array();
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            $result[] = (new Ability())->getSingle($data['ability_id']);
        } else
            $code = 400;//apiCodeError
        $res = array("code" => $code, "data" => $result);
        return json_encode($res);
    }

    public function edit($data)
    {

        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            (new Ability())->edit($data['ability_id'], $data['subject'], $data['resume'], $data['description'], 0/*dar entezar taeid*/);

        } else
            $code = 400;//apiCodeError
        $res = array("code" => $code);
        return json_encode($res);
    }

    public function changeStatus($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            (new Ability())->changeStatus($data['ability_id'], $data['code']);

        } else
            $code = 400;//apiCodeError
        $res = array("code" => $code);
        return json_encode($res);
    }

}