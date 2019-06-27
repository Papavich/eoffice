<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\personsystem\controllers;
use app\modules\personsystem\controllers\GetModelController;
use app\modules\personsystem\models\AcademicPositions;
use app\modules\personsystem\models\Amphur;
use app\modules\personsystem\models\District;
use app\modules\personsystem\models\PositionDirectors;
use app\modules\personsystem\models\Province;
use app\modules\personsystem\models\RegDepartment;
use app\modules\personsystem\models\RegFaculty;
use app\modules\personsystem\models\RegNation;
use app\modules\personsystem\models\RegOfficer;
use app\modules\personsystem\models\RegPrefix;
use app\modules\personsystem\models\RegProgram;
use app\modules\personsystem\models\RegReligion;
use app\modules\personsystem\models\RegSchool;
use app\modules\personsystem\models\Zipcode;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>
<header id="page-header">
    <h1>แบบฟอร์มเพิ่มเจ้าหน้าที่</h1>
    <ol class="breadcrumb">
        <li><a href="#">Forms</a></li>
        <li class="active">Form Edit Infomation</li>
    </ol>
    <?php $form = ActiveForm::begin(['action'=>'../../api/check-user','method'=>'post']); ?>
    <?= Html::csrfMetaTags() ?>
</header>
<div id="content" class="padding-20">
    <input name="password" value="112233">
    <input name="username" value="admin">
    <!-- tabs -->
    <div class="row">
        <div class="form-group">
            <div class="col-md-12 col-sm-12">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-block btn-success']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

