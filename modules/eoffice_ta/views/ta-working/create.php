<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaWorking */

$title_main = 'บันทึกการปฏิบัติงาน';
$title = 'ลงบันทึกการปฏิบัติงาน';
$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => $title_main, 'url' => ['work-ta2','sec' => $sec,'s'=>$s,'t'=>$t,'y'=>$y,]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-working-create">

<div class="panel-body">
    <h4 class="alert alert-info"><?=$title?> :
    Sec.<?=$sec?>
      วิชา : <?=$s?> ภาคเรียน : <?=$t?>  ปีการศึกษา : <?=$y?>
    </h4>
    <?= $this->render('_form', [
        'model' => $model,
        'sec' => $sec,'s'=>$s,'t'=>$t,'y'=>$y,'t_wload'=>$t_wload,
    ]) ?>
</div>
</div>
