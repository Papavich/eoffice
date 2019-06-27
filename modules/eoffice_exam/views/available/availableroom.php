<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_exam\models\ViewRoom;
use app\modules\eoffice_exam\models\ExamRoomDetail;

?>
<div id="panel-1" class="panel panel-default">
    <div class="panel-heading">
      <span class="title elipsis">
        <strong class="size-20">ตรวจสอบข้อมูลห้อง</strong> <!-- panel title -->
      </span>


    </div>

    <!-- panel content -->
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel-body">

         <div class="row">
            <div class="col-lg-8" style="padding-left: 350px;">วันที่
                <input type="text" name="date" id="date" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en"  data-RTL="false">
            </div>
         </div>

        <div class="row">
            <div class="col-lg-8 " style="padding-left: 350px;">
                <?php
                echo $form->field($model, 'rooms_id')->dropDownList(
                    ['empty'=>'Select...',$listData]

                ); ?>
            </div>
        </div>

            <div class="row">
                <div style="padding-left: 470px;" >
                    <?= Html::a(' ยืนยัน ', ['getvalue'],
                        ['class'=>'btn btn-success btn-xl','data-method' => 'post']) ?>
                </div>
            </div>

      </div>

      <div align="right">

      </div>
    </div>

    <br/>

<?php ActiveForm::end(); ?>


<script type="text/javascript">
$(document).ready(function(){
    $('#date').change(function(){

    var date = $('#date').val();
    var x=0;


var check = date.split("-");




var today2 = today.split("-");


if(check[0]==today2[0])
{
if(check[1]==today2[1])
{
if(check[2]==today2[2])
{

}
}
}

if(check[0]<today2[0])
{
x=x+1;
}

if(check[0]==today2[0])
{
if(check[1]<today2[1])
{
 x=x+1;
}
}

if(check[0]==today2[0])
{
if(check[1]==today2[1])
{
 if(check[2]<today2[2])
{
 x=x+1;
}
}
}

if (x!=0)
{
document.getElementById("submit_medical").disabled = true;
}
else
{
document.getElementById("submit_medical").disabled = false;
}

});
    });
</script>
