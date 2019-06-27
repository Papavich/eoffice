<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use app\modules\eproject\models\User;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = controllers::t( 'menu', 'Change Adviser' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-5 col-md-3" style="font-weight: bold" align="right">
        <?= controllers::t( 'label', 'Project Name (Thai)' ) ?> :
    </div>
    <div class="col-xs-7 col-md-9">
        <p style="margin: 0px">
            <?= $project->name_th ?>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-xs-5 col-md-3" style="font-weight: bold" align="right">
        <?= controllers::t( 'label', 'Project Name (English)' ) ?> :
    </div>
    <div class="col-xs-7 col-md-9">
        <p style="margin: 0px">
            <?= $project->name_en ?>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-xs-5 col-md-3" style="font-weight: bold" align="right">
        <?= controllers::t( 'label', 'Current Adviser' ) ?> :
    </div>
    <div class="col-xs-7 col-md-9">
        <p style="margin: 0px">
            <?= $project->mainAdviser->name ?>
        </p>
    </div>
</div>
<hr>


<?php $form = ActiveForm::begin( ['id' => 'project-form'] ); ?>
<div>
    <?php
    echo $form->field( $model, 'to' )->widget( Select2::classname(), [
        'data' => ArrayHelper::map( User::find()->where( ['user_type_id' => 1] )->andWhere(['<>','id',$project->mainAdviser->id])->all(), 'id', 'name' ),
        'options' => ['placeholder' => controllers::t( 'label', 'Choose Adviser' )],
        'theme'=>Select2::THEME_DEFAULT

    ] );
    ?>
    <i class="fancy-arrow-"></i>
</div>
<div>

    <?= $form->field( $model, 'reason' )->textarea( ['rows' => 6] ) ?>

</div>


<br>
<?= Html::submitButton( '<i class="fa fa-save"></i>' . controllers::t( 'label', 'Save' ) . '', ['class' => 'btn btn-3d btn-teal pull-right'] ) ?>

<?php ActiveForm::end(); ?>

