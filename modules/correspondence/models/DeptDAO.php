<?php

namespace app\modules\correspondence\models;


use yii\helpers\FileHelper;

class DeptDAO
{
    public function createCmsDocToDept($doc_to_dept_name,$doc_id){
        $model_to_dept = new CmsDocDept();
        $model_to_dept->doc_dept_id = 1;
        $model_to_dept->doc_dept_name = $doc_to_dept_name;
        $model_to_dept->save();
    }
    public function createCmsDocFromDept($doc_from_dept_name,$doc_id){
        $model_from_dept = new CmsDocDept();
        $model_from_dept->doc_from_dept_id = 1;
        $model_from_dept->doc_from_dept_name = $doc_from_dept_name;
        $model_from_dept->doc_id = $doc_id;
        $model_from_dept->save();
    }
}