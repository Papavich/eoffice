<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectMember */

$this->title = $model->pro_member_id;
$this->params['breadcrumbs'][] = ['label' => 'Asset Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::csrfMetaTags() ?>
<div class="asset-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('แก้ไขรายการครุภัณฑ์', ['update', 'id' => $model->pro_member_id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('ลบรายการครุภัณฑ์', ['delete-one', 'id' => $model->pro_member_id, [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]
            ]
        ) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'project_id',
            'project_name_thai',
            'project_name_eng',
            'budget',
            'sponsor_sponsor_id',
            'project_start',
            'project_end',
            'project_duration',
            'project_budget',
            'repayment',
            'project_url:url',
            'year_start',
            'year_end',
            'website',
            'participation_project_participation_project_id',
            'advisors_advisors_id',
            'institution_ag_award_id',
            'pro_member_id',
            'member_name',
            'project_role_id',
            'member_lname',
            'person_person_id',
            'project_project_id',
        ],
    ]) ?>

</div>
