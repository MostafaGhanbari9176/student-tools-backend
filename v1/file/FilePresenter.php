<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 15/08/2019
 * Time: 10:58 PM
 */

require_once 'FileModel.php';
require_once dirname(__FILE__, 2) . "/user/UserPresenter.php";

class FilePresenter
{

    public function download($data)
    {
        $p = dirname(__FILE__, 3);

        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $fileData = (new FileModel())->getData($data['fileId']);
            return @file_get_contents("$p/files/chat/" . $fileData['dir_name'] . "/" . $data['fileId'] . "." . $fileData['f_type']);
        }
        return @file_get_contents("$p/files/img/denied.png");

    }

    public function getType($data)
    {
        $fileType = "";
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $fileType = (new FileModel())->getData($data['fileId'])['f_type'];
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => array($fileType)));

    }

    public function saveFile($userId, $file, $eyeLevel): int
    {
        $p = dirname(__FILE__, 3);
        if ($file->getError() !== UPLOAD_ERR_OK)
            return 0;
        $fName = $file->getClientFileName();
        if (strpos(pathinfo($fName, PATHINFO_FILENAME), ".") !== false)
            return 0;
        if ($file->getSize() > (10485760/*10MB*/))
            return 0;
        $fileType = pathinfo($fName, PATHINFO_EXTENSION);
        switch (strtolower($fileType)) {
            case 'jpg';
            case 'png':
                $dirName = "img";
                break;
            case 'pdf':
                $dirName = "document";
                break;
            case 'mp3':
                $dirName = "music";
                break;
            default:
                $dirName = "other";
        }
        (new FileModel())->saveFile($userId, getJDate(), Date("H:i"), $dirName, $eyeLevel, $fileType);
        $fileId = (new FileModel())->getLastId($userId);
        $file->moveTo("$p/files/chat/" . $dirName . "/" . $fileId . "." . $fileType);
        return $fileId;
    }
}