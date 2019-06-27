<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="project-index">



    <?= GridView::widget([
        'dataProvider' => $model,

        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'areward_name',
            'date_areward',
            'project_member_pro_member_id',
            'level_level_id',
            'agency_award_areward_order_id',
            'advisor_id',
            //'std_id',
            //'person_id',
            'institution_ag_award_id',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
