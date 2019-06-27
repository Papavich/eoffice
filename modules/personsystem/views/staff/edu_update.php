<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\HistoryEducation */

$this->title = Yii::t('app', 'Update History Education: {nameAttribute}', [
    'nameAttribute' => $model->history_education_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'History Educations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->history_education_id, 'url' => ['view', 'id' => $model->history_education_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<header id="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="#">Staff Information </a></li>
        <li class="active">Update History Education</li>
    </ol><br>
    <a href="edu-view?id=<?php echo $model->history_education_id; ?>" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a><br>
</header>
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">
<div class="history-education-update">
    <?= $this->render('edu_form', [
        'model' => $model,
    ]) ?>

</div>
            </div>
        </div>
    </div>
</div>
