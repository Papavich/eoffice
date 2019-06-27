<?php

use common\helpers\CssHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ข้อมูลผู้ใช้');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::a(Yii::t('app', 'เพิ่มผู้ใช้ใหม่'), ['create'], ['class' => 'btn btn-success']) ?></h3>

        </div><!-- /.box-header -->
        <div class="box-body">
            <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email:email',
            [
               'attribute' => 'ชื่อ',
               'value' => 'person.person_firstname', 
            ],
            [
               'attribute' => 'สกุล',
               'value' => 'person.person_lastname', 
            ],
            // status
            [
                'attribute' => 'status',
                'filter' => $searchModel->statusList,
                'value' => function ($data) {
                    return $data->statusName;
                },
                'contentOptions' => function($model, $key, $index, $column) {
                    return ['class' => CssHelper::statusCss($model->statusName)];
                }
                    ],
                    // role
                    [
                        'attribute' => 'item_name',
                        'filter' => $searchModel->rolesList,
                        'value' => function ($data) {
                            return $data->roleName;
                        },
                        'contentOptions' => function($model, $key, $index, $column) {

                            return ['class' => CssHelper::roleCss($model->roleName)];
                        }
                            ],
                            // buttons
                            ['class' => 'yii\grid\ActionColumn',
                                'header' => "Menu",
                                'template' => '{view} {update} {delete}',
                                'buttons' => [
                                    'view' => function ($url, $model, $key) {
                                        return Html::a('', $url, ['title' => 'View user',
                                                    'class' => 'glyphicon glyphicon-eye-open']);
                                    },
                                            'update' => function ($url, $model, $key) {
                                        return Html::a('', $url, ['title' => 'Manage user',
                                                    'class' => 'glyphicon glyphicon-user']);
                                    },
                                            'delete' => function ($url, $model, $key) {
                                        return Html::a('', $url, ['title' => 'Delete user',
                                                    'class' => 'glyphicon glyphicon-trash',
                                                    'data' => [
                                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this user?'),
                                                        'method' => 'post']
                                        ]);
                                    }
                                        ]
                                    ], // ActionColumn
                                ], // columns
                            ]);
                            ?>
        </div><!-- /.box-body -->
        <div class="box-footer">
           รายการข้อมูลผู้ใช้
        </div><!-- box-footer -->
    </div><!-- /.box -->


    

</div>
