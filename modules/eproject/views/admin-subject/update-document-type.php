<?php

use app\modules\eproject\controllers;
use app\modules\eproject\components\AuthHelper;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eproject\models\CalendarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = $subject->name;
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'menu', 'Required Documents' ), 'url' => ['document-type']];
//$this->params['breadcrumbs'][] = ['label' => $subject->name, 'url' => ['document-type']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-form">

    <?php $form = ActiveForm::begin();
    echo $form->field( $subject, 'documentTypes' )->widget( Select2::classname(), [
        'data' => ArrayHelper::map( \app\modules\eproject\models\DocumentType::find()->all(), 'id', 'name' ),
        'options' => ['placeholder' => controllers::t( 'label', 'Choose Document Type' ), 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'allowClear' => true,
            'tokenSeparators' => [','],
            'maximumInputLength' => 30
        ],
    ] )->label(controllers::t( 'label', 'Document' ) );
    ?>

    <div class="form-group">
        <?= Html::submitButton( '<i class="fa fa-save"></i>'.controllers::t( 'label', 'Save' ).'', ['class' => 'btn btn-3d btn-teal pull-right'] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
