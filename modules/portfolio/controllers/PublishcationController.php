<?php
/**
 * Created by PhpStorm.
 * User: DELLosc
 * Date: 5/9/2560
 * Time: 14:41
 */

namespace app\modules\portfolio\controllers;


use yii\web\Controller;

class PublishcationController extends Controller
{

    public function actionPub_re(){

        return $this->render("Pub_re");
    }

    public function  actionPub_con(){

        return $this->render("Pub_con");
    }
}