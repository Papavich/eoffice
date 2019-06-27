<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\widgets\DateTimePicker;
use app\modules\scholar_b\controllers;


?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Add Event') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class=""><a href="../calendar/index"><?= controllers::t('label', 'Event') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Add Event') ?></li>
    </ol>
</header>
<!-- /page title -->
<div class="scb-calendar-create">
    <div id="content" class="padding-20">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-body">
                    <div class="container">

                        <?php $form = ActiveForm::begin([
                            'action' => '../calendar/create',
                            'method' => 'post',
                        ]); ?>

                        <form role="form" action="" method="post">

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-8 col-sm-8">
                                        <?= $form->field($model, 'calendar_topic')->textInput(['placeholder' => 'หัวข้อ',]) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-8 col-sm-8">
                                        <?= $form->field($model, 'calendar_detail')->textarea([
                                            'rows' => '8',
                                            'placeholder' => 'รายละเอียด']) ?>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <?= $form->field($model, 'calendar_date_start')->widget(\yii\jui\DatePicker::className(), [
                                            'language' => 'th',
                                            'dateFormat' => 'yyyy-MM-dd',
                                            'options' => ['class' => 'form-control',
                                                'placeholder' => 'วันที่เริ่ม']
                                        ]) ?>
                                    </div>

                                    <div class="col-md-4">
                                        <?= $form->field($model, 'calendar_date_end')->widget(\yii\jui\DatePicker::className(), [
                                            'language' => 'th',
                                            'dateFormat' => 'yyyy-MM-dd',
                                            'options' => ['class' => 'form-control',
                                                'placeholder' => 'วันที่สิ้นสุด']
                                        ]) ?>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-8" align="right">
                                    <?= Html::submitButton('<i class="fa fa-save"></i>'.controllers::t( 'label', 'Save' ).'', ['class' => 'btn btn-success'] )  ?>
                                </div>
                            </div>
                            <?= $form->field($model, 'staff_id_card')->hiddenInput(['value' => Yii::$app->user->identity->username])
                                ->label(false)->error(false) ?>
                        </form>
                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--Get all flash messages and loop through them -->
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