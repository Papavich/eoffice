<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\AuthorLevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Author Levels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-level-index">
    <header id="page-header">
        <h1>ลำดับผู้เขียน</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>

            <li class="active">ลำดับผู้เขียน</li>
        </ol>
    </header>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <center><?= Html::a('สร้างลำดับผู้เขียน', ['create'], ['class' => 'btn btn-success']) ?></center>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'auth_level_id',
            'auth_level_name',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions'=>['class'=>'btn btn-default'],
                'header'=>'',
                'template'=>'{update} {view} ',
                'contentOptions'=>[
                    'noWrap' => true],
                'options'=> ['style'=>'width:50px;'],
                'buttons'=>[
                    'update' => function($url,$model,$key){
                        return  Html::a('<i class="glyphicon glyphicon-pencil"></i>แก้ไข',$url,['class'=>'btn btn-block btn-social btn-warning']);
                    },
                    'view' => function($url,$model,$key){
                        return  Html::a('<i class="glyphicon glyphicon-eye-open"></i>ดู',$url,['class'=>'btn btn-block btn-social btn-warning']);
                    },
//                    'delete' => function($url,$model,$key){
//                        return  Html::a('<i class="glyphicon glyphicon-trash"></i>ลบ',['delete', 'id' => $model->auth_level_id], ['data' => ['confirm' => 'Do you really want to delete this element?','method' => 'post'],$url,['class'=>'btn btn-block btn-social btn-warning']]);
//                    },


                ],],
        ],
    ]); ?>
</div>
