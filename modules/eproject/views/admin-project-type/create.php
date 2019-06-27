<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProjectType */


$this->title =controllers::t( 'label', 'Add Project Type' );
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'Project Type' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-type-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
