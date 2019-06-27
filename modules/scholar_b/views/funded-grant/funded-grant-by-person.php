<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\scholar_b\controllers;

$this->registerJsFile('@web/web_scb/js/find-student-funded.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>


<?= Html::csrfMetaTags() ?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Funded Grant by person') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li><a href="../funded-grant/index"><?= controllers::t('label', 'Funded Grant') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Funded Grant by person') ?></li>
    </ol>
</header>
<!-- /page title -->
<div id="content" class="padding-20">
    <div class="panel-body">
        <div class="col-md-12">
            <div class="group">
                <div class="row">
                    <div class="col-md-6">
                        <h3>รายงานการเบิกจ่ายนักศึกษาทุน</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label>เลขประจำตัวนักศึกษา</label>
                        <input type="text" id="student_id" name="student_id" class="form-control"
                               value="">
                    </div>
                    <div class="col-md-2">
                        <label>ปีการศึกษา</label>
                        <select id="semester" name="semester" class="form-control pointer required">
                            <option value="0">ทั้งหมด</option>
                            <?php
                            foreach ($year as $row) {
                                $years = $row->year;
                                echo "<option value='" . $years . "'>" . $years . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label>&nbsp;&nbsp;</label><br>
                        <button id="search-funded" type="submit"  class="btn btn-primary btn-3d"><i
                                    class="fa fa-search"></i> ค้นหา
                        </button>
                    </div>


                </div>


                <div class=" row">
                    <div class="col-md-6">
                        <div>
                            <div id="show">
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

    <div class="panel-body">
        <div class="col-md-12" id="funded">

        </div>
    </div>


</div>

