<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbStudentHasActivityMain */

$this->title = 'Create Scb Student Has Activity Main';
$this->params['breadcrumbs'][] = ['label' => 'Scb Student Has Activity Mains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scb-student-has-activity-main-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
