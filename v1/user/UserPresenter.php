<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 07:18 AM
 */
require_once "VerifyCode.php";
require_once "User.php";

class UserPresenter
{
    public function sendVerifyCode($data): String
    {
        $code = 200;//error
        $upDate = false;
        $phone = $data['phone'];
        $verifyCode = $this->createVerifyCode();
        $add = (new VerifyCode())->add($phone, $verifyCode, getJDate(), Date("H:i"));
        if (!$add)
            $upDate = (new VerifyCode())->update($phone, $verifyCode, getJDate(), Date("H:i"));
        if ($add || $upDate) {
            $this->smsCode($verifyCode);
            $code = 100;//ok
        }
        $res = array();
        $res['code'] = $code;
        return json_encode($res);

    }

    public function checkVerifyCode($data)
    {
        $apiCode = "";
        $code = 200;// error
        $res = array();
        $phone = $data['phone'];
        $codeFromUser = $data['code'];
        $userKind = $data['kind'];
        $codeFromDB = (new VerifyCode())->getCode($phone);

        if ($codeFromUser === $codeFromDB)
            $apiCode = $this->addUser($phone, $userKind);

        $res['code'] = $code;
        $res['data'] = array("apiCode" => $apiCode);
        return json_encode($res);
    }

    public function logIn($data)
    {
        $res = array();
        $code = 200;
        $phone = $data['phone'];
        $passFromUser = $data['pass'];
        $apiCode = $this->createApiCode();
        $dbData = (new User())->get($phone);
        if (sizeof($dbData) == 0)
            $code = 300;
        else if ($dbData['pass'] === $passFromUser && $passFromUser !== null) {
            $code = 100;
            (new User())->upDateApiCode($phone, $apiCode);
        }
        $res['code'] = $code;
        $res ['data'] = array("kind" => $dbData['kind'], "apiCode" => $apiCode);
        return json_encode($res);

    }

    public function checkApiCode($phone, $acFromUser): bool
    {
        $acFromDb = (new User())->getApiCode($phone);
        return $acFromDb === $acFromUser;
    }

    public function createVerifyCode(): String
    {
        return "000000";
    }

    private function smsCode(String $code)
    {

    }

    private function addUser($phone, $userKind): String
    {
        $apiCode = $this->createApiCode();
        $add = (new User())->add($phone, $apiCode, $userKind, getJDate());
        if ($add)
            return $apiCode;
        (new User())->upDateApiCode($phone, $apiCode);
        return $apiCode;
    }

    private function createApiCode(): String
    {
        return "sdaou23dsvfter";
    }

    public function newPass($data)
    {
        $phone = $data['phone'];
        $pass = $data['pass'];
        $code = 200;
        (new User())->changePass($phone, $pass);
        $res = array("code" => $code);
        return json_encode($res);

    }

}