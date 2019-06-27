<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 27/11/2560
 * Time: 12:48
 */

use app\modules\eoffice_ta\models\TaTypeRule;
use app\modules\eoffice_ta\models\TaRuleApproach;
use app\modules\eoffice_ta\models\TaCalculation;
use app\modules\eoffice_ta\controllers;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\bootstrap\NavBar;
?>
<?php
$title = controllers::t('label','Setting Calculate');
$create = controllers::t( 'label', 'Create' );
$edit = controllers::t( 'label', 'Edit' );
$back = controllers::t( 'label', 'Back' );
$search = controllers::t( 'label', 'Search' );
$this->title = $title;
//$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $title;
$this->params['breadcrumbs'][] = 'ตั้งค่าสูตรคำนวณ';
$RuleApps = TaRuleApproach::find()->all();

//setting-rule-payment.php
?>

<div class="panel-body">
    <div class="navbar navbar-default">
    <div class="navbar-header">

    <?= Menu::widget([
    'items' => [
        ['label' => 'เกณฑ์คำนวณที่ใช้', 'url' => ['staff/setting-calculate']],
        ['label' => 'ตั้งค่าประเภทสูตร', 'url' => ['ta-type-rule/index']],
        ['label' => 'ตั้งค่าตัวแปร', 'url' => ['ta-variable/index']],
        ['label' => 'ตั้งค่าสูตร', 'url' => ['ta-equation/index']],
    ],
    'options' => [
        'class' => 'navbar-nav nav',
        'id'=>'navbar-id',
        'style'=>'font-size: 14px;',
        'data-tag'=>'yii2-menu',
    ],
]);
?>
        <!-- inline search -->
        <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="<?=$search?>">
            </div>
            <button type="submit" class="btn btn-default">
                <i class="fa fa-lg fa-search"></i>
            </button>
        </form>
        <!-- /inline search -->
        <form class="navbar-form navbar-right" >
        <?= Html::a(Html::tag('i','',
            ['class' => 'glyphicon glyphicon-cog']) . 'ตั้งค่า', ['setting-calculate-function'],
            ['class' => 'btn btn-default'])  ?>
         <?= Html::a(Html::tag('i', '',
                ['class' => 'glyphicon glyphicon-plus']) . $create, ['ta-rule-approach/create'],
            ['class' => 'btn  btn-default'])  ?>
        </form>
    </div>
    </div>
    <!--content doc -->
</div>
<div class="panel-body">

    <?php
    foreach ($RuleApps as  $row){
        $id = $row->ta_rule_approach_id;
        $name = $row->ta_rule_approach_name;
        $detail = $row->ta_rule_approach_detail;
        $type_rule = $row->taTypeRule->ta_type_rule_name;
        $status = $row->active_statuss;
        $crby = $row->crby;
        $udby =$row->udby;
        $crtime=$row->crtime;
        $udtime=$row->udtime;
        $Cals = TaCalculation::find()->where(['ta_rule_id'=>$id])->orderBy(['order'=>SORT_ASC])->all();
        ?>
            <div class="row"><!-- item -->
                <div class="col-md-1"><!-- company logo -->
                    <img src="<?= Yii::getAlias('@web') ?>/web_ta/images/img/idea_icon_yellow.png" width='50em' alt="company logo">
                </div>
                <div class="col-md-5"><!-- company detail -->
                    <h4 class="margin-bottom-10"><?=$name?></h4>
                    <strong>ประเภท :คิด<?=$type_rule?></strong><br>
                    <a >สมการ :</a>
                            <?php if(empty($Cals)){?>
                               <span class="color-red"><em>ยังไม่ได้กำหนดสมการ</em></span>
                       <?php
                            }else{?><strong class="label label-success ">
                                <?php
                                foreach ($Cals as $item) {
                           $symbol = $item->symbol;
                           $status_symbol = $item->status_symbol;
                           if($status_symbol == 'main'){
                               $symbol_main = $symbol.' = ';
                               echo $symbol_main;
                           }else{
                               $symbol_normal = $symbol;
                               echo $symbol_normal;
                           }?>

                       <?php } ?>
                        </strong>
                        <?php }?>
                    <?php
                        /* $x=(1*2)+(0.5*2);
                    echo $x;
                        */
                    ?>

                    <p>  <?= $detail?><br>
                    </p>  </div>
                    <div class="col-md-2">
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
                        <li ><a href=" <?= Url::to(['ta-rule-approach/view','id' => $id]) ?>" class="btn btn-3d btn-sm btn-blue">
                                <i class="glyphicon glyphicon-eye-open"></i></a>
                       <?= Html::a(Html::tag('i', '',
                                ['class' => 'glyphicon glyphicon-pencil']), ['ta-rule-approach/update','id' => $id],
                                ['class' => 'btn btn-3d btn-sm btn-warning'])  ?>
                        <?= Html::a(Html::tag('i', '',
                                ['class' => 'glyphicon glyphicon-trash']), ['ta-rule-approach/delete','id' => $id], [
                                'class' => 'btn btn-3d btn-sm btn-danger',
                                'data' => [
                                    'confirm' => 'คุณแน่ใจแล้วหรือไม่ว่าคุณต้องการลบข้อมูลนี้?',
                                    'method' => 'post',
                                ],
                            ]) ?></li>
                    </ul>
                    <!-- /right options -->
                </div>
            </div><!-- /item -->
    <hr />
<?php }?>
</div>
