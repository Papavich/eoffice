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

            'pro_member_id',
            'member_name',
            'member_lname',
            'project_project_id',
            'project_role_project_role_id',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
