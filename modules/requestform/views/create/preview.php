<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = 'สร้างแบบฟอร์มใหม่';
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $this->registerJsFile('cseofficekku/modules/requestform/assets/js/dynamic-form.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>



    <?php $form = ActiveForm::begin(['action' => 'save']);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'ยืนยัน' : 'Create', ['class' => $model->isNewRecord ? 'btn btn-3d btn-reveal btn-green' : 'btn btn-3d btn-reveal btn-green']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
</div>
