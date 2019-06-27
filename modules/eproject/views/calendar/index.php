<?php

use app\modules\eproject\controllers;
use app\modules\eproject\components\AuthHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eproject\models\CalendarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$this->title =controllers::t( 'label', 'Calendar' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar-index">
    <div class="">
        <table class="table table-bordered nomargin">
            <thead>
            <tr class="active">
                <th style="width: 5%"><p align="center" style="margin: 0px"><?=controllers::t( 'label', 'No.' )?></th>
                <th style="width: 40%"><p align="center" style="margin: 0px"><?=controllers::t( 'label', 'Activities' )?></th>
                <th style="width: 20%"><p align="center" style="margin: 0px"><?=controllers::t( 'label', 'Date' )?></th>
                <th style="width:35%"><p align="center" style="margin: 0px"><?=controllers::t( 'label', 'Form Download' )?></th>
                <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_ADMIN) { ?>
                <th>
                    <a href="create" class="btn btn-success btn-xs">
                        <i class="fa fa-plus-square"></i> Add
                    </a>
                </th>
                <?php }?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ( $data as $i=>$item) {?>
            <tr>
                <td><p align="center" style="margin: 0px"><?=$i+1?></td>
                <td><?=$item->detail?></td>
                <td><?=Yii::$app->formatter->asDate($item->start_date, 'medium')?> - <?=Yii::$app->formatter->asDate($item->end_date, 'medium')?></td>
                <td>-
                <?php
                $tmp=[];
                foreach ($item->calendarDocuments as $i)
                     $tmp[]= Html::a($i->download->title, ["/".$i->download->filePath],[]);
                echo implode(', ',$tmp);
                ?>
                </td>
                <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_ADMIN) { ?>
                <td align="center">

                    <?= Html::a('<i class="fa fa-edit"></i>', ['update', 'id' => $item->id]) ?>
                    <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $item->id], [
                        'style' => 'color:red;',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </td>
                <?php } ?>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>
