<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 26/10/2560
 * Time: 15:15
 */

namespace app\modules\eoffice_ta\controllers;

use yii\web\Controller;
use app\modules\eoffice_ta\models\TaNews;
class SiteController extends Controller
{
    public function actionIndex()
    {
        $model = TaNews::find()->all();
        $this->layout = "main_modules";
        return $this->render('index', [
            'model' => $model,
        ]);
    }

}