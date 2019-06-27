<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmRepay */

$this->title = \app\modules\eoffice_eolmv2\controllers::t( 'menu','Details for repay form');
$this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search approval form'), 'url' => ['approvalsearch']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-repay-view">



    <!--<p>
        <?/*= Html::a('Update', ['update', 'eolm_app_id' => $model->eolm_app_id, 'eolm_repay_date' => $model->eolm_repay_date], ['class' => 'btn btn-primary']) */?>
        <?/*= Html::a('Delete', ['delete', 'eolm_app_id' => $model->eolm_app_id, 'eolm_repay_date' => $model->eolm_repay_date], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>-->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'eolmAppform.eolm_app_subject',
            'eolm_repay_date',
            'eolm_repay',
        ],
    ]) ?>
    <div class="form-group text-center">
        <?php

            echo Html::a('กลับ', ['approvalsearch'], ['class' => 'btn btn-primary']);
      ?>
    </div>

</div>
