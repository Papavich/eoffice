<?php

use app\modules\pfc\models\ViewProject;
use app\modules\pfc\models\ViewPisOpenSubject;
use app\modules\pfc\models\ProcessRequirementConnect;
use yii\widgets\ActiveForm;
use app\modules\pfc\models\ViewStudentFull;
use app\modules\pfc\models\ViewUser;
use app\modules\pfc\models\ViewStudentProject;
use app\modules\pfc\models\ViewAdvise;
use app\modules\kku30\models\Kku30Subject;
use app\modules\kku30\models\Kku30SubjectOpen;
use app\modules\eproject\models\SubjectView;
use app\modules\pfc\models\ProcessGanttType;

Yii::$app->view->params['title'] = 'Home';
$session = Yii::$app->session;
?>


    <header id="page-header">
        <h1><?= $this->params['title'] ?></h1>
    </header>

<?php

        $a = Kku30SubjectOpen::find()->all();
        foreach ($a as $c){
            echo $c->subject_id;?><br><?php
        }

//        $a = ViewStudentProject::find()->all();
//        foreach ($a as $c){
//            $s = ViewUser::find()->where("id like :b", [":b" => $c->student_id])->all();
//            echo $c->student_id;?><!--<br>--><?php
//            echo $s[0]->username ?><!--<br>--><?php
//            echo $s[0]->student_fname_th ?><!--<br>--><?php
//            echo $s[0]->department_id ?><!--<br>--><?php
//            echo $s[0]->major_id ?><!--<br>--><?php
//            echo $s[0]->id ?><!--<br><br>--><?php
//        }

//        $user = ViewUser::find()->where("username like :b", [":b" => $session->get('pfc_id')])->all();
//        $student = ViewStudentProject::find()->where("student_id like :b", [":b" => $user[0]->id])->all();
//            $a = ViewStudentFull::find()->where("STUDENTCODE like :b", [":b" => '573021109-4'])->all();
//        foreach ($a as $c){
//            echo $c->Studentid;?><!--<br>--><?php
//        }
//            echo $a[0]->STUDENTYEAR;?><!--<br>--><?php

//        $a = ViewUser::find()->all();
//            echo $a[0]->username ?><!--<br>--><?php
//            echo $a[0]->student_fname_th ?><!--<br>--><?php
//            echo $a[0]->department_id ?><!--<br>--><?php
//            echo $a[0]->major_id ?><!--<br>--><?php
//            echo $a[0]->id ?><!--<br><br>--><?php

//            $user = ViewUser::find()->where("username like :b", [":b" => $session->get('pfc_id')])->all();
//            $teacher = ViewAdvise::find()->where("adviser_id like :b ORDER BY project_id", [":b" => $user[0]->id])->all();
//            $W = null;
//            foreach ($teacher as $c){
//                if($W != $c->project_id) {
//                    echo $c->project_id;
//                    $W = $c->project_id; ?><!--<br>-->
<!--                --><?php //}
//            }



?>



