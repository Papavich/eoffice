<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/9/2017
 * Time: 6:01 AM
 */

namespace app\modules\eoffice_ta\controllers;

use app\modules\eoffice_ta\models\SubjectOpen;
use app\modules\eoffice_ta\models\Kku30SubjectOpen;

use app\modules\eoffice_ta\models\TaStatus;
use yii\web\Controller;

class StudentController extends Controller
{
    public function actionRegisterTa(){
        $model = SubjectOpen::find()->all();
        $this->layout = "main_modules";
        return $this->render('list-subj-regis',[
            'model' => $model,
        ]);
    }
    public function actionWorkLoadList(){
        $this->layout = "main_modules";
        return $this->render('work-load-list');
    }
    public function actionTaWorking(){
        $this->layout = "main_modules";
        return $this->render('ta-working');
    }
    public function actionStudentComment(){
        $this->layout = "main_modules";
        return $this->render('student-comment');
    }
    public function actionStudentAssessmentTa(){
        $this->layout = "main_modules";
        return $this->render('student-assessment-ta');
    }



}