<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetGet */

$this->title = 'Create Asset Get';
$this->params['breadcrumbs'][] = ['label' => 'Asset Gets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-get-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
