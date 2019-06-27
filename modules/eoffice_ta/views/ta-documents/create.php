<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaDocuments */

$title = controllers::t('label','Document');
$main_title = controllers::t('label','Manage Document');
$create = controllers::t( 'label', 'Create' );
$this->title = $main_title;
$this->params['breadcrumbs'][] = ['label' => $main_title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $create.$title;
?>
<div class="ta-documents-create">
    <div class="panel-body">
        <h4 class="alert alert-info"><?= $create.$title?></h4>
        <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
