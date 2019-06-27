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
                  'attribute' => 'pro_member_id',
                  'value' => 'pro_member_id',
                  'contentOptions' => ['class' => 'text-center'],
                  'headerOptions' => ['class' => 'text-center'],
              ],

              'member_name',
              'member_lname',


             ]

      ])?>

</div>
