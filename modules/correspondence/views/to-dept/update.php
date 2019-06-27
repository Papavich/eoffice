<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsDocToDept */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cms Doc To Dept',
]) . $model->doc_to_dept_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms Doc To Depts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->doc_to_dept_id, 'url' => ['view', 'doc_to_dept_id' => $model->doc_to_dept_id, 'doc_id' => $model->doc_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cms-doc-to-dept-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
