<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsDocType */

$this->title = Yii::t('app', 'Create Cms Doc Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms Doc Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-doc-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
