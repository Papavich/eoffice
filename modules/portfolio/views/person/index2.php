<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = Yii::t('app', 'พนักงาน ทั้งหมด  รายการ');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-6">
        <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
          'person_id',
          //'prefix_name',
          'person_firstname',
        ],
    ]) ?>
    </div>
</div>






