<?php

namespace app\modules\correspondence\controllers;

use app\modules\correspondence\models\CmsAddress;
use app\modules\correspondence\models\CmsDocDept;
use app\modules\correspondence\models\CmsDocSecret;
use app\modules\correspondence\models\CmsDocSpeed;
use app\modules\correspondence\models\CmsDocSubType;
use app\modules\correspondence\models\CmsDocType;
use Yii;
use app\modules\correspondence\models\CmsDocToDept;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ToDeptController implements the CRUD actions for CmsDocToDept model.
 */
class SettingController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /* ************************************ Settings  ********************************** */
    public function actionSettingDocument()
    {
        $this->layout = "main_staff";
        //$this->layout = "main_module";
        $model_type = CmsDocType::find()->all();
        $model_speed = CmsDocSpeed::find()->all();
        $model_secret = CmsDocSecret::find()->all();
        $model_sub_type = CmsDocSubType::find()->all();
        $model_to_dept = CmsDocDept::find()->all();
        $model_from_dept = CmsDocDept::find()->all();
        $models_from_dept =CmsDocDept::find()->all();
        $model_address = CmsAddress::find()->orderBy(['address_year' => SORT_DESC,'sub_type_id'=>SORT_DESC])->all();
     /*   $countQuery = clone $model_from_dept;
        $pages = new Pagination(['defaultPageSize' => 15, 'totalCount' => $countQuery->count()]);
        $models_from_dept = $model_from_dept->offset($pages->offset)
            ->limit($pages->limit)
            ->all();*/

       /* return $this->render('setting_document', ['model_type' => $model_type
            , 'model_speed' => $model_speed, 'model_secret' => $model_secret, 'model_sub_type' => $model_sub_type
            , 'model_to_dept' => $model_to_dept, 'model_from_dept' => $model_from_dept,
            'models_from_dept' => $models_from_dept,'model_address'=>$model_address,
            'pages' => $pages,]);*/
        return $this->render('setting_document', ['model_type' => $model_type
            , 'model_speed' => $model_speed, 'model_secret' => $model_secret, 'model_sub_type' => $model_sub_type
            , 'model_to_dept' => $model_to_dept, 'model_from_dept' => $model_from_dept,
            'models_from_dept' => $models_from_dept,'model_address'=>$model_address,
            ]);
    }
}
