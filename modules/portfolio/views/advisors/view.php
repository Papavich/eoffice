<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Advisors */

$this->title = $model->advisors_id;
$this->params['breadcrumbs'][] = ['label' => 'Advisors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advisors-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->advisors_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->advisors_id], [
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
            'advisors_id',
            'person_id',
            'department_id',
            'prefix_id',
            'acadmic_positions_id',
            'expertise_id',
            'areward_order_areward_order_id',
            'project_member_pro_member_id',
            'publication_order_pub_order_id',
        ],
    ]) ?>

</div>
