<?php

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\models\ScbProject;
use Yii;
use app\modules\scholar_b\models\ScbPortfolio;
use app\modules\scholar_b\models\ScbPortfolioSearch;
use app\modules\scholar_b\models\ScbStudent;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\uploadedFile;
use yii\db\Exception;
use yii\helpers\Html;

Yii::setAlias('@root',realpath(dirname(__FILE__).'/../../../web/'));
/**
 * PortfolioController implements the CRUD actions for ScbPortfolio model.
 */
class PortfolioController extends Controller
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
                    'deleteport' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ScbPortfolio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ScbPortfolioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ScbPortfolio model.
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
     * Creates a new ScbPortfolio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ScbPortfolio();
        $model_std = ScbProject::find()->where(['crby' => Yii::$app->user->identity->getId()])->all();

        if ($model->load(Yii::$app->request->post())) {
            try {
                $model->port_img = UploadedFile::getInstance($model, 'port_img');
                $model->port_file = UploadedFile::getInstance($model, 'port_file');
                $model->port_img = $model->uploadImage();
                $model->port_file = $model->uploadFile();

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
                return $this->redirect(['view', 'id' => $model->id_portfolio]);
            }

            $model->port_status = 0;
            $model->save();

            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app', Html::encode('อัปโหลดผลงานสำเร็จ')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);

            return $this->redirect('index');
        }

        return $this->render('create', [
            'model' => $model,
            'model_std' => $model_std
        ]);
    }

    /**
     * Updates an existing ScbPortfolio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            try {
                $model->port_img = UploadedFile::getInstance($model, 'port_img');
                $model->port_file = UploadedFile::getInstance($model, 'port_file');
                $model->port_img = $model->uploadImage();
                $model->port_file = $model->uploadFile();
            } catch (Exception $e) {
            }

            $model->port_status = 0;
            $model->save();

            Yii::$app->getSession()->setFlash('alert3', [
                'type' => 'info',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app', Html::encode('แก้ไขข้อมูลสำเร็จ')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);

            return $this->redirect(['view',
                'id' => $model->id_portfolio]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ScbPortfolio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteport($id)
    {
        $model = ScbPortfolio::find()->where(['id_portfolio' => $id])->one();
        try {
            if ($model->port_img != null && $model->port_file != null) {
                unlink(Yii::getAlias('@root') . $model->uploadImageFolder . '/' . $model->port_img);
                unlink(Yii::getAlias('@root') . $model->uploadFilesFolder . '/' . $model->port_file);
            } else if ($model->port_img == null && $model->port_file != null) {
                unlink(Yii::getAlias('@root') . $model->uploadFilesFolder . '/' . $model->port_file);
            } else if ($model->port_img != null && $model->port_file == null) {
                unlink(Yii::getAlias('@root') . $model->uploadImageFolder . '/' . $model->port_img);
            }
            $model->delete();
            Yii::$app->getSession()->setFlash('alert4', [
                'type' => 'warning',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app', Html::encode('ลบข้อมูลเรียบร้อยแล้ว')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['index']);
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
            return $this->redirect(['index']);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the ScbPortfolio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ScbPortfolio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ScbPortfolio::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
