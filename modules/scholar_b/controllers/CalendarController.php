<?php

namespace app\modules\scholar_b\controllers;

use Yii;
use app\modules\scholar_b\models\ScbCalendar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\helpers\Html;


class CalendarController extends Controller
{
    const ACT_PAGE_SIZE = 10;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'deletecalendar' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

        $this->layout = "main_module";
        $data = ScbCalendar::find()->orderBy('calendar_date_start')->all();
        $query = ScbCalendar::find()->orderBy('calendar_date_end DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => self::ACT_PAGE_SIZE]);

        return $this->render('index', [
            'data' => $data,
            'pages' => $pages,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $this->layout = "main_module";

        $model = new ScbCalendar();
        if ($model->load(Yii::$app->request->post())) {
            $model->save();

            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app', Html::encode('บันทึกปฏิทินนัดหมายสำเร็จ')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);

            return $this->redirect(['index',
                'id' => $model->calendar_id,
                'staff_id' => $model->staff_id_card
            ]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->getSession()->setFlash('alert3', [
                'type' => 'info',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app', Html::encode('แก้ไขข้อมูลสำเร็จ')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);

            return $this->redirect(['index',
                'id' => $model->calendar_id,
            ]);
        }
        return $this->render('update', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDeletecalendar($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->getSession()->setFlash('alert2', [
            'type' => 'danger',
            'duration' => 12000,
            'icon' => 'fa fa-users',
            'title' => Yii::t('app', Html::encode('Alert')),
            'message' => Yii::t('app', Html::encode('ลบปฏิทินนัดหมายสำเร็จ')),
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = ScbCalendar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
