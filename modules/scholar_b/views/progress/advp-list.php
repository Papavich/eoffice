<?php

use app\modules\scholar_b\models\model_main\RegSysbytedes;
use app\modules\scholar_b\models\ScbStudent;
use yii\helpers\Html;
use app\modules\scholar_b\controllers;
use app\modules\scholar_b\models\model_main\EofficeCentralViewStudentFull;
use app\modules\scholar_b\models\ScbScholarshipType;


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
                            รายชื่อนักศึกษาในการดูแลโครงงานที่เสนอรายงานความก้าวหน้า
                        </span>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse in">
                            <div class="panel-body">
                                <div class="tabs nomargin">
                                    <table class="table table-bordered table-striped table-scb">
                                        <thead>
                                        <tr>
                                            <th width="5%">ลำดับ</th>
                                            <th width="10%">รหัสนักศึกษา</th>
                                            <th width="17%">
                                                <p align="center" style="margin: 0px">ชื่อ-นามสกุล</p>
                                            </th>
                                            <th width="5%">ชั้นปี</th>
                                            <th width="5%">สถานะ</th>
                                            <th width="13%">สาขาวิชา</th>
                                            <th width="22%">
                                                <p align="center" style="margin: 0px">ประเภททุน</p>
                                            </th>
                                            <th width="13%">
                                                <p align="center" style="margin: 0px"></p>
                                            </th>
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
                                                <td><?php $data = ScbStudent::find()->where(['student_id' => $item['student_id']])->one();
                                                    $sc_name = ScbScholarshipType::find()->where(['scholarship_id' => $data->scholarship_id])->one();
                                                    if ($data) {
                                                        echo $sc_name->scholarship_name;
                                                    }
                                                    ?></td>
                                                <td>
                                                    <a href="../progress/advp-index?student_id=<?= $item['student_id'] ?>&seq=<?= $seq ?>&sem=<?= $sem ?>&year_select=<?= $year_select ?>"
                                                       class="btn btn-info btn-xs">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <a href="../student/info-full?id=<?= $item['student_id'] ?>"
                                                       class="btn btn-default btn-xs">
                                                        <i class="	glyphicon glyphicon-user"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            <?php $count++;
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <div align="right">
                                        <a class="btn btn-info btn-xs">
                                            <i class="fa fa-eye"></i> ดูรายงานความก้าวหน้า
                                        </a>
                                        <a class="btn btn-default btn-xs">
                                            <i class="	glyphicon glyphicon-user"></i> ดูข้อมูลส่วนตัว
                                        </a>
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