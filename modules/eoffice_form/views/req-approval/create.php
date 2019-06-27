<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ReqApproval */

$this->title = 'Create Req Approval';
$this->params['breadcrumbs'][] = ['label' => 'Req Approvals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="req-approval-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
