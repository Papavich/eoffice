<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eproject\models\DocumentType */

$this->title = \app\modules\eproject\controllers::t('label','Create Document Type');
$this->params['breadcrumbs'][] = ['label' => \app\modules\eproject\controllers::t('label','Document Type'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-type-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
