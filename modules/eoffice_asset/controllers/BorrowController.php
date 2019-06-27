<?php

namespace app\modules\eoffice_asset\controllers;

use app\modules\eoffice_asset\models\EofficeCentralViewPisUser;
use app\modules\eoffice_asset\models\ModelAssetBorrowDetail;
use Mpdf\Tag\Select;
use Yii;
use app\modules\eoffice_asset\models\AssetBorrow;
use app\modules\eoffice_asset\models\AssetBorrowRescript;
use app\modules\eoffice_asset\models\AssetBorrowSearch;
use app\modules\eoffice_asset\models\AssetBorrowDetail;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AssetBorrowController implements the CRUD actions for AssetBorrow model.
 */
class BorrowController extends Controller
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
     * Lists all AssetBorrow models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";

        $searchModel = new AssetBorrowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        $this->layout = "main_modules"; //ทีม

        $model = $this->findModel($id);
        $connection = Yii::$app->get('db_asset');
        $query = $connection->createCommand("SELECT * FROM asset_borrow_detail where asset_borrow_id=$id ");  //showผลงาน
        $modelA = $query->queryAll();


        return $this->render('view', [
            'model' => $model,
            'modelA' => $modelA,]

        );
    }

    public function actionViewUser($id=89)
    {
        $this->layout = "main_modules"; //ทีม

        $model = $this->findModel($id);
        $connection = Yii::$app->get('db_asset');
        $query = $connection->createCommand("SELECT * FROM asset_borrow_detail where asset_borrow_id=$id ");  //showผลงาน
        $modelA = $query->queryAll();


        return $this->render('view-user', [
            'model' => $model,
            'modelA' => $modelA,]

        );
    }

    public function actionViewRescript($id)
    {
        return $this->render('asset-borrow-rescript/view', [
            'model' => $this->findModel($id),

        ]);
    }

    /**
     * Creates a new AssetBorrow model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionRescript(){
        $this->layout = "main_modules";

       // if ($model->load(Yii::$app->request->post()) && $model->save()) {
       //     return $this->redirect(['view', 'id' => $model->borrow_id]);
       // }

        $user = Yii::$app->user->getId();
        $person = Yii::$app->getDb()->createCommand("SELECT * FROM view_pis_user WHERE id = $user")->queryOne();



         $model = new AssetBorrowRescript();

         $staff = $person['person_fname_th'].$person['person_lname_th'];



        if ($model->load(Yii::$app->request->post())) {
            $model->borrow_rescript_staff = $staff;
            $model->save();
            return $this->redirect(['asset-borrow-rescript/view', 'id' => $model->borrow_rescript_id]);
        }

        return $this->render('rescript', [
            'model' => $model,
            'person' => $person
        ]);
    }


    public function actionCreate()
    {

        $this->layout = "main_modules";

        $user = Yii::$app->user->getId();
        $person = Yii::$app->getDb()->createCommand("SELECT * FROM view_pis_user WHERE id = $user")->queryOne();



        $modelBorrow = new AssetBorrow;
        $modelsBorrowDetail = [new AssetBorrowDetail];

        if($person['user_type_id'] == 0){
            $modelBorrow->borrow_user_fname = $person['student_fname_th'];
            $modelBorrow->borrow_user_lname = $person['student_lname_th'];
            $modelBorrow->borrow_user_tel = $person['STUDENTMOBILE'];

            $time = time();
            Yii::$app->formatter->locale = 'th_TH';
            $modelBorrow->borrow_date = Yii::$app->formatter->asDate($time, 'php:Y-m-d');
        }else{
            $modelBorrow->borrow_user_fname = $person['person_fname_th'];
            $modelBorrow->borrow_user_lname = $person['person_lname_th'];
            $modelBorrow->borrow_user_tel = $person['STUDENTMOBILE'];

            $time = time();
            Yii::$app->formatter->locale = 'th_TH';
            $modelBorrow->borrow_date = Yii::$app->formatter->asDate($time, 'php:Y-m-d');
        }


        if ($modelBorrow->load(Yii::$app->request->post())) {

            $modelBorrow->save();

            $modelsBorrowDetail = ModelAssetBorrowDetail::createMultiple(AssetBorrowDetail::classname(), $modelsBorrowDetail);
            ModelAssetBorrowDetail::loadMultiple($modelsBorrowDetail, Yii::$app->request->post());
            foreach ($modelsBorrowDetail as $row) {

                if ($row->borrow_detail_status) {
                    $model = new AssetBorrowDetail;

                    $num_status = 1;

                    $model->asset_borrow_id = $modelBorrow->borrow_id;
                    $model->borrow_detail_asset_id = $row->asset_detail_id;
                    $model->borrow_detail_status = $num_status;



                   $model->save();


                }


            }
       //    exit;

        }

        return $this->render('create', [
            //'user' => $user,
            'person' => $person,
            'modelBorrow' => $modelBorrow,
            'modelsBorrowDetail' => (empty($modelsBorrowDetail)) ? [new AssetBorrowDetail()] : $modelsBorrowDetail,



        ]);
    }


    /**
     * Updates an existing AssetBorrow model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->borrow_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AssetBorrow model.
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
     * Finds the AssetBorrow model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AssetBorrow the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AssetBorrow::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelRescript($id)
    {
        if (($model = AssetBorrowRescript::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}