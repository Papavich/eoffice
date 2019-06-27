<?php
use yii\helpers\Html;
/* @var $this yii\web\View */


$this->title = \app\modules\eoffice_eolm\controllers::t( 'menu', 'Home');

?>
<div class="row">
    <div class="col-md-6 col-sm-6">
        <h5 class="text-center">การบันทึกแบบขออนุมัติหลักการ</h5>
        <div class="col-md-12 col-sm-12">
        <?=Html::img(Yii::getAlias('@web/web_eolm/images/pic1.svg'),['style'=>'display: block;margin:0 auto;width: 100%'])?>

        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <h5 class="text-center">การบันทึกแบบขออนุมัติเบิกจ่าย</h5>
        <div class="col-md-12 col-sm-12">
        <?=Html::img(Yii::getAlias('@web/web_eolm/images/pic2.svg'),['style'=>'display: block;margin:0 auto;width: 100%'])?>
        </div>
    </div>
</div>