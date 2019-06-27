<?php

use app\modules\eproject\controllers;
use app\modules\eproject\components\AuthHelper;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eproject\models\CalendarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = controllers::t( 'menu', 'Required Documents' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar-index">
    <div class="">
        <table class="table table-bordered nomargin">
            <thead>
            <tr class="active">
                <th style="width: 5%"><p align="center" style="margin: 0px"><?= controllers::t( 'label', 'No.' ) ?></th>
                <th style="width: 20%"><p align="center"
                                          style="margin: 0px"><?= controllers::t( 'label', 'Subjects' ) ?>
                </th>
                <th style="width: 40%"><p align="center"
                                          style="margin: 0px"><?= controllers::t( 'label', 'Document' ) ?></th>
                <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_ADMIN) { ?>
                    <th style="width: 3%">
                        <?=Html::a('<i class="fa fa-plus-square"></i>'.controllers::t( 'label', 'Add' ),
                            ['add-subject'],['class'=>'btn btn-success btn-xs'])?>

                    </th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($subjects as $i => $subject) { ?>
                <tr>
                    <td><p align="center" style="margin: 0px"><?= $i + 1 ?></td>
                    <td><?= $subject->name ?></td>
                    <td>
                        <?php
                        $tmp = [];

                        foreach ($subject->documentTypes as $documentType)
                            $tmp[] = $documentType->name;
                        echo implode( ', ', $tmp );
                        ?>

                    </td>
                    <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_ADMIN) { ?>
                        <td align="center">
                            <?= Html::a( '<i class="fa fa-edit"></i>', ['update-document-type', 'id' => $subject->id] ) ?>
                            <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $subject->id], [
                                'style' => 'color:red;',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
