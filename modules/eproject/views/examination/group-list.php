<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use app\modules\eproject\models\Major;
use app\modules\eproject\models\ProjectType;
use app\modules\eproject\models\User;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = controllers::t( 'label', 'Project List in Group' ).' '.$id;
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label','Exam Committee'), 'url' => ['board']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div id="t1">
    <div class="panel-body">


        <!--<div class="table-responsive">-->
        <div class="">
            <?php if (count( $projectData ) == 0) { ?>
                <div align="center" class="main-container">
                    <?= controllers::t( 'label', 'Not Found' ) ?>

                </div>
            <?php } else { ?>
                <table class="table table-bordered nomargin">
                    <thead>
                    <tr class="active">
                        <th><p align="center" style="margin: 0px"><b><?= controllers::t( 'label', 'Picture' ) ?></b></p>
                        </th>
                        <th><p align="center" style="margin: 0px"><b><?= controllers::t( 'label', 'Description' ) ?></b>
                            </p></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($projectData

                                   as $item) { ?>
                        <tr>
                            <td align="center"><?php if ($item->image == "") {
                                    echo Html::img( '@web/images/demo/portfolio/thumb/small_a5.png', ['style' => 'max-width:150px;max-height:150px;'] );
                                } else {
                                    echo Html::img( '@web/web_eproject/uploads/project_images/' . $item->image, ['style' => 'max-width:150px;max-height:150px;'] );
                                } ?></td>
                            <td>
                                <div class="row">
                                    <div class="col-xs-4 col-lg-3" style="padding: 0px">
                                        <p align="right" style="margin: 0px">
                                            <b><?= controllers::t( 'label', 'Project ID' ) ?>:</b></p>
                                    </div>
                                    <div class="col-xs-8 col-lg-9 ">
                                        <p style="margin: 0px">
                                            <?= $item->projectNumber ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-lg-3" style="padding: 0px">
                                        <p align="right" style="margin: 0px">
                                            <b><?= controllers::t( 'label', 'Project Name (Thai)' ) ?>:</b></p>
                                    </div>
                                    <div class="col-xs-8 col-lg-9">
                                        <p style="margin: 0px"><?= $item->name_th ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-4 col-lg-3" style="padding: 0px">
                                        <p align="right" style="margin: 0px">
                                            <b><?= controllers::t( 'label', 'Project Name (English)' ) ?>:</b></p>
                                    </div>
                                    <div class="col-xs-8 col-lg-9">
                                        <p style="margin: 0px"><?= $item->name_en ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-lg-3" style="padding: 0px">
                                        <p align="right" style="margin: 0px">
                                            <b><?= controllers::t( 'label', 'Advisers' ) ?>:</b></p>
                                    </div>
                                    <div class="col-xs-8 col-lg-9">
                                        <?php if ($item->advises != null) {
                                            foreach ($item->advises as $advise) { ?>
                                                <p style="margin: 0px"><a href="#"><?= $advise->adviser->name ?></a>
                                                <?php if ($advise->adviser_type_id == 1) { ?>
                                                    (<?= controllers::t( 'label', 'Main Adviser' ) ?>)</p>
                                                <?php } else if ($advise->adviser_type_id == 2) { ?>
                                                    (<?= controllers::t( 'label', 'Co-Adviser' ) ?>)</p>
                                                <?php }
                                                if ($advise->adviser_type_id == 3) {
                                                    echo "(" . controllers::t( 'label', 'External Adviser' ) . ")";
                                                }
                                            }
                                        } else {
                                            echo "<br>";
                                        } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-lg-3" style="padding: 0px">
                                        <p align="right" style="margin: 0px">
                                            <b><?= controllers::t( 'label', 'Project Description' ) ?>: </b></p>
                                    </div>
                                    <div class="col-xs-8 col-lg-9">
                                        <p style="margin: 0px"><a href="<?=Url::toRoute(['project/view','id'=>$item->id])?>">
                                                [<?= controllers::t( 'label', 'Project Document' ) ?>]</a>
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</div>
