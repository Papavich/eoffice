<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use app\modules\eproject\models\User;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$web = Yii::getAlias( '@web' );
$this->registerJsFile( $web . '/js/fon-js.js', ['depends' => [\yii\web\JqueryAsset::className()]] );

$this->title = controllers::t( 'label', 'Request For Adviser' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin( ['id' => 'project-form'] ); ?>

<div class="col-md-12 col-sm-12">
    <?= $form->field( $model, 'topic' )->textInput( ['readonly' => !$model->isNewRecord] ) ?>
</div>

<div class="col-md-12 col-sm-12">

    <?php
    echo $form->field( $model, 'students' )->widget( Select2::classname(), [
        'data' => ArrayHelper::map( \app\modules\eproject\models\RequestAdviser::getAvailableStudentWithoutMe(), 'id', 'name' ),
        'options' => ['placeholder' => controllers::t( 'label', 'Select Project Partner' ), 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
    ] )->label( controllers::t( 'label', 'Project Partner' ) );
    ?>
</div><br>


<div class="col-md-12 col-sm-12">

    <?= $form->field( $model, 'detail' )->textarea( ['rows' => 6] ) ?>

</div><br>
<div class="col-md-12 col-sm-12">
    <?php
    echo $form->field( $model, 'adviser_id' )->widget( Select2::classname(), [
        'data' => ArrayHelper::map( User::find()->where( ['user_type_id' => 1] )->all(), 'id', 'name' ),

        'options' => ['placeholder' => controllers::t( 'label', 'Choose Adviser' ), 'value' => $teacher],
        'theme' => Select2::THEME_DEFAULT,

    ] );
    ?>
</div>

<div class="col-md-12 col-sm-12">
    <br>
    <?= Html::submitButton( '<i class="fa fa-save"></i>' . controllers::t( 'label', 'Save' ) . '', ['class' => 'btn btn-3d btn-teal pull-right'] ) ?>

</div>
<?php ActiveForm::end(); ?>
