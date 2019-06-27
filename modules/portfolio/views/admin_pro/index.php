<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'โครงการวิจัย';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="project-index">

    <h1 align="center"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Create PDF Report', ['pdf'], ['class' => 'btn btn-primary']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'project_id',
            'project_name_thai',
            'project_name_eng',
            //'budget',
            //'sponsor_sponsor_id',
            // 'project_start',
            // 'project_end',
            // 'project_duration',
            // 'project_budget',
            // 'repayment',
            // 'project_url:url',
            // 'year_start',
            // 'year_end',
            // 'website',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
