<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\Expertise */
$this->title = Yii::t('app', 'Update Expertise: {nameAttribute}', [
    'nameAttribute' => $model->expertise_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Expertises'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->expertise_id, 'url' => ['view', 'id' => $model->expertise_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<header id="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="#">Teacher Information </a></li>
        <li class="active">Update History Education</li>
    </ol><br>
    <a href="admin-update-teacher?id=<?php echo $model->person_id; ?>&active=3" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a><br>
</header>
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">
<div class="expertise-update">
    <?= $this->render('exper_form', [
        'model' => $model,
    ]) ?>
</div>
            </div>
        </div>
    </div>
</div>
