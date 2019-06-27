<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 26/10/2560
 * Time: 20:59
 */

namespace app\modules\eoffice_eolmv2\controllers;


use Yii;
use yii\web\Controller;

class LanguageController extends Controller
{
    const DEFAULT_LANGUAGE = 'th';

    /**
     * @return \yii\web\Response
     */
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