<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 6/7/2560
 * Time: 17:22
 */

namespace app\modules\eproject\controllers;


use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\models\AdviserType;
use app\modules\eproject\models\ExamCommittee;
use app\modules\eproject\models\ExamGroup;
use app\modules\eproject\models\Major;
use app\modules\eproject\models\OpenSubject;
use app\modules\eproject\models\ProjectDocument;
use app\modules\eproject\models\RequestAdvisee;
use app\modules\eproject\models\Subject;
use app\modules\eproject\models\SubjectDocumentType;
use app\modules\eproject\models\SubjectView;
use app\modules\eproject\models\User;
use app\modules\eproject\models\StudentProject;
use app\modules\eproject\models\Project;
use app\modules\eproject\models\YearSemester;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use app\modules\eproject\models\Enroll;
use app\modules\eproject\models\Advise;


class AdminReportingController extends Controller
{

    /////////////////////////////////////////
    private function getScoreTable($subjectId)
    {
        $data = [];
        $examGroups = ExamGroup::find()
            ->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( ['subject_id' => $subjectId] )
            ->all();

        foreach ($examGroups as $keyOfExamGroup => $examGroup) {
            $dataTmp = [];
            $tcStr = [];
            $dataTmp['header'] = "กลุ่มสอบ " . $examGroup->name . " (";
            $totalProjectCount = 0;
            foreach (ExamCommittee::find()->where( ['exam_group_id' => $examGroup->id] )->all() as $key => $examCommittee) {
                $tcStr[$key] = $examCommittee->user->name;
                $projects = Project::find()
                    ->innerJoin( Advise::tableName(), Advise::tableName() . '.project_id = ' . Project::tableName() . '.id' )
                    ->where( ['adviser_id' => $examCommittee->user_id] )
                    ->andWhere( [Advise::tableName() . '.year_id' => ModelHelper::getNowYear()] )
                    ->andWhere( [Advise::tableName() . '.semester_id' => ModelHelper::getNowSemester()] )
                    ->andWhere( ['subject_id' => $subjectId] )
                    ->orderBy( 'number' )
                    ->all();
                foreach ($projects as $keyProject => $project) {
                    $keyTeacher=0;
                    $teacherStr = [];
                    if ($project->mainAdviser != null) {
                        $teacherStr[$keyTeacher] = $project->mainAdviser->name;
                        $keyTeacher++;
                    }
                    foreach ($project->coAdvisers as $coAdviser) {
                        $teacherStr[$keyTeacher] = $coAdviser->name .' (ร่วม)';
                        $keyTeacher++;
                    }
                    $studenTmp = [];
                    foreach ($project->currentStudents as $keyCurrentStudent => $item) {
                        $studenTmp[$keyCurrentStudent] = ['id' => $item->user_id,
                            'name' => $item->name];
                    }
                    $dataTmp['project'][$keyProject] = ['student' => $studenTmp,
                        'teacher' => $teacherStr,
                        'name_th' => $project->name_th,
                        'name_en' => $project->name_en,
                        'code' => $project->projectCode];

                }
                $projectCount = count( $projects );
                $totalProjectCount += $projectCount;
            }
            $dataTmp['header'] .= implode( ', ', $tcStr );
            $dataTmp['header'] .= ") จำนวน " . $totalProjectCount . " โครงงาน ";
            if ($totalProjectCount != 0) {
                $data[$keyOfExamGroup] = $dataTmp;
            }
        }
        return $data;
    }

    public function actionScoreTable()
    {
        if (Yii::$app->request->get( 'id' ) == null) {
            $subjectId = Subject::getNowOpenSubjects()[0]->id;
        } else {
            $subjectId = Yii::$app->request->get( 'id' );
        }
        $data = $this->getScoreTable( $subjectId );
        return $this->render( 'score-table', [
            'projects' => $data,
            'subjectId' => $subjectId
        ] );
    }

    public function actionDownloadScoreTable()
    {
        if (Yii::$app->request->get( 'id' ) == null) {
            $subjectId = Subject::getNowOpenSubjects()[0]->id;
        } else {
            $subjectId = Yii::$app->request->get( 'id' );
        }
        $subject = SubjectView::find()->where( ['id' => $subjectId] )->one();

        $data = $this->getScoreTable( $subjectId );
        $spreadsheet = new Spreadsheet();

        // Create a new worksheet called "My Data"
        $spreadsheet->removeSheetByIndex( 0 );
        $sheet = new Worksheet( $spreadsheet, 'ตารางให้คะแนน' );
        $spreadsheet->addSheet( $sheet, 0 );
        $sheet->setTitle( 'ตารางให้คะแนน' );
        $sheet = $this->initialScoreTable( $sheet );//$projects[0]->subjectName .
        $sheet->setCellValue( 'A1', 'ตารางให้คะแนน (' . $subject->id . ' ' . $subject->name_th .
            ') เทอม ' . ModelHelper::getNowSemester() . ' ปีการศึกษา ' . ModelHelper::getNowYear() );
        $rowCount = 3;
        foreach ($data as $project) {
            $sheet->mergeCells( 'A' . $rowCount . ':F' . $rowCount );
            $sheet->setCellValue( 'A' . $rowCount, $project['header'] );
            $sheet->getStyle( 'A' . $rowCount )->getFill()
                ->setFillType( \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID )
                ->getStartColor()->setARGB( 'FFFF00' );
            $rowCount++;
            foreach ($project['project'] as $item) {
                //Merge Cell
                $tmpRowCount = $rowCount;
                $rowCount += count( $item['student'] );
                if ($rowCount - $tmpRowCount == 1) {
                    $rowCount++;
                } else if ($rowCount - $tmpRowCount == 0) {
                    $rowCount += 2;
                }


                $sheet->mergeCells( 'A' . $tmpRowCount . ':A' . ($rowCount - 1) );
                $sheet->mergeCells( 'C' . $tmpRowCount . ':C' . ($rowCount - 1) );
                $sheet->mergeCells( 'F' . $tmpRowCount . ':F' . ($rowCount - 1) );
                $sheet->getStyle( 'A' . $tmpRowCount . ':A' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border'] );
                $sheet->getStyle( 'B' . $tmpRowCount . ':B' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border_outline'] );
                $sheet->getStyle( 'C' . $tmpRowCount . ':C' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border'] );
                $sheet->getStyle( 'D' . $tmpRowCount . ':D' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border_outline'] );
                $sheet->getStyle( 'E' . $tmpRowCount . ':E' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border_outline'] );
                $sheet->getStyle( 'F' . $tmpRowCount . ':F' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border'] );

                //Put Project Number and Project Name
                $sheet->setCellValue( 'A' . $tmpRowCount, $item['code'] );

                $sheet->getStyle( 'A' . $tmpRowCount . ':A' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border'] );
                $sheet->setCellValue( 'B' . $tmpRowCount, $item['name_th'] );
                $sheet->setCellValue( 'B' . ($tmpRowCount + 1), $item['name_en'] );
                //Adviser
                if (count($item['teacher'])!=0) {
                    $sheet->setCellValue( 'C' . ($tmpRowCount), implode($item['teacher'],"\n") );
                    $sheet->getStyle('C' . ($tmpRowCount))->getAlignment()->setWrapText(true);
                }
                //Student
                foreach ($item['student'] as $key => $std) {
                    $sheet->setCellValue( 'D' . ($tmpRowCount + $key), $std['id'] );
                    $sheet->setCellValue( 'E' . ($tmpRowCount + $key), $std['name'] );
                }
            }

        }
        $spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight( 20 );
        $writer = new Xlsx( $spreadsheet );
        $writer->save( 'reportTopic.xlsx' );
        $data = \Yii::getAlias( '@web' ) . '/reportTopic.xlsx';
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    private function initialScoreTable($sheet)
    {

        $sheet->getStyle( 'A1:F199' )
            ->getAlignment()->setVertical( \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER );
        //Merge Header
        $sheet->mergeCells( 'A1:F1' );
        //Set Width
        $sheet->getColumnDimension( 'A' )->setWidth( 10 );
        $sheet->getColumnDimension( 'B' )->setWidth( 70 );
        $sheet->getColumnDimension( 'C' )->setWidth( 23 );
        $sheet->getColumnDimension( 'D' )->setWidth( 15 );
        $sheet->getColumnDimension( 'E' )->setWidth( 23 );
        $sheet->getColumnDimension( 'F' )->setWidth( 15 );
        //Set Header Height
        $sheet->getRowDimension( '2' )->setRowHeight( 40 );
        //Set Header Style
        $sheet->getStyle( 'A2:F2' )->getFont()->setBold( true );
        //Header Aligment

        $sheet->getStyle( 'A2:F2' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );
        $sheet->getStyle( 'A1' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );
        //Set Header Content
        $sheet->setCellValue( 'A2', 'หมายเลขโครงงาน' );
        $sheet->getStyle( 'A2' )->getAlignment()->setWrapText( true );
        $sheet->setCellValue( 'B2', 'หัวข้อโครงงาน' );
        $sheet->setCellValue( 'C2', 'อ.ที่ปรึกษา' );
        $sheet->setCellValue( 'D2', 'รหัสประจำตัว' );
        $sheet->setCellValue( 'E2', 'ชื่อ - นามสกุล' );
        $sheet->setCellValue( 'F2', 'คะแนนเต็ม' );
        //Set Header Border

        $sheet->getStyle( 'A2:F2' )->applyFromArray( $this->getStyle()['border'] );
        $sheet->getStyle( 'A1:F1' )->applyFromArray( $this->getStyle()['border'] );
        return $sheet;
    }

    ////////////////////////////////////

    public function actionTopic()
    {
        if (Yii::$app->request->get( 'major' ) == null) {
            $major = 0;
        } else {
            $major = Yii::$app->request->get( 'major' );
        }

        $projectIds = StudentProject::find()
            ->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->select( 'project_id' )->distinct();

        if ($major == 0) {
            $projects = Project::find()
                ->where( ['id' => $projectIds] )->orderBy( ['major_id' => SORT_ASC, 'number' => SORT_ASC] )->all();
        } else {
            $projects = Project::find()
                ->where( ['id' => $projectIds] )
                ->andWhere( ['major_id' => $major] )
                ->orderBy( 'number' )->all();
        }

        return $this->render( 'topic', [
            'projects' => $projects,
            'major' => $major
        ] );
    }

    /**
     * @param $sheet Worksheet
     * @return mixed
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function initialTopic($sheet)
    {

        $sheet->getStyle( 'A1:H199' )
            ->getAlignment()->setVertical( \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER );
        //Merge Header
        $sheet->mergeCells( 'A1:H1' );
        //Set Width
        $sheet->getColumnDimension( 'A' )->setWidth( 10 );
        $sheet->getColumnDimension( 'B' )->setWidth( 70 );
        $sheet->getColumnDimension( 'C' )->setWidth( 23 );
        $sheet->getColumnDimension( 'D' )->setWidth( 15 );
        $sheet->getColumnDimension( 'E' )->setWidth( 23 );
        $sheet->getColumnDimension( 'F' )->setWidth( 8 );
        $sheet->getColumnDimension( 'G' )->setWidth( 8 );
        $sheet->getColumnDimension( 'H' )->setWidth( 8 );
        //Set Header Height
        $sheet->getRowDimension( '2' )->setRowHeight( 40 );
        //Set Header Style
        $sheet->getStyle( 'A2:H2' )->getFont()->setBold( true );
        //Header Aligment

        $sheet->getStyle( 'A2:H2' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );
        $sheet->getStyle( 'G2:H2' )->getFont()->setSize( 5 );
        $sheet->getStyle( 'A1' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );
        //Set Header Content
        $sheet->setCellValue( 'A2', 'หมายเลขโครงงาน' );
        $sheet->getStyle( 'A2' )->getAlignment()->setWrapText( true );
        $sheet->setCellValue( 'B2', 'หัวข้อโครงงาน' );
        $sheet->setCellValue( 'C2', 'อ.ที่ปรึกษา' );
        $sheet->setCellValue( 'D2', 'รหัสประจำตัว' );
        $sheet->setCellValue( 'E2', 'ชื่อ - นามสกุล' );
        $sheet->setCellValue( 'F2', 'พิเศษ *' );
        $sheet->setCellValue( 'G2', 'ส่งแบบฟอร์มเข้าพบที่ปรึกษา 1' );
        $sheet->getStyle( 'G2' )->getAlignment()->setWrapText( true );
        $sheet->setCellValue( 'H2', 'ส่งแบบฟอร์มเข้าพบที่ปรึกษา 2' );
        $sheet->getStyle( 'H2' )->getAlignment()->setWrapText( true );

        //Set Header Border

        $sheet->getStyle( 'A2:H2' )->applyFromArray( $this->getStyle()['border'] );
        $sheet->getStyle( 'A1:H1' )->applyFromArray( $this->getStyle()['border'] );
        return $sheet;
    }


    /**
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function actionDownloadTopic()
    {
        if (Yii::$app->request->get( 'major' ) == null) {
            $major = 0;
        } else {
            $major = Yii::$app->request->get( 'major' );
        }
        $projectIds = StudentProject::find()
            ->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->select( 'project_id' )->distinct();
        if ($major == 0) {

            $majors = Major::find()->all();
            $tmp2 = [];
            foreach ($majors as $item) {
                $tmp2[] = $item->code;
            }
        } else {
            $majors[] = Major::findOne( $major );

        }
        $spreadsheet = new Spreadsheet();

        // Create a new worksheet called "My Data"
        $spreadsheet->removeSheetByIndex( 0 );
        foreach ($majors as $major) {
            $projects = Project::find()
                ->where( ['id' => $projectIds] )
                ->andWhere( ['major_id' => $major->id] )
                ->orderBy( 'number' )
                ->all();
            if ($projects) {
                $sheet = new Worksheet( $spreadsheet, $major->code );
                $spreadsheet->addSheet( $sheet, 0 );
                $sheet->setTitle( $major->code );
                $sheet = $this->initialTopic( $sheet );//$projects[0]->subjectName .
                $sheet->setCellValue( 'A1', 'ตารางแสดงหัวข้อโครงงาน ' . ' ปี 4' .
                    ' เทอม ' . ModelHelper::getNowSemester() . ' ปีการศึกษา ' . ModelHelper::getNowYear() . ' สาขา ' . $major->code );
                $rowCount = 3;
                foreach ($projects as $project) {
                    //Merge Cell
                    $tmpRowCount = $rowCount;
                    $rowCount += count( $project->students );
                    if ($rowCount - $tmpRowCount == 1) {
                        $rowCount++;
                    } else if ($rowCount - $tmpRowCount == 0) {
                        $rowCount += 2;
                    }
                    if ($project->students[0]->branch_id == 2) {
                        $sheet->getStyle( 'A' . $tmpRowCount . ':H' . ($rowCount - 1) )->getFill()
                            ->setFillType( \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID )
                            ->getStartColor()->setARGB( 'FFFF00' );
                        $sheet->setCellValue( 'F' . $tmpRowCount, "*" );
                    }


                    $sheet->mergeCells( 'A' . $tmpRowCount . ':A' . ($rowCount - 1) );
                    $sheet->mergeCells( 'C' . $tmpRowCount . ':C' . ($rowCount - 1) );
                    $sheet->mergeCells( 'F' . $tmpRowCount . ':F' . ($rowCount - 1) );
                    $sheet->mergeCells( 'G' . $tmpRowCount . ':G' . ($rowCount - 1) );
                    $sheet->mergeCells( 'H' . $tmpRowCount . ':H' . ($rowCount - 1) );
                    $sheet->getStyle( 'A' . $tmpRowCount . ':A' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border'] );
                    $sheet->getStyle( 'B' . $tmpRowCount . ':B' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border_outline'] );
                    $sheet->getStyle( 'H' . $tmpRowCount . ':H' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border'] );
                    $sheet->getStyle( 'C' . $tmpRowCount . ':C' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border'] );
                    $sheet->getStyle( 'D' . $tmpRowCount . ':D' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border_outline'] );
                    $sheet->getStyle( 'E' . $tmpRowCount . ':E' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border_outline'] );
                    $sheet->getStyle( 'G' . $tmpRowCount . ':G' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border'] );
                    $sheet->getStyle( 'F' . $tmpRowCount . ':F' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border'] );

                    //Put Project Number and Project Name
                    $sheet->setCellValue( 'A' . $tmpRowCount, $project->projectNumber );

                    $sheet->getStyle( 'A' . $tmpRowCount . ':A' . ($rowCount - 1) )->applyFromArray( $this->getStyle()['border'] );
                    $sheet->setCellValue( 'B' . $tmpRowCount, $project->name_th );
                    $sheet->setCellValue( 'B' . ($tmpRowCount + 1), $project->name_en );
                    //Adviser
                    $keyTeacher = 0;
                    $teacherStr = [];
                    if ($project->mainAdviser != null) {
                        $teacherStr[$keyTeacher] = $project->mainAdviser->name;
                        $keyTeacher++;
                    }
                    foreach ($project->coAdvisers as $coAdviser) {
                        $teacherStr[$keyTeacher] = $coAdviser->name . ' (ร่วม)';
                        $keyTeacher++;
                    }
                    if (count($teacherStr)!=0) {
                        $sheet->setCellValue( 'C' . ($tmpRowCount), implode($teacherStr,"\n") );
                        $sheet->getStyle('C' . ($tmpRowCount))->getAlignment()->setWrapText(true);
                    }
                    //Student
                    foreach ($project->students as $key => $student) {
                        $sheet->setCellValue( 'D' . ($tmpRowCount + $key), $student->user_id );
                        $sheet->setCellValue( 'E' . ($tmpRowCount + $key), $student->name );
                        if ($student->branch_id == 2) {
                            $sheet->getStyle( 'A' . $tmpRowCount . ':H' . ($rowCount - 1) )->getFill()
                                ->setFillType( \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID )
                                ->getStartColor()->setARGB( 'FFFF00' );
                            $sheet->setCellValue( 'F' . $tmpRowCount, "*" );
                        }
                    }
                }
            }
        }

        $spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight( 20 );
        $writer = new Xlsx( $spreadsheet );
        $writer->save( 'reportTopic.xlsx' );
        $data = \Yii::getAlias( '@web' ) . '/reportTopic.xlsx';
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    ///////////////////////////////////

    public function actionGroup()
    {
        return $this->render( 'group' );
    }

    /**
     * @param $sheet Worksheet
     * @return mixed
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function initialGroup($sheet)
    {

        $sheet->getStyle( 'A1:G99' )
            ->getAlignment()->setVertical( \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER );
        $sheet->getStyle( 'A4:A99' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );

        $sheet->getStyle( 'C3:C99' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );

        $sheet->getStyle( 'D3:D99' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );

        $sheet->getStyle( 'E3:E99' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );

        $sheet->getStyle( 'F3:F99' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );

        $sheet->getStyle( 'G4:G99' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );


        //Merge Header
        $sheet->mergeCells( 'A1:G1' );
        $sheet->mergeCells( 'A2:A3' );
        $sheet->mergeCells( 'B2:B3' );
        $sheet->mergeCells( 'C2:F2' );
        $sheet->mergeCells( 'G2:G3' );
        //Set Width
        $sheet->getColumnDimension( 'A' )->setWidth( 10 );
        $sheet->getColumnDimension( 'B' )->setWidth( 35 );
        $sheet->getColumnDimension( 'C' )->setWidth( 5 );
        $sheet->getColumnDimension( 'D' )->setWidth( 5 );
        $sheet->getColumnDimension( 'E' )->setWidth( 5 );
        $sheet->getColumnDimension( 'F' )->setWidth( 5 );
        $sheet->getColumnDimension( 'G' )->setWidth( 15 );


        //Header Aligment

        $sheet->getStyle( 'A2:G2' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );
        $sheet->getStyle( 'A1' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );

        //Set Header Content
        $sheet->setCellValue( 'A2', 'กลุ่มสอบที่' );
//        $sheet->getStyle( 'A2' )->getAlignment()->setWrapText( true );
        $sheet->setCellValue( 'B2', 'อ.ที่ปรึกษา' );
        $sheet->setCellValue( 'C2', 'จำนวน' );
        $sheet->setCellValue( 'C3', 'CS' );
        $sheet->setCellValue( 'D3', 'ICT' );
        $sheet->setCellValue( 'E3', 'GIS' );
        $sheet->setCellValue( 'F3', 'รวม' );
        $sheet->setCellValue( 'G2', 'จำนวนเรื่องในแต่ละกลุ่มสอบ' );
        $sheet->getStyle( 'G2' )->getAlignment()->setWrapText( true );
        //Set Header Border

        $sheet->getStyle( 'A1:G1' )->applyFromArray( $this->getStyle()['border'] );
        $sheet->getStyle( 'A2:A3' )->applyFromArray( $this->getStyle()['border'] );
        $sheet->getStyle( 'B2:B3' )->applyFromArray( $this->getStyle()['border'] );
        $sheet->getStyle( 'C2:F2' )->applyFromArray( $this->getStyle()['border'] );
        $sheet->getStyle( 'C3' )->applyFromArray( $this->getStyle()['border'] );
        $sheet->getStyle( 'D3' )->applyFromArray( $this->getStyle()['border'] );
        $sheet->getStyle( 'E3' )->applyFromArray( $this->getStyle()['border'] );
        $sheet->getStyle( 'F3' )->applyFromArray( $this->getStyle()['border'] );
        $sheet->getStyle( 'G2:G3' )->applyFromArray( $this->getStyle()['border'] );
        return $sheet;
    }

    /**
     * @return array
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function actionDownloadGroup()
    {
        $year = \Yii::$app->request->get( 'year' );
        $semester = \Yii::$app->request->get( 'semester' );
        $subject = \Yii::$app->request->get( 'subject' );
        $examGroups = ExamGroup::find()
            ->where( ['year_id' => $year] )
            ->andWhere( ['semester_id' => $semester] )
            ->andWhere( ['subject_id' => $subject] )
            ->all();
        $data = [];
        if (count( $examGroups ) != 0) {
            foreach ($examGroups as $key => $item) {
                $data[$key]['name'] = $item->name;
                $data[$key]['id'] = $item->id;
                foreach ($item->users as $subKey => $user) {
                    $data[$key]['advisers'][$subKey]['name'] = $user->name;
                    $data[$key]['advisers'][$subKey]['id'] = $user->id;
                    $projectIds = Advise::find()
                        ->where( ['year_id' => $year] )
                        ->andWhere( ['semester_id' => $semester] )
                        ->andWhere( ['subject_id' => $subject] )
                        ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER] )
                        ->andWhere( ['adviser_id' => $user->id] )
                        ->select( 'project_id' );
                    $data[$key]['advisers'][$subKey]['cs'] = (int)Project::find()
                        ->where( ['id' => $projectIds] )
                        ->andWhere( ['major_id' => 1] )->count();
                    $data[$key]['advisers'][$subKey]['ict'] = (int)Project::find()
                        ->where( ['id' => $projectIds] )
                        ->andWhere( ['major_id' => 2] )->count();
                    $data[$key]['advisers'][$subKey]['gis'] = (int)Project::find()
                        ->where( ['id' => $projectIds] )
                        ->andWhere( ['major_id' => 3] )->count();
                    $data[$key]['advisers'][$subKey]['total'] = $data[$key]['advisers'][$subKey]['cs'] +
                        $data[$key]['advisers'][$subKey]['ict'] +
                        $data[$key]['advisers'][$subKey]['gis'];

                }

            }

        }
        $spreadsheet = new Spreadsheet();

        // Create a new worksheet called "My Data"
        $spreadsheet->removeSheetByIndex( 0 );
        $sheet = new Worksheet( $spreadsheet, "กลุ่มสอบ" );
        $spreadsheet->addSheet( $sheet, 0 );
        $this->initialGroup( $sheet );
        $sheet->setCellValue( 'A1', 'กลุ่มสอบโครงงาน และกรรมการสอบ' );
        $pointer = 4;
        foreach ($data as $key => $item) {
            $total = 0;
            if (isset( $item['advisers'] )) {
                foreach ($item['advisers'] as $adviser) {
                    $total += $adviser['total'];
                }
            }

            if (isset( $item['advisers'] )) {

                foreach ($item['advisers'] as $i => $adviser) {
                    if ($i == 0) {
                        $pointerOld = $pointer;
                        $pointer += count( $item['advisers'] );
                        if (($pointer - $pointerOld) > 1) {
                            $sheet->mergeCells( 'A' . $pointerOld . ':A' . ($pointer - 1) );
                            $sheet->mergeCells( 'G' . $pointerOld . ':G' . ($pointer - 1) );

                        }
                        $sheet->setCellValue( 'G' . ($pointerOld + $i), $total );
                        $sheet->setCellValue( 'A' . $pointerOld, $item['name'] );
                    }

                    $sheet->setCellValue( 'B' . ($pointerOld + $i), $adviser['name'] );
                    $sheet->setCellValue( 'C' . ($pointerOld + $i), $adviser['cs'] );
                    $sheet->setCellValue( 'D' . ($pointerOld + $i), $adviser['ict'] );
                    $sheet->setCellValue( 'E' . ($pointerOld + $i), $adviser['gis'] );
                    $sheet->setCellValue( 'F' . ($pointerOld + $i), $adviser['total'] );
                    $sheet->getStyle( 'A' . ($pointerOld + $i) . ':G' . ($pointerOld + $i) )->applyFromArray( $this->getStyle()['border'] );

                }
            } else {
                $sheet->setCellValue( 'A' . $pointer, $item['name'] );
                $sheet->setCellValue( 'C' . $pointer, 0 );
                $sheet->setCellValue( 'D' . $pointer, 0 );
                $sheet->setCellValue( 'E' . $pointer, 0 );
                $sheet->setCellValue( 'F' . $pointer, 0 );
                $sheet->setCellValue( 'G' . $pointer, 0 );
                $sheet->getStyle( 'A' . $pointer . ':G' . $pointer )->applyFromArray( $this->getStyle()['border'] );
                $pointer++;

            }
        }
//        $spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight( 23 );
        $writer = new Xlsx( $spreadsheet );
        $writer->save( 'reportTopic.xlsx' );
        $data = \Yii::getAlias( '@web' ) . '/reportTopic.xlsx';
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;


    }

    public function actionAjaxGetSubject()
    {
        $year = \Yii::$app->request->post( 'year' );
        $semester = \Yii::$app->request->post( 'semester' );
        $subjectIds = Subject::find()->select( 'id' );
        $openSubjectIds = OpenSubject::find()->where( ['subject_id' => $subjectIds] )
            ->andWhere( ['year_id' => $year] )
            ->andWhere( ['semester_id' => $semester] )
            ->select( 'subject_id' );
        $subject = SubjectView::find()->where( ['id' => $openSubjectIds] )->all();
        $data = ArrayHelper::toArray( $subject, [
            'app\modules\eproject\models\SubjectView' => [
                'id',
                'name',
            ],
        ] );
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    public function actionAjaxSearch()
    {
        $year = \Yii::$app->request->post( 'year' );
        $semester = \Yii::$app->request->post( 'semester' );
        $subject = \Yii::$app->request->post( 'subject' );
        $examGroups = ExamGroup::find()
            ->where( ['year_id' => $year] )
            ->andWhere( ['semester_id' => $semester] )
            ->andWhere( ['subject_id' => $subject] )
            ->all();
        $data = false;
        if (count( $examGroups ) != 0) {
            foreach ($examGroups as $key => $item) {
                $data[$key]['name'] = $item->name;
                $data[$key]['id'] = $item->id;
                foreach ($item->users as $subKey => $user) {
                    $data[$key]['advisers'][$subKey]['name'] = $user->name;
                    $data[$key]['advisers'][$subKey]['id'] = $user->id;
                    $projectIds = Advise::find()
                        ->where( ['year_id' => $year] )
                        ->andWhere( ['semester_id' => $semester] )
                        ->andWhere( ['subject_id' => $subject] )
                        ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER] )
                        ->andWhere( ['adviser_id' => $user->id] )
                        ->select( 'project_id' );
                    $data[$key]['advisers'][$subKey]['cs'] = (int)Project::find()
                        ->where( ['id' => $projectIds] )
                        ->andWhere( ['major_id' => 1] )->count();
                    $data[$key]['advisers'][$subKey]['ict'] = (int)Project::find()
                        ->where( ['id' => $projectIds] )
                        ->andWhere( ['major_id' => 2] )->count();
                    $data[$key]['advisers'][$subKey]['gis'] = (int)Project::find()
                        ->where( ['id' => $projectIds] )
                        ->andWhere( ['major_id' => 3] )->count();
                    $data[$key]['advisers'][$subKey]['total'] = $data[$key]['advisers'][$subKey]['cs'] +
                        $data[$key]['advisers'][$subKey]['ict'] +
                        $data[$key]['advisers'][$subKey]['gis'];

                }

            }

        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;

    }

    ////////////////////////////////////////////

    /**
     * @param $sheet Worksheet
     * @return mixed
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function initialPpa($sheet)
    {

        $sheet->getStyle( 'A1:E99' )
            ->getAlignment()->setVertical( \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER );
        $sheet->getStyle( 'B1:B99' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );

        $sheet->getStyle( 'C1:C99' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );

        $sheet->getStyle( 'D1:D99' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );

        $sheet->getStyle( 'E1:E99' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );

        $sheet->getStyle( 'A1:A2' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );

        //Merge Header
        $sheet->mergeCells( 'A1:E1' );

        //Set Width
        $sheet->getColumnDimension( 'A' )->setWidth( 35 );
        $sheet->getColumnDimension( 'B' )->setWidth( 10 );
        $sheet->getColumnDimension( 'C' )->setWidth( 10 );
        $sheet->getColumnDimension( 'D' )->setWidth( 10 );
        $sheet->getColumnDimension( 'E' )->setWidth( 10 );

//        $sheet->getStyle( 'A2' )->getAlignment()->setWrapText( true );
        $sheet->setCellValue( 'A2', 'อาจารย์ที่ปรึกษา' );
        $sheet->setCellValue( 'B2', 'สาขา' );
        $sheet->setCellValue( 'C2', 'รับทั้งหมด' );
        $sheet->setCellValue( 'D2', 'รับไปแล้ว' );
        $sheet->setCellValue( 'E2', 'คงเหลือ' );

        //Set Header Border

        $sheet->getStyle( 'A1:E2' )->applyFromArray( $this->getStyle()['border'] );
        return $sheet;
    }


    public function actionProjectPerAdviser()
    {
        $major = Yii::$app->request->get( 'major' );
        $year = Yii::$app->request->get( 'year' );
        $semester = Yii::$app->request->get( 'semester' );
        if (!isset( $major )) {
            $major = 0;
            $year = ModelHelper::getNowYear();
            $semester = ModelHelper::getNowSemester();
        }
        if ($major == 0) {
            $requestAdvisee = RequestAdvisee::find()
                ->where( ['year_id' => $year] )
                ->andWhere( ['semester_id' => $semester] )
                ->all();
        } else {
            $requestAdvisee = RequestAdvisee::find()
                ->innerJoin( User::tableName(),
                    RequestAdvisee::tableName() . '.adviser_id=' . User::tableName() . '.id AND ' .
                    User::tableName() . '.major_id=' . $major )
                ->andWhere( ['year_id' => $year] )
                ->andWhere( ['semester_id' => $semester] )
                ->all();
        }
        return $this->render( 'project-per-adviser',
            ['requestAdvisee' => $requestAdvisee,
                'major' => $major,
                'year' => $year,
                'semester' => $semester] );


    }

    public function actionDownloadPpa()
    {
        $major = Yii::$app->request->get( 'major' );
        $year = Yii::$app->request->get( 'year' );
        $semester = Yii::$app->request->get( 'semester' );
        if ($major == 0) {
            $requestAdvisee = RequestAdvisee::find()
                ->where( ['year_id' => $year] )
                ->andWhere( ['semester_id' => $semester] )
                ->all();
            $majors = Major::find()->all();
            $tmp2 = [];
            foreach ($majors as $item) {
                $tmp2[] = $item->code;
            }
            $majorStr = implode( ', ', $tmp2 );
        } else {
            $requestAdvisee = RequestAdvisee::find()
                ->innerJoin( User::tableName(),
                    RequestAdvisee::tableName() . '.adviser_id=' . User::tableName() . '.id AND ' .
                    User::tableName() . '.major_id=' . $major )
                ->andWhere( ['year_id' => $year] )
                ->andWhere( ['semester_id' => $semester] )
                ->all();
            $majors[] = Major::findOne( $major );
            $majorStr = Major::findOne( $major )->code;
        }

        $spreadsheet = new Spreadsheet();
        // Create a new worksheet called "My Data"
        $spreadsheet->removeSheetByIndex( 0 );
        $sheet = new Worksheet( $spreadsheet, "สถานะอาจารย์ที่ปรึกษา" );
        $spreadsheet->addSheet( $sheet, 0 );
        $this->initialPpa( $sheet );
        $sheet->setCellValue( 'A1', 'สถานะอาจารย์ที่ปรึกษา สาขา ' . $majorStr . ' เทอม ' . $semester . ' ปีการศึกษา ' . $year );
        $pointer = 3;
        foreach ($requestAdvisee as $item) {
            $sheet->setCellValue( 'A' . $pointer, $item->adviser->name );
            $sheet->setCellValue( 'B' . $pointer, $item->adviser->major->code );
            $sheet->setCellValue( 'C' . $pointer, $item->need );
            $sheet->setCellValue( 'D' . $pointer, $item->added );
            $sheet->setCellValue( 'E' . $pointer, $item->need - $item->added );
            $sheet->getStyle( 'A' . $pointer . ':E' . $pointer )->applyFromArray( $this->getStyle()['border'] );

            $sheet->getRowDimension( $pointer )->setRowHeight( 23 );
            $pointer++;
        }

//        $spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight( 23 );
        $writer = new Xlsx( $spreadsheet );
        $writer->save( 'reportTopic.xlsx' );
        $data = \Yii::getAlias( '@web' ) . '/reportTopic.xlsx';
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    ////////////////
    public function actionUnsentTopic()
    {

        $subjectIds = Subject::find()->select( 'id' );
        $openSubjectIds = OpenSubject::find()->where( ['subject_id' => $subjectIds] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->select( 'subject_id' );
        $subject = SubjectView::find()->where( ['id' => $openSubjectIds] )->all();
        if (Yii::$app->request->get( 'subject' ) == null) {
            if ($subject) {
                $subjectId = $subject[0]->id;
            } else {
                $subjectId = 0;
            }
        } else {
            $subjectId = Yii::$app->request->get( 'subject' );
        }

        $advise = Advise::find()
            ->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['subject_id' => $subjectId] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->distinct()->select( 'project_id' );
        $stdProject = StudentProject::find()
            ->where( ['project_id' => $advise] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( ['subject_id' => $subjectId] )
            ->select( 'student_id' );
        $enrolls = Enroll::find()
            ->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( ['subject_id' => $subjectId] )
            ->andWhere( ['not in', 'student_id', $stdProject] )
            ->all();
        return $this->render( 'unsent-topic',
            ['enrolls' => $enrolls,
                'subject' => $subject,
                'subjectId' => $subjectId
            ] );
    }

    public function actionDownloadUnsentTopic()
    {
        $subjectIds = Subject::find()->select( 'id' );
        $openSubjectIds = OpenSubject::find()->where( ['subject_id' => $subjectIds] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->select( 'subject_id' );
        $subject = SubjectView::find()->where( ['id' => $openSubjectIds] )->all();
        if (Yii::$app->request->get( 'subject' ) == null) {
            if ($subject) {
                $subjectId = $subject[0]->id;
            } else {
                $subjectId = 0;
            }
        } else {
            $subjectId = Yii::$app->request->get( 'subject' );
        }

        $advise = Advise::find()
            ->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['subject_id' => $subjectId] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->distinct()->select( 'project_id' );
        $stdProject = StudentProject::find()
            ->where( ['project_id' => $advise] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( ['subject_id' => $subjectId] )
            ->select( 'student_id' );
        $enrolls = Enroll::find()
            ->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( ['subject_id' => $subjectId] )
            ->andWhere( ['not in', 'student_id', $stdProject] )
            ->all();
        $spreadsheet = new Spreadsheet();
        // Create a new worksheet called "My Data"
        $spreadsheet->removeSheetByIndex( 0 );
        $sheet = new Worksheet( $spreadsheet, "รายชื่อนักศึกษา" );
        $spreadsheet->addSheet( $sheet, 0 );
        $this->initialUnsentTopic( $sheet );
        $sheet->setCellValue( 'A1', 'นักศึกษาที่ยังไม่ส่งหัวข้อโครงงาน' );
        $pointer = 3;
        foreach ($enrolls as $item) {
            $sheet->setCellValue( 'A' . $pointer, $pointer - 2 );
            $sheet->setCellValue( 'B' . $pointer, $item->student->user_id );
            $sheet->setCellValue( 'C' . $pointer, $item->student->name );
            $sheet->setCellValue( 'D' . $pointer, $item->student->major->code );
            $sheet->getStyle( 'A' . $pointer . ':D' . $pointer )->applyFromArray( $this->getStyle()['border'] );
            $pointer++;
        }

//        $spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight( 23 );
        $writer = new Xlsx( $spreadsheet );
        $writer->save( 'reportTopic.xlsx' );
        $data = \Yii::getAlias( '@web' ) . '/reportTopic.xlsx';
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
    }

    /**
     * @param $sheet Worksheet
     * @return mixed
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function initialUnsentTopic($sheet)
    {

        $sheet->getStyle( 'A1:D999' )
            ->getAlignment()->setVertical( \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER );

        $sheet->getStyle( 'A1:D999' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );

        //Merge Header
        $sheet->mergeCells( 'A1:D1' );

        //Set Width
        $sheet->getColumnDimension( 'A' )->setWidth( 10 );
        $sheet->getColumnDimension( 'B' )->setWidth( 25 );
        $sheet->getColumnDimension( 'C' )->setWidth( 35 );
        $sheet->getColumnDimension( 'D' )->setWidth( 10 );

//        $sheet->getStyle( 'A2' )->getAlignment()->setWrapText( true );
        $sheet->setCellValue( 'A2', 'ลำดับ' );
        $sheet->setCellValue( 'B2', 'รหัส' );
        $sheet->setCellValue( 'C2', 'ชื่อ' );
        $sheet->setCellValue( 'D2', 'สาขา' );
        //Set Header Border

        $sheet->getStyle( 'A1:D2' )->applyFromArray( $this->getStyle()['border'] );
        return $sheet;
    }

    ////////////
    public function actionUnsentDocument()
    {
        $subject = Yii::$app->request->get( 'subject' );

        if ($subject == NULL) {
            $subject = 0;
        }
        $filter = $subject == 0 ? '' : ' AND ' . StudentProject::tableName() . '.subject_id = ' . $subject;
        $projects = Project::find()
            ->innerJoin( StudentProject::tableName(), Project::tableName() . '.id =' . StudentProject::tableName() . '.project_id
        AND ' . StudentProject::tableName() . '.year_id = ' . ModelHelper::getNowYear() .
                ' AND ' . StudentProject::tableName() . '.semester_id = ' . ModelHelper::getNowSemester() .
                $filter )
            ->all();

        return $this->render( 'unsent-document',
            ['oldData' => $subject,
                'projects' => $projects] );
    }

    public function actionDownloadUnsentDocument()
    {
        $subject = Yii::$app->request->get( 'subject' );

        if ($subject == NULL) {
            $subject = 0;
        }
        $filter = $subject == 0 ? '' : ' AND ' . StudentProject::tableName() . '.subject_id = ' . $subject;
        $projects = Project::find()
            ->innerJoin( StudentProject::tableName(), Project::tableName() . '.id =' . StudentProject::tableName() . '.project_id
        AND ' . StudentProject::tableName() . '.year_id = ' . ModelHelper::getNowYear() .
                ' AND ' . StudentProject::tableName() . '.semester_id = ' . ModelHelper::getNowSemester() .
                $filter )
            ->all();
        $spreadsheet = new Spreadsheet();
        // Create a new worksheet called "My Data"
        $spreadsheet->removeSheetByIndex( 0 );
        $sheet = new Worksheet( $spreadsheet, "รายชื่อโครงงาน" );
        $spreadsheet->addSheet( $sheet, 0 );
        $this->initialUnsentDocument( $sheet );
        $sheet->setCellValue( 'A1', 'รายชื่อกลุ่มที่ยังไม่ส่งเอกสาร' );
        $pointer = 3;
        foreach ($projects as $item) {
            $subjectDocumentTypes = SubjectDocumentType::find()
                ->leftJoin( ProjectDocument::tableName()
                    , SubjectDocumentType::tableName() . '.document_type_id=' . ProjectDocument::tableName()
                    . '.document_type_id
                         AND ' . ProjectDocument::tableName() . '.project_id = ' . $item->id )
                ->where( ['subject_id' => $item->subject] )
                ->andWhere( ProjectDocument::tableName() . '.project_id is null' )
                ->all();
            if (count( $subjectDocumentTypes ) != 0) {
                $documentsName = [];
                foreach ($subjectDocumentTypes as $subjectDocumentType) {
                    $documentsName[] = $subjectDocumentType->documentType->name;
                }
                $pointerOld = $pointer;
                $pointer += count( $item->students );
                if ($pointer == $pointerOld) {
                    $pointer++;
                } else if (($pointer - $pointerOld) > 1) {
                    $sheet->mergeCells( 'A' . $pointerOld . ':A' . ($pointer - 1) );
                    $sheet->mergeCells( 'B' . $pointerOld . ':B' . ($pointer - 1) );
                    $sheet->mergeCells( 'D' . $pointerOld . ':D' . ($pointer - 1) );
                }

                $sheet->setCellValue( 'A' . $pointerOld, $item->projectNumber );
                $sheet->setCellValue( 'B' . $pointerOld, $item->name );
                foreach ($item->students as $key => $student) {

                    $sheet->setCellValue( 'C' . ($pointerOld + $key), $student->name );
                    $sheet->getRowDimension( $pointerOld + $key )->setRowHeight( 23 );
                }
                $sheet->setCellValue( 'D' . $pointerOld, implode( ', ', $documentsName ) );
                $sheet->getStyle( 'A' . $pointerOld . ':D' . ($pointer - 1) )->applyFromArray( $this->getStyle()['border'] );
            }

        }

//        $spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight( 23 );
        $writer = new Xlsx( $spreadsheet );
        $writer->save( 'reportTopic.xlsx' );
        $data = \Yii::getAlias( '@web' ) . '/reportTopic.xlsx';
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;

    }


    /**
     * @param $sheet Worksheet
     * @return mixed
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    private function initialUnsentDocument($sheet)
    {

        $sheet->getStyle( 'A1:D99' )
            ->getAlignment()->setVertical( \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER );

        $sheet->getStyle( 'A1:D2' )
            ->getAlignment()->setHorizontal( \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER );

        //Merge Header
        $sheet->mergeCells( 'A1:D1' );

        //Set Width
        $sheet->getColumnDimension( 'A' )->setWidth( 10 );
        $sheet->getColumnDimension( 'B' )->setWidth( 60 );
        $sheet->getColumnDimension( 'C' )->setWidth( 35 );
        $sheet->getColumnDimension( 'D' )->setWidth( 35 );

//        $sheet->getStyle( 'A2' )->getAlignment()->setWrapText( true );
        $sheet->setCellValue( 'A2', 'กลุ่มที่' );
        $sheet->setCellValue( 'B2', 'ชื่อโครงงาน' );
        $sheet->setCellValue( 'C2', 'รายชื่อนักศึกษา' );
        $sheet->setCellValue( 'D2', 'เอกสารที่ยังไม่ส่ง' );
        //Set Header Border

        $sheet->getStyle( 'A1:D2' )->applyFromArray( $this->getStyle()['border'] );
        return $sheet;
    }

    public function actionIndex()
    {
        return $this->render( 'index' );
    }

    private function getStyle()
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