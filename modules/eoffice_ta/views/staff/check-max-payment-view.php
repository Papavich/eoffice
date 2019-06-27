<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 29/11/2560
 * Time: 1:32
 */

use yii\widgets\DetailView;
use app\modules\eoffice_ta\models\SubjectOpen;
use app\modules\eoffice_ta\models\TaRuleApproach;
use app\modules\eoffice_ta\models\TaTypeRule;
use app\modules\eoffice_ta\models\TaCalculation;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRequest;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\Person;
use app\modules\eoffice_ta\models\TaWorkLoad;
use app\modules\eoffice_ta\models\Subject;
use app\modules\eoffice_ta\models\Section;
use app\modules\eoffice_ta\models\model_main\PersonView;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;
use app\modules\eoffice_ta\models\model_main\EofficeMainPerson;
use app\modules\eoffice_ta\models\model_main\EofficeMainPrefix;
use app\modules\eoffice_ta\models\SectionTeacher;
use app\modules\eoffice_ta\models\ViewKku30SectionProgram;
use yii\helpers\Url;
use app\modules\eoffice_ta\components\NextPage;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
?>

<?php
$title_main = 'กรอบค่าตอบแทนผู้ช่วยสอน';
$title = 'กรอบค่าตอบแทนผู้ช่วยสอนของ วิชา';
$this->title = $title_main;

?>

<div class="panel-body">
    <div class="navbar navbar-default">
        <div class="navbar-header">

            <?= Menu::widget([
                'items' => [
                    ['label' => 'ตรวจสอบการร้องขอTA', 'url' => ['check-request']],
                    ['label' => 'กรอบค่าตอบแทนผู้ช่วยสอน', 'url' => ['check-max-payment']],
                ],
                'options' => [
                    'class' => 'navbar-nav nav',
                    'id'=>'navbar-id',
                    'style'=>'font-size: 14px;',
                    'data-tag'=>'yii2-menu',
                ],
            ]);
            ?>
            <?php
           $model = Subject::findOne(['subject_id'=>$s,'subject_version'=>$ver,
                    /* 'subopen_semester'=>$t
                    ,'subopen_year'=>$y
                    */
                    ]);
           $credit = $model->subject_credit.'('.$model->subject_time.')';
            if (!empty($model)){

            ?>

        </div>
    </div>
    <div id="panel-1" class="panel panel-default">
     <h4 class="alert alert-info">
     <?=$title?>&nbsp;<?=$model->subject_id?> &nbsp;หน่วยกิต: <?=$credit?> &nbsp; ปีการศึษา : <?=$t?>
     </h4>
       <br>
                <?php
                $t_secs = SectionTeacher::findOne([
                    'subject_id'=>$s]);
                $person = EofficeMainUser::findOne(['person_id' => $t_secs->teacher_id]);
                $per = EofficeMainPerson::findOne(['person_id'=>$person->person_id]);

                $req = TaRequest::findOne(['subject_id'=>$s,'subject_version' => $ver,
                    'term_id'=>$t]);
                ?>
                <div> <strong>อาจารย์ผู้ร้องขอผู้ช่วยสอน :</strong>
                    <strong style="color: #0055aa" class="size-13">
                        <?=' ' . $per->person_name .
                        ' ' . $per->person_surname;?></strong></div>
                <br>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-vertical-middle nomargin" >
                        <thead>
                        <tr>
                            <th >โครงการ</th>
                            <th class="text-center">ประเภทการร้องขอ</th>
                            <th class="text-center">จำนวนนักศึกษา</th>
                            <th class="text-center">หน่วยภาระงาน</th>
                            <th class="warning text-center">กรอบเงิน/เดือน</th>
                            <th class="warning text-center">กรอบเงิน/เทอม</th>

                        </tr>

                        </thead>
                        <?php
                            /* $sec_programs = ViewKku30SectionProgram::find()->where([
                            //'program_class'=>1,
                            'subject_id'=>$s,'subject_version' => $ver,
                            'subopen_semester'=>$t,'subopen_year'=>$y])->all();
                        foreach ($sec_programs as $sec_program) {*/
                        ?>
                        <tbody>
                        <tr>
                            <?php
                             //  if ($sec_program->program_class == '1'){
                            ?>
                            <td>
                                <div><strong>ภาคปกติ</strong></div>
                            </td>
                            <td class="text-center">
                                <?=$req->taTypeWork->ta_type_work_fullname?>
                            </td>
                            <td class="text-center">
                                <strong style="color: darkmagenta" class="size-13">
                                    <i class="fa fa-user"></i>
                                <?=$stdn?>
                                </strong>
                            </td>
                            <td class="text-center">
                                <strong><?=$wn?></strong>
                            </td>
                            <td class="warning text-center">
                                <strong style="color: limegreen" class="size-13">
                                <i class="glyphicon glyphicon-usd"></i>
                                <?=Yii::$app->formatter->asDecimal($pn)?>
                                </strong>
                            </td>
                            <td class="warning text-center">
                                <strong style="color: limegreen" class="size-13">
                                <i class="glyphicon glyphicon-usd"></i>
                                <?=Yii::$app->formatter->asDecimal($pn*4)?>
                                </strong>
                            </td>
                               <?php  //}elseif($sec_program->program_class == '2'){?>

                        </tr>
                        <tr>
                            <td>
                            <div><strong>โครงการพิเศษ</strong></div>
                            </td>
                            <td class="text-center">
                                <?=$req->taTypeWork->ta_type_work_fullname?>
                            </td>
                            <td class="text-center">
                                <strong style="color: darkmagenta" class="size-13">
                                    <i class="fa fa-user"></i>
                                <?=$stdv?>
                                </strong>
                            </td>
                            <td class="text-center">
                                <strong><?=$wv?></strong></td>
                            <td class="warning text-center">
                                <strong style="color: limegreen" class="size-13">
                                <i class="glyphicon glyphicon-usd"></i>
                                <?=Yii::$app->formatter->asDecimal($pv);?>
                                </strong>
                            </td>
                            <td class="warning text-center">
                                <strong style="color: limegreen" class="size-13">
                                <i class="glyphicon glyphicon-usd"></i>
                                <?=Yii::$app->formatter->asDecimal($pv*4);?>
                                </strong>
                            </td>
                               <?php  //}?>
                        </tr>
                        </tbody>
                        <?php  //}?>
                    </table>

                </div>
  <?php  }else{
            echo '<div align="center">
                <strong class="color-red">เกิดข้อผิดพลาดกับข้อมูล</strong>
        </div> ';
            }?>