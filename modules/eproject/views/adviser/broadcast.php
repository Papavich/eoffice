<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use dosamigos\ckeditor\CKEditor;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


$this->title = controllers::t( 'menu', 'Adviser Broadcast' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile( '@web/ckeditor/ckeditor.js' )
?>
<?php $form = ActiveForm::begin( ['id' => 'broadcast-form'] ); ?>
<div class="col-md-12 col-sm-12">
    <?= $form->field( $model, 'topic' )->textInput( ['readOnly' => ($model->status == 1)] ) ?>
</div><br>


<div class="col-md-12 col-sm-12">
    <?= $form->field( $model, 'detail' )->widget( CKEditor::className(), [
        'options' => ['rows' => 1, 'readOnly' => ($model->status == 1)],
        'preset' => 'full',
        'clientOptions' => [
            'filebrowserUploadUrl' => \yii\helpers\Url::toRoute(['site/upload']),
        ]
    ] ) ?>
</div><br>
<div class="col-md-6 col-sm-6">
    <?= $form->field( $model, 'need' )->textInput( ['readOnly' => ($model->status == 1)] ) ?>
</div>

<div class="col-md-6 col-sm-6">

    <?php

    echo $form->field( $model, 'majors' )->widget( Select2::classname(), [
        'disabled' => ($model->status == 1),
        'data' => ArrayHelper::map( \app\modules\eproject\models\Major::find()->all(), 'id', 'name_th' ),
        'options' => ['placeholder' => controllers::t( 'label', 'Select Major' ), 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'allowClear' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
    ] )->label( controllers::t( 'label', 'Major' ) );
    ?>
</div>
<div class="col-md-12 col-sm-12">
    <?= $form->field( $model, 'contact' )->textInput( ['readOnly' => ($model->status == 1)] ) ?>
</div><br>

<br>

<div class="col-md-12 col-sm-12">
    <br>
    <?php
    if (($model->status == 1)) {
        echo Html::submitButton( '<i class="fa fa-close"></i>' . controllers::t( 'label', 'Cancel Announce' ) . '', ['class' => 'btn btn-3d btn-teal pull-right', 'name' => 'submitBtn', 'value' => 'cancel'] );
    } else {
        echo Html::submitButton( '<i class="fa fa-bullhorn"></i>' . controllers::t( 'label', 'Announce' ) . '', ['class' => 'btn btn-3d btn-teal pull-right', 'name' => 'submitBtn', 'value' => 'submit'] );
    }
    ?>
</div><br>

<?php ActiveForm::end(); ?>




