<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ReqTracking */

$this->title = 'Create Req Tracking';
$this->params['breadcrumbs'][] = ['label' => 'Req Trackings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="req-tracking-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
