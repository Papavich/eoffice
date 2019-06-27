<?php

use yii\helpers\Html;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaComparisonGrade */

$this->title = 'เทียบความรู้ของผู้ช่วยสอน'; //Create Ta Comparison Grade //create?id=322131&ver=1&y=2560&t=2
$this->params['breadcrumbs'][] = ['label' => 'รายวิชารับสมัครผู้ช่วยสอน', 'url' => ['ta-register/index','term_name'=>$t.'/'.$y
]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-comparison-grade-create">

    <div class="panel-body">

    <?= $this->render('_form', [
        'model' => $model,
       's'=>$s,
        'ver'=>$ver,
        'y'=>$y,
        't'=>$t,

    ]) ?>
    </div>
</div>
