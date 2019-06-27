<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\modules\scholar_b\controllers;

$this->registerJsFile('@web/web_scb/js/list-status.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?= Html::csrfMetaTags() ?>



<?php

$scmain = \app\modules\scholar_b\models\ScbScholarshipType::find()->where(['scholarship_id' => $id])->one();

?>
<!-- /page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Import Candidates List') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li><a href="../candidate/list"><?= controllers::t('label', 'Candidates List') ?></a></li>
        <li class="active"><?= controllers::t('label', 'List') ?></li>
    </ol>
</header>
<!-- /page title -->

<div id="content" class="padding-20">
    <div class="panel-body">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => '../candidate/list-by-sc', 'method' => 'post']); ?>
        <input type="hidden" name="id" value="<?= $id ?>"/>
        <input type="hidden" name="year" value="<?= $year ?>"/>

        <div id="content" class="padding-10">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>นำเข้ารายชื่อผู้สมัคร
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($modelFile, 'file')->fileInput() ?>
                    </div>

                    <div class="col-md-2">
                        <br>
                        <?= Html::submitButton('Save', ['class' => 'btn btn-sm btn-primary']); ?>
                    </div>

                </div>
            </div>
        </div>


        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php if ($enroll) { ?>

<?php $form = ActiveForm::begin(['action' => '../candidate/status', 'id' => 'list_by_sc']); ?>


<div id="content" class="padding-20">
    <div class="panel-body">
        <div class="col-md-12">
            <br>
            <center><h4> <?php echo $scmain->scholarship_name . " ปีการศึกษา " . $year ?> </h4></center>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-12" style="margin-top: 20px">
                    <table id="table1" class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr>
                            <th width="5%"><input type="checkbox" name="check_all" id="check_all" value="1"></th>
                            <th width="5%">ลำดับ</th>
                            <th width="20%">เลขประจำตัวประชาชน</th>
                            <th width="35%">ชื่อ-สกุล</th>
                            <th width="15%">สาขาที่เลือก</th>
                            <th width="10%">สถานะ</th>
                            <th width="10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <input type="hidden" value="<?= sizeof($enroll) ?>" id="sum">
                        <?php
                        $count = 1;
                        foreach ($enroll as $item) {
                            ?>
                            <td><input type="checkbox" name="check[]" id="<?= $count ?>" class="check"></td>
                            <td><?= $count ?></td>
                            <td><input type="hidden" name="id_card[]" id="id_card<?= $count ?>"
                                       value="<?= $item->candidate_id_card ?>"><?php
                                echo $item->candidate_id_card ?></td>
                            <td><?php
                                echo $item->candidateIdCard->prefix . $item->candidateIdCard->firstname . " " . $item->candidateIdCard->lastname;
                                ?></td>
                            <td>

                                <?php
                                $cent_major = \app\modules\scholar_b\models\model_main\EofficeCentralViewPisMajor ::find()->all();
                                $datas = \app\modules\scholar_b\models\ScbSelectMajor ::find()->where(['candidate_id_card' => $item->candidate_id_card, 'scholarship_id' => $item->scholarship_id, 'scholarship_year' => $item->scholarship_year])->all();
                                foreach ($datas as $row) {
                                    echo $row->majorName->name_th . "<br>";
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $item->candidateIdCard->status ?>
                            </td>
                            <td>
                                <center><a class="btn-sm btn-info"
                                           href='../candidate/detailcandidate?id=<?php echo $item->candidate_id_card ?>'>ดูเพิ่มเติม</a>
                                </center>
                            </td>
                            </tr>
                            <?php
                            $count++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="status" id="status_sent">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="year" value="<?= $year ?>">

                <div class="col-md-12">
                    <a class="btn btn-danger status_check" data="1">ไม่ผ่านเกณฑ์</a>
                    <a class="btn btn-warning status_check" data="2">ผู้มีสิทธิ์สอบสัมภาษณ์</a>
                    <a class="btn btn-android status_check" data="3">ผู้มีสิทธิ์เข้าศึกษา</a>
                    <a class="btn btn-success status_check" data="4">รายงานตัวเป็นนักศึกษา</a>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php
            } else {
                echo "
<div id=\"content\" class=\"padding-20\">
    <div class=\"panel-body\">
        <div class=\"col-md-12\"><center><label>ไม่มีผู้สมัครใน" . $scmain->scholarship_name . " ปีการศึกษา $year </label></center></div></div></div>";

            }
            ?>

        </div>
    </div>
</div>