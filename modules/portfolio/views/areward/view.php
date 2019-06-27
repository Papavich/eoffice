<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Areward */

$this->title = $model->areward_id;
$this->params['breadcrumbs'][] = ['label' => 'Arewards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="areward-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="box box-info box-solid">
        <div class="panel-body container-items ">
      <div class="text-center">
        <?php echo Html::img('@web/web_pfo/areward/'.$model->image,['width'=>'500','height'=>'500'],['alt' => 'alt image'])?>


      </div>
    </div>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'areward_id',
            'areward_name',
            'date_areward',
            'level_level_id',
            'institution_ag_award_id',
            'data_detail',
            'image',
            'cities_id',
            'member_member_id',
            'std_id',
            'person_id',
        ],
    ]) ?>

</div>
