<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
?>

<div id="panel-1" class="panel panel-default">
    <div class="panel-heading">
      <span class="title elipsis">
        <strong class="size-20">จัดทำรายงาน</strong> <!-- panel title -->
      </span>

    </div>
    <!-- panel content -->
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel-body">
        <strong style="padding-left: 18px;">ช่วงเวลาการจัดทำรายงาน</strong>
        <div style="padding-left: 250px;">
            <div class="row">

                <div class="col-md-3">
                    <input type="text" name="startDate" id="startDate" class="form-control datepicker" value='<?php echo $exam_detail_date_start;?>' data-format="yyyy-mm-dd" data-lang="en"  data-RTL="false">
                </div>

                <div class="col-md-1">
                    <strong><center>ถึง</center></strong><br/>
                </div>

                <div class="col-md-3">
                    <input type="text" name="endDate" id="endDate" class="form-control datepicker" value="<?php echo $exam_detail_date_end; ?>" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                </div>
            </div>
        </div>
        <br/>
        <br/>
        <div style="margin-left: 430px;">
            <?= Html::a('ยืนยัน', ['excel-room'], ['class'=>'btn btn-success btn-lg','data-method' => 'post']) ?>
        </div>
<?php ActiveForm::end(); ?>