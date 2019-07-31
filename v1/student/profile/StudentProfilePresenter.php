<?php

use Slim\Http\UploadedFile;

/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 30/07/2019
 * Time: 09:54 PM
 */

require_once "StudentProfile.php";
require_once "../../user/UserPresenter.php";

class StudentProfilePresenter
{
    public function add($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            (new StudentProfile())->add($data['sId'], $data['phone'], $data['name'], getJDate(), Date("H:i"));
        } else
            $code = 400;
        $res = array("code" => $code);
        return json_encode($res);

    }

    public function myProfile($data)
    {
        $result = array();
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            $result[] = (new StudentProfile())->get($data['phone']);
        } else
            $code = 400;
        $res = array("code" => $code, "data" => $result);
        return json_encode($res);
    }

    public function downMyImg($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode']))
            return @file_get_contents("../../../files/img/student/$data[phone].jpg");
        return @file_get_contents("../../../files/img/student/denied.png");

    }

    public function upImg($data, $files)
    {

        $uploadedFile = $files['img'];
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                $code = 100;
                $uploadedFile->moveTo("../../../files/img/student/". $data['phone'].".jpg");
            } else
                $code = 200;
        } else
            $code = 400;
        $res = array("code" => $code);
        return json_encode($res);
    }

    public function saveAboutMe($data)
    {
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            (new StudentProfile())->upDateAboutMe($data['phone'], $data['text']);
        } else
            $code = 400;
        $res = array("code" => $code);
        return json_encode($res);
    }

    public function aboutMe($data)
    {
        $result = array();
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $code = 100;
            $result[] = (new StudentProfile())->getAboutMe($data['phone']);
        } else
            $code = 400;
        $res = array("code" => $code, "data" => $result);
        return json_encode($res);
    }


}