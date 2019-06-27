<?php

/* @var $this yii\web\View */

/* @var $major integer */

use app\modules\eproject\controllers;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;


$this->title = controllers::t( 'menu', 'Adviser Status' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$form = ActiveForm::begin( ['method' => 'get', 'action' => 'student-per-adviser'] );
$data = ArrayHelper::map( \app\modules\eproject\models\Major::find()->all(), 'id', 'name' );
$data[0] = controllers::t( 'label', 'All' );
ksort( $data );
echo '<label class="control-label">' . controllers::t( 'label', 'Major' ) . '</label>';
echo Select2::widget( [
    'name' => 'major',
    'data' => $data,
    'theme'=>Select2::THEME_DEFAULT,
    'value' => $major
] );
echo '<br><br>' . Html::submitButton( '<i class="fa fa-search"></i>' . controllers::t( 'label', 'Search' ) . '',
        ['class' => 'btn btn-3d btn-teal pull-right'] );
ActiveForm::end();
?><br>
<br><br>
<div id="t2">
    <?php if (count( $requestAdvisee ) != 0) { ?>
        <table class="table table-bordered nomargin">
            <thead>

            <tr class="active">
                <th style="width: 40%"><p align="center" style="margin: 0px">
                        <b><?= controllers::t( 'label', 'Teacher Lists' ) ?></b></th>
                <th style="width: 10%"><p align="center" style="margin: 0px">
                        <b><?= controllers::t( 'label', 'Major' ) ?></b></th>
                <th width="10%"><p align="center" style="margin: 0px"><b><?= controllers::t( 'label', 'Need' ) ?></b>
                </th>
                <th width="10%"><p align="center" style="margin: 0px"><b><?= controllers::t( 'label', 'Added' ) ?></b>
                </th>
                <th width="10%"><p align="center" style="margin: 0px">
                        <b><?= controllers::t( 'label', 'Available' ) ?></b></th>

            </tr>

            </thead>
            <tbody>
            <?php foreach ($requestAdvisee as $item) { ?>

                <tr>
                    <td><?= $item->adviser->name ?></td>
                    <td><p align="center" style="margin: 0px"><?= $item->adviser->major->code ?></td>
                    <td><p align="center" style="margin: 0px"><?= $item->need ?></td>
                    <td><p align="center" style="margin: 0px"><?= $item->added ?></td>
                    <td style="color: <?= (($item->need - $item->added) <= 0) ? 'red' : 'green' ?>;"><p align="center" style="margin: 0px"><?= (($item->need - $item->added)>=0)?$item->need - $item->added:0 ?>
                    </td>
                </tr>

            <?php } ?>

            </tbody>

        </table>
    <?php } else { ?>

        <div align="center" class="main-container">
            <?= controllers::t( 'label', 'Not Found' ) ?>
        </div>

    <?php } ?>
    <br>


</div>
