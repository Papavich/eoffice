<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsDocSpeed */

$this->title = Yii::t('app', 'Create Cms Doc Speed');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms Doc Speeds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-doc-speed-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
