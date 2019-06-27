<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\MajorHasProgram */

$this->title = $model->major_id;
$this->params['breadcrumbs'][] = ['label' => 'Major Has Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<header id="page-header">
    <h1>View Infomation</h1>
    <ol class="breadcrumb">
        <li><a href="#">Add Information</a></li>
        <li class="active">View Position Director</li>
    </ol><br>
    <a href="add-program-major" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a><br>
</header>
<div id="content" class="padding-20">

    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">
                <p>
                    <?= Html::a('Update', ['program-update', 'major_id' => $model->major_id, 'PROGRAMID' => $model->PROGRAMID], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['program-delete', 'major_id' => $model->major_id, 'PROGRAMID' => $model->PROGRAMID], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'major.major_name',
                        'PROGRAMID',
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
