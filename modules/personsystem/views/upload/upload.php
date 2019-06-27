<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
?>
    <header id="page-header">
        <h1>Import Personal Information</h1>
        <ol class="breadcrumb">
            <li><a href="#">Import</a></li>
            <li class="active">Import Personal Information</li>
        </ol>
    </header>
    <div id="content" class="padding-20">
    <div class="row">
    <div class="col-md-12">
    <!-- ------ -->
    <div class="panel panel-default">

    <div class="panel-body">
    <br>


<?php
$form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data'],'method' => 'get', 'action' => 'import-excel',]);

?>



<?= $form->field($model,'file')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save',['class'=>'btn btn-primary','id'=>'submit']) ?>
    </div>
<?php ActiveForm::end(); ?>
    </div>
        <?php if(isset($test)){
            echo $test . "Upload File Success";
        }
            ?>
  </div>
    </div>
    </div>
    </div>



