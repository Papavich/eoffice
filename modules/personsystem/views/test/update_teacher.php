<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\Person */

$this->title = Yii::t('app', 'Update Person: {nameAttribute}', [
    'nameAttribute' => $model->person_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->person_id, 'url' => ['view', 'id' => $model->person_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="person-update">
    <?= $this->render('teacher_form', [
        'model' => $model,
        'dataProviderEdu'=>$dataProviderEdu,
        'searchModelEdu'=>$searchModelEdu,
        'searchModelExper' => $searchModelExper,
        'dataProviderExper' => $dataProviderExper,
        'modelExper'=>$modelExper,
    ]) ?>
</div>