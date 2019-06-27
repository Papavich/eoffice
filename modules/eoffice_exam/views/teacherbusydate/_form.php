<?php

use kartik\widgets\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamBusydate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eoffice-exam-busydate-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'exam_busydate_date', [
    ])->widget(DatePicker::classname(),[
      'options' => ['placeholder' => ''],
      'value' => date('yyyy-mm-dd'),
      'type' => DatePicker::TYPE_COMPONENT_APPEND,
      'readonly' => true,
      'pluginOptions' => [
      'format' => 'yyyy-mm-dd',
      'todayHighlight' => TRUE,
    ]
    ])
    ?>

    <?= $form->field($model, 'exam_busydate_time')->dropDownList(
    			['เช้า' => 'เช้า (08.00 -12.00 น.)',
           'บ่าย' => 'บ่าย (13.00 -17.00 น.)'
          ])
    ?>

    <?= $form->field($model, 'exam_busydate_note')->dropDownList(
    			['ติดประชุม' => 'ติดประชุม',
           'เดินทางไปต่างประเทศ' => 'เดินทางไปต่างประเทศ',
           'เดินทางไปราชการด่วน' => 'เดินทางไปราชการด่วน',
           'ลากิจส่วนตัว' => 'ลากิจส่วนตัว',
           'อื่นๆ' => 'อื่นๆ',
         ],['prompt'=>'select...',
         // 'id' => 'note',
         'onchange'=>'java_script_:show(this.options[this.selectedIndex].value)'])
?>

<!-- <div id='note'>

</div> -->
    <?= $form->field($model, 'exam_busy_file')->fileInput(['multiple' => true]) ?>

    <?= $form->field($model, 'person_id')->hiddenInput(['value'=>Yii::$app->user->identity->person_id])->label(''); ?>


    <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'เพิ่มข้อมูล') : Yii::t('app', 'แก้ไขข้อมูล'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<script type="text/javascript">

function show(select_item) {
	    if (select_item == "อื่นๆ") {
		    note.style.disabled='true';
			note.style.display='true';
		}
		else{
			note.style.disabled='fault';
			note.style.display='none';
		}
	}

            // $(document).ready(function(){
            //     $("#note").change(function(){
            //         $(this).find("option:selected").each(function(){
            //             if($(this).attr("value")=="อื่นๆ"){
            //                 $(".box").not(".1").hide();
            //                 $(".1").show();
            //             }
            //           }
            //         }
            //       }
</script>
