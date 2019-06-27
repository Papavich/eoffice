<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 14/3/2561
 * Time: 22:22
 */

namespace app\modules\scholar_b\controllers;
use Yii;
use app\modules\scholar_b\models\ModelScbCondition;
use app\modules\scholar_b\models\ScbCondition;
use yii\helpers\Json;
use yii\web\Controller;

class ConditionsController extends Controller
{
    public function actionAdd()
    {
        $model = [new ScbCondition()];
        if(Yii::$app->request->post()){
            $model = ModelScbCondition::createMultiple(ScbCondition::classname(), $model);
            ModelScbCondition::loadMultiple($model, Yii::$app->request->post());
            foreach ($model as $row){
                $row->scholarship_id = "";
                $row->scholarship_year = "";
                if($row->condi_name != "" && $row->condi_value != ""){
                    $row->save();
                }

            }
            return Json::encode($model);
        }
        $this->layout = "main_module";
        return $this->render('add', [
            'model' => (empty($model)) ? [new ScbCondition] : $model
        ]);
    }
    public function actionChecklist()
    {
        $this->layout = "main_module";
        return $this->render('checklist');
    }
}