<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\PublicationOrder */

$this->title = $model->pub_order_id;
$this->params['breadcrumbs'][] = ['label' => 'Publication Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pub_order_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pub_order_id], [
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
            'pub_order_id',
            'publication_pub_id',
            'author_level_auth_level_id',
            'project_member_pro_member_id',
            'publications_type_pub_type_id',
        ],
    ]) ?>

</div>
