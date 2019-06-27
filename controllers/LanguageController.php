<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/30/2017
 * Time: 3:31 AM
 */

namespace app\controllers;


use yii\web\Controller;

class LanguageController extends Controller
{
    const DEFAULT_LANGUAGE = 'th';
    public function actionChange(){
        $cookies = \Yii::$app->response->cookies;
        $lang=$_GET['lang'];
        if($lang=='en'){
            $cookies->add(new \yii\web\Cookie([
                'name' => 'language',
                'value' => 'en',
            ]));
        }else{
            $cookies->add(new \yii\web\Cookie([
                'name' => 'language',
                'value' => self::DEFAULT_LANGUAGE,
            ]));
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }
}