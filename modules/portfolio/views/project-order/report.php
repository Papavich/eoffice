<?php

use yii\grid\GridView;
use yii\helpers\Url;
/* @var $model app\modules\portfolio\models\ProjectOrder */
?>
<div class="project-order">
    
    <div class="text-center">

    </div>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
               'attribute' => 'project_order_id',
               'value' => function($dataProvider){

               },
               'contentOptions' => ['class' => 'text-center'],
               'headerOptions' => ['class' => 'text-center'],
            ],
            'fullname',
           // 'person_lastname',
        ],
    ]); ?>

</div>


