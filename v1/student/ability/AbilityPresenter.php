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
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            (new Ability())->add($userId, $data['subject'], $data['resume'], $data['description'], getJDate());

        } else
            $code = 400;//apiCodeError
        $res = array("code" => $code);
        return json_encode($res);


    }

    public function getMyList($data)
    {
        $list = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            $result = (new Ability())->getMyList($userId);
            while ($row = $result->fetch_assoc()) $list[] = json_encode($row);
        } else
            $code = 400;//apiCodeError
        $res = array("code" => $code, "data" => $list);
        return json_encode($res);
    }

    public function getList($data)
    {
        $list = array();
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            $result = (new Ability())->getList($data['otherId']);
            while ($row = $result->fetch_assoc()) $list[] = json_encode($row);
        } else
            $code = 400;//apiCodeError
        $res = array("code" => $code, "data" => $list);
        return json_encode($res);
    }

    public function getMySingle($data)
    {
        $result = array();
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            $result = (new Ability())->getMySingle($userId, $data['abilityId']);
        } else
            $code = 400;//apiCodeError
        $res = array("code" => $code, "data" => array(json_encode($result)));
        return json_encode($res);
    }

    public function getSingle($data)
    {
        $result = array();
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            $result = (new Ability())->getSingle($data['abilityId']);
        } else
            $code = 400;//apiCodeError
        $res = array("code" => $code, "data" => array(json_encode($result)));
        return json_encode($res);
    }

    public function edit($data)
    {

        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            (new Ability())->edit($data['abilityId'], $data['subject'], $data['resume'], $data['description'], 0/*dar entezar taeid*/);

        } else
            $code = 400;//apiCodeError
        $res = array("code" => $code);
        return json_encode($res);
    }

    public function changeStatus($data)
    {
        if ($userId = (new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            (new Ability())->changeStatus($userId, $data['abilityId'], $data['status']);

        } else
            $code = 400;//apiCodeError
        $res = array("code" => $code);
        return json_encode($res);
    }

}