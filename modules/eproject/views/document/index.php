<?php

/* @var $this yii\web\View */

use app\modules\eproject\components\AuthHelper;
use app\modules\eproject\controllers;
use yii\helpers\Html;
use yii\timeago\TimeAgo;
use yii\widgets\LinkPager;

$this->title =controllers::t( 'label', 'Document'  );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class=" nomargin">
    <table class="table table-bordered nomargin">
        <thead>

        <tr class="active">
            <th style="width:45%"><p align="center" style="margin: 0px"><?=controllers::t( 'label', 'Detail'  )?></th>
            <th style="width: 25%"><p align="center" style="margin: 0px"><?=controllers::t( 'label', 'Edited at'  )?></th>
            <th style="width: 25%"><p align="center" style="margin: 0px"><?=controllers::t( 'label', 'Created at'  )?></th>
            <th align="center" style="width: 5%"><?php if (AuthHelper::getUserType() == AuthHelper::TYPE_ADMIN) { ?><a  href="create" class="btn btn-success btn-xs"><i class="fa fa-plus-square"></i> Add </a><?php }?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data as $item) {  ?>
            <tr>
                <td  ><b><?php echo $item->title ?></b></td>
                <td align="center" style="margin: 0px"><?php echo TimeAgo::widget(['timestamp' => $item->udtime."GMT+7", 'language' => Yii::$app->language ])?></td>
                <td align="center" style="margin: 0px"><?php echo TimeAgo::widget(['timestamp' => $item->crtime."GMT+7", 'language' => Yii::$app->language ])?></td>
                <td align="center">

                    <?= Html::a('<i class="fa fa-download"></i>', ["/".$item->filePath],['style' => 'color:green;']) ?>
                    <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_ADMIN) { ?>
                    <?= Html::a('<i class="fa fa-edit"></i>', ['update', 'id' => $item->id]) ?>
                    <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $item->id], [
                        'style' => 'color:red;',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?php }?>
                </td>
            </tr>

        <?php } ?>
        </tbody>
    </table>
</div>
<div class="text-center">
    <?php
    echo LinkPager::widget([
        'pagination' => $pages,
    ]);
    ?>
</div>