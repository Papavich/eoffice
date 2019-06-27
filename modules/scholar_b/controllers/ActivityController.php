<?php

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\models\Listactivity;
use app\modules\scholar_b\models\model_main\EofficeCentralViewStudentFull;
use app\modules\scholar_b\models\ScbActivityType;
use app\modules\scholar_b\models\ScbScholarshipType;
use app\modules\scholar_b\models\ScbScholarshipTypeHasYear;
use app\modules\scholar_b\models\ScbStudentHasActivityMain;
use app\modules\scholar_b\models\ScbYear;
use Yii;
use app\modules\scholar_b\models\ScbActivityMain;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\web\uploadedFile;
// Microsoft Excel
use PHPExcel;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Fill;
use PHPExcel_Style_Border;
use PHPExcel_IOFactory;

Yii::setAlias('@root', realpath(dirname(__FILE__) . '/../../../web/'));


/**
 * ActivityController implements the CRUD actions for ScbActivityMain model.
 */
class ActivityController extends Controller
{
    const ACT_PAGE_SIZE = 10;
    const STATUS_ENABLED = 1;   //อนุมัติแล้ว
    const STATUS_DISABLED = 0;  //ยังไม่อนุมัติ

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
                    'deletestatus' => ['POST'],
                ],
            ],

        ];
    }

    /**
     * Lists all ScbActivityMain models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_module";

        $model_activity = new ScbActivityMain();
        $model_upload = new ScbStudentHasActivityMain();

        $query = ScbActivityMain::find()->orderBy('year DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => self::ACT_PAGE_SIZE]);

        $std = Listactivity::find()
            ->where(['student_id' => Yii::$app->user->identity->username])
            ->all();

        $dataProvider = ScbStudentHasActivityMain::find()->where(['select_activity_status' => $this::STATUS_DISABLED])->all();

        //ค้นหาปีในหน้ากิจกรรม
        $year_search = Yii::$app->request->get('year');
        if ($year_search == null){
            $model = ScbActivityMain::find()->all();
        }else{
            $model = ScbActivityMain::find()
                ->where(['year' => $year_search])
                ->all();
        }
        return $this->render('index', [
            'model' => $model,
            'pages' => $pages,
            'model_activity' => $model_activity,
            'data' => $dataProvider,
            'model_upload' => $model_upload,
            'std' => $std

        ]);
    }

    /* เพิ่มกิจกรรมภาควิชาอยู่ในหน้ากิจกรรมภาควิชา*/
    public function actionAddactindex()
    {
        $model_activity = new ScbActivityMain();


        if ($model_activity->load(Yii::$app->request->post())) {
            $model_activity->save();

            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app', Html::encode('เพิ่มกิจกรรมภาควิชาเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);

            return $this->redirect(['index',
                'act_main_id' => $model_activity->act_main_id,
                'year' => $model_activity->year]);
        } else {

            $this->layout = "main_module";
            return $this->render('../site/error500');
        }
    }

    /* การอนุมัติกิจกรรมของเด็กทุนอยู่ในหน้ากิจกรรมหลัก*/
    public function actionStatus($student_id, $activity_main_id, $year)
    {
        $checkactivity = $this->findModel2($student_id, $activity_main_id, $year);
        if ($checkactivity->select_activity_status = $this::STATUS_ENABLED) {
            $checkactivity->save();

            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app', Html::encode('อนุมัติคำร้องขอสำเร็จ')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
        }
        $this->layout = "main_module";

        return $this->redirect('index#jtab4_nobg');
    }

    /**
     * Creates a new ScbActivityMain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionView($act_main_id, $year)
    {

        $query = ScbActivityMain::find()->orderBy('year DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => self::ACT_PAGE_SIZE]);

//        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $std_select_act = ScbStudentHasActivityMain::find()
            ->where(['activity_main_id' => $act_main_id, 'year' => $year])
            ->all();


        return $this->render('view', [
            'model' => $this->findModel($act_main_id, $year),
            'pages' => $pages,
            'std_select_act' => $std_select_act,
        ]);
    }

    /* หน้าเข้าร่วมกิจกรรมเด็กทุน */
    public function actionSelectAct($student_id, $act_main_id, $year)
    {

        $model_select = new ScbStudentHasActivityMain();


        $model_select->student_id = $student_id;
        $model_select->activity_main_id = $act_main_id;
        $model_select->year = $year;
        $model_select->select_activity_status = 0;
        $model_select->save(false);

        return $this->redirect(['view',
            'act_main_id' => $model_select->activity_main_id,
            'year' => $model_select->year,
        ]);
    }

    public function actionUpdate($act_main_id, $year, $act_type_id)
    {
        $this->layout = "main_module";
        $model = $this->findModel1($act_main_id, $year, $act_type_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->getSession()->setFlash('alert3', [
                'type' => 'info',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app', Html::encode('แก้ไขข้อมูลสำเร็จ')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['index',
                'act_main_id' => $model->act_main_id,
                'year' => $model->year,
                'act_type_id' => $model->act_type_id
            ]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /* เจ้าหน้าที่ลบสถานะการอนุมัติออก*/
    public function actionDeletestatus($student_id, $activity_main_id, $year)
    {
        $model = $this->findModel2($student_id, $activity_main_id, $year)->delete();

        Yii::$app->getSession()->setFlash('alert4', [
            'type' => 'warning',
            'duration' => 12000,
            'icon' => 'fa fa-users',
            'title' => Yii::t('app', Html::encode('Submission')),
            'message' => Yii::t('app', Html::encode('ลบคำร้องขอสำเร็จ')),
            'positonY' => 'top',
            'positonX' => 'right'
        ]);

        $this->layout = "main_module";

        return $this->redirect(['index',
            'model' => $model
        ]);

    }

    /* เจ้าหน้าที่ลบกิจกรรม*/
    public function actionDeleteactivity($act_main_id, $year, $act_type_id)
    {
        $model = $this->findModel1($act_main_id, $year, $act_type_id)->delete();

        Yii::$app->getSession()->setFlash('alert2', [
            'type' => 'danger',
            'duration' => 12000,
            'icon' => 'fa fa-users',
            'title' => Yii::t('app', Html::encode('Alert')),
            'message' => Yii::t('app', Html::encode('ลบกิจกรรมสำเร็จ')),
            'positonY' => 'top',
            'positonX' => 'right'
        ]);

        return $this->redirect(['index',
            'model' => $model]);
    }
    public function DateThaifull($strDate)
    {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear ";
    }
    public function actionExcel()
    {
        $act_main_id = Yii::$app->request->get('act_main_id');
        $year = Yii::$app->request->get('year');

        // Create new PHPExcel object
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

// Set properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");


        //Set Bold
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A4")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A5")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("B5")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("C5")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("D5")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("E5")->getFont()->setBold(true);
        //End Set Bold

        // Set Height/Width
        $objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        //End Set Height/Width

        //Set Center
        $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //End Set Center

        //Border
        $BStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $objPHPExcel->getActiveSheet()->getStyle('A5:E20')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A5:E20')->applyFromArray($BStyle);
        //End Border

        $model_activity = ScbActivityMain::find()
            ->where('act_main_id="' . $act_main_id. '"')
            ->one();
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ชื่อกิจกรรม : ')
            ->setCellValue('B1', $model_activity->act_main_name)
            ->setCellValue('A2', 'รายละเอียด : ')
            ->setCellValue('B2', $model_activity->act_main_detail)
            ->setCellValue('A3', 'ตั้งแต่วันที่ : ')
            ->setCellValue('B3', $this->DateThaifull($model_activity->act_main_date_start) .' ถึงวันที่ '. $this->DateThaifull($model_activity->act_main_date_end))
            ->setCellValue('A4', 'รายชื่อนักศึกษาเข้าร่วม')
            ->setCellValue('A5', 'รหัสนักศึกษา')
            ->setCellValue('B5', 'ชื่อ-นามสกุล')
            ->setCellValue('C5', 'สาขาวิชา')
            ->setCellValue('D5', 'ประเภททุน')
            ->setCellValue('E5', 'ปีทุน');//กำหนดให้ cell A2 พิมพ์คำว่า Employees Report
        $i = 6;
            $model_student= ScbStudentHasActivityMain::find()
                ->where('activity_main_id="' . $act_main_id. '"')
                ->andWhere('year=' . $year)
                ->andWhere('select_activity_status=1')
                ->all();
             foreach ($model_student as $item) {
                 $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item->student_id])->one();
                 $scholarship_name = ScbScholarshipType::find()
                     ->from(['scb_scholarship_type' , 'scb_scholarship_type_has_year'])
                     ->where('scb_scholarship_type.scholarship_id=scb_scholarship_type_has_year.scholarship_id')
                     ->one();
                 $scholarship_year = ScbScholarshipTypeHasYear::find()
                     ->from(['scb_scholarship_type_has_year','scb_student'])
                     ->where('scb_scholarship_type_has_year.scholarship_year=scb_student.scholarship_year')
                     ->andWhere('scb_scholarship_type_has_year.scholarship_id=scb_student.scholarship_id')
                     ->one();
                 $objPHPExcel->getActiveSheet()->setCellValue('A' . $i,$item->student_id);
                 $objPHPExcel->getActiveSheet()->setCellValue('B' . $i,$data->PREFIXNAME . ' ' . $data->STUDENTNAME . ' ' . $data->STUDENTSURNAME);
                 $objPHPExcel->getActiveSheet()->setCellValue('C' . $i,$data->major_name);
                 $objPHPExcel->getActiveSheet()->setCellValue('D' . $i,$scholarship_name->scholarship_name);
                 $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getAlignment()->setWrapText(true);
                 $objPHPExcel->getActiveSheet()->setCellValue('E' . $i,$scholarship_year->scholarship_year);
                $i++;

             }

// Rename sheet
        /*    $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(-1);*/
        $objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="report'.date("Ymd_is").'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    /**
     * Finds the ScbActivityMain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $act_main_id
     * @param integer $year
     * @return ScbActivityMain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($act_main_id, $year)
    {
        if (($model = ScbActivityMain::findOne(['act_main_id' => $act_main_id, 'year' => $year])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModel1($act_main_id, $year, $act_type_id)
    {
        if (($model = ScbActivityMain::findOne(['act_main_id' => $act_main_id, 'year' => $year, 'act_type_id' => $act_type_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModel2($student_id, $activity_main_id, $year)
    {
        if (($model = ScbStudentHasActivityMain::findOne(['activity_main_id' => $activity_main_id, 'year' => $year, 'student_id' => $student_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
