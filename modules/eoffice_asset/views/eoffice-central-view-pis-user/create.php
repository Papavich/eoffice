<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\EofficeCentralViewPisUser */

$this->title = 'Create Eoffice Central View Pis User';
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Central View Pis Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-central-view-pis-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
