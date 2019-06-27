<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title =controllers::t( 'label', 'Upload Project Document' );
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'Project' ), 'url' => ['project/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Collapsible -->
<div id="panel-misc-portlet-r1" class="panel panel-clean ">
    <div class="panel-heading">
        <span class="elipsis"><!-- panel title -->
            <strong>Proposal</strong>
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
        <div class="row" style="font-weight: bold">
            <div class="col-xs-4"><?=controllers::t( 'label', 'Document' )?></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-2"></div>
            <hr>
        </div>
        <div class="row" style="margin-top:-10px">
            <div class="col-xs-4">
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
            <div class="col-xs-3"></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-2">
                <a href="#" onclick="updateDocumentType(1,0)" class="btn btn-success btn-xs" data-toggle="modal"
                   data-target=".bs-example-modal-lg"><i class="fa fa fa-upload"></i><?=controllers::t( 'label', 'Upload' )?></a>
            </div>
        </div>
    </div>
    <!-- /panel content -->
</div>
<!-- /Collapsible -->
<!-- Collapsible -->
<div id="panel-misc-portlet-r1" class="panel panel-clean ">
    <div class="panel-heading">
        <span class="elipsis"><!-- panel title -->
            <strong>Progress 1</strong>
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
        <div class="row" style="font-weight: bold">
            <div class="col-xs-4"><?=controllers::t( 'label', 'Document' )?></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-2"></div>
            <hr>
        </div>
        <div class="row" style="margin-top:-10px">
            <div class="col-xs-4">
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
            <div class="col-xs-3"></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-2">
                <a href="#" onclick="updateDocumentType(2,0)" class="btn btn-success btn-xs" data-toggle="modal"
                   data-target=".bs-example-modal-lg"><i class="fa fa fa-upload"></i><?=controllers::t( 'label', 'Upload' )?></a>
            </div>
        </div>
    </div>
    <!-- /panel content -->
</div>
<!-- /Collapsible -->
<!-- Collapsible -->
<div id="panel-misc-portlet-r1" class="panel panel-clean ">
    <div class="panel-heading">
        <span class="elipsis"><!-- panel title -->
            <strong>Progress 2</strong>
        </span>
        <!-- right options -->
        <ul class="options pull-right list-inline">
            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a>
            </li>
        </ul>
        <!-- /right options -->
        <?php
        echo Yii::$app->authManager->isAdmin();
        ?>
    </div>
    <!-- panel content -->
    <div class="panel-body">
        <div class="row" style="font-weight: bold">
            <div class="col-xs-4"><?=controllers::t( 'label', 'Document' )?></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-2"></div>
            <hr>
        </div>
        <div class="row" style="margin-top:-10px">
            <div class="col-xs-4">
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
            <div class="col-xs-3"></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-2">
                <a href="#" onclick="updateDocumentType(3,0)" class="btn btn-success btn-xs" data-toggle="modal"
                   data-target=".bs-example-modal-lg"><i class="fa fa fa-upload"></i><?=controllers::t( 'label', 'Upload' )?></a>
            </div>
        </div>
    </div>
    <!-- /panel content -->
</div>
<!-- /Collapsible -->
<!-- Collapsible -->
<div id="panel-misc-portlet-r1" class="panel panel-clean ">
    <div class="panel-heading">
        <span class="elipsis"><!-- panel title -->
            <strong>Final Report</strong>
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
        <div class="row" style="font-weight: bold">
            <div class="col-xs-4"><?=controllers::t( 'label', 'Document' )?></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-2"></div>
            <hr>
        </div>
        <div class="row" style="margin-top:-10px">
            <div class="col-xs-4">
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
            <div class="col-xs-3"></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-2">
                <a href="#" onclick="updateDocumentType(4,0)" class="btn btn-success btn-xs" data-toggle="modal"
                   data-target=".bs-example-modal-lg"><i class="fa fa fa-upload"></i><?=controllers::t( 'label', 'Upload' )?></a>
            </div>
        </div>
    </div>
    <!-- /panel content -->
</div>
<!-- /Collapsible -->
<!-- Collapsible -->
<div id="panel-misc-portlet-r1" class="panel panel-clean ">
    <div class="panel-heading">
        <span class="elipsis"><!-- panel title -->
            <strong>User Manual</strong>
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
        <div class="row" style="font-weight: bold">
            <div class="col-xs-4"><?=controllers::t( 'label', 'Document' )?></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-2"></div>
            <hr>
        </div>
        <div class="row" style="margin-top:-10px">
            <div class="col-xs-4">
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
            <div class="col-xs-3"></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-2">
                <a href="#" onclick="updateDocumentType(5,0)" class="btn btn-success btn-xs" data-toggle="modal"
                   data-target=".bs-example-modal-lg"><i class="fa fa fa-upload"></i><?=controllers::t( 'label', 'Upload' )?></a>
            </div>
        </div>
    </div>
    <!-- /panel content -->
</div>
<!-- /Collapsible -->
<!-- Collapsible -->
<div id="panel-misc-portlet-r1" class="panel panel-clean ">
    <div class="panel-heading">
        <span class="elipsis"><!-- panel title -->
            <strong>Poster</strong>
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
        <div class="row" style="font-weight: bold">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><?=controllers::t( 'label', 'Document' )?></div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
            <hr>
        </div>
        <div class="row" style="margin-top:-10px">
            <div class="col-xs-4">
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
            <div class="col-xs-3"></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-2">
                <a href="#" onclick="updateDocumentType(6,0)" class="btn btn-success btn-xs" data-toggle="modal"
                   data-target=".bs-example-modal-lg"><i class="fa fa fa-upload"></i><?=controllers::t( 'label', 'Upload' )?></a>
            </div>
        </div>
    </div>
    <!-- /panel content -->
</div>
<!-- /Collapsible -->
<!-- Collapsible -->
<div id="panel-misc-portlet-r1" class="panel panel-clean ">
    <div class="panel-heading">
        <span class="elipsis"><!-- panel title -->
            <strong>Abstract</strong>
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
        <div class="row" style="font-weight: bold">
            <div class="col-xs-4"><?=controllers::t( 'label', 'Document' )?></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-2"></div>
            <hr>
        </div>
        <div class="row" style="margin-top:-10px">
            <div class="col-xs-4">
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
            <div class="col-xs-3"></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-2">
                <a href="#" onclick="updateDocumentType(7,0)" class="btn btn-success btn-xs" data-toggle="modal"
                   data-target=".bs-example-modal-lg"><i class="fa fa fa-upload"></i><?=controllers::t( 'label', 'Upload' )?></a>
            </div>
        </div>
    </div>
    <!-- /panel content -->
</div>
<!-- /Collapsible -->
<!-- Collapsible -->
<div id="panel-misc-portlet-r1" class="panel panel-info ">
    <div class="panel-heading">
        <span class="elipsis"><!-- panel title -->
            <strong><?=controllers::t( 'label', 'Public Document' )?></strong>
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
        <div class="row" style="margin-top:-15px; margin-bottom: -15px;">
            <div class="table-responsive">
                <table class="table table-bordered nomargin">
                    <thead>
                    <tr>
                        <th><?=controllers::t( 'label', 'Conference Name' )?></th>
                        <th><?=controllers::t( 'label', 'Type' )?></th>
                        <th><?=controllers::t( 'label', 'Document' )?></th>

                        <th width="35px"><a href="#" class="btn btn-default btn-xs"
                                            data-toggle="modal"
                                            data-target="#addPublicDocument"><i
                                        class="fa fa fa-plus"></i><?=controllers::t( 'label', 'add files' )?></a></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($public as $item) { ?>
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
                            <td align="center"><a href="#" onclick="updateDocumentType(8,<?= $item->id ?>)"
                                                  class="" data-toggle="modal"
                                                  data-target=".bs-example-modal-lg">
                                    <i style="color: green;" class="fa fa fa-upload"></i></a>
                                <?= Html::a( '<i class="fa fa-trash"></i>', ['delete-public-document', 'id' => $item->id], [
                                    'style' => 'color:red;',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                    ],
                                ] ) ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /panel content -->
</div>
<!-- /Collapsible -->


<!-- Large Modal >-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- header modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myLargeModalLabel"><?=controllers::t( 'label', 'Upload ' )?></h4>
            </div>
            <!-- body modal -->
            <div class="modal-body">
                <?php $form = ActiveForm::begin( ['id' => 'upload-form', 'action' => 'create', 'options' => ['enctype' => 'multipart/form-data']] ); ?>
                <input type="hidden" name="id" value="<?=$projectId?>">
                <div class="tabs nomargin">

                    <!-- tabs -->
                    <ul class="nav nav-tabs nav-justified">
                        <li onclick="updateFileType('upload')" class="active">
                            <a href="#jtab1_nobg" data-toggle="tab">
                                <i class="fa fa-cloud-upload"></i> <?=controllers::t( 'label', 'From File' )?>
                            </a>
                        </li>
                        <li onclick="updateFileType('url')" class="">
                            <a href="#jtab2_nobg" data-toggle="tab">
                                <i class="fa fa-link"></i> <?=controllers::t( 'label', 'From Url' )?>
                            </a>
                        </li>
                    </ul>

                    <!-- tabs content -->
                    <div class="tab-content transparent">
                        <div id="jtab1_nobg" class="tab-pane active">
                            <br>
                            <label><?=controllers::t( 'label', 'File' )?> </label>
                            <div class="form-group">
                                <div class="fancy-file-upload fancy-file-info">

                                    <i class="fa fa-upload"></i>
                                    <input type="hidden" name="ProjectDocument[path]" value="">
                                    <input type="file"
                                           class="form-control"
                                           id="projectdocument-path"
                                           name="ProjectDocument[path]"
                                           onchange="jQuery(this).next('input').val(this.value);"/>
                                    <input type="text" class="form-control" placeholder="no file selected" readonly=""/>
                                    <span class="button"><?=controllers::t( 'label', 'Choose File' ) ?></span>
                                    <input type="hidden" name="file_type" id="file_type" value="upload">
                                    <input type="hidden" name="doc_type" id="doc_type">
                                    <input type="hidden" name="old_id" id="old_id">
                                    <input type="hidden" name="doc_id" id="doc_id">

                                </div>
                            </div>
                        </div>

                        <div id="jtab2_nobg" class="tab-pane">
                            <br>
                            <label>Url</label>
                            <div class="form-group">
                                <input class="form-control" type="url" name="url" id="url"
                                       >
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-3d btn-info pull-right"><i
                                        class="fa fa fa-upload"></i><?=controllers::t( 'label', 'Upload' )?>
                            </button>
                        </div>
                    </div>

                </div>


                <div class="row"></div>


                <?php ActiveForm::end(); ?>


            </div>

        </div>

    </div>
</div>


<!-- Large Modal >-->
<div class="modal fade " id="addPublicDocument" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- header modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myLargeModalLabel"><?controllers::t( 'label', ' uploaded' )?></h4>
            </div>
            <!-- body modal -->
            <div class="modal-body">
                <?php $form = ActiveForm::begin( ['id' => 'public-form', 'action' => 'add-public-document'] ); ?>
                <input type="hidden" name="id" value="<?=$projectId?>">

                <label> <?=controllers::t( 'label', 'Publication Name' )?> </label>
                <div class="form-group">
                    <input class="form-control" type="text" name="name" id="name"
                           placeholder="ex. Thailand International Conference">
                </div>
                <div class="form-group">

                    <?php
                    echo $form->field( $publicDocument, 'public_type_id' )
                        ->dropDownList( ArrayHelper::map( \app\modules\eproject\models\PublicType::find()
                            ->all(), 'id', 'name' ) )->label( controllers::t( 'label', 'Publications Type' ) );
                    ?>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-3d btn-info pull-right"><i
                                class=" fa fa-save"></i><?=controllers::t( 'label', 'Add' )?>
                    </button>
                </div>

            </div>


            <div class="row"></div>


            <?php ActiveForm::end(); ?>


        </div>

    </div>

</div>
</div>
<script type="application/javascript">
    function updateDocumentType(type, doc_id) {
        $("#doc_type").val(type);
        $("#doc_id").val(doc_id);
    }

    function updateFileType(type) {
        $("#file_type").val(type);
    }

</script>