<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsDocSecret */

$this->title = Yii::t('app', 'Create Cms Doc Secret');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms Doc Secrets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-doc-secret-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
