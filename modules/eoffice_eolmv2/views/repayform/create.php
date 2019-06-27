<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmRepay */

$this->title = \app\modules\eoffice_eolmv2\controllers::t( 'menu','Create repay form');
$this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search approval form'), 'url' => ['approvalsearch']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-repay-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
