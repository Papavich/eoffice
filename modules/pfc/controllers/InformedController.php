<?php
/**
 * Created by PhpStorm.
 * User: pessm
 * Date: 11/17/2017
 * Time: 2:39 AM
 */

namespace app\modules\pfc\controllers;
use yii\web\Controller;


class InformedController extends Controller
{
    public  function  actionInformed(){
        return $this->render('informed', [

        ]);
    }
}