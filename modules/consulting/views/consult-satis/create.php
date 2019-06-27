<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultSatis */

$this->title = 'Create Consult Satis';
$this->params['breadcrumbs'][] = ['label' => 'Consult Satis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-satis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
