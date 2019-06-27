<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;


$this->title =controllers::t( 'label', 'Add Files' );
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'Document' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?=$this->render('_form', [
    'model' => $model
])?>


