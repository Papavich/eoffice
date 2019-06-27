<?php

namespace app\modules\portfolio\controllers;
use app\modules\portfolio\controllers\ArewardController;
use app\modules\portfolio\models\BaseDistrict;
use app\modules\portfolio\models\BaseTambon;
use app\modules\portfolio\controllers;
use app\modules\portfolio\models\Cities;
use app\modules\portfolio\models\States;
use yii\helpers\Json;

class BaseController extends \yii\web\Controller
{
    /**
     * @param null $id
     * @return string
     */
    public function actionLoaddistrict($id=null)
    {
        $districts = BaseDistrict::find()
            ->where(['base_province_id'=>$id])
            ->orderBy('district_name ASC')
            ->all();
        $option =' <option value ="">-เลือกอำเภอ-</option>';
        foreach ($districts as $d ){
            $option .='<option value ="'.$d->id.'">'.$d->district_name.'</option>';
        }
        echo $option;

       // return Json::encode($option)
//        return $this->render('create' , [
//           'option'=> $option,
//        ]);

    }

    public function actionLoadtambon($id=null)
    {
        $tambons = BaseTambon::find()
            ->where(['base_district_id'=>$id])
            ->orderBy('tambon_name ASC')
            ->all();
        $option = '<option value ="">-เลือกตำบล-</option>';
        foreach ($tambons as $t ){
            $option .='<option value ="'.$t->id.'">'.$t->tambon_name.'</option>';
        }
        echo $option;

       // return $this->render('loadtambon');
    }


    public function actionState($id=null)
    {
        $districts = States::find()
            ->where(['country_id'=>$id])
            ->orderBy('name ASC')
            ->all();
        $option =' <option value ="">-เลือกรัฐ-</option>';
        foreach ($districts as $d ){
            $option .='<option value ="'.$d->id.'">'.$d->name.'</option>';
        }
        echo $option;

        // return Json::encode($option)
//        return $this->render('create' , [
//           'option'=> $option,
//        ]);

    }

    public function actionCity($id=null)
    {
        $tambons = Cities::find()
            ->where(['state_id'=>$id])
            ->orderBy('name ASC')
            ->all();
        $option = '<option value ="">-เลือกเมือง-</option>';
        foreach ($tambons as $t ){
            $option .='<option value ="'.$t->id.'">'.$t->name.'</option>';
        }
        echo $option;

        // return $this->render('loadtambon');
    }

}
