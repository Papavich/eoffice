<?php

namespace app\modules\scholar_b\controllers;

use Yii;
use app\modules\scholar_b\models\ScbStudentHasActivityMain;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\uploadedFile;
use app\modules\scholar_b\controllers;
use yii\db\Exception;

Yii::setAlias('@root',realpath(dirname(__FILE__).'/../../../web'));

/**
 * UploadactController implements the CRUD actions for ScbStudentHasActivityMain model.
 */
class UploadactController extends Controller
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
     * Creates a new ScbStudentHasActivityMain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ScbStudentHasActivityMain();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                'activity/index#jtab2_nobg',
                'model_upload' => ScbStudentHasActivityMain::find()->all()]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($student_id, $activity_main_id, $year)
    {
        $model = $this->findModel($student_id, $activity_main_id, $year);
        if ($model->load(Yii::$app->request->post())) {
            try {
                $model->activity_img = UploadedFile::getInstance($model, 'activity_img');
                $model->activity_img = $model->uploadImage();
                $model->save();

                Yii::$app->getSession()->setFlash('alert1', [
                    'type' => 'success',
                    'duration' => 12000,
                    'icon' => 'fa fa-users',
                    'title' => Yii::t('app', Html::encode('Submission')),
                    'message' => Yii::t('app', Html::encode('อัพโหลดหลักฐานเรียบร้อย')),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['activity/index']);
            } catch (Exception $e) {
                Yii::$app->getSession()->setFlash('alert2', [
                    'type' => 'danger',
                    'duration' => 12000,
                    'icon' => 'fa fa-users',
                    'title' => Yii::t('app', Html::encode('Submission')),
                    'message' => Yii::t('app', Html::encode('เกิดข้อผิดพลาด')),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['activity/index']);
            }
        }

        $this->layout = "main_module";
        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing ScbStudentHasActivityMain model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $student_id
     * @param integer $activity_main_id
     * @param integer $year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($student_id, $activity_main_id, $year)
    {
        $model = ScbStudentHasActivityMain::find()->where(['student_id' => $student_id, 'activity_main_id' => $activity_main_id ,'year'=>$year])->one();
        //$this->findModel($student_id, $activity_main_id, $year)->delete();
     if($model->activity_img!=null ) {
         unlink(Yii::getAlias('@root') . $model->uploadImageFolder . '/' . $model->activity_img);
     }
        $model->delete();
        //return Yii::getAlias('@root') . $this->uploadImageFolder . '/' . $this->activity_img;
            return $this->redirect(['activity/index']);
    }

    /**
     * Finds the ScbStudentHasActivityMain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $student_id
     * @param integer $activity_main_id
     * @param integer $year
     * @return ScbStudentHasActivityMain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($student_id, $activity_main_id, $year)
    {
        if (($model = ScbStudentHasActivityMain::findOne(['student_id' => $student_id, 'activity_main_id' => $activity_main_id, 'year' => $year])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
