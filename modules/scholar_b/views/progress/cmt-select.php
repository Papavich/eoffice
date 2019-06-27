<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 8/5/2561
 * Time: 1:48
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<?php $form = ActiveForm::begin([
    'action' => ['cmt-list'],
    'method' => 'get',
]); ?>
    <div class="scb-progress-report-select">
        <div id="content" class="padding-20">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <center><h4>รายงานความก้าวหน้า</h4></center>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3" align="center"></div>
                    <div class="col-md-8" align="center">
                        <div class="col-md-4">
                            <label>ปีการศึกษา</label>
                            <select name="year" class="form-control select2 required">
                                <option disabled selected value>เลือกปี</option>
                                <?php
                                foreach ($year as $rows) {
                                    $year = $rows->year;
                                    echo "<option value='" . $year . "'>" . $year . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>ภาคการศึกษา</label>
                            <select id="sem" name="sem" class="form-control select2 required">
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
                            <label>ครั้งที่</label>
                            <select name="seq" class="form-control select2 required">
                                <option disabled selected value>--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group" align="center">
                        <div class="col-md-12">
                            <?= Html::submitButton('<i class="glyphicon glyphicon-check"></i>' . 'Confirm', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>