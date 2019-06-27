<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\UserRequest */

$this->title = 'ยื่นคำร้องใหม่';
$this->params['breadcrumbs'][] = ['label' => 'ยื่นคำร้องใหม่', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3></h3>
<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
                  <span class="title elipsis">
                    <strong><?= Html::encode($this->title) ?></strong>
                  </span>
        </div>
        <div class="panel-body">
            <div class="user-request-index">

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>