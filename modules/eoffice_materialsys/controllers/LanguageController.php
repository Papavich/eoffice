<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 31/10/2560
 * Time: 21:06
 */

namespace app\modules\eoffice_materialsys\controllers;
use yii;
use yii\web\Controller;

class LanguageController extends Controller
{
    const DEFAULT_LANGUAGE = 'th';
    public function actionChange(){
        $cookies = Yii::$app->response->cookies;
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
        return $this->redirect(Yii::$app->request->referrer);
    }
}