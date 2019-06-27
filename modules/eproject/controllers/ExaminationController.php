<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 14/8/2560
 * Time: 15:15
 */

namespace app\modules\eproject\controllers;


use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\models\Advise;
use app\modules\eproject\models\ExamCommittee;
use app\modules\eproject\models\ExamGroup;
use app\modules\eproject\models\OpenSubject;
use app\modules\eproject\models\Project;
use app\modules\eproject\models\Subject;
use Yii;
use yii\web\Controller;

class ExaminationController extends Controller
{

    public function actionBoard()
    {
        $examGroupData = null;
        if (Yii::$app->request->get( 'subject' ) != null) {
            $subject_id = Yii::$app->request->get( 'subject' );

        } else {
            if (Subject::getNowOpenSubjects()) {
                $subject_id = Subject::getNowOpenSubjects()[0]->id;
            } else {
                $subject_id = null;
            }
        }

        $examGroupData = ExamGroup::find()
            ->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( ['subject_id' => $subject_id] )
            ->all();

        return $this->render( 'board',
            ['oldData' => $subject_id,
                'examGroupData' => $examGroupData] );
    }

    public function actionGroupList()
    {
        $id = Yii::$app->request->get( 'id' );
        if ($examGroup = ExamGroup::find()->where( ['id' => $id] )->one()) {
            if ($examCommittee = ExamCommittee::find()->where( ['exam_group_id' => $id] )->all()) {
                $projects = [];
                foreach ($examCommittee as $committee) {
                    $projectTmp = Project::find()
                        ->innerJoin( Advise::tableName(), Project::tableName() . '.id = ' . Advise::tableName() . '.project_id' )
                        ->where( ['adviser_id'=>$committee->user_id] )
                        ->andWhere( [Advise::tableName() . '.year_id'=> $committee->year_id] )
                        ->andWhere( [Advise::tableName() . '.subject_id'=> $committee->subject_id] )
                        ->andWhere( [Advise::tableName() . '.semester_id'=> $committee->semester_id] )
                        ->orderBy('number')
                        ->all();
                    foreach ($projectTmp as $item) {
                        array_push( $projects, $item );
                    }

                }
                return $this->render( 'group-list', [
                    'projectData' => $projects,
                    'id'=>$examGroup->name
                ] );
            } else {
                $this->redirect( ['examination/board'] );
            }

        } else {
            $this->redirect( ['examination/board'] );
        }
    }


}