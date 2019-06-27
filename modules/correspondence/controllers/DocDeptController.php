<?php

namespace app\modules\correspondence\controllers;

use app\modules\correspondence\models\CmsDocDept;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SecretController implements the CRUD actions for CmsDocSecret model.
 */
class DocDeptController extends Controller
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
     * Lists all CmsDocSecret models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CmsDocDept::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CmsDocSecret model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CmsDocDept model.
     * If creation is successful, the browser will be redirected to the 'setting/setting-document#ttab4_nobg' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CmsDocDept();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['setting/setting-document#ttab4_nobg', 'model_secret' => CmsDocDept::find()->all()]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Creates a new CmsDocDept model in StaffSend and StaffReceive controller.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateDocdept()
    {
        $model = new CmsDocDept();
        $checkDocDept = CmsDocDept::find()->where(['doc_dept_name'=>$_POST['name']])->one();
        //กรณีที่ผู้ใช้ย้อนกลับมาแก้ไข หากมีการเพิ่มหน่วยงามใหม่จะต้องไม่ใช่ชื่อหน่วยงานที่มีอยู่แล้ว
        if(!$checkDocDept){
            $id_dept = CmsDocDept::find()->orderBy(['doc_dept_id' => SORT_DESC])->limit(1)->one();
            $model->doc_dept_id = $id_dept->doc_dept_id + 1;
            $model->doc_dept_name = $_POST['name'];
            $model->user_id = null;
            $model->save();
            echo  $model->doc_dept_id;
        }else{
            echo $checkDocDept->doc_dept_id;
        }
    }
    /**
     * Updates an existing CmsDocDept model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->layout = "main_module";
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['setting/setting-document#ttab4_nobg', 'models_from_dept' => CmsDocDept::find()->all()]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CmsDocSecret model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $model = $this->findModel($_POST['id']);
        $model->delete();
       //return $this->render('../setting/setting-document#ttab5_nobg');
    }

    /**
     * Finds the CmsDocSecret model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsDocDept the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsDocDept::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
