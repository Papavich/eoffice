<?php

namespace app\modules\eoffice_materialsys\controllers;

use app\modules\eoffice_materialsys\models\MatsysBillMaster;
use Yii;
use app\modules\eoffice_materialsys\models\MatsysCompany;
use app\modules\eoffice_materialsys\models\CompanySearch;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyController implements the CRUD actions for MatsysCompany model.
 */
class CompanyController extends Controller
{

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

    public function actionIndex()
    {
        $query = MatsysCompany::find();

        $countQuery = clone $query;         //คำสั่งสร้าง Page แบ่งหน้า
        $pages = new Pagination( ['totalCount' => $countQuery->count(), 'pageSize' => 10] );
        $mat_company = $query->offset( $pages->offset )
            ->limit( $pages->limit )
            ->all();

        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;
        $this->layout = 'main_material';
        return $this->render('index', [
            'mat_company' => $mat_company,
            'pages' => $pages,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $data = MatsysCompany::find()->where(['company_id' => $_POST['mat_id']])->exists();
        if ($data) {
            \Yii::$app->session->setFlash('warning', "มีข้อมูลในระบบแล้ว ไม่สามารถเพิ่มได้");
            return $this->redirect("@web/eoffice_materialsys/company/index");
        } else {
            $model = new MatsysCompany();
            $model->company_id = $_POST['mat_id'];
            $model->company_name = $_POST['mat_name'];
            $model->company_address = $_POST['mat_address'];
            $model->company_sellman = $_POST['mat-sellman'];
            $model->company_phone = $_POST['mat_phone'];
            \Yii::$app->session->setFlash('success', "บันทึกข้อมูลสำเร็จ"); //คำสั่ง alert แจ้งเตือน ทำสำเร็๗
            if ($model->save()) {
                \Yii::$app->session->setFlash( 'success', "เพิ่มข้อมูลสำเร็จ" ); //คำสั่ง alert แจ้งเตือน ทำสำเร็๗
                return $this->redirect("@web/eoffice_materialsys/company/index");
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }
    public function actionUpdatecompany()
    {
        foreach ($_POST['mat_id'] as $index => $value){
            $item = MatsysCompany::findOne($value);
            $item->company_name = $_POST['mat_name'][$index];
            $item->company_address = $_POST['mat_address'][$index];
            $item->company_sellman = $_POST['mat-sellman'][$index];
            $item->company_phone = $_POST['mat_phone'][$index];
            $item->save();
        }
        \Yii::$app->session->setFlash( 'success', "บันทึกข้อมูลสำเร็จ" ); //คำสั่ง alert แจ้งเตือน ทำสำเร็๗
        return $this->redirect("@web/eoffice_materialsys/company/index");
    }

    public function actionDeletecompany()
    {
        $comp = MatsysBillMaster::find()->where(['company_id' => $_POST['mat_id']])->exists();
            if ($comp){
                \Yii::$app->session->setFlash( 'error', "ข้อมูลถูกใช้งาน ไม่สามารถลบได้" );
                return $this->redirect("@web/eoffice_materialsys/company/index");
            } else {
            foreach ($_POST['mat_id'] as $key => $val) {
                $item = MatsysCompany::findOne($val);
                $item->delete();
            }
        }
        return $this->redirect("@web/eoffice_materialsys/company/index");
    }

    protected function findModel($id)
    {
        if (($model = MatsysCompany::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
