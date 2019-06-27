<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\PublicationOrder */

$this->title = 'Create Publication Order';
$this->params['breadcrumbs'][] = ['label' => 'Publication Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
