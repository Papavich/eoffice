<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\materialsystem\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Matsys Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matsys-company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Matsys Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'company_id',
            'company_name',
            'company_address',
            'company_phone',
            'company_sellman',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
