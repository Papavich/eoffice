<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaDocuments */

$main_title = controllers::t( 'label', 'Manage Document');
$title = controllers::t( 'label', 'Document');
$detail = controllers::t( 'label', 'Detail');
$edit = controllers::t( 'label', 'Edit');
$delete = controllers::t( 'label', 'Delete');
$this->title = $main_title;
$this->params['breadcrumbs'][] = ['label' => 'Ta Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $detail.$title;
?>
<div class="ta-documents-view">
<div class="panel-body">
    <h4 ><?= $detail.$title.' : '.$model->ta_documents_name ?></h4>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'ta_documents_name',
            'ta_doc_detail',
            'ta_documents_path',
            //'ta_doc_status',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>
    <p>
        <?php  /*
          Html::a(Html::tag('i', '',
            ['class' => 'glyphicon glyphicon-pencil']).$edit, ['update', 'id' => $model->ta_documents_id], ['class' => 'btn btn-warning'])
         Html::a(Html::tag('i', '',
            ['class' => 'glyphicon glyphicon-trash']).$delete, ['delete', 'id' => $model->ta_documents_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>
</div>
</div>