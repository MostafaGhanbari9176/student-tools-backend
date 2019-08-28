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

    public function signUp($data)
    {

        if ($verifyCodeFromDb = (new VerifyCode())->getCode($data['phone']))
            $verifyCodeFromDb = $verifyCodeFromDb->fetch_assoc()['code'];
        $apiCode = "";
        $code = 200;
        if ($data['code'] == $verifyCodeFromDb) {
            $code = 100;
            $apiCode = $this->createApiCode();
            $result = (new User())->add($data['phone'], $apiCode, $data['kind'], getJDate());
            if (!$result)
            {
                $result = (new User())->getPass($data['phone']);
                if($result->num_rows > 0) {
                    $result = $result->fetch_assoc()['pass'];
                    if($result === null)
                        (new User())->upDateApiCode($data['phone'], $apiCode);
                    else
                        $code = 300; //badLogSign
                }
            }

        }
        $res = array("code" => $code, "data" => array($apiCode));
        return json_encode($res);
    }

    public function logIn($data)
    {
        $result = "";
        $code = 200;
        if ($passFromDb = (new User())->getPass($data['phone'])) {
            $passFromDb = $passFromDb->fetch_assoc()['pass'];
            if ($passFromDb === $data['pass']) {
                $code = 100;
                $apiCode = $this->createApiCode();
                (new User())->upDateApiCode($data['phone'], $apiCode);
                $result = json_encode((new User())->get($data['phone']));
            }
        } else
            $code = 300;

        $res = array("code" => $code, "data" => array($result));
        return json_encode($res);
    }

    public function newPass($data)
    {
        if ($verifyCodeFromDb = (new VerifyCode())->getCode($data['phone']))
            $verifyCodeFromDb = $verifyCodeFromDb->fetch_assoc()['code'];
        $code = 200;
        if ($data['code'] == $verifyCodeFromDb) {
            $code = 100;
            $apiCode = $this->createApiCode();
            $result = (new User())->upDateApiCode($data['phone'], $apiCode);
            if (!$result)
                $code = 300; //badLogSign
            else
                $result = (new User())->get($data['phone']);
        }
        $res = array("code" => $code, "data" => array(json_encode($result)));
        return json_encode($res);
    }

    public function changePass($data)
    {
        $code = 400;
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            (new User())->changePass($data['phone'], $data['pass']);
        }
        $res = array("code" => $code);
        return json_encode($res);
    }

    public function checkApiCode($phone, $apiCode)
    {
        if($result = (new User())->getUserId($phone, $apiCode))
            $result = $result->fetch_assoc()['user_id'];
        return $result;
    }

    public function createVerifyCode(): String
    {
        return "000000";
    }

    private function smsCode(String $code)
    {

    }

    private function createApiCode(): String
    {
        return microtime();
    }

}