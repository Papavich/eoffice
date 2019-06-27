<?php
$this->title = Yii::t('app', 'ตำแหน่ง');
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
      'position_id',
      'position_name',
    ],
]) ?>            
</p>

