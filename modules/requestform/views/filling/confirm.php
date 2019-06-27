<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\modules\requestform\models\ReqType;
use app\modules\requestform\models\ReqCategory;


/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = 'ยื่นแบบฟอร์มใหม่';
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <div id="content" class="padding-20">

        <div class="row">
            <div class="create-form">
                <?php $form = ActiveForm::begin(['action' => 'save']);?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Next' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
