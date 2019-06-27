<?php

use app\modules\eproject\components\AuthHelper;
use app\modules\eproject\controllers;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'News' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">


    <div class="border-bottom-1 border-top-1 padding-10">
                <span class="pull-right size-13 margin-top-3 text-muted">
                    <?= Yii::$app->formatter->asDate( $model->crtime, 'full' ) ?>
                </span>
        <?= controllers::t( 'label', 'By' ) ?> <strong><?php echo $model->crbyObj->name ?> </strong>
    </div>
    <div align="right">
        <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_ADMIN) { ?>
            <?= Html::a( '<i class="fa fa-edit"></i> ' . controllers::t( 'label', 'Edit' ), ['update', 'id' => $model->id], ['class' => ''] ) ?>
            <?= Html::a( '<i class="fa fa-trash"></i> ' . controllers::t( 'label', 'Delete' ), ['delete', 'id' => $model->id], [
                'style' => 'color:red;',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ] ) ?>
        <?php }else{ echo "<br>";} ?>
    </div>
    <div class="col-lg-12 well well-lg panel">
        <div class="panel-body" style="all: initial;">
            <?php
            echo $model->details;
            ?>
        </div>
    </div>


</div>
