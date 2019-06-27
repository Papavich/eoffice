<?php

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\models\ScbStudent;
use app\modules\scholar_b\models\ScbStudentHasTeacher;
use app\modules\scholar_b\models\ScbTeacherHasType;
use yii\web\Controller;
use Yii;
use yii\helpers\Html;
use yii\data\Pagination;

class SettingController extends Controller
{
    const List_PAGE_SIZE = 10;

    public function actionAddTeacher()
    {
        $this->layout = "main_module";

        //$status = ScbStudent::find()->where(['student_id' => Yii::$app->request->post('ScbStudentHasTeacher')['student_id']])->one();
        $model_std_teac = new ScbStudentHasTeacher();
        $model_teachertype = new ScbTeacherHasType();

        //part add-advisor
        $query = ScbStudentHasTeacher::find()->orderBy('student_id DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => self::List_PAGE_SIZE]);
        $model_student = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        //part add-committee
        $query = ScbTeacherHasType::find()->orderBy('year DESC');
        $model_committee = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();


        return $this->render('add-teacher', [
            'model_std_teac' => $model_std_teac,
            'model_teachertype' => $model_teachertype,
            'model_student' => $model_student,
            'model_committee' => $model_committee,
            'pages' => $pages,
        ]);

    }

    public function actionAddadvisor()
    {
        $model_std_teac = new ScbStudentHasTeacher();
        $model_teachertype = new ScbTeacherHasType();

        $status = ScbStudent::find()->where(['student_id' => Yii::$app->request->post('ScbStudentHasTeacher')['student_id']])->one();
        $status->status_advisor = 1;
        $status->save();


        if ($model_teachertype->load(Yii::$app->request->post())) {
            $model_teachertype->teacher_type_id = 1;
            $model_teachertype->save(false);

            $model_std_teac->load(Yii::$app->request->post());
            $model_std_teac->teacher_id_card = $model_teachertype->teacher_id_card;
            $model_std_teac->teacher_type_id = 1;
            $model_std_teac->save();


            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app', Html::encode('แต่งตั้งอาจารย์ที่ปรึกษาทุนเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['add-teacher',
                'student_id' => $model_std_teac->student_id,
                'teacher_id_card' => $model_std_teac->teacher_id_card,
                'teacher_type_id' => $model_std_teac->teacher_type_id = 1,
                'year' => $model_teachertype->year,
            ]);
        } else {
            $this->layout = "main_module";
            return $this->render('../site/error404');

        }
    }

    public function actionAddcommittee()
    {
        $model_teachertype = new ScbTeacherHasType();

        if ($model_teachertype->load(Yii::$app->request->post())) {
            $model_teachertype->teacher_type_id;
            $model_teachertype->save(false);

            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app', Html::encode('แต่งตั้งกรรมการทุนเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['add-teacher',
                'teacher_id_card' => $model_teachertype->teacher_id_card,
                'teacher_type_id' => $model_teachertype->teacher_type_id,
                'year' => $model_teachertype->year,
            ]);
        } else {
            $this->layout = "main_module";
            return $this->render('../site/error404');

        }

    }
}