<?php

use yii\helpers\Html;
use app\modules\eoffice_asset\models\Asset;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetDetail */

$this->params['breadcrumbs'][] = ['label' => 'Asset Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="asset-detail-create">


    <?= $this->render('_form', [
        'model' => $model,
        'modelA' => $modelA



    ]) ?>

</div>

