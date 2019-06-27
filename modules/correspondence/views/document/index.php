<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \app\modules\correspondence\controllers;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\correspondence\models\DocumentGridView */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cms Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-document-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cms Document', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=  GridView::widget([
        'tableOptions' => [
            'class' => 'table table-striped table-hover table-bordered',
            'width'=>'100%',
            'cellspacing'=> '0'
        ],
        'dataProvider' => $dataProvider,
        'columns' => [
/*            [
                'label' => controllers::t('menu', 'Sending number'),
                'attribute' => 'cmsDocRollSends',
                'value' => function ($model, $key, $index, $column) {
                       foreach ($model->cmsDocRollSends as $send_id){
                           return
                               substr($send_id->doc_roll_send_id, -4);
                       }
                },
                'filter' => true,
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Book number'),
                'attribute' => 'doc_id_regist',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Sent Date'),
                'attribute' => 'sent_date',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'From'),
                'attribute' => 'doc_from',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'To'),
                'attribute' => 'docDept',
                'value' => 'docDept.doc_dept_name',
                'filter' => true,
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Subject'),
                'attribute' => 'doc_subject',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Doing'),
                'attribute' => 'cmsDocRollSends',
                'value' => 'cmsDocRollSends.doc_roll_send_doing',
                'filter' => true,
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Status'),
                'attribute' => 'check',
                'value' => 'check.check_name',
                'filter' => true,
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',  // the default buttons + your custom button
            'buttons' => [
                'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a("<i class=\"fa fa-edit\"></i>
                                            <span>" . controllers::t('menu', 'Edit') . "</span>",
                            ['staff-send/edit-send-form?id=' . $model->doc_id], ['class' => 'btn btn-3d btn-xs btn-reveal btn-blue btnw']);
                },
                'delete' => function($url, $model, $key) {     // render your custom button
                        return "<a href=\"#\" onclick=\"redirectDeleteRoll('".$model->doc_id."')\"
                                               class=\"btn btn-3d btn-xs btn-reveal btn-red btnw confirmDeleteRoll\">
                                                <i class=\"fa fa-trash\"></i>
                                                <span>".controllers::t('menu', 'Delete')."</span>
                                            </a>";
                },
            ],


            ]*/
            [
                'label' => controllers::t('menu', 'Registration number'),
                'attribute' => 'cmsDocRollReceives',
                'value' => function ($model, $key, $index, $column) {
                    foreach ($model->cmsDocRollReceives as $send_id){
                        return
                            substr($send_id->doc_roll_receive_id, -4);
                    }
                },
                'filter' => true,
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Receive Date'),
                'attribute' => 'receive_date',
                'value' => function ($model, $key, $index, $column) {
                        return
                            controllers::DateThai($model->receive_date);

                },
                'filter' => true,
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Book number'),
                'attribute' => 'doc_id_regist',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'From'),
                'attribute' => 'docDept',
                'value' => 'docDept.doc_dept_name',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'To'),
                'attribute' => 'cmsInboxes',
                'format' => 'html',
                'value' => function ($model, $key, $index, $column) {
                    foreach ($model->cmsInboxes as $items) {
                        if (count($model->cmsInboxes) > 1) {
                            return Html::a($items->user->username . " ".controllers::t('menu','and others'),
                                ['detail_book?id=' . $model->doc_id], ['target' => '_blank']);

                        } else {
                            return Html::a($items->user->username,
                                ['detail_book?id=' . $model->doc_id], ['target' => '_blank']);;

                        }
                    }
                },
                'filter' => true,
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Subject'),
                'attribute' => 'doc_subject',
                'headerOptions' => ['class' => 'text-center']
            ],

            [
                'label' => controllers::t('menu', 'Recorder'),
                'attribute' => 'user',
                'value' => 'user.username',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Doing'),
                'attribute' => 'cmsDocRollReceivesDoing',
                'value' => function ($model, $key, $index, $column) {
                    foreach ($model->cmsDocRollReceives as $send_id){
                        return
                            $send_id->doc_roll_receive_doing;
                    }
                },
                'filter' => true,
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Status'),
                'attribute' => 'check',
                'value' => 'check.check_name',
                'filter' => true,
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',  // the default buttons + your custom button
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a("<i class=\"fa fa-edit\"></i>
                                            <span>" . controllers::t('menu', 'Edit') . "</span>",
                            ['staff-send/edit-send-form?id=' . $model->doc_id], ['class' => 'btn btn-3d btn-xs btn-reveal btn-blue btnw']);
                    },
                    'delete' => function($url, $model, $key) {     // render your custom button
                        return "<a href=\"#\" onclick=\"redirectDeleteRoll('".$model->doc_id."')\"
                                               class=\"btn btn-3d btn-xs btn-reveal btn-red btnw confirmDeleteRoll\">
                                                <i class=\"fa fa-trash\"></i>
                                                <span>".controllers::t('menu', 'Delete')."</span>
                                            </a>";
                    },
                ],


            ]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
