<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsDocDept */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Cms Doc To Dept',
    ]) . $model->doc_dept_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms Doc To Depts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->doc_dept_id, 'url' => ['view', 'doc_dept_id' => $model->doc_dept_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cms-doc-to-dept-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
