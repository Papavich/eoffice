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

              //'areward_id',
              'areward_name',
              'date_areward',
              // 'level_level_id',
              // 'institution_ag_award_id',
              //'data_detail',
              [
                  'attribute' => 'image',
                  'format' => 'html',
                  'value' => function($model){
                      return Html::img('@web/web_pfo/areward/'.$model->image, ['class' => 'thumbnail', 'width'=>80]);
                  }
              ],

              //'cities_id',
              //'member_member_id',
              //'std_id',
              //'person_id',


             ]

      ])?>

</div>
