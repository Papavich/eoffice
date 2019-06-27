<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaComment */

$this->title = 'Create Ta Comment';
$this->params['breadcrumbs'][] = ['label' => 'Ta Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-comment-create">
<div class="panel-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div></div>
