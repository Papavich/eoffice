<?php

/* @var $this yii\web\View */

/* @var $oldData string */

use app\modules\eproject\controllers;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = controllers::t( 'menu', 'Work Load' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="">
    <?php if (count( $users ) != 0) { ?>
        <table class="table table-bordered nomargin">
            <thead>
            <tr class="active">

                <th style="width: 10%"><p align="center"
                                          style="margin: 0px"><?= controllers::t( 'label', 'No.' ) ?>
                </th>
                <th style="width: 40%"><p align="center" style="margin: 0px"><?= controllers::t( 'label', 'Adviser' ) ?>
                </th>

                <?php foreach (\app\modules\eproject\models\Major::find()->all() as $item) { ?>
                    <th style="width:25px"><p align="center"
                                              style="margin: 0px"><?= $item->code ?></p>
                    </th>
                    <?php
                } ?>
                <th style="width:25px"><p align="center"
                                          style="margin: 0px"><?= controllers::t( 'label', 'Total' ) ?></p>
                </th>


            </tr>


            </thead>
            <?php foreach ($users as $key => $user) {
                $workLoad=$user->workLoad;
                ?>
                <tr>
                    <td align="center"><?=($key+1)?></td>
                    <td><p align="center" style="margin: 0px"><?= $user->name ?></td>

                    <?php foreach (\app\modules\eproject\models\Major::find()->all() as $item) { ?>
                        <td align="center">
                            <?= $workLoad["data"][$item->code] ?>
                        </td>
                        <?php
                    } ?>

                    <td>
                        <p align="center" style="margin: 0px">
                            <?= $workLoad["total"] ?>
                        </p>
                    </td>
                </tr>
            <?php } ?>
            <tbody>

            </tbody>
        </table>
    <?php } else if ($users !== null && count( $users ) == 0) { ?>
        <div align="center" class="main-container">
            <?= controllers::t( 'label', 'Not Found' ) ?>

        </div>
    <?php } ?>

</div>
<br>