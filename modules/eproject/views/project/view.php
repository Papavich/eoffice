<?php

/* @var $this yii\web\View */

use app\modules\eproject\components\AuthHelper;
use app\modules\eproject\controllers;
use yii\helpers\Html;

$userType = AuthHelper::getUserType();
$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'Project' ), 'url' => ['project/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Collapsible -->
<div id="panel-misc-portlet-r1" class="panel panel-info ">
    <div class="panel-heading">
        <span class="elipsis"><!-- panel title -->
            <strong><?= controllers::t( 'label', 'Project Description' ) ?></strong>
        </span>
        <!-- right options -->
        <ul class="options pull-right list-inline">
            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a>
            </li>
        </ul>
        <!-- /right options -->
    </div>
    <!-- panel content -->
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Image' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9"> <?php if ($model->image == "") {
                    echo Html::img( '@web/images/demo/portfolio/thumb/small_a5.png', ['style' => 'max-width:150px;max-height:150px;'] );
                } else {
                    echo Html::img( '@web/web_eproject/uploads/project_images/' . $model->image, ['style' => 'max-width:150px;max-height:150px;'] );
                } ?>
            </div>
        </div>
        <div class="row">
            <br>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Project Number' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9"> <?= ($model->number != "") ? $model->major->code . ' ' . $model->number . '/' . $model->year_id : '-' ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Project Name (Thai)' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9"><?= $model->name_th ?></div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Project Name (English)' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9"><?= $model->name_en ?></div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Owner' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9">
                <?php foreach ($model->students as $item) { ?>
                    <a href="#"> <?= $item->name ?></a><br>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Adviser' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9">
                <?php foreach ($model->advises as $projectXAdviser) { ?>
                    <p style="margin: 0px"><?= $projectXAdviser->adviser->name ?>
                    <?php if ($projectXAdviser->adviser_type_id == 1) { ?>
                        (<?= controllers::t( 'label', 'Main Adviser' ) ?>)</p>
                    <?php } else if ($projectXAdviser->adviser_type_id == 2) { ?>
                        (<?= controllers::t( 'label', 'Co-Adviser' ) ?>)</p>
                    <?php } ?><?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Project Type' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9">
                <?php foreach ($model->projectTypes as $item) { ?>
                    <?= Html::a($item->name, ['project/index', 'type[]' => $item->id,
                        'keyword'=>"",
                        'branch'=>0,
                        'year'=>9999,
                        'semester'=>0,
                        'search_by'=>1], ['class' => 'profile-link']) ?>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Theories' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9">
                <?php foreach ($model->theories as $item) { ?>
                     <?= $item->name ?>,
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Tools' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9">
                <?php foreach ($model->tools as $item) { ?>
                     <?= $item->name ?>,
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Abstract' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9"> <?= $model->abstract ?>
            </div>
        </div>

    </div>
    <!-- /panel content -->
</div>
<!-- /Collapsible -->
<!-- Collapsible -->
<div id="panel-misc-portlet-r1" class="panel panel-warning ">
    <div class="panel-heading">
        <span class="elipsis"><!-- panel title -->
            <strong><?= controllers::t( 'label', 'Project Document' ) ?></strong>
        </span>
        <!-- right options -->
        <ul class="options pull-right list-inline">
            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a>
            </li>
        </ul>
        <!-- /right options -->
    </div>
    <!-- panel content -->
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-4 col-md-3 padding-6" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Poster' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9">
                <?php foreach ($data['poster'] as $item) { ?>
                    <a href="<?= $item->filePath ?>">
                        <img src="<?= Yii::$app->homeUrl ?>web_eproject/images/<?php
                        if ($item->file_type_id == 1) {
                            echo "pdf";
                        } else if ($item->file_type_id == 2) {
                            echo "word";
                        } else if ($item->file_type_id == 3) {
                            echo "ppt";
                        } else if ($item->file_type_id == 4) {
                            echo "image";
                        } else if ($item->file_type_id == 5) {
                            echo "url";
                        } ?>.png" height="25px">
                    </a>
                <?php } ?>
            </div>
        </div>
        <?php if (!Yii::$app->user->isGuest) { ?>
            <div class="row">
                <div class="col-xs-4 col-md-3 padding-6" style="font-weight: bold"
                     align="right"><?= controllers::t( 'label', 'Proposal' ) ?> :
                </div>
                <div class="col-xs-8 col-md-9">
                    <?php foreach ($data['proposal'] as $item) { ?>
                        <a href="<?= $item->filePath ?>">
                            <img src="<?= Yii::$app->homeUrl ?>web_eproject/images/<?php
                            if ($item->file_type_id == 1) {
                                echo "pdf";
                            } else if ($item->file_type_id == 2) {
                                echo "word";
                            } else if ($item->file_type_id == 3) {
                                echo "ppt";
                            } else if ($item->file_type_id == 4) {
                                echo "image";
                            } else if ($item->file_type_id == 5) {
                                echo "url";
                            } ?>.png" height="25px">
                        </a>
                    <?php } ?>
                </div>
            </div>
            <?php if ($userType == AuthHelper::TYPE_TEACHER || $userType == AuthHelper::TYPE_ADMIN) { ?>
                <div class="row">
                    <div class="col-xs-4 col-md-3 padding-6" style="font-weight: bold"
                         align="right"><?= controllers::t( 'label', 'Progress 1' ) ?> :
                    </div>
                    <div class="col-xs-8 col-md-9">
                        <?php foreach ($data['progress1'] as $item) { ?>
                            <a href="<?= $item->filePath ?>">
                                <img src="<?= Yii::$app->homeUrl ?>web_eproject/images/<?php
                                if ($item->file_type_id == 1) {
                                    echo "pdf";
                                } else if ($item->file_type_id == 2) {
                                    echo "word";
                                } else if ($item->file_type_id == 3) {
                                    echo "ppt";
                                } else if ($item->file_type_id == 4) {
                                    echo "image";
                                } else if ($item->file_type_id == 5) {
                                    echo "url";
                                } ?>.png" height="25px">
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-md-3 padding-6" style="font-weight: bold"
                         align="right"><?= controllers::t( 'label', 'Progress 2' ) ?> :
                    </div>
                    <div class="col-xs-8 col-md-9">
                        <?php foreach ($data['progress2'] as $item) { ?>
                            <a href="<?= $item->filePath ?>">
                                <img src="<?= Yii::$app->homeUrl ?>web_eproject/images/<?php
                                if ($item->file_type_id == 1) {
                                    echo "pdf";
                                } else if ($item->file_type_id == 2) {
                                    echo "word";
                                } else if ($item->file_type_id == 3) {
                                    echo "ppt";
                                } else if ($item->file_type_id == 4) {
                                    echo "image";
                                } else if ($item->file_type_id == 5) {
                                    echo "url";
                                } ?>.png" height="25px">
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-md-3 padding-6" style="font-weight: bold"
                         align="right"><?= controllers::t( 'label', 'Final Report' ) ?> :
                    </div>
                    <div class="col-xs-8 col-md-9">
                        <?php foreach ($data['final'] as $item) { ?>
                            <a href="<?= $item->filePath ?>">
                                <img src="<?= Yii::$app->homeUrl ?>web_eproject/images/<?php
                                if ($item->file_type_id == 1) {
                                    echo "pdf";
                                } else if ($item->file_type_id == 2) {
                                    echo "word";
                                } else if ($item->file_type_id == 3) {
                                    echo "ppt";
                                } else if ($item->file_type_id == 4) {
                                    echo "image";
                                } else if ($item->file_type_id == 5) {
                                    echo "url";
                                } ?>.png" height="25px">
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-md-3 padding-6" style="font-weight: bold"
                         align="right"><?= controllers::t( 'label', 'User Manual' ) ?> :
                    </div>
                    <div class="col-xs-8 col-md-9">
                        <?php foreach ($data['userManual'] as $item) { ?>
                            <a href="<?= $item->filePath ?>">
                                <img src="<?= Yii::$app->homeUrl ?>web_eproject/images/<?php
                                if ($item->file_type_id == 1) {
                                    echo "pdf";
                                } else if ($item->file_type_id == 2) {
                                    echo "word";
                                } else if ($item->file_type_id == 3) {
                                    echo "ppt";
                                } else if ($item->file_type_id == 4) {
                                    echo "image";
                                } else if ($item->file_type_id == 5) {
                                    echo "url";
                                } ?>.png" height="25px">
                            </a>
                        <?php } ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4 col-md-3 padding-6" style="font-weight: bold"
                         align="right"><?= controllers::t( 'label', 'Abstract' ) ?> :
                    </div>
                    <div class="col-xs-8 col-md-9">
                        <?php foreach ($data['abstract'] as $item) { ?>
                            <a href="<?= $item->filePath ?>">
                                <img src="<?= Yii::$app->homeUrl ?>web_eproject/images/<?php
                                if ($item->file_type_id == 1) {
                                    echo "pdf";
                                } else if ($item->file_type_id == 2) {
                                    echo "word";
                                } else if ($item->file_type_id == 3) {
                                    echo "ppt";
                                } else if ($item->file_type_id == 4) {
                                    echo "image";
                                } else if ($item->file_type_id == 5) {
                                    echo "url";
                                } ?>.png" height="25px">
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-md-3 padding-6" style="font-weight: bold"
                         align="right"><?= controllers::t( 'label', 'Public Document' ) ?> :
                    </div>
                    <div class="col-xs-8 col-md-9">
                        <table class="table nomargin">
                            <thead>
                            <tr>
                                <th><?= controllers::t( 'label', 'Conference Name' ) ?></th>
                                <th><?= controllers::t( 'label', 'Type' ) ?></th>
                                <th><?= controllers::t( 'label', 'Document' ) ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($public

                            as $item) { ?>
                            <tr>
                                <td><?= $item->title ?></td>
                                <td><?= $item->publicType->name ?></td>
                                <td>
                                    <?php foreach ($item->publicDocuments as $item1) { ?>
                                        <a href="<?= $item1->filePath ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>web_eproject/images/<?php
                                            if ($item1->file_type_id == 1) {
                                                echo "pdf";
                                            } else if ($item1->file_type_id == 2) {
                                                echo "word";
                                            } else if ($item1->file_type_id == 3) {
                                                echo "ppt";
                                            } else if ($item1->file_type_id == 4) {
                                                echo "image";
                                            } else if ($item1->file_type_id == 5) {
                                                echo "url";
                                            } ?>.png" height="25px">
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>

                            </tbody>
                            <?php } ?>

                        </table>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <!-- /panel content -->
</div>
<!-- /Collapsible -->