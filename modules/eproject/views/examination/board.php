<?php

/* @var $this yii\web\View */

/* @var $oldData string */

use app\modules\eproject\controllers;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = controllers::t( 'label', 'Exam Committee' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin( ['method' => 'get', 'action' => 'board'] ); ?>
<fieldset>
    <div class="row">
        <div class="form-group">
            <div class="col-md-12 col-sm-12">
                <label><?= controllers::t( 'label', 'Subjects' ) ?></label>

                <?php
                echo Select2::widget( [
                    'name' => 'subject',
                    'value' => $oldData,
                    'theme'=>Select2::THEME_DEFAULT,
                    'data' => ArrayHelper::map( \app\modules\eproject\models\Subject::getNowOpenSubjects(), 'id', 'name' ),
                    'options' => ['multiple' => false]
                ] );
                ?>
                <br>
                <?= Html::submitButton( '<i class="fa fa-search"></i>' . controllers::t( 'label', 'Search' ) . '', ['class' => 'btn btn-3d btn-teal pull-right'] ) ?>


            </div>

        </div>

    </div>
</fieldset>
<?php ActiveForm::end(); ?>
<br>
<div class="">
    <?php if (count( $examGroupData ) != 0) { ?>
        <table class="table table-bordered nomargin">
            <thead>
            <tr class="active">

                <th style="width: 10%"><p align="center"
                                          style="margin: 0px"><?= controllers::t( 'label', 'Exam Group' ) ?>
                </th>
                <th style="width: 40%"><p align="center" style="margin: 0px"><?= controllers::t( 'label', 'Adviser' ) ?>
                </th>
                <th style="width: 20%"><p align="center"
                                          style="margin: 0px"><?= controllers::t( 'label', 'Number of Project' ) ?></p>
                </th>


            </tr>


            </thead>
            <?php foreach ($examGroupData as $key => $examGroup) { ?>
                <tr>

                    <td><p align="center" style="margin: 0px"><?= $examGroup->name ?></td>
                    <td>
                        <?php foreach ($examGroup->users as $examCommittee) { ?>
                            <?=$examCommittee->name.'<br>'?>
                        <?php } ?>
                    </td>
                    <td>
                        <p align="center" style="margin: 0px">
                        <?=($examGroup->projectCount==0)?$examGroup->projectCount:'<a href="'.\yii\helpers\Url::toRoute(['examination/group-list','id'=>$examGroup->id]).'">'.$examGroup->projectCount.'</a>'?>
                        </p>
                    </td>
                </tr>
            <?php } ?>
            <tbody>

            </tbody>
        </table>
    <?php } else if ($examGroupData !== null && count( $examGroupData ) == 0) { ?>
        <div align="center" class="main-container">
            <?= controllers::t( 'label', 'Not Found' ) ?>

        </div>
    <?php } ?>

</div>
<br>