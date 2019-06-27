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
                  'attribute' =>'  \'pub_order_id\',',
                  'value' => 'pub_order_id',
                  'contentOptions' => ['class' => 'text-center'],
                  'headerOptions' => ['class' => 'text-center'],
              ],


              'pub_order_id',
              'person_id',
              'publication_pub_id',
              'author_level_auth_level_id',


             ]

      ])?>

</div>
