<?php
use yii\grid\GridView;
use yii\helpers\Url;

?>

<div class="project-index">
    <div class="text-conter">


    </div>
   <h1 class="text-center">รายงานผลงาน ทั้งหมดจำนวน <?= $dataProvider->getTotalCount(); ?> คน</h1>

      <?= GridView::widget([

           'dataProvider' => $dataProvider,
          'columns' => [
              ['class' => 'yii\grid\SerialColumn' ],
              [
                  'attribute' => 'project_id',
                  'value' => 'project_id',
                  'contentOptions' => ['class' => 'text-center'],
                  'headerOptions' => ['class' => 'text-center'],
              ],

              'project_name_thai',
              'project_name_eng',
              'budget',


             ]

      ])?>

</div>
