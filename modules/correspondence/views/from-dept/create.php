<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsDocFromDept */

$this->title = Yii::t('app', 'Create Cms Doc From Dept');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms Doc From Depts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-doc-from-dept-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
