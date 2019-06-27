<?php

namespace app\modules\materialsystem\controllers;

use app\modules\materialsystem\models\MatsysMaterial;
use Yii;
use app\modules\materialsystem\models\MatsysLocation;
use app\modules\materialsystem\models\LocationSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LocationController implements the CRUD actions for MatsysLocation model.
 */
class LocationController extends Controller
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
     * Lists all MatsysLocation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = MatsysLocation::find();

        $countQuery = clone $query;         //คำสั่งสร้าง Page แบ่งหน้า
        $pages = new Pagination( ['totalCount' => $countQuery->count(), 'pageSize' => 10] );
        $mat_location = $query->offset( $pages->offset )
            ->limit( $pages->limit )
            ->all();

        $searchModel = new LocationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;

        $this->layout = 'main_material';
        return $this->render('index', [
            'mat_location' => $mat_location,
            'pages' => $pages,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MatsysLocation model.
     * @param string $id
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
     * Creates a new MatsysLocation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $data= MatsysLocation::find()->where(['location_id' => $_POST['loca_id']])->exists();
        if ($data) {
            \Yii::$app->session->setFlash( 'warning', "มีข้อมูลในระบบแล้ว ไม่สามารถเพิ่มได้" );
            return $this->redirect("@web/materialsystem/location/index");
        } else {
            $model = new MatsysLocation();
            $model->location_id = $_POST['loca_id'];
            $model->location_name = $_POST['loca_name'];

            if ($model->save()) {
                \Yii::$app->session->setFlash( 'success', "เพิ่มข้อมูลสำเร็จ" ); //คำสั่ง alert แจ้งเตือน ทำสำเร็จ
                return $this->redirect("@web/materialsystem/location/index");
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing MatsysLocation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdatelocation()
    {
        foreach ($_POST['loca_id'] as $index => $value){
            $item = MatsysLocation::findOne($value);
            $item->location_name = $_POST['loca_name'][$index];
            $item->save();
        }
        \Yii::$app->session->setFlash( 'success', "บันทึกข้อมูลสำเร็จ" ); //คำสั่ง alert แจ้งเตือน ทำสำเร็๗
        return $this->redirect("@web/materialsystem/location/index");
    }

    /**
     * Deletes an existing MatsysLocation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeletelocation()
    {
        $loc = MatsysMaterial::find()->where(['location_id' => $_POST['loca_id']])->exists();
        if ($loc){
            \Yii::$app->session->setFlash( 'error', "ข้อมูลถูกใช้งาน ไม่สามารถลบได้" );
            return $this->redirect("@web/materialsystem/location/index");
        }else {
            foreach ($_POST['loca_id'] as $key => $value) {
                $item = MatsysLocation::findOne($value);
                $item->delete();
            }
            \Yii::$app->session->setFlash('success', "ลบข้อมูลสำเร็จ");
            return $this->redirect("@web/materialsystem/location/index");
        }
    }

    /**
     * Finds the MatsysLocation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MatsysLocation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MatsysLocation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
