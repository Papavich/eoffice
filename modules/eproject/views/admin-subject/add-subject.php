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


$this->title = controllers::t( 'label', 'Add Related Subject' );
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'menu', 'Required Documents' ), 'url' => ['document-type']];
//$this->params['breadcrumbs'][] = ['label' => $subject->name, 'url' => ['document-type']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin();
echo $form->field( new \app\modules\eproject\models\Subject(), 'id' )->widget( Select2::classname(), [
    'data' => ArrayHelper::map( \app\modules\eproject\models\SubjectView::find()->all(), 'id', 'name' ),
    'options' => ['placeholder' => controllers::t( 'label', 'Choose Subject' )],
    'theme'=>Select2::THEME_DEFAULT,
] )->label( controllers::t( 'label', 'Subjects' ) );
?>

<div class="form-group">
    <?= Html::submitButton( '<i class="fa fa-save"></i>' . controllers::t( 'label', 'Save' ) . '', ['class' => 'btn btn-3d btn-teal pull-right'] ) ?>
</div>

<?php ActiveForm::end(); ?>
