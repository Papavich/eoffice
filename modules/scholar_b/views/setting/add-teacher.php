<?php

use yii\widgets\ActiveForm;
use app\modules\scholar_b\controllers;
use app\modules\scholar_b\models\model_main\EofficeCentralViewStudentFull;
use app\modules\scholar_b\models\model_main\EofficeCentralViewPisPerson;
use app\models\GetBranch;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

$this->registerJsFile('@web/web_scb/js/tabmenu.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Setting Teacher') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Setting Teacher') ?></li>
    </ol>
</header>
<!-- /page title -->

<div id="content" class="padding-20">
    <div class="row">

        <!-- tabs -->
        <ul class="nav nav-tabs tabmenu" style="margin-left: 14px;">
            <li class="active">
                <a href="#tab1_nobg" data-toggle="tab" aria-expanded="false">
                    <i class="fa fa-plus"></i> ฐานข้อมูลอาจารย์ที่ปรึกษาทุน
                </a>
            </li>
            <li class="">
                <a href="#tab2_nobg" data-toggle="tab" aria-expanded="false">
                    <i class="fa fa-plus"></i> ฐานข้อมูลกรรมการทุน
                </a>
            </li>
        </ul>

        <!-- tabs content -->
        <div class="tab-content transparent">
            <div id="tab1_nobg" class="tab-pane active"><!-- TAB 1 CONTENT -->
                <div class="col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php $form = ActiveForm::begin([
                                'action' => '../setting/addadvisor',
                                'method' => 'post'
                            ]); ?>
                            <h5>รายชื่อนักศึกษาที่ยังไม่มีอาจารย์ที่ปรึกษาทุน</h5>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-2 col-sm-2">
                                        <?= $form->field($model_teachertype, 'year')->dropDownList(controllers\GetModelController::getYear(),
                                            ['prompt' => controllers::t('label', 'Enter Year')]) ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4">
                                        <?php

                                        $getStudent = controllers\GetModelController::getStudent();

                                        $arrayStudent = [];
                                        foreach ($getStudent as $rows) {
                                            $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $rows])->one();
                                            if ($data) {
                                                $arrayStudent[$rows] = $data->PREFIXNAME . "" . $data->STUDENTNAME . " " . $data->STUDENTSURNAME;
                                            }
                                        }
                                        ?>

                                        <?= $form->field($model_std_teac, 'student_id')->dropDownList(($arrayStudent),
                                            [
                                                'prompt' => controllers::t('label', 'Enter Student Name')
                                            ]) ?>

                                    </div>

                                    <div class="col-md-4 col-sm-4">
                                        <?php
                                        $getTeacher = controllers\GetModelController::getTeacher();

                                        $arrayTeacher = [];
                                        foreach ($getTeacher as $rows) {
                                            $data = EofficeCentralViewPisPerson::find()->where(['person_card_id' => $rows])->one();
                                            if ($data) {
                                                $arrayTeacher[$rows] = $data->PREFIXABB . "" . $data->person_name . " " . $data->person_surname;
                                            }
                                        }
                                        ?>
                                        <?= $form->field($model_teachertype, 'teacher_id_card')->dropDownList(($arrayTeacher),
                                            [
                                                'prompt' => controllers::t('label', 'Enter Teacher Name')
                                            ]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4">
                                        <?= $form->field($model_teachertype, 'teacher_type_id')->hiddenInput(['value' => '1'])
                                            ->label(false)->error(false) ?>
                                    </div>

                                    <div class="col-md-10" align="right">
                                        <?= Html::submitButton('<i class="fa fa-save"></i>'
                                            . controllers::t('label', 'Save') . '', ['class' => 'btn btn-success']) ?>
                                    </div>
                                </div>
                            </div>


                            <?php ActiveForm::end() ?>
                        </div>
                    </div><!-- END PANEL DEFALUT -->

                    <!-- Start list student have teacher -->
                    <div class="col-md-14">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <!--  TABLE   -->
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="col-md-6">
                                            <h4>
                                                <b><?php echo controllers::t('label', 'Table Show Student have teacher'); ?></b>
                                            </h4>
                                        </div>
                                        <br><br><br>
                                        <table class="table table-striped table-responsive">

                                            <thead>
                                            <tr>
                                                <th width="10%">ลำดับ
                                                <th width="20%">รหัสนักศึกษา</th>
                                                <th width="20%">ชื่อ-นามสกุล</th>
                                                <th width="20%">สาขาวิชา</th>
                                                <th width="20%">อาจารย์ที่ปรึกษา</th>
                                            </tr>

                                            <tbody>
                                            <?php
                                            $count = 1;
                                            foreach ($model_student as $key => $item) { ?>
                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><?= $item->student_id ?></td>
                                                <td>
                                                    <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item->student_id])->one();
                                                    if ($data) {
                                                        echo $data->PREFIXNAME . '' . $data->STUDENTNAME . ' ' . $data->STUDENTSURNAME;
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item->student_id])->one();
                                                    if ($data) {
                                                        echo $data->major_name;
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php $data = EofficeCentralViewPisPerson::find()->where(['person_card_id' => $item->teacher_id_card])->one();
                                                    if ($data) {
                                                        echo $data->academic_positions_abb_thai . '' . $data->person_name . ' ' . $data->person_surname;
                                                    } ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <?php
                                            $count++;
                                            } ?>
                                        </table>

                                        <!-- pagination -->
                                        <div class="text-center">
                                            <?php
                                            echo LinkPager::widget([
                                                'pagination' => $pages,
                                            ]);
                                            ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End list student have teacher -->

                </div>
            </div><!-- /TAB 1 CONTENT -->

            <div id="tab2_nobg" class="tab-pane"><!-- TAB 2 CONTENT -->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php $form = ActiveForm::begin([
                                'action' => 'addcommittee',
                                'method' => 'post'
                            ]); ?>
                            <h5>แต่งตั้งกรรมการทุน</h5>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-2 col-sm-2">
                                        <?= $form->field($model_teachertype, 'year')->dropDownList(controllers\GetModelController::getYear(),
                                            ['prompt' => controllers::t('label', 'Enter Year')]) ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4">
                                        <?php
                                        $getTeacher = controllers\GetModelController::getTeacher();

                                        $arrayTeacher = [];
                                        foreach ($getTeacher as $rows) {
                                            $data = EofficeCentralViewPisPerson::find()->where(['person_card_id' => $rows])->one();
                                            if ($data) {
                                                $arrayTeacher[$rows] = $data->academic_positions_abb_thai . "" . $data->person_name . " " . $data->person_surname;
                                            }
                                        }
                                        ?>
                                        <?= $form->field($model_teachertype, 'teacher_id_card')->dropDownList(($arrayTeacher),
                                            [
                                                'prompt' => controllers::t('label', 'Enter Teacher Name')
                                            ]) ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4">
                                        <?= $form->field($model_teachertype, 'teacher_type_id')->dropDownList([
                                            'prompt' => controllers::t('label', 'Enter Type Committee'),
                                            '5' => 'หัวหน้ากรรมการ',
                                            '4' => 'กรรมการ',
                                            '6' => 'กรรมการและเลขานุการ',
                                            '7' => 'ผู้ช่วยกรรมการและเลขานุการ'
                                        ]) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-10" align="right">
                                        <?= Html::submitButton('<i class="fa fa-save"></i>'
                                            . controllers::t('label', 'Save') . '', ['class' => 'btn btn-success']) ?>
                                    </div>
                                </div>
                            </div>


                            <?php ActiveForm::end() ?>
                        </div>


                    </div><!-- END PANEL DEFALUT -->

                    <!-- Start list Committee -->
                    <div class="col-md-14">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <!--  TABLE   -->
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="col-md-6">
                                            <h4>
                                                <b><?php echo controllers::t('label', 'Table Show committee'); ?></b>
                                            </h4>
                                        </div>
                                        <br><br><br>
                                        <table class="table table-striped table-responsive">

                                            <thead>
                                            <tr>
                                                <th width="5%">ลำดับ</th>
                                                <th width="20%">ปีการศึกษา</th>
                                                <th width="20%">ชื่อ-นามสกุล</th>
                                                <th width="20%">ตำแหน่ง</th>
                                            </tr>

                                            <tbody>
                                            <?php
                                            $count = 1;
                                            foreach ($model_committee as $item) {
                                                if ($item->teacher_type_id == 4 || $item->teacher_type_id == 5 || $item->teacher_type_id == 6) { ?>
                                                    <tr>
                                                        <td><?= $count ?></td>
                                                        <td><?= $item->year ?></td>
                                                        <td><?php $data = EofficeCentralViewPisPerson::find()->where(['person_card_id' => $item->teacher_id_card])->one();
                                                            if ($data) {
                                                                echo $data->academic_positions_abb_thai . '' . $data->person_name . ' ' . $data->person_surname;
                                                            } ?>
                                                        </td>
                                                        <td><?php if ($item->teacher_type_id == 4 && $item->teacher_type_id != null) {
                                                                echo 'กรรมการ';
                                                            } elseif ($item->teacher_type_id == 5 && $item->teacher_type_id != null) {
                                                                echo 'หัวหน้ากรรมการ';
                                                            } elseif ($item->teacher_type_id == 6 && $item->teacher_type_id != null) {
                                                                echo 'กรรมการและเลขานุการ';
                                                            } else{
                                                                echo 'ไม่มีข้อมูล';
                                                            }?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $count++;
                                                }
                                            } ?>
                                            </tbody>

                                        </table>

                                        <!-- pagination -->
                                        <div class="text-center">
                                            <?php
                                            echo LinkPager::widget([
                                                'pagination' => $pages,
                                            ]);
                                            ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End list Committee -->


                </div>
            </div><!-- /TAB 2 CONTENT -->
        </div>

    </div>
    <!-- /tabs content -->

</div>
<!-- /panel content -->


<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo \kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php endforeach; ?>


