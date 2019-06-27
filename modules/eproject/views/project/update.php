<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use app\modules\eproject\models\User;
use app\modules\eproject\models\ProjectType;
use kartik\widgets\Select2;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = controllers::t( 'label', 'Edit Project Information' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'Project' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-xs-4 col-md-2" style="font-weight: bold" align="right"><?= controllers::t( 'label', 'Owner' ) ?>:
    </div>
    <div class="col-xs-8 col-md-10">
        <?php foreach ($model->students as $item) { ?>
            <a href="#"> <?= $item->name ?></a><br>
        <?php } ?>
    </div>
</div>
<div class="row">
    <div class="col-xs-4 col-md-2" style="font-weight: bold" align="right"><?= controllers::t( 'label', 'Adviser' ) ?>
        :
    </div>
    <div class="col-xs-8 col-md-10">
        <?php if ($model->mainAdviser != null){?>
        <p style="margin: 0px"><a href="#"> <?= $model->mainAdviser->name ?></a>
            <?php } else {
                echo "<br>";
            } ?>
    </div>
</div>


<?php $form = ActiveForm::begin( ['options' => ['enctype' => 'multipart/form-data']] ); ?>
<fieldset>
    <input type="hidden" name="id" value="<?=$model->id?>">
    <legend><br><?= controllers::t( 'label', 'General information' ) ?></legend>
    <div class="row">
        <div class="form-group">
            <div class="col-md-6 col-sm-6">

                <?= $form->field( $model, 'name_th' )->textInput( ['readOnly' => ($model->name_th != "")] ) ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field( $model, 'name_en' )->textInput( ['readOnly' => ($model->name_en != "")] ) ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <!--                <div class="col-md-6 col-sm-6">-->
            <!--                    <br> <label>ผู้ร่วมจัดทำโครงงาน </label>-->
            <!--                    <select id="select2" multiple="multiple" class="form-control select2" style="width: 100%">-->
            <!--                        <option value="1">นางสาวคุณัญญา ยุประมี</option>-->
            <!--                        <option value="2">นายคมเคียว ตั้งประเสริฐ</option>-->
            <!---->
            <!--                    </select>-->
            <!--                    <i class="fancy-arrow-"></i>-->
            <!--                </div>-->
            <div class="col-md-6 col-sm-6">
                <?php
                echo $form->field( $model, 'coAdvisers' )->widget( Select2::classname(), [
                    'data' => ArrayHelper::map( $model->availableCoAdviser, 'id', 'name' ),
                    'options' => ['placeholder' => controllers::t( 'label', 'Choose Co-Adviser' ), 'multiple' => true],
                    'pluginOptions' => [
                        'tags' => true,
                        'allowClear' => true,
                        'tokenSeparators' => [',', ' '],
                        'maximumInputLength' => 10
                    ],
                ] )->label( controllers::t( 'label', controllers::t( 'label', 'Co-Adviser' ) ) );
                ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?php
                echo $form->field( $model, 'externalAdvisers' )->widget( Select2::classname(), [
                    'data' => ArrayHelper::map( User::find()->where( ['user_type_id' => 3] )->all(), 'id', 'name' ),
                    'options' => ['placeholder' => controllers::t( 'label', 'Choose External Adviser' ), 'multiple' => true],
                    'pluginOptions' => [
                        'tags' => true,
                        'allowClear' => true,
                        'tokenSeparators' => [',', ' '],
                        'maximumInputLength' => 10
                    ],
                ] )->label( controllers::t( 'label', controllers::t( 'label', 'External Adviser' ) ) );
                ?>
            </div>
        </div>
    </div>


</fieldset><br><br>

<fieldset>
    <br>
    <legend><?= controllers::t( 'label', 'Description' ) ?></legend>

    <div class="row">
        <div class="form-group">
            <div class="col-md-6 col-sm-6">
                <?php
                echo $form->field( $model, 'projectTypes' )->widget( Select2::classname(), [
                    'data' => ArrayHelper::map( ProjectType::find()->all(), 'id', 'name' ),
                    'options' => ['placeholder' => controllers::t( 'label', 'Choose Project Types' ), 'multiple' => true],
                    'pluginOptions' => [
                        'tags' => true,
                        'allowClear' => true,
                        'tokenSeparators' => [','],
                        'maximumInputLength' => 30
                    ],
                ] )->label( controllers::t( 'label', 'Project Types' ) );
                ?>
                <i class="fancy-arrow-"></i>
            </div>
            <div class="col-md-6 col-sm-6">
                <?php
                echo $form->field( $model, 'theories' )->widget( Select2::classname(), [
                    'data' => ArrayHelper::map( \app\modules\eproject\models\Theory::find()->all(), 'id', 'name' ),
                    'options' => ['placeholder' => controllers::t( 'label', 'Choose Related theories' ), 'multiple' => true],
                    'pluginOptions' => [
                        'tags' => true,
                        'allowClear' => true,
                        'tokenSeparators' => [','],
                        'maximumInputLength' => 30
                    ],
                ] )->label( controllers::t( 'label', 'Theories' ) );
                ?>
                <i class="fancy-arrow-"></i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <div class="col-md-6 col-sm-6">
                <?php
                echo $form->field( $model, 'tools' )->widget( Select2::classname(), [
                    'data' => ArrayHelper::map( \app\modules\eproject\models\Tool::find()->all(), 'id', 'name' ),
                    'options' => ['placeholder' => controllers::t( 'label', 'Choose Tools used' ), 'multiple' => true],
                    'pluginOptions' => [
                        'tags' => true,
                        'allowClear' => true,
                        'tokenSeparators' => [','],
                        'maximumInputLength' => 30
                    ],
                ] )->label( controllers::t( 'label', 'Tools' ) );
                ?>
                <i class="fancy-arrow-"></i>
            </div>
            <div class="form-group">

                <label for="projectdocument-image"><?= controllers::t( 'label', 'Images' ) ?></label>
                <div class="fancy-file-upload fancy-file-info col-md-6 col-sm-6">

                    <i class="fa fa-upload"></i>
                    <input type="hidden" name="Project[image]" value="">
                    <input type="file"
                           class="form-control"
                           id="projectdocument-image"
                           name="Project[image]"
                           onchange="jQuery(this).next('input').val(this.value)"/>
                    <input type="text" class="form-control" placeholder="no file selected" readonly=""/>
                    <span class="button"><?= controllers::t( 'label', 'Choose File' ) ?></span>
                    <input type="hidden" name="file_type" id="file_type" value="upload">
                    <input type="hidden" name="doc_type" id="doc_type">
                    <input type="hidden" name="old_id" id="old_id">
                    <input type="hidden" name="doc_id" id="doc_id">

                </div>
            </div>

        </div>


    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field( $model, 'abstract' )->textarea( ['rows' => 6] ) ?>

        </div>

    </div>


    <br>
    <div align="center" class="row">
        <div class="col-md-12 col-sm-12">
            <?= Html::submitButton( '<i class="fa fa-save"></i>' . controllers::t( 'label', 'Save' ) . '', ['class' => 'btn btn-3d btn-teal pull-right'] ) ?>
            <?= Html::button( '<i class="fa fa-tags"></i>' . controllers::t( 'label', 'Auto Tag Generating' ) . '', ['class' => 'btn btn-3d btn-teal pull-right',
                'id' => 'test',
                'data-toggle' => "modal",
                'data-target' => "#autoTag"] ) ?>

        </div>
    </div>


</fieldset>
<?php ActiveForm::end(); ?>

<!-- Large Modal >-->
<div class="modal fade bs-example-modal-lg" id="autoTag" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- header modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myLargeModalLabel"><?= controllers::t( 'label', 'Tag Generator' ) ?></h4>
            </div>
            <!-- body modal -->
            <div class="modal-body">

                <div class="tabs nomargin">


                    <div class="form-group " align="center">
                        <button type="submit" class="btn btn-3d btn-teal" id="byAbstract" data-toggle="modal"
                                data-target="#autoTag"><i
                                    class="fa fa-file-text"></i><?= controllers::t( 'label', 'From Abstract' ) ?>
                        </button>
                        <button type="submit" class="btn btn-3d btn-teal " id="byProposal" data-toggle="modal"
                                data-target="#autoTag"><i
                                    class="fa fa-book"></i><?= controllers::t( 'label', 'From Proposal Document' ) ?>
                        </button>
                        <div class="row"></div>
                    </div>
                </div>

            </div>


            <div class="row"></div>


        </div>

    </div>

</div>

