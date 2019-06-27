<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRegisterSection */


$this->title = 'สมัครเป็นผู้ช่วยสอน';
$this->params['breadcrumbs'][] = ['label' => 'Ta Register Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-register-section-create">


    <?= $this->render('_form', [
        'model' => $model,'modelRegis'=>$modelRegis,
        'id'=> $id,'ver'=>$ver,'y'=>$y,'t'=>$t,//'section' => $section,
    ]) ?>

</div>
