<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\PublicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Publications';
$this->params['breadcrumbs'][] = $this->title;
?>

<header id="page-header">
    <h1>รายละเอียดผลงานตีพิมพ์</h1>
    <ol class="breadcrumb">
        <li><a href="#">หน้าหลัก</a></li>
        <li><a href="#">ผลงานตีพิมพ์</a></li>
        <li class="active">รายละเอียดผลงานตีพิมพ์</li>
    </ol>
</header>
<div class="publication-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <center><?= Html::a('สร้างผลงานตีพิมพ์', ['publication-insert/create'], ['class' => 'btn btn-success']) ?></center>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'pub_id',
            'pub_name_thai',
            'pub_name_eng',
            'book_name',
            'date',
            //'acticle_detail',
            //'page_number',
            //'abstract',
            //'press',
            //'publisher',
            //'ISBN',
            //'auth_level_id',
            //'issn',
            //'dataval',
            //'article',
            //'number',
            //'issuance',
            //'dataindex',
            //'impact_factor',
            //'doi',
            //'advisor_id',
            //'person_id',
            //'std_id',
            //'contributor_contributor_id',
            //'cities_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
