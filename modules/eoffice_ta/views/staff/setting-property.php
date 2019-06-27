<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 27/11/2560
 * Time: 12:48
 */


use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;
?>
<?php
$title = controllers::t( 'label', 'Property Title' );
$create = controllers::t( 'label', 'Create' );
$search = controllers::t( 'label', 'Search' );
$back = controllers::t( 'label', 'Back' );
$label_detail = controllers::t( 'label', 'Detail' );
$this->title = $title;
?>

<!-- page title -->
<header id="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="options pull-right list-inline">
        <li>
            <?= Html::a(Html::tag('i', '',
                ['class' => 'glyphicon glyphicon-plus']) . $create, ['ta-property/create'],
                ['class' => 'btn btn-reveal btn-info'])  ?>
        </li>
        <li> <?= Html::a(Html::tag('i', '',
                    ['class' => 'glyphicon glyphicon-share-alt']) . $back, ['site/index'],
                ['class' => 'btn btn-reveal btn-primary'])  ?>
        </li>
    </ol>
</header>
<!-- /page title -->
<div class="panel-body">
<!--content doc -->
<!-- inline search -->
<div class="well ">
    <div class="input-group fullwidth">
        <input class="form-control input-lg" type="text" id="inline-search" placeholder="<?=$search?>">
        <span class="input-group-addon"><i class="fa fa-lg fa-search"></i></span>
    </div>
</div>
<!-- /inline search -->
    <?php
    foreach ($Rules as  $item){
    $id = $item->ta_property_id;
    $gread_name = $item->ta_property_name;
    $gread_value = $item->ta_property_value;
    $level = $item->levelDegree->level_name;
    $detail = $item->property_detail;
    $gpa = $item->property_gpa;
    $crby = $item->crby;
    $udby = $item->udby;
    $crtime = $item->crtime;
    $udtime = $item->udtime;
       ?>
        <div class="row"><!-- item -->
            <div class="col-md-2"><!-- company logo -->
                <img src="<?= Yii::getAlias('@web') ?>/web_ta/images/img/ethics.png" width='120em' alt="company logo">
            </div>
            <div class="col-md-7"><!-- company detail -->
                <h4 class="margin-bottom-10">คุณสมบัติผู้ช่วยสอน ระดับ<?=$level?></h4>

            <?php
                 if(!empty($gpa&&$gread_name&&$gread_value)){?>
            <strong>เกรดเฉลี่ยรวมขั้นต่ำ(GPA) <?=$gpa?> </strong><br>
                <strong> เกรดรายวิชาที่สมัครขั้นต่ำ : </strong> <span class="label label-success"><?=$gread_name?></span>
            &nbsp;หรือ&nbsp;<span class="label label-success"><?=$gread_value?></span> <br>
            <?=$label_detail?> : <br><?=$detail?> <br>
                 <?php }?>
                <span class="size-13">
                        <i class="glyphicon glyphicon-time"></i>
                        สร้างเมื่อ&nbsp;&nbsp;<?= Yii::$app->formatter->format($crtime, 'relativeTime') ?>
                    </span>&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="size-13">
                        <i class="glyphicon glyphicon-time"></i>
                        แก้ไขเมื่อ&nbsp;&nbsp;<?= Yii::$app->formatter->format($udtime, 'relativeTime') ?>
                    </span>
        </div>
            <div class="col-md-3">
                <!-- right options -->
                <ul class="options pull-right list-inline">
                <?= Html::a(Html::tag('i', '',
                    ['class' => 'glyphicon glyphicon-pencil']), ['ta-property/update','id'=>$id],
                    ['class' => 'btn btn-3d btn-sm btn-warning'])  ?>
                <?= Html::a(Html::tag('i', '',
                    ['class' => 'glyphicon glyphicon-trash']), ['ta-property/delete','id'=>$id], [
                    'class' => 'btn btn-3d btn-sm btn-danger',
                    'data' => [
                        'confirm' => 'คุณแน่ใจแล้วหรือไม่ว่าคุณต้องการลบข้อมูลนี้?',
                        'method' => 'post',
                    ],
                ]) ?>
                </ul>
                <!-- /right options -->
            </div>
        </div><!-- /item -->
        <hr />
    <?php }?>
</div>

