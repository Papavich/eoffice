<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsDocFromDept */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cms Doc From Dept',
]) . $model->doc_from_dept_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms Doc From Depts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->doc_from_dept_id, 'url' => ['view', 'doc_from_dept_id' => $model->doc_from_dept_id, 'doc_id' => $model->doc_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cms-doc-from-dept-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
