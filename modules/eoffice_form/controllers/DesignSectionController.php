<?php

namespace app\modules\eoffice_form\controllers;

use app\modules\eoffice_form\models\DesignAttribute;
use app\modules\eoffice_form\models\DesignAttributeSearch;
use Yii;
use app\modules\eoffice_form\models\DesignSection;
use app\modules\eoffice_form\models\DesignSectionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DesignSectionController implements the CRUD actions for DesignSection model.
 */
class DesignSectionController extends Controller
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
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DesignSection models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new DesignSectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DesignSection model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = "main_modules";

        $session = Yii::$app->session;
        $session['design_section_id']= $id;

        $searchModel = new DesignAttributeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionViewSubject($id)
    {
        $this->layout = "main_modules";

        return $this->render('viewSubject', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new DesignSection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($template_id)
    {
        $this->layout = "main_modules";
        $model = new DesignSection();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $SectionID = $model->design_section_id;
            //echo $model->sectionType->section_type_name;
            //$SectionType = $_POST['DesignSection']['section_type_id'];
            if ( $model->sectionType->section_type_name == 'ข้อมูลพื้นฐาน') {
                $boxAttribute = new DesignAttribute();
                if (isset($_POST)) {
                    for( $i = 0;$i <8 ;$i++){
                        $boxAttribute->load(Yii::$app->request->post());
                        $boxAttribute = new DesignAttribute();
                        if($i == 0){
                            $boxAttribute->attribute_ref = 'รหัสนักศึกษา';
                            $boxAttribute->attribute_name = 'รหัสนักศึกษา';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '1';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 1){
                            $boxAttribute->attribute_ref = 'คำนำหน้า';
                            $boxAttribute->attribute_name = 'คำนำหน้า';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '2';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 2){
                            $boxAttribute->attribute_ref = 'ชื่อ';
                            $boxAttribute->attribute_name = 'ชื่อ';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '3';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 3){
                            $boxAttribute->attribute_ref = 'นามสกุล';
                            $boxAttribute->attribute_name = 'นามสกุล';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '5';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 4){
                            $boxAttribute->attribute_ref = 'สาขาวิชา';
                            $boxAttribute->attribute_name = 'สาขาวิชา';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '9';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 5){
                            $boxAttribute->attribute_ref = 'ภาควิชา';
                            $boxAttribute->attribute_name = 'ภาควิชา';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '13';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 6){
                            $boxAttribute->attribute_ref = 'คณะ';
                            $boxAttribute->attribute_name = 'คณะ';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '11';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 7){
                            $boxAttribute->attribute_ref = 'ชั้นปีที่';
                            $boxAttribute->attribute_name = 'ชั้นปีที่';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '7';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 8){
                            $boxAttribute->attribute_ref = 'ระดับการศึกษา';
                            $boxAttribute->attribute_name = 'ระดับการศึกษา';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '15';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 9){
                            $boxAttribute->attribute_ref = 'ชื่อปริญญา';
                            $boxAttribute->attribute_name = 'ชื่อปริญญา';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '17';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }

                    }
                }
            }else if($model->sectionType->section_type_name == 'ที่อยู่อาศัย'){
                $boxAttribute = new DesignAttribute();
                if (isset($_POST)) {
                    for( $i = 0;$i <10 ;$i++){
                        $boxAttribute->load(Yii::$app->request->post());
                        $boxAttribute = new DesignAttribute();
                        if($i == 0){
                            $boxAttribute->attribute_ref = 'ที่อยู่1';
                            $boxAttribute->attribute_name = 'ที่อยู่1';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '25';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 1){
                            $boxAttribute->attribute_ref = 'ที่อยู่2';
                            $boxAttribute->attribute_name = 'ที่อยู่2';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '26';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 2){
                            $boxAttribute->attribute_ref = 'อำเภอ';
                            $boxAttribute->attribute_name = 'อำเภอ';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '27';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 3){
                            $boxAttribute->attribute_ref = 'รหัสไปรษณีย์';
                            $boxAttribute->attribute_name = 'รหัสไปรษณีย์';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '28';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }
                    }
                }
            }else if($model->sectionType->section_type_name == 'รายวิชา'){
                return $this->redirect(['view-subject', 'id' => $model->design_section_id]);
            }else{
                return $this->redirect(['view', 'id' => $model->design_section_id]);
            }
            return $this->redirect(['view', 'id' => $model->design_section_id]);
        }

        return $this->render('create', [
            'template_id' => $template_id,
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DesignSection model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id,$template_id)
    {
        $this->layout = "main_modules";
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $SectionID = $model->design_section_id;
            $SectionType =$_POST['DesignSection']['section_type_id'];
            if ( $model->sectionType->section_type_name == 'ข้อมูลพื้นฐาน') {
                $boxAttribute = new DesignAttribute();
                if (isset($_POST)) {
                    for( $i = 0;$i <8 ;$i++){
                        $boxAttribute->load(Yii::$app->request->post());
                        $boxAttribute = new DesignAttribute();
                        if($i == 0){
                            $boxAttribute->attribute_ref = 'รหัสนักศึกษา';
                            $boxAttribute->attribute_name = 'รหัสนักศึกษา';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '1';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 1){
                            $boxAttribute->attribute_ref = 'คำนำหน้า';
                            $boxAttribute->attribute_name = 'คำนำหน้า';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '2';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 2){
                            $boxAttribute->attribute_ref = 'ชื่อ';
                            $boxAttribute->attribute_name = 'ชื่อ';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '3';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 3){
                            $boxAttribute->attribute_ref = 'นามสกุล';
                            $boxAttribute->attribute_name = 'นามสกุล';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '5';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 4){
                            $boxAttribute->attribute_ref = 'สาขาวิชา';
                            $boxAttribute->attribute_name = 'สาขาวิชา';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '9';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 5){
                            $boxAttribute->attribute_ref = 'ภาควิชา';
                            $boxAttribute->attribute_name = 'ภาควิชา';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '13';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 6){
                            $boxAttribute->attribute_ref = 'คณะ';
                            $boxAttribute->attribute_name = 'คณะ';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '11';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 7){
                            $boxAttribute->attribute_ref = 'ชั้นปีที่';
                            $boxAttribute->attribute_name = 'ชั้นปีที่';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '7';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 8){
                            $boxAttribute->attribute_ref = 'ระดับการศึกษา';
                            $boxAttribute->attribute_name = 'ระดับการศึกษา';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '15';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 9){
                            $boxAttribute->attribute_ref = 'ชื่อปริญญา';
                            $boxAttribute->attribute_name = 'ชื่อปริญญา';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '17';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }

                    }
                }
            }else if($model->sectionType->section_type_name == 'ที่อยู่อาศัย'){
                $boxAttribute = new DesignAttribute();
                if (isset($_POST)) {
                    for( $i = 0;$i <10 ;$i++){
                        $boxAttribute->load(Yii::$app->request->post());
                        $boxAttribute = new DesignAttribute();
                        if($i == 0){
                            $boxAttribute->attribute_ref = 'ที่อยู่1';
                            $boxAttribute->attribute_name = 'ที่อยู่1';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '25';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 1){
                            $boxAttribute->attribute_ref = 'ที่อยู่2';
                            $boxAttribute->attribute_name = 'ที่อยู่2';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '26';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 2){
                            $boxAttribute->attribute_ref = 'อำเภอ';
                            $boxAttribute->attribute_name = 'อำเภอ';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '27';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }elseif($i == 3){
                            $boxAttribute->attribute_ref = 'รหัสไปรษณีย์';
                            $boxAttribute->attribute_name = 'รหัสไปรษณีย์';
                            $boxAttribute->attribute_type_id = '1';
                            $boxAttribute->attribute_order = $i+1;
                            $boxAttribute->attribute_function_id = '28';
                            $boxAttribute->design_section_id = $SectionID;
                            $boxAttribute->save();
                        }
                    }
                }
            }else if($model->sectionType->section_type_name == 'รายวิชา'){
                return $this->redirect(['view-subject', 'id' => $model->design_section_id]);
            }else{
                return $this->redirect(['view', 'id' => $model->design_section_id]);
            }

        }else{
            return $this->render('update', [
                'template_id' => $template_id,
                'model' => $model,
            ]);
        }


    }

    /**
     * Deletes an existing DesignSection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id,$template_id)
    {
        $template_id = $template_id;
        $this->layout = "main_modules";
        $this->findModel($id)->delete();

        return $this->redirect(['req-template/view','id'=>$template_id]);
    }

    /**
     * Finds the DesignSection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DesignSection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DesignSection::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
