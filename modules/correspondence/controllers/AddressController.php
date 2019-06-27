<?php

namespace app\modules\correspondence\controllers;

use app\modules\correspondence\models\CmsAddress;
use app\modules\correspondence\models\CmsDocSubType;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SecretController implements the CRUD actions for CmsDocSecret model.
 */
class AddressController extends Controller
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
            'query' => CmsAddress::find(),
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
     * Creates a new CmsDocSecret model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CmsAddress();
        $this->layout = "main_module";
        if (CmsAddress::findOne($_POST['CmsAddress']['address_id'])) {
            return "false";
        } elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['setting/setting-document#ttab6_nobg', 'model_secret' => CmsAddress::find()->all()]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Updates an existing CmsDocSecret model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->layout = "main_module";
        $year = range(1990, 2040);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['setting/setting-document#ttab6_nobg', 'model_secret' => CmsAddress::find()->all()]);
        } else {
            return $this->render('update', [
                'model' => $model,'year'=>$year
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
        $model = $this->findModel($_POST['address_id']);
        $model->delete();
        //return true;
        //return $this->redirect(['setting/setting-document#ttab6_nobg']);
    }
    //get sub_type_id in drop down for show address_id has the sub_type_id
    public function actionGetAddress()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $address_id = $parents[0];
               // $out = $this->getAddress($address_id);
                foreach(CmsAddress::find()->where(['sub_type_id' => $address_id])->orderBy(['sub_type_id' => SORT_ASC])->all() as $address){
                    $out[] = ['id' => $address->address_id, 'name' => $address->address_name];
                }
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetAddressToShow()
    {
        $address = CmsAddress::find()
            ->select('address_id, address_name')->where(['sub_type_id' => $_GET['subtype_id']])->orderBy(['sub_type_id' => SORT_ASC])->all();
        echo Json::encode($address);
//        echo $address;
    }

    /**
     * Finds the CmsDocSecret model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CmsAddress the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CmsAddress::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
