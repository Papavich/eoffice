<?php

namespace app\modules\eoffice_ta\controllers;

use app\modules\eoffice_ta\models\Kku30SubjectOpen;
use app\modules\eoffice_ta\models\Kku30Subject;
use app\modules\eoffice_ta\models\TaStatus;
use Yii;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\model_central\ViewStudentFull;
use app\modules\eoffice_ta\models\model_central\ViewPisSubjectSection;
use app\modules\eoffice_ta\models\TaWorking;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\TaWorkingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;
use yii\helpers\Html;
use yii\helpers\Url;
use PHPExcel;
use PHPExcel_IOFactory;



\Yii::setAlias('@webprint', '@web/../modules/eoffice_ta');
/**
 * TaWorkingController implements the CRUD actions for TaWorking model.
 */
class TaWorkingController extends Controller
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

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


    /**
     * Lists all TaWorking models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
        $u = $user->person_id;
        //$user = EofficeMainUser::findOne(['id' => Yii::$app->user->id]);
        //$u = Yii::$app->formatter->asNtext($user->person_id);

        $query = TaRegister::find()->where(['person_id'=>$u,'ta_status_id'=>TaStatus::CHOOSE_TA]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 5]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $searchModel = new TaWorkingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $this->layout = "main_modules";
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=> $model,
            'pages' => $pages,
            'u'=> $u,
        ]);
    }

    public function actionWorkTa2($sec,$s,$t,$y)
    {
        $user = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
        $u = $user->person_id;
       /* $user = EofficeMainUser::findOne(['id' => Yii::$app->user->id]);
        $u = Yii::$app->formatter->asNtext($user->person_id);
       */
        $modelRegisSecs = TaRegisterSection::find()->where(['section'=>$sec,'person_id'=>$u
            ,'subject_id'=>$s,'term'=>$t,'year'=>$y])->all();
        $this->layout = "main_modules";

        $subj = ViewPisSubjectSection::findOne(['COURSECODE'=>$s,'SEMESTER'=>$t,'ACADYEAR'=>$y]);
        $ver = $subj->REVISIONCODE;

       // $subj->COURSECODE;$subj->SEMESTER;$subj->ACADYEAR;
        // -----------------------------------------------------------------------------------
         //SORT_ASC  จากน้อย --->มาก  && SORT_DESC  จากมาก --->น้อย
        $query = TaWorking::find()->where(['section'=>$sec,'person_id'=>$u,
            'subject_id'=>$s,'term_id'=>$t,'year_id'=>$y])->orderBy(['working_date'=>SORT_ASC]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 4]);
        $Working = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        // -----------------------------------------------------------------------------------
        $sum_hr_C = 0;
        $sum_hr_L = 0;
        $hr_C[] =0;
        $hr_L[] =0;
        $Working2 = TaWorking::find()->where(['section'=>$sec,'person_id'=>$u,
            'subject_id'=>$s,'term_id'=>$t,'year_id'=>$y])->orderBy(['working_date'=>SORT_ASC])->all();
        if (!empty($Working2)) {
            foreach ($Working2 as $working2) {
                $type_work = $working2->ta_type_work_id;
                if ($type_work == 'C') {
                    $hr_C[] = $working2->hr_working;

                } elseif ($type_work == 'L') {
                    $hr_L[] = $working2->hr_working;
                }
            }
            $sum_hr_C = array_sum($hr_C);
            $sum_hr_L = array_sum($hr_L);
        } else if (empty($Working2)){
                $sum_hr_C = 0;
                $sum_hr_L = 0;
                $hr_C=0;
                $hr_L=0;
            }

        return $this->render('work-ta2', [
             'modelRegisSecs' => $modelRegisSecs,
             'pages' => $pages,
             'Working' => $Working,
             's'=>$s,'t'=>$t,'y'=>$y,'sec'=>$sec,
             'ver'=>$ver,
           //  'hr_C'=>$hr_C,'hr_L'=>$hr_L,
             'sum_hr_C' =>$sum_hr_C ,'sum_hr_L'=>$sum_hr_L,
        ]);
    }

    /**
     * Displays a single TaWorking model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TaWorking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($sec,$s,$ver,$t,$y,$t_wload)
    {
        $user = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
        //$u = $user->person_id;
        /*$user = EofficeMainUser::findOne(['id' => Yii::$app->user->id]);*/
        $u = Yii::$app->formatter->asNtext($user->person_id); //*** ต้องแปลงเป็น string ********
        $model = new TaWorking();

        if ($model->load(Yii::$app->request->post())) {
            //$model->ta_work_plan_id;
            $model->section = $sec;
            $model->person_id = $u;
            $model->subject_id = $s;
            $model->subject_version = $ver;
            $model->term_id = $t;
            $model->year_id = $y;
            $model->hr_working = (strtotime($model->time_end) - strtotime($model->time_start))/( 60 * 60 );
            $model->ta_status_id = TaStatus::WORKING_TA;
            $model->active_status = TaWorking::STATUS_NEW;
            $model->working_evidence = $model->upload($model,'working_evidence');
            $model->crby = Yii::$app->user->id;
            $model->crtime=date('Y-m-d H:i:s');
            $model->save();
            $this->layout = "main_modules";  //s=322131&t=2%2F2560&y=2560
            return $this->redirect(['work-ta2', 'sec' => $sec,'s'=>$s,'t'=>$t,'y'=>$y,]);
        }
        $this->layout = "main_modules";
        return $this->render('create', [
            'model' => $model,
            'sec' => $sec,'s'=>$s,'t'=>$t,'y'=>$y,'t_wload'=>$t_wload,
        ]);
    }

    /**
     * Updates an existing TaWorking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id,$t_wload)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $model->hr_working = (strtotime($model->time_end) - strtotime($model->time_start))/( 60 * 60 );
            $model->working_evidence = $model->upload($model,'working_evidence');
            $model->ta_status_id = TaStatus::WORKING_TA;
            $model->udby = Yii::$app->user->id;
            $model->udtime = date('Y-m-d H:i:s');
            $model->ta_status_id = TaStatus::WORKING_TA;
            $model->active_status = TaWorking::STATUS_NEW;
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['work-ta2',
                'sec' => $model->section,'s'=>$model->subject_id,
                't'=>$model->term_id,'y'=>$model->year_id,]);
        }
        $this->layout = "main_modules";
        return $this->render('update', [
            'model' => $model,'t_wload'=>$t_wload,
        ]);
    }

    /**
     * Deletes an existing TaWorking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id,$sec,$s,$ver,$t,$y)
    {
        $this->findModel($id)->delete();

        $this->layout = "main_modules";
        return $this->redirect(['work-ta2', 'sec' => $sec,'s'=>$s,'t'=>$t,'y'=>$y,]);
    }

    /**
     * Finds the TaWorking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaWorking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaWorking::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPrint($s,$t,$y)
    {
        $user = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
        $u = $user->person_id;
       // $user = EofficeMainUser::findOne(['id' => Yii::$app->user->id]);
       // $user = EofficeMainUser::findOne(['person_id' => $item->person_id]);
        //$uid = $u->id;
        //$u = Yii::$app->formatter->asNtext($user->person_id);
        $std =  ViewStudentFull::findOne(['STUDENTID'=>$user->person_id]);

        $std_id = $std->STUDENTCODE;
        $std_name = $std->STUDENTNAME;
        $std_surname = $std->STUDENTSURNAME;
        $gpa = $std->GPA;
        $level = $std->LEVELNAME;
        $prefix = $std->PREFIXNAME;

        $query = TaRegister::find()->where(['person_id'=>$u]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 5]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        /*
        $modelRegisSecs = TaRegisterSection::find()->where(['section'=>$sec,'person_id'=>$u
            ,'subject_id'=>$s,'term'=>$t,'year'=>$y])->all();
        $this->layout = "main_modules";
          */
        $subj = Kku30SubjectOpen::findOne(['subject_id'=>$s,'subopen_semester'=>$t,'subopen_year'=>$y]);
        $ver = $subj->subject_version;
        $subject = Kku30Subject::findOne(['subject_id'=>$s,'subject_version'=>$ver]);

        // -----------------------------------------------------------------------------------

        // -----------------------------------------------------------------------------------
        $sum_hr_C = 0;
        $sum_hr_L = 0;
        $hr_C[] =0;
        $hr_L[] =0;
        $Working2 = TaWorking::find()->where(['person_id'=>$u,
            'subject_id'=>$s,'term_id'=>$t,'year_id'=>$y])
            ->orderBy(['working_date'=>SORT_ASC])->all();
        if (!empty($Working2)) {
            foreach ($Working2 as $working2) {
                $type_work = $working2->ta_type_work_id;
                if ($type_work == 'C') {
                    $hr_C[] = $working2->hr_working;

                } elseif ($type_work == 'L') {
                    $hr_L[] = $working2->hr_working;
                }
            }
            $sum_hr_C = array_sum($hr_C);
            $sum_hr_L = array_sum($hr_L);
        } else if (empty($Working2)){
            $sum_hr_C = 0;
            $sum_hr_L = 0;
            $hr_C=0;
            $hr_L=0;
        }
        Settings::setTempDir(Yii::getAlias('../modules/eoffice_ta').'/temp/');
        $templateProcessor = new TemplateProcessor(Yii::getAlias('../modules/eoffice_ta').'/msword/template_working.docx');//เลือกไฟล์ template ที่เราสร้างไว้


        $this->layout = "main_modules";

        $Workings = TaWorking::find()->where(['person_id'=>$u,
            'subject_id'=>$s,'term_id'=>$t,'year_id'=>$y])
            ->orderBy(['working_date'=>SORT_ASC])->all();
        $subj = Kku30SubjectOpen::findOne(['subject_id'=>$s,'subopen_semester'=>$t,'subopen_year'=>$y]);
        $ver = $subj->subject_version;
       // $templateProcessor->cloneRow('ta_work_plan_id',count($Workings));
        $i = 1;
        foreach ($Workings as $item => $val) { //item is key
            $templateProcessor->setValue(
                [
                    'subject_id', 'subject_name','credit',
                    'term', 'prefix','name','surname','level','std_id',
                    //'no','date'
                ],
                [
                    $subj->subject_id,$subj->subject->subject_nameeng,
                    $subj->subject->subject_credit.'('.$subj->subject->subject_time.')',
                    $subj->subopen_semester,$prefix,$std_name,$std_surname,$level,$std_id,
                   // $i, $val->working_date

                ]); // การ setValue หลายๆ ตะวแปรพร้อมกะน
            $templateProcessor->setValue('no'.$i, $i);
            $templateProcessor->setValue('id'.$i, $val['ta_work_plan_id']);
            $templateProcessor->setValue('date'.$i, $val['working_date']);
            /*$templateProcessor->setValue('time_start#'.$i, $val['time_start']);
            $templateProcessor->setValue('time_end#'.$i, $val['time_end']);
            $templateProcessor->setValue('section#'.$i, $val['section']);
            $templateProcessor->setValue('type_work#'.$i, $val['ta_type_work_id']);
            $templateProcessor->setValue('hr_working#'.$i, $val['hr_working']);
            $templateProcessor->setValue('work_role#'.$i, $val['ta_work_role']);

            */
            //$templateProcessor->setValue('price_sum#'.$i, ($val['price'] > 0 ? number_format($val['price'] * $val['amount'], 2) : ''));
            $i++;
        }





        //$templateProcessor->setValue('emp_employeeNumber', '1002'); การ setValue ทีล่ะตัว
        $templateProcessor->saveAs(Yii::getAlias('../modules/eoffice_ta').'/msword/result_working.docx'); //กำหนด Path ที่จะสร้างไฟล์

        //ลองให้ google doc viewer แสดงข้อมูลไฟล์ให้เห็นผ่าน iframe (อาจเพี้ยนๆ บ้าง)
        $this->layout = "main_modules";
        echo '<iframe src="'.Url::to(Yii::getAlias('@webprint').'/msword/result_working.docx', true)
            .'"  style="position: absolute;width:100%; height: 100%;border: none;"></iframe>';
        $path = Yii::getAlias('../modules/eoffice_ta').'/msword';
        $file = $path . '/result_working.docx';
        //$this->Download($file);


        $this->layout = "main_modules";
        return $this->render('index',[
            'model'=> $model,
            'pages' => $pages,
            'u'=> $u, 'sum_hr_C' =>$sum_hr_C ,'sum_hr_L'=>$sum_hr_L,
        ]);
    }
    public function Download($file){
        if (file_exists($file)) {
            Yii::$app->response->SendFile($file);
            $this->layout = "main_modules";
        }
    }

    //สร้างAction ดังนี้
    public function actionExcel($s,$t,$y) {
        // Create new PHPExcel object

        $user = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
        $u = $user->person_id;
        $objPHPExcel = new PHPExcel(); //สร้างไฟล์ excel
        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'หลักฐานการลงเวลาปฏิบัติงานผู้ช่วยสอนและผู้ช่วยปฏิบัติงาน') //กำหนดให้ cell A2 พิมพ์คำว่า Employees Report
            ->setCellValue('A2', 'วิชา') //กำหนดให้ cell A2 พิมพ์คำว่า Employees Report
            ->setCellValue('B2', $s) //กำหนดให้ cell A2 พิมพ์คำว่า Employees Report
            ->setCellValue('A4', 'วันที่') //กำหนดให้ cell A4 พิมพ์คำว่า employeeNumber
            ->setCellValue('B4', 'เวลาเริ่ม') //กำหนดให้ cell B4 พิมพ์คำว่า firstName
            ->setCellValue('C4', 'เวลาสิ้นสุด') //กำหนดให้ cell C4 พิมพ์คำว่า lastName
            ->setCellValue('D4', 'ประเภทงาน') //กำหนดให้ cell D4 พิมพ์คำว่า extension
            ->setCellValue('E4', 'section') //กำหนดให้ cell E4 พิมพ์คำว่า email
            ->setCellValue('F4', 'งานที่ปฏิบัติ') //กำหนดให้ cell D4 พิมพ์คำว่า officeCode
            ->setCellValue('G4', 'จำนวนชั่วโมง'); //กำหนดให้ cell G4 พิมพ์คำว่า reportsTo
            //->setCellValue('H4', 'jobTitle'); //กำหนดให้ cell H4 พิมพ์คำว่า jobTitle
        $i = 6; // กำหนดค่า i เป็น 6 เพื่อเริ่มพิมพ์ที่แถวที่ 6

        // Write data from MySQL result
        foreach(TaWorking::find()->where(['person_id'=>$u,'subject_id'=>$s,'term_id'=>$t,'year_id'=>$y])->orderBy(['working_date'=>SORT_ASC])->all() as $item){ //วนลูปหาพนักงานทั้งหมด
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $item["working_date"]);
            //กำหนดให้คอลัมม์ A แถวที่ i พิมพ์ค่าของ employeeNumber
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $item["time_start"]);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $item["time_end"]);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $item["ta_type_work_id"]);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $item["section"]);
            //$model = Offices::findOne($item["officeCode"]);
            //query หาชื่อจังหวัดที่มีค่าตรงกับ officeCode ของพนักงาน
           // $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $model->city);
            // แทนค่าคอลัมม์ที่ F แถวที่  i ด้วย City ที่ query ออกมาได้
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $item["ta_working_note"]);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $item["hr_working"]);
            $i++;
        }

        // Rename sheet
        //$objPHPExcel->getActiveSheet()->setTitle('Employees');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        //$objPHPExcel->setActiveSheetIndex(0);

        // Save Excel 2007 file
        //Yii::getAlias('@web').'/web_ta/working/
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('working.xlsx'); // Save File เป็นชื่อ myData.xlsx
        echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web').'/working.xlsx'), ['class' => 'btn btn-info']);  //สร้าง link download

    }



}
