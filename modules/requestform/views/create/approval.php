<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = 'สร้างแบบฟอร์มใหม่';
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('cs-e-office/modules/requestform/assets/js/dynamic-form.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="test-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['action' => 'preview','id' => 'mainform', 'method' => 'post',]);?>



    <div class="panel-body">
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <ul class="side-nav list-group margin-bottom30">
            <a onclick="acceptorFunction()" class = "btn btn-3d btn-green btn-xlg btn-block btn-reveal">
                <big>เพิ่มผู้พิจารณา</big>
            </a><br>
                <!-- acceptorFunction -->
                <a onclick="resetElements()" class="btn btn-3d btn-reveal btn-red">
                    <i class="fa fa-times"></i>
                    <span>รีเซ็ท</span>
                </a>
                <?= Html::submitButton($model->isNewRecord ? 'เสร็จสิ้น' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-3d btn-reveal btn-green' : 'btn btn-3d btn-reveal btn-green']) ?>
            </ul>
        </div>

        <div class="col-md-9 col-lg-9">

			<div id="myForm" class="form-group">

			</div>
	</div>

    </div>
    <div class="row">

</div>
    </div>
</div>
<?php ActiveForm::end(); ?>
