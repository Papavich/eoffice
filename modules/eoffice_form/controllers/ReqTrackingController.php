<?php

namespace app\modules\eoffice_form\controllers;

use app\modules\eoffice_form\models\ReqTemplate;
use app\modules\eoffice_form\models\ReqApproveGroup;
use app\modules\eoffice_form\models\ReqApproval;
use app\modules\eoffice_form\models\UserRequest;
use Yii;
use app\modules\eoffice_form\models\ReqTracking;
use app\modules\eoffice_form\models\ReqTrackingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use yii\helpers\Html;
use yii\helpers\Url;

use app\modules\eoffice_form\models\AttributeData;
use app\modules\eoffice_form\models\DesignAttribute;
use app\modules\eoffice_form\models\DesignSection;


/**
 * ReqTrackingController implements the CRUD actions for ReqTracking model.
 */
class ReqTrackingController extends Controller
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
     * Lists all ReqTracking models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new ReqTrackingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReqTracking model.
     * @param integer $user_id
     * @param integer $template_id
     * @param string $cr_date
     * @param integer $cr_term
     * @param integer $cr_year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_id, $template_id, $cr_date, $cr_term, $cr_year)
    {
        $this->layout = "main_modules";

        $getFormValue = UserRequest::find()->where(['user_id' => $user_id,
            'template_id' => $template_id,
            'cr_date' => $cr_date,
            'cr_term' => $cr_term,
            'cr_year' => $cr_year])->all();
        foreach ($getFormValue as $item) {
            $AllField = $item->req_json;
        }

        return $this->render('view', [
            'AllField' => json_decode($AllField, JSON_UNESCAPED_UNICODE),
            'model' => $this->findModel($user_id, $template_id, $cr_date, $cr_term, $cr_year),
            'user_id' => $user_id,
            'template_id' => $template_id,
            'cr_date' => $cr_date,
            'cr_term' => $cr_term,
            'cr_year' => $cr_year,
        ]);
    }

    /**
     * Creates a new ReqTracking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $this->layout = "main_modules";
        $model = new ReqTracking();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'template_id' => $model->template_id, 'cr_date' => $model->cr_date, 'cr_term' => $model->cr_term, 'cr_year' => $model->cr_year]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }*/

    /**
     * Updates an existing ReqTracking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param integer $template_id
     * @param string $cr_date
     * @param integer $cr_term
     * @param integer $cr_year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionUpdate($user_id, $template_id, $cr_date, $cr_term, $cr_year)
    {
        $model = $this->findModel($user_id, $template_id, $cr_date, $cr_term, $cr_year);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'template_id' => $model->template_id, 'cr_date' => $model->cr_date, 'cr_term' => $model->cr_term, 'cr_year' => $model->cr_year]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }*/

    /**
     * Deletes an existing ReqTracking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param integer $template_id
     * @param string $cr_date
     * @param integer $cr_term
     * @param integer $cr_year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     *//*
    public function actionDelete($user_id, $template_id, $cr_date, $cr_term, $cr_year)
    {
        $this->findModel($user_id, $template_id, $cr_date, $cr_term, $cr_year)->delete();

        return $this->redirect(['index']);
    }*/

    public function actionCanceled($user_id, $template_id, $cr_date, $cr_term, $cr_year)
    {
        $this->layout = "main_modules";
        $model = $this->findModel($user_id, $template_id, $cr_date, $cr_term, $cr_year);
        if(isset($_POST)) {
            $model->load(Yii::$app->request->post());
            $ReqStatus = $model;
            $ReqStatus->req_status = 'ยกเลิกคำร้อง';
            $ReqStatus->req_enddate = date('Y-m-d');
            $ReqStatus->save();
        }

        $queryGroup = ReqApproveGroup::find()->where([
            'user_id' => $user_id,
            'template_id' => $template_id,
            'cr_date' => $cr_date,
            'cr_term' => $cr_term,
            'cr_year' => $cr_year])->all();
        foreach ($queryGroup as $app_group) {
            $app_group->load(Yii::$app->request->post());
            $app_group->approve_group_status = 'ยกเลิกคำร้อง';
            $app_group->approve_group_enddate = date('Y-m-d');;
            $app_group->save();
        }

        $queryApproval = ReqApproval::find()->where([
            'user_id' => $user_id,
            'template_id' => $template_id,
            'cr_date' => $cr_date,
            'cr_term' => $cr_term,
            'cr_year' => $cr_year])->all();
        foreach ($queryApproval as $approval) {
            $approval->load(Yii::$app->request->post());
            $approval->approve_status = 'ยกเลิกคำร้อง';
            $approval->approve_enddate = date('Y-m-d');;
            $approval->save();
        }





        return $this->redirect(['req-tracking/index']);
    }

    public function actionWordReport($user_id, $template_id, $cr_date, $cr_term, $cr_year)
    {
        $this->layout = "main_modules";
        Settings::setTempDir('../modules/eoffice_form/temp/'); //Path ของ Folder temp ที่สร้างเอาไว้
        $getTemplate = ReqTemplate::find()->where(['template_id' => $template_id])->all();
        foreach ($getTemplate as $temp) {
            $TempDoc = $temp->template_file;
        }

        $FileDoc[] = json_decode($TempDoc, JSON_UNESCAPED_UNICODE);
        $DocCode = array_keys($FileDoc[0]);

                $templateProcessor = new TemplateProcessor('../modules/eoffice_form/template/'.$template_id.'/'.$DocCode[0]); //Path ของ template ที่สร้างเอาไว้
                $getFormValue = UserRequest::find()->where(['user_id' => $user_id,
                    'template_id' => $template_id,
                    'cr_date' => $cr_date,
                    'cr_term' => $cr_term,
                    'cr_year' => $cr_year])->all();
                foreach ($getFormValue as $item) {
                    $AllField = $item->req_json;
                }







        $field_ref = [];
        $getDesignSection = DesignSection::find()->where(['template_id' =>$template_id])->orderBy('design_section_order')->all();
        foreach ($getDesignSection as $item) {
            //$DesignSection[] = $item->design_section_id;
            $getDesignAttribute = DesignAttribute::find()->where(['design_section_id' => $item->design_section_id])->orderBy('attribute_order')->all();
            foreach ($getDesignAttribute as $attribute) {
                switch ($attribute->attributeType->attribute_type_name) {
                    case "Textbox":
                        array_push($field_ref, $attribute->attribute_ref);
                        break;
                    case "Areabox":
                        array_push($field_ref, $attribute->attribute_ref);
                        break;
                    case "Checkbox":
                        $getAttributeList = AttributeData::find()->where(['attribute_ref' => $attribute->attribute_ref])->orderBy('attribute_order')->all();
                        count($getAttributeList);
                        array_push($field_ref, $attribute->attribute_ref);
                        break;
                    case "Radiobox":
                        array_push($field_ref, $attribute->attribute_ref);
                        break;
                    case "Selectbox":
                        array_push($field_ref, $attribute->attribute_ref);
                        break;
                    case "Datepicker":
                        array_push($field_ref, $attribute->attribute_ref);
                        break;
                    case "Paragraph":
                        break;
                    case "File Upload":
                        array_push($field_ref, $attribute->attribute_ref);
                        break;
                    case "Picture":
                        break;
                }
            }
        }


//        echo '<pre>';
//        print_r($field_ref);
//        echo '</pre>';








                $FieldREF = json_decode($AllField, JSON_UNESCAPED_UNICODE);
                for( $i = 0 ; $i < count($FieldREF) ; $i++){
                    //$templateProcessor->setValue([$FieldREF[$i]['field_ref']],$FieldREF[$i]['field_value']); // การ setValue หลายๆ ตะวแปรพร้อมกะน
                    $templateProcessor->setValue(
                    [
                        $field_ref[$i],
                    ],
                    [
                        $FieldREF[$i]['field_value'][0]

                    ]); // การ setValue หลายๆ ตะวแปรพร้อมกะน
                }

                $getApprove = ReqApproval::find()->where([
                    'user_id' => $user_id,
                    'template_id' => $template_id,
                    'cr_date' => $cr_date,
                    'cr_term' => $cr_term,
                    'cr_year' => $cr_year])->all();

                $i = 1;
                foreach ($getApprove as $item){
                    $templateProcessor->setValue(
                        [
                            'OOApprove'.$i.'OO',

                            'OOApproveName'.$i.'OO',
                            'OOEnddate'.$i.'OO',
                        ],
                        [
                            $item->approve_status.
                            '
                            
                            '
                            .$item->approve_comment,
                            $item->approve_name,
                            $item->approve_enddate
                        ]);
                    $i++;
                }



        $templateProcessor->saveAs('../modules/eoffice_form/template/'.$template_id.'/ms_word_result.docx'); //กำหนด Path ที่จะสร้างไฟล์
        echo '<p>';
        echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web').'/../modules/eoffice_form/template/'.$template_id.'/ms_word_result.docx'), ['class' => 'btn btn-info']); // สร้าง Link สำหรับ Download ไฟล์ที่แทนที่ข้อมูลแล้ว
        echo '</p>';
    }
    /**
     * Finds the ReqTracking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $template_id
     * @param string $cr_date
     * @param integer $cr_term
     * @param integer $cr_year
     * @return ReqTracking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $template_id, $cr_date, $cr_term, $cr_year)
    {
        if (($model = ReqTracking::findOne(['user_id' => $user_id, 'template_id' => $template_id, 'cr_date' => $cr_date, 'cr_term' => $cr_term, 'cr_year' => $cr_year])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
