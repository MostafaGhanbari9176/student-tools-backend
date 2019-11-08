<?php
/**
 * Created by PhpStorm.
 * User: Mostafa
 * Date: 28/09/2019
 * Time: 09:47 PM
 */

require_once dirname(__FILE__) . "/../../user/UserPresenter.php";
require_once "StudentFiled.php";

class FieldPresenter
{
    private $fieldData = array();

    public function getFieldList($data)
    {
        $resultData = array();
        if (true) {
            $result = (new StudentFiled())->get();
            while ($row = $result->fetch_assoc()) $this->fieldData[] = $row;
            $resultData = $this->createFieldResponse(-1);
            $code = 100;
        } else
            $code = 400;
        return json_encode(array("code" => $code, "data" => $resultData));
    }

    private function createFieldResponse(int $parentId)
    {
        $dataResult = array();
        foreach ($this->fieldData as $field) {
            if ($field['parent_id'] == $parentId) {
                $fieldData = array();
                $fieldData['name'] = $field['name_text'];
                $fieldData['parentId'] = $field['parent_id'];
                $fieldData['fieldId'] = $field['field_id'];
                $fieldData['child'] = $this->createFieldResponse($field['field_id']);
                if ($parentId == -1)
                    $dataResult[] = json_encode($fieldData);
                else
                    $dataResult[] = $fieldData;
            }
        }
        return $dataResult;
    }

}