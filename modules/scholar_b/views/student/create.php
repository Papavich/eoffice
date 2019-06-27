<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\model_main\EofficeMainStudent */

$this->title = 'Create Eoffice Main Student';
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Main Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-main-student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
