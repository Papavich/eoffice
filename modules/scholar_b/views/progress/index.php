<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\scholar_b\models\ScbProgressReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scb Progress Reports';

?>
<?php $form = ActiveForm::begin(); ?>
<div class="scb-progress-report-index">
    <div id="content" class="padding-20">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                <h4>รายงานความก้าวหน้า</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                    <label>ครั้งที่</label>
                    <select name="seq" class="form-control pointer required">
                        <option disabled selected value>--</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="5">6</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>ภาคการศึกษา</label>
                    <select id="semester" name="semester" class="form-control pointer required">
                        <option disabled selected value>เลือกเทอม</option>
                        <?php
                        foreach ($semester as $row) {
                            $sem = $row->semester;
                            echo "<option value='" . $sem . "'>" . $sem . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>ปีการศึกษา</label>
                    <select  name="year" class="form-control pointer required">
                        <option disabled selected value>เลือกปี</option>
                        <?php
                        foreach ($year as $rows) {
                            $year = $rows->year;
                            echo "<option value='" . $year . "'>" . $year . "</option>";
                        }
                        ?>
                    </select>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

<?php ActiveForm::end(); ?>
