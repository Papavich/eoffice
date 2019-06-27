<?php

/* @var $this yii\web\View */


use app\modules\eproject\controllers;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = controllers::t( 'label', 'History' );
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'menu', 'Advisee Management' ), 'url' => ['management']];
$this->params['breadcrumbs'][] = $this->title;
?>



<?php $form = ActiveForm::begin( ['method' => 'get', 'action' => 'history'] ); ?>
<div class="col-md-6">
    <?= $form->field( $yearSemester, 'year_id' )->dropDownList( \yii\helpers\ArrayHelper::map( \app\modules\eproject\models\Year::find()->orderBy( ['id' => SORT_DESC] )->all(), 'id', 'id' ) ) ?>
</div>
<div class="col-md-6">
    <?= $form->field( $yearSemester, 'semester_id' )->dropDownList( \yii\helpers\ArrayHelper::map( \app\modules\eproject\models\Semester::find()->all(), 'id', 'id' ) ) ?>
</div>


<?= Html::submitButton( '<i class="fa fa-search"></i>' . controllers::t( 'label', 'Search' ) . '', ['class' => 'btn btn-3d btn-teal pull-right'] ) ?>

<div class="row"></div>
<?php ActiveForm::end(); ?>
<br>


<?php if (count( $data ) == 0) { ?>
    <div align="center" class="main-container">
        <?= controllers::t( 'label', 'Not Found' ) ?>

    </div>
<?php }
foreach ($data as $item) { ?>
    <div class="panel panel-clean" id="panel-misc-portlet-l4">

        <div class="panel-heading">

									<span class="elipsis"><!-- panel title -->
										<strong style="font-size: large"><?= $item->name ?> </strong>
									</span>


        </div>

        <!-- panel content -->
        <div class="panel-body">

            <div class="row">
                <div class="col-xs-4 col-md-4" style="font-weight: bold"
                     align="right"><?= controllers::t( 'label', 'Project Number' ) ?> :
                </div>
                <div class="col-xs-8 col-md-8"> <?= ($item->number != "") ? $item->major->code . ' ' . $item->number . '/' . $item->year_id : '-' ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-md-4" style="font-weight: bold"
                     align="right"><?= controllers::t( 'label', 'Project Name (Thai)' ) ?> :
                </div>
                <div class="col-xs-8 col-md-8"><?= $item->name_th ?></div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-md-4" style="font-weight: bold"
                     align="right"><?= controllers::t( 'label', 'Project Name (English)' ) ?> :
                </div>
                <div class="col-xs-8 col-md-8"><?= $item->name_en ?></div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-md-4" style="font-weight: bold"
                     align="right"><?= controllers::t( 'label', 'Owner' ) ?> :
                </div>
                <div class="col-xs-8 col-md-8">
                    <?php foreach ($item->students as $std) { ?>
                        <a href="#"> <?= $std->name ?></a><br>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-md-4" style="font-weight: bold"
                     align="right"><?= controllers::t( 'label', 'No Submit Document' ) ?> :
                </div>
                <div class="col-xs-8 col-md-8">
                    <?php if (count( $item->unsentDocument ) == 0) { ?>
                        <i style="color: green;">ไมมี</i>
                    <?php } else {
                        $tmp = [];
                        foreach ($item->unsentDocument as $subjectDocumentType) {
                            $tmp[] = $subjectDocumentType->documentType->name;
                        }
                        ?>
                        <i style="color: red;"><?= implode( ', ', $tmp ) ?></i>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-md-4" style="font-weight: bold"
                     align="right"><?= controllers::t( 'label', 'Project Description' ) ?> :
                </div>
                <div class="col-xs-8 col-md-8">
                    <?= Html::a( '[' . controllers::t( 'label', 'See More' ) . ']', ['project/view', 'id' => $item->id] ) ?>

                </div>
            </div>
            <!-- /panel content -->
        </div>
    </div>


<?php } ?>

<!-- pagination -->
<div class="text-center">
    <?php
    echo LinkPager::widget( [
        'pagination' => $pages,
    ] );
    ?>
</div>

