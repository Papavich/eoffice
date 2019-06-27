<?php

namespace app\modules\materialsystem\controllers;

use app\modules\materialsystem\models\MatsysMaterial;
use Yii;
use app\modules\materialsystem\models\MatsysMaterialType;
use app\modules\materialsystem\models\TypeSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TypeController implements the CRUD actions for MatsysMaterialType model.
 */
class TypeController extends Controller
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
     * Lists all MatsysMaterialType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = MatsysMaterialType::find();

        $countQuery = clone $query;         //คำสั่งสร้าง Page แบ่งหน้า
        $pages = new Pagination( ['totalCount' => $countQuery->count(), 'pageSize' => 10] );
        $mat_type = $query->offset( $pages->offset )
            ->limit( $pages->limit )
            ->all();

        $searchModel = new TypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;
        $this->layout = 'main_material';
        return $this->render('index', [
            'mat_type' => $mat_type,
            'pages' => $pages,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MatsysMaterialType model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = 'main_material';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MatsysMaterialType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $data= MatsysMaterialType::find()->where(['material_type_id' => $_POST['material_type_id']])->exists();
        if ($data) {
            \Yii::$app->session->setFlash( 'warning', "มีข้อมูลในระบบแล้ว ไม่สามารถเพิ่มได้" );
            return $this->redirect("@web/materialsystem/type/index");
        } else {
            $model = new MatsysMaterialType();
            $model->material_type_id = $_POST['material_type_id'];

            $model->material_type_name = $_POST['material_type_name'];

            if ($model->save()) {
                \Yii::$app->session->setFlash( 'success', "เพิ่มข้อมูลสำเร็จ" ); //คำสั่ง alert แจ้งเตือน ทำสำเร็จ
                return $this->redirect("@web/materialsystem/type/index");
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing MatsysMaterialType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdatetype()
    {
        foreach ($_POST['mat_id'] as $index => $value){
            $item = MatsysMaterialType::findOne($value);
            $item->material_type_name = $_POST['material_type_name'][$index];
            $item->save();
        }
        \Yii::$app->session->setFlash( 'success', "บันทึกข้อมูลสำเร็จ" ); //คำสั่ง alert แจ้งเตือน ทำสำเร็๗
        return $this->redirect("@web/materialsystem/type/index");
    }

    /**
     * Deletes an existing MatsysMaterialType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeletetype()
    {
        $type = MatsysMaterial::find()->where(['material_type_id' => $_POST['type_id']])->exists();
        if ($type){
            \Yii::$app->session->setFlash( 'error', "ข้อมูลถูกใช้งาน ไม่สามารถลบได้" );
            return $this->redirect("@web/materialsystem/type/index");
        }else {
            foreach ($_POST['type_id'] as $key => $value) {
                $item = MatsysMaterialType::findOne($value);
                $item->delete();
            }
            \Yii::$app->session->setFlash('success', "ลบข้อมูลสำเร็จ");
            return $this->redirect("@web/materialsystem/type/index");
        }
    }

    /**
     * Finds the MatsysMaterialType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MatsysMaterialType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MatsysMaterialType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
