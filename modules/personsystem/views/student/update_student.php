
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\ViewStudentFull */

$this->title = Yii::t('app', 'Update View Student Full: {nameAttribute}', [
    'nameAttribute' => $model->STUDENTID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'View Student Fulls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->STUDENTID, 'url' => ['view', 'id' => $model->STUDENTID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
    <?= $this->render('student_form', [
        'model' => $model,
    'modelStudent'=>$modelStudent,
    'amphurHome'=> $amphurHome,
    'districtHome'=>$districtHome,
    'amphurCurrent'=> $amphurCurrent,
    'districtCurrent'=>$districtCurrent,
    'amphurFather'=>$amphurFather,
    'districtFather'=>$districtFather,
    'amphurMother'=>$amphurMother,
    'districtMother'=>$districtMother,
    'amphurParent'=>$amphurParent,
    'districtParent'=>$districtParent,
    ]) ?>
