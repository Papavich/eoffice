<?php

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\models\ModelScbCondition;
use app\modules\scholar_b\models\ScbCondition;
use app\modules\scholar_b\models\ScbScholarshipType;
use app\modules\scholar_b\models\ScbScholarshipYear;
use Yii;
use app\modules\scholar_b\models\ScbScholarshipTypeHasYear;
use app\modules\scholar_b\models\ScbScholarshipTypeHasYearSearch;
use yii\db\Exception;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\uploadedFile;
use yii\helpers\url;
Yii::setAlias('@root',realpath(dirname(__FILE__).'/../../../web/'));

/**
 * ManageScDetailController implements the CRUD actions for ScbScholarshipTypeHasYear model.
 */
class ManageScDetailController extends Controller
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
     * Lists all ScbScholarshipTypeHasYear models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ScbScholarshipTypeHasYearSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = "main_module";
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ScbScholarshipTypeHasYear model.
     * @param string $scholarship_id
     * @param integer $scholarship_year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($scholarship_id, $scholarship_year)
    {
        $model_conditions = ScbCondition::find()->where(['scholarship_id'=>$scholarship_id,'scholarship_year'=>$scholarship_year])->all();
        $this->layout = "main_module";
        return $this->render('view', [
            'model' => $this->findModel($scholarship_id, $scholarship_year),
            'model_conditions'=>$model_conditions
        ]);
    }

    /**
     * Creates a new ScbScholarshipTypeHasYear model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model_sc_detail = new ScbScholarshipTypeHasYear();
        $sc_main = ScbScholarshipType::find()->all();
        $sc_year = ScbScholarshipYear::find()->all();
        $model_conditions = [new ScbCondition()];
        if ($model_sc_detail->load(Yii::$app->request->post())) {
            try {
                $model_sc_detail->scholarship_image = UploadedFile::getInstance($model_sc_detail, 'scholarship_image');
                $model_sc_detail->scholarship_file = UploadedFile::getInstance($model_sc_detail, 'scholarship_file');
                $model_sc_detail->scholarship_image = $model_sc_detail->uploadImage();
                $model_sc_detail->scholarship_file = $model_sc_detail->uploadFile();
                $model_sc_detail->save(false);

                $model_conditions = ModelScbCondition::createMultiple(ScbCondition::classname(), $model_conditions);
                ModelScbCondition::loadMultiple($model_conditions, Yii::$app->request->post());
                //return Json::encode($model);
                $con = Yii::$app->request->post('con');
                $con_val = Yii::$app->request->post('con_val');
                foreach ($con as $key => $row){
                    $modelcondition = new ScbCondition();
                    $modelcondition->scholarship_id = $model_sc_detail->scholarship_id;
                    $modelcondition->scholarship_year = $model_sc_detail->scholarship_year;
                    $modelcondition->condi_name = $row;
                    $modelcondition->condi_value = $con_val[$key];
                    $modelcondition->condi_fiexed = $row;
                    $modelcondition->save(false);

                }

                foreach ($model_conditions as $row){
                    $condition = new ScbCondition();

                    //$condition->condi_id = $row->condi_id;

                    $condition->scholarship_id = $model_sc_detail->scholarship_id;
                    $condition->scholarship_year = $model_sc_detail->scholarship_year;
                    $condition->condi_name = $row->condi_name;
                    $condition->condi_value = $row->condi_value;
                    if($row->condi_name != ""){
                        $condition->save(false);
                    }
                }
                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['view', 'scholarship_id' => $model_sc_detail->scholarship_id, 'scholarship_year' => $model_sc_detail->scholarship_year]);
            } catch (Exception $e) {
                Yii::$app->session->setFlash('danger', 'มีข้อผิดพลาด');
                return $this->redirect(['view', 'scholarship_id' => $model_sc_detail->scholarship_id, 'scholarship_year' => $model_sc_detail->scholarship_year]);
            }

        }
        $this->layout = "main_module";
        return $this->render('create', [
            'model_sc_detail' => $model_sc_detail,
            'sc_main' => $sc_main,
            'sc_year' => $sc_year,
            'model_conditions' => (empty($model_conditions)) ? [new ScbCondition] : $model_conditions,
        ]);
    }

    /**
     * Updates an existing ScbScholarshipTypeHasYear model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $scholarship_id
     * @param integer $scholarship_year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($scholarship_id, $scholarship_year)
    {
        $sc_main = ScbScholarshipType::find()->all();
        $sc_year = ScbScholarshipYear::find()->all();
        $model_sc_detail = $this->findModel($scholarship_id, $scholarship_year);
        $model_conditions = ScbCondition::find()->where(['scholarship_id'=>$scholarship_id,'scholarship_year'=>$scholarship_year])->all();
        if($model_conditions == null){
            $model_conditions = [new ScbCondition()];
        }
        if ($model_sc_detail->load(Yii::$app->request->post())) {
            //return Json::encode($model_sc_detail);
            try {
                $model_sc_detail->scholarship_image = UploadedFile::getInstance($model_sc_detail, 'scholarship_image');
                $model_sc_detail->scholarship_file = UploadedFile::getInstance($model_sc_detail, 'scholarship_file');
                $model_sc_detail->scholarship_image = $model_sc_detail->uploadImage();
               $model_sc_detail->scholarship_file = $model_sc_detail->uploadFile();
                $model_sc_detail->save();
                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                ScbCondition::deleteAll(['scholarship_id'=>$model_sc_detail->scholarship_id,'scholarship_year'=>$model_sc_detail->scholarship_year]);

                $model_conditions = ModelScbCondition::createMultiple(ScbCondition::classname(), $model_conditions);
                ModelScbCondition::loadMultiple($model_conditions, Yii::$app->request->post());
                //return Json::encode($model);
                foreach ($model_conditions as $row){
                    $condition = new ScbCondition();
                    $condition->scholarship_id = $model_sc_detail->scholarship_id;
                    $condition->scholarship_year = $model_sc_detail->scholarship_year;
                    $condition->condi_name = $row->condi_name;
                    $condition->condi_value = $row->condi_value;
                    if($row->condi_name != ""){
                        $condition->save();
                    }
                }
                return $this->redirect(['view', 'scholarship_id' => $model_sc_detail->scholarship_id, 'scholarship_year' => $model_sc_detail->scholarship_year]);
            } catch (Exception $e) {
                Yii::$app->session->setFlash('danger', 'มีข้อผิดพลาด');
                return $this->redirect(['view', 'scholarship_id' => $model_sc_detail->scholarship_id, 'scholarship_year' => $model_sc_detail->scholarship_year]);
            }
        }
        //return Json::encode($model);
        $this->layout = "main_module";
        return $this->render('update', [
            'model_sc_detail' => $model_sc_detail,
            'sc_main' => $sc_main,
            'sc_year' => $sc_year,
            'model_conditions' => (empty($model_conditions)) ? [new ScbCondition] : $model_conditions,
        ]);
    }

    /**
     * Deletes an existing ScbScholarshipTypeHasYear model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $scholarship_id
     * @param integer $scholarship_year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionDelete($scholarship_id, $scholarship_year)
    {
        $model_sc_detail = ScbScholarshipTypeHasYear::find()->where(['scholarship_id' => $scholarship_id, 'scholarship_year' => $scholarship_year])->one();
        $model_conditions = ScbCondition::find()->where(['scholarship_id'=>$scholarship_id,'scholarship_year'=>$scholarship_year])->all();

        ////$this->findModel($scholarship_id, $scholarship_year)->delete();
        //$model_sc_detail->delete();
        try{
            if($model_conditions) {
                ScbCondition::deleteAll(['scholarship_id' => $model_sc_detail->scholarship_id, 'scholarship_year' => $model_sc_detail->scholarship_year]);
            }
            if($model_sc_detail->scholarship_image!=null && $model_sc_detail->scholarship_file!=null){
            unlink(Yii::getAlias('@root').$model_sc_detail->uploadImageFolder.'/'.$model_sc_detail->scholarship_image);
            unlink(Yii::getAlias('@root').$model_sc_detail->uploadFilesFolder.'/'.$model_sc_detail->scholarship_file);
            } else if ($model_sc_detail->scholarship_image==null && $model_sc_detail->scholarship_file!=null){
                unlink(Yii::getAlias('@root').$model_sc_detail->uploadFilesFolder.'/'.$model_sc_detail->scholarship_file);
            } else if ($model_sc_detail->scholarship_image!=null && $model_sc_detail->scholarship_file==null){
                unlink(Yii::getAlias('@root').$model_sc_detail->uploadImageFolder.'/'.$model_sc_detail->scholarship_image);
            } 
                $model_sc_detail->delete();
                Yii::$app->session->setFlash('success','ลบข้อมูลเรียบร้อยแล้ว');
            return $this->redirect(['index']);
        }catch (Exception $e){
            Yii::$app->session->setFlash('success','มีข้อผิดพลาด');
            return $this->redirect(['index']);
        }

        return $this->redirect(['index']);
    }


    /**
     * Finds the ScbScholarshipTypeHasYear model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $scholarship_id
     * @param integer $scholarship_year
     * @return ScbScholarshipTypeHasYear the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($scholarship_id, $scholarship_year)
    {
        if (($model = ScbScholarshipTypeHasYear::findOne(['scholarship_id' => $scholarship_id, 'scholarship_year' => $scholarship_year])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
