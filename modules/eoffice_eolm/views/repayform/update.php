<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmRepay */

$this->title = \app\modules\eoffice_eolm\controllers::t( 'menu','Update repay form');
$this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolm\controllers::t( 'menu','Search approval form'), 'url' => ['approvalsearch']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-repay-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
