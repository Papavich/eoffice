<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'แสดงข้อมูลผู้ใช้ ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ผู้ใช้'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?= Html::a(Yii::t('app', 'กลับ'), ['index'], ['class' => 'btn btn-warning']) ?>
                <?= Html::a(Yii::t('app', 'แก้ไข'), ['update', 'id' => $model->id], [
                    'class' => 'btn btn-primary'])
                ?>
                <?=
                Html::a(Yii::t('app', 'ลบ'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'แน่ใจว่าต้องการลบผู้ใช้นี้?'),
                        'method' => 'post',
                    ],
                ])
                ?>
            </h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'username',
                    'email:email',
                    'person.person_firstname',
                    'person.person_lastname',
                    //'password_hash',
                    [
                        'attribute' => 'status',
                        'value' => $model->getStatusName(),
                    ],
                    [
                        'attribute' => 'item_name',
                        'value' => $model->getRoleName(),
                    ],
                    //'auth_key',
                    //'password_reset_token',
                    //'account_activation_token',
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ])
            ?>
        </div><!-- /.box-body -->
        <div class="box-footer">
            แสดงรายการผู้ใช้งาน
        </div><!-- box-footer -->
    </div><!-- /.box -->


</div>
