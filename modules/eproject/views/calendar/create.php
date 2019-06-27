<?php

use app\modules\eproject\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eproject\models\Calendar */


$this->title =controllers::t( 'label', 'Create Schedule' );
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'Calendar' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
