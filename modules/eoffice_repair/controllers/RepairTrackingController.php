<?php

namespace app\modules\eoffice_repair\controllers;

use Yii;
use app\modules\eoffice_repair\models\RepairTracking;
use app\modules\eoffice_repair\models\RepairTrackingSearch;

use app\modules\eoffice_repair\models\RepairDescription;
use app\modules\eoffice_repair\models\RepairDescriptionSearch;

// use app\modules\eoffice_repair\models\RepairTrackingSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RepairTrackingController implements the CRUD actions for RepairTracking model.
 */
class RepairTrackingController extends Controller
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

    // public function actionForm()
    // {
    //     {
    //
    //         $this->layout = "main_modules";
    //
    //
    //         $desc = new  RepairDescription();
    //           // $asset = new AssetDetail();
    //         $status = new RepairStatus();
    //         $img = new RepairImage();
    //         // $buliding = new Buildings();
    //
    //
    //
    //         $desc['rep_desc_fname'] = "ศิริพร";
    //         $desc['rep_desc_lname'] = "สังข์ปิติกุล";
    //         $desc['rep_desc_email'] = "siri@gmail.com";
    //         $desc['rep_desc_tel'] = "088-4853135";
    //         //  $desc['rep_desc_request_date'] = "2018-03-16";
    //         $desc['rep_desc_cost'] = "0";
    //
    //         if ($desc->load(Yii::$app->request->post())) {
    //
    //             $desc['rep_status_id'] = 1;
    //             $desc->save();
    //             $desc['rep_image_id'] = 1;
    //             $desc->save();
    //             $desc->rep_desc_request_date=date("Y-m-d");
    //             // $desc['rep_desc_cost'] = 0;
    //             // $desc->save();
    //
    //         }
    //
    //
    //         $this->layout = "main_modules";
    //
    //         if ($desc->load(Yii::$app->request->post()) && $desc->save() &&
    //             $room->load(Yii::$app->request->post()) && $room->save() &&
    //             $asset->load(Yii::$app->request->post()) && $asset->save() &&
    //             $status->load(Yii::$app->request->post()) && $status->save() &&
    //             $img->load(Yii::$app->request->post()) && $img->save()&&
    //             $buliding->load(Yii::$app->request->post()) && $buliding->save()
    //
    //
    //         ) {
    //             return $this->render('/repairsystem/rep-des/show');
    //
    //         } else {
    //             return $this->render('form_repair', [ 'rep' => $desc,
    //                 'rep2' => $room,
    //              'rep3' => $asset,
    //                 'rep4' => $status,
    //                 'rep5' => $img,
    //                 'rep6' => $buliding]);
    //
    //             return $this->render('index');
    //         }
    //
    //
    //     }
    //
    //
    //     $this->layout = "main_modules";
    //
    //     return $this->render('form_repair');
    // }

    /**
     * Lists all RepairTracking models.
     * @return mixed
     */


    public function actionIndex()
    {
      $this->layout = "main_modules";
        $searchModel = new RepairTrackingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RepairTracking model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RepairTracking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      $this->layout = "main_modules";
        $model = new RepairTracking();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->rep_track_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RepairTracking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
      $this->layout = "main_modules";
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->rep_track_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RepairTracking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RepairTracking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RepairTracking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RepairTracking::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
