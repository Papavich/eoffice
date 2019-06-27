<?php

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\models\model_main\EofficeCentralViewPisUser;
use app\modules\scholar_b\models\model_main\EofficeCentralViewStudentFull;
use app\modules\scholar_b\models\model_main\RegSysbytedes;
use app\modules\scholar_b\models\ScbScholarshipType;
use app\modules\scholar_b\models\ScbStudent;
use app\modules\scholar_b\models\ScbStudentHasTeacherSearch;
use app\modules\scholar_b\models\ScbYear;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use app\modules\scholar_b\models\ScbStudentHasTeacher;
use app\modules\scholar_b\models\StudentHasTeacherSearch;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ListStudentController implements the CRUD actions for ScbStudentHasTeacher model.
 */
class ListStudentController extends Controller
{
    const ACT_PAGE_SIZE = 10;

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

    public function actionInfostudent()
    {
        $this->layout = "main_module";
        $personId = EofficeCentralViewPisUser::findOne( \Yii::$app->user->identity->getId() )->username;

        $model = ScbScholarshipType::find()->all();

        // Advisor
        $list_student_teacher = ScbStudentHasTeacher::find()
            ->where( ['teacher_type_id' => 1] )
            ->andWhere( ['scb_student_has_teacher.teacher_id_card' => $personId] )
            ->all();

        // Committee
        $list_student = ScbStudentHasTeacher::find()
            ->from( ['scb_student_has_teacher', 'scb_student', 'scb_scholarship_type'] )
            ->where( ['scb_student.scholarship_id' => Yii::$app->request->get( 'scholarship_name' )] )
            ->andWhere( 'scb_student.scholarship_id = scb_scholarship_type.scholarship_id' )
            ->andWhere( 'scb_student_has_teacher.student_id = scb_student.student_id' )
            ->all();


        // Teacher project
        $teacher = Yii::$app->get( 'db_scb' )
            ->createCommand( 'SELECT
	DISTINCT scb_student_has_project.student_id
FROM
	scb_teacher_has_project
INNER JOIN scb_student_has_project ON scb_teacher_has_project.project_code = scb_student_has_project.project_code
WHERE
	scb_teacher_has_project.teacher_id_card = "' . $personId . '"' )
            ->queryAll();
        //return Json::encode($teacher);

        return $this->render( 'infostudent', [
            'list_student' => $list_student,
            'list_student_teacher' => $list_student_teacher,
            'teacher' => $teacher,
            'model' => $model,

        ] );
    }

    public function actionInfoStudentAll()
    {
        $this->layout = "main_module";

        $personId = EofficeCentralViewPisUser::findOne( \Yii::$app->user->identity->getId() )->username;
        $year_search = Yii::$app->request->get( 'year' );
        $sholarship_search = Yii::$app->request->get( 'scholarship_name' );
        // Committee
        if ($year_search == null || $sholarship_search == null) {
            $sholarship_search = ScbScholarshipType::find()->one()->scholarship_id;
            $year_search = ScbYear::find()->one()->year;
        }
        $list_student = ScbStudentHasTeacher::find()
            ->from( ['scb_student_has_teacher', 'scb_student', 'scb_scholarship_type'] )
            ->where( ['scb_student.scholarship_year' => $year_search] )
            ->orWhere( ['scb_student.scholarship_id' => $sholarship_search] )
            ->andWhere( 'scb_student.scholarship_id = scb_scholarship_type.scholarship_id' )
            ->andWhere( 'scb_student_has_teacher.student_id = scb_student.student_id' )
            ->all();
        // Advisor
        $list_student_teacher = ScbStudentHasTeacher::find()
            ->where( ['teacher_type_id' => 1] )
            ->andWhere( ['scb_student_has_teacher.teacher_id_card' => $personId] )
            ->all();


        // Teacher project
        $teacher = Yii::$app->get( 'db_scb' )
            ->createCommand( 'SELECT
	DISTINCT scb_student_has_project.student_id
FROM
	scb_teacher_has_project
INNER JOIN scb_student_has_project ON scb_teacher_has_project.project_code = scb_student_has_project.project_code
WHERE
	scb_teacher_has_project.teacher_id_card = "' . $personId . '"' )
            ->queryAll();
        //return Json::encode($teacher);

        return $this->render( 'info-student-all', [
            'list_student' => $list_student,
            'list_student_teacher' => $list_student_teacher,
            'teacher' => $teacher,
            'sholarship_search' => $sholarship_search,
            'year_search' => $year_search
        ] );
    }

    public function actionReport()
    {
        $this->layout = "main_module";

        $personId = EofficeCentralViewPisUser::findOne( \Yii::$app->user->identity->getId() )->username;
        $year_search = Yii::$app->request->get( 'year_search' );
        $sholarship_search = Yii::$app->request->get( 'scholarship_search' );
        // Committee
        if ($year_search == null || $sholarship_search == null) {
            $sholarship_search = ScbScholarshipType::find()->one()->scholarship_id;
            $year_search = ScbYear::find()->one()->year;
        }
        $list_student = ScbStudentHasTeacher::find()
            ->from( ['scb_student_has_teacher', 'scb_student', 'scb_scholarship_type'] )
            ->where( ['scb_student.scholarship_year' => $year_search] )
            ->orWhere( ['scb_student.scholarship_id' => $sholarship_search] )
            ->andWhere( 'scb_student.scholarship_id = scb_scholarship_type.scholarship_id' )
            ->andWhere( 'scb_student_has_teacher.student_id = scb_student.student_id' )
            ->all();
        // Advisor
        $list_student_teacher = ScbStudentHasTeacher::find()
            ->where( ['teacher_type_id' => 1] )
            ->andWhere( ['scb_student_has_teacher.teacher_id_card' => $personId] )
            ->all();


        // Teacher project
        $teacher = Yii::$app->get( 'db_scb' )
            ->createCommand( 'SELECT
	DISTINCT scb_student_has_project.student_id
FROM
	scb_teacher_has_project
INNER JOIN scb_student_has_project ON scb_teacher_has_project.project_code = scb_student_has_project.project_code
WHERE
	scb_teacher_has_project.teacher_id_card = "' . $personId . '"' )
            ->queryAll();
        $spreadsheet = new Spreadsheet();
        // Create a new worksheet called "My Data"
        $spreadsheet->removeSheetByIndex( 0 );
        $sheet = new Worksheet( $spreadsheet, "รายชื่อนักศึกษาทุน" );
        $spreadsheet->addSheet( $sheet, 0 );
        $this->initialReport( $sheet );
        $sheet->setCellValue( 'A1', 'รายชื่อนักศึกษาทุน' );
        $sheet->setCellValue( 'A2', 'ทุนการศึกษา : ' . ScbScholarshipType::findOne( $sholarship_search )->scholarship_name
            . ' ปีการศึกษา : ' . $year_search );
        $pointer = 4;
        foreach ($list_student as $key => $item) {


            $sheet->setCellValue( 'A' . $pointer, ($key + 1) );
            $sheet->setCellValue( 'B' . $pointer, $item->student_id );
            $data = EofficeCentralViewStudentFull::find()->where( ['STUDENTCODE' => $item->student_id] )->one();
            if ($data) {
                $sheet->setCellValue( 'C' . $pointer, $data->PREFIXNAME . ' ' . $data->STUDENTNAME . ' ' . $data->STUDENTSURNAME );
            }
            $data = EofficeCentralViewStudentFull::find()->where( ['STUDENTCODE' => $item->student_id] )->one();
            if ($data) {
                $namestatus = RegSysbytedes::find()
                    ->where( ['reg_sysbytedes.TABLENAME' => "STUDENTSTATUS", 'reg_sysbytedes.COLUMNNAME' => "STUDENTSTATUS"] )
                    ->andWhere( ['BYTECODE' => $data->STUDENTSTATUS] )
                    ->one();
                if ($namestatus->BYTECODE == 10 && $namestatus->BYTECODE != null) {
                    $sheet->setCellValue( 'D' . $pointer, 'นักศึกษาปกติ' );
                } elseif ($namestatus->BYTECODE == 11 && $namestatus->BYTECODE != null) {

                    $sheet->setCellValue( 'D' . $pointer, 'รักษาสภาพนักศึกษา' );
                } elseif ($namestatus->BYTECODE == 40 && $namestatus->BYTECODE != null) {

                    $sheet->setCellValue( 'D' . $pointer, 'สำเร็จการศึกษา' );
                } elseif ($namestatus->BYTECODE != null) {
                    $sheet->setCellValue( 'D' . $pointer, 'พ้นสภาพนักศึกษา' );
                } else {
                    $sheet->setCellValue( 'D' . $pointer, 'ไม่มีข้อมูล' );
                }

                $sheet->setCellValue( 'E' . $pointer, $data->STUDENTYEAR );
                $sheet->setCellValue( 'F' . $pointer, $data->major_code );
                $scbtype1 = ScbScholarshipType::findOne( [$item->student->scholarship_id] );
                $scbtype_name = $scbtype1->scholarship_name;
                $sheet->setCellValue( 'G' . $pointer, $scbtype_name );

                $sheet->getStyle( 'G' . $pointer )->getAlignment()->setWrapText( true );
                $sheet->setCellValue( 'H' . $pointer, $data->OFFICERNAME . ' ' . $data->OFFICERSURNAME );

            }
            $sheet->getStyle( 'A' . $pointer . ':H' . $pointer )->applyFromArray( $this->getStyle()['border'] );
            $pointer++;
        }


        $writer = new Xlsx( $spreadsheet );
        $writer->save( 'reportTopic.xlsx' );
        $data = \Yii::getAlias( '@web' ) . '/reportTopic.xlsx';
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    private
    function initialReport($sheet)
    {

        $sheet->getStyle( 'A1:H99' )
            ->getAlignment()->setVertical( \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER );

        $sheet->getStyle( 'A1:H2' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );

        //Merge Header
        $sheet->mergeCells( 'A1:H1' );
        $sheet->mergeCells( 'A2:H2' );

        //Set Width
        $sheet->getColumnDimension( 'A' )->setWidth( 8 );
        $sheet->getColumnDimension( 'B' )->setWidth( 15 );
        $sheet->getColumnDimension( 'C' )->setWidth( 20 );
        $sheet->getColumnDimension( 'D' )->setWidth( 15 );
        $sheet->getColumnDimension( 'E' )->setWidth( 10 );
        $sheet->getColumnDimension( 'F' )->setWidth( 10 );
        $sheet->getColumnDimension( 'G' )->setWidth( 35 );
        $sheet->getColumnDimension( 'H' )->setWidth( 20 );

//        $sheet->getStyle( 'A2' )->getAlignment()->setWrapText( true );
        $sheet->setCellValue( 'A3', 'ลำดับ' );
        $sheet->setCellValue( 'B3', 'รหัสนักศึกษา' );
        $sheet->setCellValue( 'C3', 'ชื่อ-นามสกุล' );
        $sheet->setCellValue( 'D3', 'สถานะ' );
        $sheet->setCellValue( 'E3', 'ชั้นปี' );
        $sheet->setCellValue( 'F3', 'สาขาวิชา' );
        $sheet->setCellValue( 'G3', 'ประเภททุน' );
        $sheet->setCellValue( 'H3', 'อาจารย์ที่ปรึกษาทุน' );
        //Set Header Border

        $sheet->getStyle( 'A1:H3' )->applyFromArray( $this->getStyle()['border'] );
        return $sheet;
    }

    private
    function getStyle()
    {

        return [
            'border' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ], 'border_outline' => [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ],
        ];
    }

}
