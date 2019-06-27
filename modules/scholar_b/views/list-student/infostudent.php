<?php

use app\modules\scholar_b\models\model_main\RegSysbytedes;
use app\modules\scholar_b\models\ScbStudent;
use yii\helpers\Html;
use app\modules\scholar_b\controllers;
use app\modules\scholar_b\components\AuthHelper;
use yii\widgets\LinkPager;
use app\modules\scholar_b\models\model_main\EofficeCentralViewStudentFull;
use app\modules\scholar_b\models\ScbScholarshipType;
use app\modules\scholar_b\models\model_main\EofficeCentralViewPisUser;
use app\modules\scholar_b\models\ScbTeacherHasProject;
use app\modules\scholar_b\models\ScbProject;
use app\modules\scholar_b\models\ScbStudentHasProject;
use yii\grid\GridView;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->registerJsFile('@web/web_scb/js/sweetalert.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/web_scb/js/tabmenu.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerCssFile("@web/web_pms/plugins/dataTable/dataTables.bootstrap.min.css");
$this->registerCssFile("@web/assets/css/layout-datatables.css");

$this->registerJsFile('@web/web_pms/plugins/dataTable/jquery.dataTables.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/web_pms/plugins/dataTable/dataTables.bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


?>

    <style>
        * {
            box-sizing: border-box;
        }

        .zoom {
            padding: auto;
            background-color: white;
            transition: transform .2s;
            width: auto;
            height: auto;
            margin: 0 auto;
        }

        .zoom:hover {
            -ms-transform: scale(1.5); /* IE 9 */
            -webkit-transform: scale(1.5); /* Safari 3-8 */
            transform: scale(1.5);
        }
    </style>

<?= Html::csrfMetaTags() ?>
    <!-- page title -->
    <header id="page-header">
        <h1><?= controllers::t('label', 'List Student') ?></h1>
        <ol class="breadcrumb">
            <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
            <li class="active"><?= controllers::t('label', 'List Student') ?></li>
        </ol>
    </header>
    <!-- /page title -->

    <div class="scb-activity-main-index">
        <div id="content" class="padding-20">
            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <span>
                            <i class="fa fa-tag"></i>
                            <?= controllers::t('label', 'List Student') ?>
                            </a>
                        </span>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse in">
                            <div class="panel-body">
                                <div class="tabs nomargin">

                                    <!-- tabs -->
                                    <ul class="nav nav-tabs nav-justified tabmenu">
                                        <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Staff) { ?>
                                            <li class="active">
                                                <a href="#jtab1_nobg" data-toggle="tab" aria-expanded="false">
                                                    <i class="fa fa-bars"></i> รายชื่อนักศึกษาทุนทั้งหมด
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Teacher) { ?>
                                            <li class="active">
                                                <a href="#jtab2_nobg" data-toggle="tab" aria-expanded="false">
                                                    <i class="fa fa-bars"></i> รายชื่อนักศึกษาทุนในสังกัด
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#jtab3_nobg" data-toggle="tab" aria-expanded="false">
                                                    <i class="fa fa-bars"></i> รายชื่อนักศึกษาโปรเจค
                                                </a>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                    <!-- tabs content -->
                                    <div class="tab-content transparent">
                                        <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Staff) { ?>
                                            <!--START TAB1 แสดงรายชื่อนักศึกษาทุน -->
                                            <div id="jtab1_nobg" class="tab-pane active"><!-- TAB 1 CONTENT -->
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-8">
                                                        <?php $form = ActiveForm::begin([
                                                            'class' => 'horizontal',
                                                            'method' => 'get',
                                                        ]); ?>
                                                        <?php
                                                        $terms = ScbScholarshipType::find()->orderBy(['scholarship_id' => SORT_DESC])->all();
                                                        foreach ($terms as $term) {
                                                        }
                                                        echo Select2::widget([
                                                            'name' => 'scholarship_name',
                                                            'value' => $term->scholarship_id,
                                                            'theme' => Select2::THEME_DEFAULT,
                                                            'options' => [
                                                                'placeholder' => 'Select type scholarship',
                                                                'multiple' => false],
                                                            'data' => ArrayHelper::map(ScbScholarshipType::find()->all(), 'scholarship_id', 'scholarship_name'),

                                                        ]);
                                                        $term_name2 = \Yii::$app->request->get('scholarship_name');
                                                        ?>
                                                    </div>
                                                    <div class="col-md-1 col-sm-1">
                                                        <?= Html::submitButton('<i class="fa fa-search"></i>' . controllers::t('label', 'Search'), ['class' => 'btn btn-blue']) ?>
                                                    </div>
                                                    <?php ActiveForm::end(); ?>
                                                </div>
                                                <br>

                                                <table id="" class="table table-bordered table-striped table-scb">
                                                    <thead>
                                                    <tr>
                                                        <th width="5%">ลำดับ</th>
                                                        <th width="10%">รหัสนักศึกษา</th>
                                                        <th width="20%">
                                                            <p align="center" style="margin: 0px">ชื่อ-นามสกุล</p>
                                                        </th>
                                                        <th width="10%">สถานะ</th>
                                                        <th width="5%">ชั้นปี</th>
                                                        <th width="10%">สาขาวิชา</th>
                                                        <th width="15%">
                                                            <p align="center" style="margin: 0px">ประเภททุน</p>
                                                        </th>
                                                        <th width="10%">
                                                            <p align="center" style="margin: 0px">#</p>
                                                        </th>
                                                        <th width="5%"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $count = 1;
                                                    foreach ($list_student as $key => $item) { ?>
                                                        <tr>
                                                            <td><?= $count ?></td>
                                                            <td><?= $item->student_id ?></td>
                                                            <td>
                                                                <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item->student_id])->one();
                                                                if ($data) {
                                                                    echo $data->PREFIXNAME . ' ' . $data->STUDENTNAME . ' ' . $data->STUDENTSURNAME;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item->student_id])->one();
                                                                if ($data) {
                                                                    $namestatus = RegSysbytedes::find()
                                                                        ->where(['reg_sysbytedes.TABLENAME' => "STUDENTSTATUS", 'reg_sysbytedes.COLUMNNAME' => "STUDENTSTATUS"])
                                                                        ->andWhere(['BYTECODE' => $data->STUDENTSTATUS])
                                                                        ->one();
                                                                    if ($namestatus->BYTECODE == 10 && $namestatus->BYTECODE != null) {
                                                                        echo '<span class="label label-sm label-success"><b>นักศึกษาปกติ</b></span>';
                                                                    } elseif ($namestatus->BYTECODE == 11 && $namestatus->BYTECODE != null) {
                                                                        echo '<span class="label label-sm label-default"><b>รักษาสภาพนักศึกษา</b></span>';
                                                                    } elseif ($namestatus->BYTECODE == 40 && $namestatus->BYTECODE != null) {
                                                                        echo '<span class="label label-sm label-info"><b>สำเร็จการศึกษา</b></span>';
                                                                    } elseif ($namestatus->BYTECODE != null) {
                                                                        echo '<span class="label label-sm label-primary"><b>พ้นสภาพนักศึกษา</b></span>';
                                                                    } else {
                                                                        echo '<span style="color:red;">ไม่มีข้อมูล</span>';
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item->student_id])->one();
                                                                if ($data) {
                                                                    echo $data->STUDENTYEAR;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item->student_id])->one();
                                                                if ($data) {
                                                                    echo $data->major_name;
                                                                }
                                                                ?>
                                                            </td>
                                                            <?php
                                                            $scbtype1 = ScbScholarshipType::findOne([$item->student->scholarship_id]);
                                                            $scbtype_name = $scbtype1->scholarship_name;
                                                            ?>
                                                            <td><?= $scbtype_name ?> </td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <?php $count++;
                                                    } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>
                                        <!-- END TAB 1 -->


                                        <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Teacher) { ?>
                                            <!-- START TAB2 หน้าอัพโหลดหลักฐานการเข้าร่วมกิจกรรม-->
                                            <div id="jtab2_nobg" class="tab-pane active">
                                                <table class="table table-bordered table-striped example table-scb">
                                                    <thead>
                                                    <tr>
                                                        <th width="5%">ลำดับ</th>
                                                        <th width="10%">รหัสนักศึกษา</th>
                                                        <th width="20%">
                                                            <p align="center" style="margin: 0px">ชื่อ-นามสกุล</p>
                                                        </th>
                                                        <th width="10%">สถานะ</th>
                                                        <th width="5%">ชั้นปี</th>
                                                        <th width="10%">สาขาวิชา</th>
                                                        <th width="15%">
                                                            <p align="center" style="margin: 0px">ประเภททุน</p>
                                                        </th>
                                                        <th width="5%"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $count = 1;
                                                    foreach ($list_student_teacher as $key => $item) { ?>
                                                        <tr>
                                                            <td><?= $count ?></td>
                                                            <td><?= $item->student_id ?></td>
                                                            <td>
                                                                <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item->student_id])->one();
                                                                if ($data) {
                                                                    echo $data->PREFIXNAME . ' ' . $data->STUDENTNAME . ' ' . $data->STUDENTSURNAME;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item->student_id])->one();
                                                                if ($data) {
                                                                    $namestatus = RegSysbytedes::find()
                                                                        ->where(['reg_sysbytedes.TABLENAME' => "STUDENTSTATUS", 'reg_sysbytedes.COLUMNNAME' => "STUDENTSTATUS"])
                                                                        ->andWhere(['BYTECODE' => $data->STUDENTSTATUS])
                                                                        ->one();
                                                                    if ($namestatus->BYTECODE == 10 && $namestatus->BYTECODE != null) {
                                                                        echo '<span class="label label-sm label-success"><b>นักศึกษาปกติ</b></span>';
                                                                    } elseif ($namestatus->BYTECODE == 11 && $namestatus->BYTECODE != null) {
                                                                        echo '<span class="label label-sm label-default"><b>รักษาสภาพนักศึกษา</b></span>';
                                                                    } elseif ($namestatus->BYTECODE == 40 && $namestatus->BYTECODE != null) {
                                                                        echo '<span class="label label-sm label-info"><b>สำเร็จการศึกษา</b></span>';
                                                                    } elseif ($namestatus->BYTECODE != null) {
                                                                        echo '<span class="label label-sm label-primary"><b>พ้นสภาพนักศึกษา</b></span>';
                                                                    } else {
                                                                        echo '<span style="color:red;">ไม่มีข้อมูล</span>';
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item->student_id])->one();
                                                                if ($data) {
                                                                    echo $data->STUDENTYEAR;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item->student_id])->one();
                                                                if ($data) {
                                                                    echo $data->major_name;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?= ScbScholarshipType::findOne($item->student->scholarship_id)->scholarship_name ?></td>
                                                            <td></td>
                                                        </tr>
                                                        <?php $count++;
                                                    } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- END TAB 2 -->


                                            <!-- START TAB3 รายชื่อนักศึกษาโปรเจค-->
                                            <div id="jtab3_nobg" class="tab-pane">
                                                <table class="table table-bordered table-striped table-scb">
                                                    <thead>
                                                    <tr>
                                                        <th width="5%">ลำดับ</th>
                                                        <th width="10%">รหัสนักศึกษา</th>
                                                        <th width="20%">
                                                            <p align="center" style="margin: 0px">ชื่อ-นามสกุล</p>
                                                        </th>
                                                        <th width="5%">ชั้นปี</th>
                                                        <th width="10%">สถานะ</th>
                                                        <th width="10%">สาขาวิชา</th>
                                                        <th width="15%">
                                                            <p align="center" style="margin: 0px">หัวข้อโปรเจค</p>
                                                        </th>
                                                        <th width="5%"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $count = 1;


                                                    foreach ($teacher as $item) {
                                                        ?>

                                                        <tr>
                                                            <td><?= $count ?></td>
                                                            <td><?php echo $item['student_id'] ?></td>
                                                            <td>
                                                                <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item['student_id']])->one();
                                                                if ($data) {
                                                                    echo $data->PREFIXNAME . ' ' . $data->STUDENTNAME . ' ' . $data->STUDENTSURNAME;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item['student_id']])->one();
                                                                if ($data) {
                                                                    echo $data->STUDENTYEAR;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item['student_id']])->one();
                                                                if ($data) {
                                                                    $namestatus = RegSysbytedes::find()
                                                                        ->where(['reg_sysbytedes.TABLENAME' => "STUDENTSTATUS", 'reg_sysbytedes.COLUMNNAME' => "STUDENTSTATUS"])
                                                                        ->andWhere(['BYTECODE' => $data->STUDENTSTATUS])
                                                                        ->one();
                                                                    if ($namestatus->BYTECODE == 10 && $namestatus->BYTECODE != null) {
                                                                        echo '<span class="label label-sm label-success"><b>นักศึกษาปกติ</b></span>';
                                                                    } elseif ($namestatus->BYTECODE == 11 && $namestatus->BYTECODE != null) {
                                                                        echo '<span class="label label-sm label-default"><b>รักษาสภาพนักศึกษา</b></span>';
                                                                    } elseif ($namestatus->BYTECODE == 40 && $namestatus->BYTECODE != null) {
                                                                        echo '<span class="label label-sm label-info"><b>สำเร็จการศึกษา</b></span>';
                                                                    } elseif ($namestatus->BYTECODE != null) {
                                                                        echo '<span class="label label-sm label-primary"><b>พ้นสภาพนักศึกษา</b></span>';
                                                                    } else {
                                                                        echo '<span style="color:red;">ไม่มีข้อมูล</span>';
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item['student_id']])->one();
                                                                if ($data) {
                                                                    echo $data->major_name;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php $data = ScbStudentHasProject::find()->where(['student_id' => $item['student_id']])->one();
                                                                    $sc_name = ScbProject::find()->where(['project_code' => $data->project_code])->all();
                                                                foreach ($sc_name as $rows) {
                                                                    if ($rows) {
                                                                        echo $rows->project_name;
                                                                    }
                                                                }
                                                                ?></td>
                                                            <td></td>
                                                        </tr>

                                                        <?php $count++;
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>
                                        <!-- END TAB 3-->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php

$this->registerJs(<<<JS
   $('.table-scb').DataTable({
                "ordering": false
            });
JS
);
?>