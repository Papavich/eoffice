<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 17/9/2560
 * Time: 14:08
 */

namespace app\modules\eoffice_eolm\components;
use Yii;

class ModelHelper
{
    public static function create($model){
        $model->crby=Yii::$app->user->identity->getId();
        $model->udby=Yii::$app->user->identity->getId();
        $model->crtime=date('Y-m-d H:i:s');
        $model->udtime=date('Y-m-d H:i:s');
        return $model;
    }
    public static function update($model){
        $model->udby=Yii::$app->user->identity->getId();
        $model->udtime=date('Y-m-d H:i:s');
        return $model;
    }
}