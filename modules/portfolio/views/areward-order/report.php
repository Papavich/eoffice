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
                  'attribute' =>' areward_order_id',
                  'value' => 'areward_name',
                  'contentOptions' => ['class' => 'text-center'],
                  'headerOptions' => ['class' => 'text-center'],
              ],


              'date_areward',
              'project_member_pro_member_id',
              'level_level_id',
              'agency_award_areward_order_id',
              'advisor_id',
              'std_id',
              'person_id',
              'institution_ag_award_id',


             ]

      ])?>

</div>
