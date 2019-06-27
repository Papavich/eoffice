<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $broadcast app\modules\eproject\models\AdviserBroadcast */

$this->title = $broadcast->topic;
//$this->params['breadcrumbs'][] = ['label' => controllers::t( 'menu', 'Project Adviser' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <div class="">


        <div class="clearfix margin-bottom-60">

            <div class="border-bottom-1 border-top-1 padding-10">
                <span class="pull-right size-13 margin-top-3 text-muted">
                    <?= Yii::$app->formatter->asDate( $broadcast->crtime, 'full' ) ?>
                </span>
                <?= controllers::t( 'label', 'By' ) ?> <strong><?php echo $broadcast->crbyObj->name ?> </strong>
            </div>
            <br>

            <div class="col-lg-12 well well-lg panel">
                <div class="panel-body">

                    <?php if (\app\modules\eproject\components\AuthHelper::isStudent()){?>
                    <div class="pull-right">
                        <?=Html::a('<i class="et-document"></i>ไปยังหน้าคำร้อง',['adviser/request','teacher'=>$broadcast->adviser_id],['class'=>'btn btn-3d btn-teal'])?>
                    </div>
                    <?php }?>
                    <div>
                        <strong><?= controllers::t( 'label', 'Major' ) ?> : </strong>
                        <?php foreach ($broadcast->majors as $major) {
                            echo $major->name . " ";
                        } ?><br>
                        <strong><?= controllers::t( 'label', 'Need' ) ?> : </strong>
                        <?= $broadcast->need; ?><br>
                        <strong><?= controllers::t( 'label', 'Contact' ) ?> : </strong>
                        <?= $broadcast->contact; ?><br>

                    </div>
                    <hr>
                    <?php
                    echo $broadcast->detail;
                    ?>


                </div>
            </div>


        </div>
    </div>


</div>
