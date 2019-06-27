<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\personsystem\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\HistoryEducation */

$this->title = $model->history_education_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'History Educations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<header id="page-header">
    <h1>View Infomation</h1>
    <ol class="breadcrumb">
        <li><a href="#">Add Information</a></li>
        <li class="active">View Period</li>
    </ol><br>
    <a href="admin-update-staff?id=<?php echo $model->person_id; ?>&active=2" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a><br>
</header>
<?= Html::csrfMetaTags() ?>
    <div id="content" class="padding-20">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-body">
                    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['edu-update', 'id' => $model->history_education_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['edu-delete', 'id' => $model->history_education_id,'person'=>$model->person_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?></p>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'level_education',
        'educational_background',
        'educational_background_eng',
        'educational_institution',
        'educational_institution_eng',
        'graduate_year',
    ],
]) ?>
                </div>
            </div>
        </div>
    </div>
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo \kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php endforeach; ?>