<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Publication */

$this->title = $model->pub_name_eng.'  '.$model->pub_name_thai;
$this->params['breadcrumbs'][] = ['label' => 'Publications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->pub_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->pub_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pub_id',
            'pub_name_thai',
            'pub_name_eng',
            'book_name',
            'date',
            'acticle_detail',
            'page_number',
            'abstract',
            'press',
            'publisher',
            'ISBN',
            'auth_level_id',
            'issn',
            'dataval',
            'article',
            'number',
            'issuance',
            'dataindex',
            'impact_factor',
            'doi',
            //'advisor_id',
            //'person_id',
            //'std_id',
            'contributor_contributor_id',
            'cities_id',
        ],
    ]) ?>

</div>
