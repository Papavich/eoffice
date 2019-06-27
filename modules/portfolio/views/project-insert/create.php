<?php

use yii\helpers\Html;
use yii\base\Model;
use app\modules\portfolio\models\Project;
use app\modules\portfolio\models\ProjectMember;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectMember */


$this->params['breadcrumbs'][] = ['label' => 'Asset Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= $this->render('_form', [

        'persons' => $persons,
        'modelProject' => $modelProject,
        'modelsProjectMember' => $modelsProjectMember,

    ]) ?>

</div>
