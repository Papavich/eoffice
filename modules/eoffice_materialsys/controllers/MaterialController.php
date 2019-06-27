<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 9/3/2561
 * Time: 10:20
 */

namespace app\modules\eoffice_materialsys\controllers;

use app\modules\eoffice_materialsys\models\MatsysBillDetail;
use app\modules\eoffice_materialsys\models\MatsysLocation;
use app\modules\eoffice_materialsys\models\MatsysMaterialType;
use app\modules\eoffice_materialsys\models\UploadForm;
use app\modules\eoffice_materialsys\models\MatsysBillDetailSearch;
use yii\data\Pagination;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

use Yii;
use app\modules\eoffice_materialsys\models\MatsysMaterial;
use app\modules\eoffice_materialsys\models\MatsysMaterialSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class MaterialController extends Controller
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
        return $this->redirect(['material/listmaterial']);
    }

    public function actionListmaterial()
    {
        $searchModel = new MatsysMaterialSearch();
        $modelMaterial = new MatsysMaterial();
        $modelLocation = ArrayHelper::map(MatsysLocation::find()->all(), 'location_id', 'location_name');
        $modelType = ArrayHelper::map(MatsysMaterialType::find()->all(), 'material_type_id', 'material_type_name');
        $url_params = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['pagination' => ['pageSize' => 5]]);
        if (isset($url_params['view'])) {
            $dataProvider->pagination->pageSize = 24;
        } else {
            $dataProvider->pagination->pageSize = 20;
        }
        $material_alerts = MatsysMaterial::find()
            ->innerJoin('matsys_bill_detail','matsys_material.material_id = matsys_bill_detail.material_id')
            ->groupBy('matsys_bill_detail.material_id')
            ->all();
        $material_alert_items = [];
        foreach ($material_alerts as $key => $value){
            if($value->material_amount_check == null){
                $value->material_amount_check = 0;
            }elseif(MatsysMaterial::amountAll($value->material_id) < $value->material_amount_check){
                array_push($material_alert_items,$value);
            }
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelMateril' => $modelMaterial,
            'modelLocation' => $modelLocation,
            'modelType' => $modelType,
            'material_alert'=> $material_alert_items
        ]);
    }

    public function actionView($id)
    {
        $searchModel = new MatsysBillDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 15;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelImage = new UploadForm();

        $modelLocation = ArrayHelper::map(MatsysLocation::find()->all(), 'location_id', 'location_name');
        $modelType = ArrayHelper::map(MatsysMaterialType::find()->all(), 'material_type_id', 'material_type_name');


        if ($model->load(Yii::$app->request->post())) {
            $uploadPath = '../web/web_mat/temp/';
            $image_path = '../web/web_mat/images/';
            $file = scandir($uploadPath);
            $fileImage = scandir($image_path);
            foreach ($file as $key => $value) {
                if ($key >= 2) {
                    foreach ($fileImage as $key2 => $value2) {
                        $name_file = substr($value2, 0, strrpos($value2, '.'));
                        if ($name_file == $model->material_id) {
                            unlink($image_path . $value2);
                            break;
                        }
                    }
                    $userfile_extn = substr($value, strrpos($value, '.') + 1);
                    copy($uploadPath . $value, $image_path . $model->material_id . '.' . $userfile_extn);
                    $model->material_image = $model->material_id . '.' . $userfile_extn;
                }
            }
            $model->save();
            $path_name = "../web/web_mat/temp/";
            $file = scandir($path_name);
            foreach ($file as $key => $value) {
                if ($key >= 2) {
                    unlink($path_name . $value);
                }
            }
            return $this->redirect(
                [
                    'view',
                    'id' => $model->material_id
                ]
            );
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelLocation' => $modelLocation,
                'modelType' => $modelType,
                'modelImage' => $modelImage
            ]);
        }
    }

    public function actionDelete()
    {
        try {
            $mat_id = Yii::$app->request->post('id');
            $this->findModel($mat_id)->delete();
            echo "pass";
        } catch (Exception $e) {
            echo "false";
        }
    }

    protected function findModel($id)
    {
        if (($model = MatsysMaterial::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /* Ajax Create Material */
    public function actionAjaxcreate()
    {
        if (Yii::$app->request->post()) {
            $path_name = "../web/web_mat/temp/";
            $path_success_name = "../web/web_mat/images/";
            $model_material = new MatsysMaterial();
            $filepdf = null;

            $file = scandir($path_name);
            foreach ($file as $key => $value) {
                if ($key >= 2) {
                    $filepdf = $value;
                    break;
                }
            }
            $extension = explode('.', $filepdf);
            $lastIndex = count($extension);
            $model_material->load(Yii::$app->request->post());
            $model_material->material_image = $model_material->material_id . "." . $extension[$lastIndex - 1];
            copy($path_name . $filepdf, $path_success_name . $model_material->material_image);
            try {
                $model_material->save();
            } catch (Exception $e) {
                return $e->getMessage();
            }
            $file = scandir($path_name);
            foreach ($file as $key => $value) {
                if ($key >= 2) {
                    unlink($path_name . $value);
                }
            }
            return $path_success_name . $model_material->material_image;
        } else {
            return false;
        }
    }

    /* Upload image */
    public function actionUpfile()
    {
        $fileName = 'file';
        $uploadPath = '../web/web_mat/temp/';
        $file = scandir($uploadPath);
        foreach ($file as $key => $value) {
            if ($key >= 2) {
                unlink($uploadPath . $value);
            }
        }

        if (isset($_FILES[$fileName])) {
            $file = \yii\web\UploadedFile::getInstanceByName($fileName);
            if ($file->saveAs($uploadPath . '/' . $file->name)) {
                //Now save file data to database
                echo "true";
            } else {
                echo "false";
            }
        }
        return false;
    }

    /* Clear temp image */
    public function actionCleartemp()
    {
        $uploadPath = '../web/web_mat/temp/';
        $file = scandir($uploadPath);
        foreach ($file as $key => $value) {
            if ($key >= 2) {
                unlink($uploadPath . $value);
            }
        }
    }

    //Ajax Delete file image
    public function actionDeleteimage()
    {
        $this->enableCsrfValidation = false;
        $filename = Yii::$app->request->post('filename');
        $path_name = "../web/web_mat/temp/" . $filename;
        if (unlink($path_name)) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    public function actionCheckidmaterial()
    {
        $material_id = Yii::$app->request->post('material_id');
        $result = MatsysMaterial::findOne($material_id);
        if ($result == null) {
            echo "pass";
        } else {
            echo "false";
        }
    }

    public function actionAmountcheck()
    {
        $material_id = MatsysMaterial::find()
            ->innerJoin('matsys_bill_detail','matsys_material.material_id = matsys_bill_detail.material_id')
            ->groupBy('matsys_bill_detail.material_id')
            ->all();
        $amount = 0;
        foreach ($material_id as $key => $value){
            if($value->material_amount_check == null){
                $value->material_amount_check = 0;
            }elseif(MatsysMaterial::amountAll($value->material_id) < $value->material_amount_check){
                $amount++;
            }
        }
        echo $amount;
    }
}