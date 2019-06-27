<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaDocuments */

$main_title = controllers::t( 'label', 'Manage Document');
$title = controllers::t( 'label', 'Document');
$edit = controllers::t( 'label', 'Edit');
$this->title = $main_title;
$this->params['breadcrumbs'][] = ['label' => $main_title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $edit.$title;
?>
<div class="ta-documents-update">
    <div class="panel-body">
    <h4 class="alert alert-info"><?= $edit.$title.' : '.$model->ta_documents_name ?></h4>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
