<?php

namespace app\modules\eproject\controllers;

use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\models\CalendarDocument;
use app\modules\eproject\models\DownloadXCalendar;
use Yii;
use app\modules\eproject\models\Calendar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CalendarController implements the CRUD actions for Calendar model.
 */
class CalendarController extends Controller
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

    /**
     * Lists all Calendar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $data = Calendar::find()->orderBy( 'start_date' )->all();
        $calendarModel = new Calendar();

        return $this->render( 'index', [
            'data' => $data,
            'model' => $calendarModel,
        ] );
    }

    /**
     * Displays a single Calendar model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render( 'view', [
            'model' => $this->findModel( $id ),
        ] );
    }

    /**
     * Creates a new Calendar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $calendarModel = new Calendar() ;
        if ($calendarModel->load( Yii::$app->request->post() ) && $calendarModel->save()) {
            if (Yii::$app->request->post( 'Calendar' )['downloads']) {
                foreach (Yii::$app->request->post( 'Calendar' )['downloads'] as $item) {
                    $relationModel =  new CalendarDocument() ;
                    $relationModel->download_id = $item;
                    $relationModel->calendar_id = $calendarModel->id;
                    $relationModel->save();
                }
            }
            return $this->redirect( ['index'] );
        } else {
            return $this->render( 'create', [
                'model' => $calendarModel,
            ] );
        }
    }

    /**
     * Updates an existing Calendar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel( $id );
        if ($model->load( Yii::$app->request->post() ) && $model->save()) {
            CalendarDocument:: deleteAll( 'calendar_id = :id ', [':id' => $model->id] );

            if (Yii::$app->request->post( 'Calendar' )['downloads']) {
                foreach (Yii::$app->request->post( 'Calendar' )['downloads'] as $item) {
                    $relationModel =  new CalendarDocument();
                    $relationModel->download_id = $item;
                    $relationModel->calendar_id = $model->id;
                    $relationModel->save();
                }
            }

            return $this->redirect( ['index'] );
        } else {
            return $this->render( 'update', [
                'model' => $model,
            ] );
        }
    }

    /**
     * Deletes an existing Calendar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel( $id )->delete();

        return $this->redirect( ['index'] );
    }

    /**
     * Finds the Calendar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Calendar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Calendar::findOne( $id )) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }
}
