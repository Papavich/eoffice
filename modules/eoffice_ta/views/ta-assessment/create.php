<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaAssessment */

$this->title = 'Create Ta Assessment';
$this->params['breadcrumbs'][] = ['label' => 'Ta Assessments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-assessment-create">

    <div class="panel-body">
        <h4 class="alert alert-info">สร้างแบบฟอร์มประเมิน</h4>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>

