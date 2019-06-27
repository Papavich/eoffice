<?php

namespace app\modules\portfolio\controllers;

use Yii;
use app\modules\portfolio\models\Publication;
use app\modules\portfolio\models\PublicationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * PublicationController implements the CRUD actions for Publication model.
 */
class PublicationController extends Controller
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
     * Lists all Publication models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PublicationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionShow()
    {
        $this->view->params['status'] = 'index3';
        $this->layout = "main";



        $projects = Publication::find()->all();





        return $this->render("index3", [
            "projects" => $projects,


            ]
            );

    }

    public function actionShowMe()
    {
        $this->view->params['status'] = 'view3';
        $this->layout = "main";

        $id = Yii::$app->user->getId();
         //return Json::encode($id);


//        $model = $this->findModel($id);

        $query = Yii::$app->getDb()->createCommand("SELECT * FROM view_pis_user where id=$id")->queryOne();
        $query2 = Publication::find()->where([
            'person_id' => $query['person_id']
        ])->all();

        //return Json::encode($query2);
       // $modelA = $query->queryAll();
        //   $modelA = $this->findModelAssetDetail($model);
        //  $modelA = AssetDetail::find()->where(['asset_asset_id'=>$id])->all();

        /* $persons = [];
         $persons_main = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_user')->queryAll();
         foreach ($persons_main as $person_main) {
             $person['id'] = $person_main['id'];
             $person['name'] = $person_main['user_type_id'] !== '0' ? $person_main['person_name'] . ' ' . $person_main['person_lname_th'] : $person_main['student_fname_th'] . ' ' . $person_main['student_lname_th'];
             array_push($persons, $person);
         }*/
        //  return Json::encode($id);
        return $this->render('view3', [

         'query2' =>  $query2

        ]);


    }

    /**
     * Displays a single Publication model.
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
     * Creates a new Publication model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Publication();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pub_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Publication model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pub_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Publication model.
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
     * Finds the Publication model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Publication the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Publication::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
