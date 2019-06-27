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
            'pub_order_id',
            'person_id',
            'publication_pub_id',
            'author_level_auth_level_id',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
