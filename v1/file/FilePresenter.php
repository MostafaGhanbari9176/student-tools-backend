<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 15/08/2019
 * Time: 10:58 PM
 */

require_once 'FileModel.php';
require_once "../user/UserPresenter.php";

class FilePresenter
{

    public function download($data)
    {

        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $fileData = (new FileModel())->getData($data['fileId']);
            return @file_get_contents("../../../files/chat/".$fileData['dir_name']."/".$data['fileId'].".".$fileData['f_type']);
        }
        return @file_get_contents("../../files/img/denied.png");

    }

    public function getType($data)
    {
        $fileType = "";
        if ((new UserPresenter())->checkApiCode($data['phone'], $data['apiCode'])) {
            $fileType = (new FileModel())->getData($data['fileId'])['f_type'];
            $code = 100;
        }
        else
            $code = 400;
        return json_encode(array("code"=>$code, "data"=>array($fileType)));

    }

    public function saveFile($userId, $file, $eyeLevel):int
    {
        if($file->getError() !== UPLOAD_ERR_OK)
            return 0;
        $fName = $file->getClientFileName();
        if(strpos(pathinfo($fName, PATHINFO_FILENAME), ".") !== false)
            return 0;
        if($file->getSize() > (10485760/*10MB*/))
            return 0;
        $fileType = pathinfo($fName, PATHINFO_EXTENSION);
        switch ($fileType)
        {
            case 'jpg';
            case 'JPG':$dirName = "img";
            break;
            case 'pdf';
            case 'PDF':$dirName = "document";
            break;
            default:$dirName = "other";
        }
        (new FileModel())->saveFile($userId, getJDate(), Date("H:i"),$dirName, $eyeLevel, $fileType);
        $fileId = (new FileModel())->getLastId($userId);
        $file->moveTo("../../../files/chat/".$dirName."/".$fileId.".".$fileType);
        return $fileId;
    }
}