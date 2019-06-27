<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eproject\models\DocumentType */

$this->title = \app\modules\eproject\controllers::t('label','Update Document Type');
$this->params['breadcrumbs'][] = ['label' => \app\modules\eproject\controllers::t('label','Document Type'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = \app\modules\eproject\controllers::t('label','Update');
?>
<div class="document-type-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
