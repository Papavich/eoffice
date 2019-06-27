<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_consult\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>

     <div class="col-sm-12">

       <?= DetailView::widget([
           'model' => $model,
           'attributes' => [
               'question_one',
           ],
       ]) ?>
       <?= $form->field($model, 'question_one')->radio(['label' => 'น้อยมาก', 'value' => 1, 'uncheck' => null]) ?>
       <?= $form->field($model, 'question_one')->radio(['label' => 'น้อย', 'value' => 2, 'uncheck' => null]) ?>
       <?= $form->field($model, 'question_one')->radio(['label' => 'ปานกลาง', 'value' => 3, 'uncheck' => null]) ?>
       <?= $form->field($model, 'question_one')->radio(['label' => 'มาก', 'value' => 4, 'uncheck' => null]) ?>
       <?= $form->field($model, 'question_one')->radio(['label' => 'มากที่สุด', 'value' => 5, 'uncheck' => null]) ?>
   </div>




    <div class="col-sm-12">
      <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              'question_two',
          ],
      ]) ?>
      <?= $form->field($model, 'question_two')->radio(['label' => 'น้อยมาก', 'value' => 1, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_two')->radio(['label' => 'น้อย', 'value' => 2, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_two')->radio(['label' => 'ปานกลาง', 'value' => 3, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_two')->radio(['label' => 'มาก', 'value' => 4, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_two')->radio(['label' => 'มากที่สุด', 'value' => 5, 'uncheck' => null]) ?>
  </div>



    <div class="col-sm-12">
      <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              'question_three',
          ],
      ]) ?>
      <?= $form->field($model, 'question_three')->radio(['label' => 'น้อยมาก', 'value' => 1, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_three')->radio(['label' => 'น้อย', 'value' => 2, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_three')->radio(['label' => 'ปานกลาง', 'value' => 3, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_three')->radio(['label' => 'มาก', 'value' => 4, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_three')->radio(['label' => 'มากที่สุด', 'value' => 5, 'uncheck' => null]) ?>
  </div>



    <div class="col-sm-12">
      <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              'question_four',
          ],
      ]) ?>
      <?= $form->field($model, 'question_four')->radio(['label' => 'น้อยมาก', 'value' => 1, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_four')->radio(['label' => 'น้อย', 'value' => 2, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_four')->radio(['label' => 'ปานกลาง', 'value' => 3, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_four')->radio(['label' => 'มาก', 'value' => 4, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_four')->radio(['label' => 'มากที่สุด', 'value' => 5, 'uncheck' => null]) ?>
  </div>



    <div class="col-sm-12">
      <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              'question_five',
          ],
      ]) ?>
      <?= $form->field($model, 'question_five')->radio(['label' => 'น้อยมาก', 'value' => 1, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_five')->radio(['label' => 'น้อย', 'value' => 2, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_five')->radio(['label' => 'ปานกลาง', 'value' => 3, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_five')->radio(['label' => 'มาก', 'value' => 4, 'uncheck' => null]) ?>
      <?= $form->field($model, 'question_five')->radio(['label' => 'มากที่สุด', 'value' => 5, 'uncheck' => null]) ?>
  </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
