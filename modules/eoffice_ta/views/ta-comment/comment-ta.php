<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\timeago\TimeAgo;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaComment;
use app\modules\eoffice_ta\models\model_central\ViewStudentFull;
use yii\widgets\LinkPager;
use app\modules\eoffice_ta\models\Subject;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;
use app\modules\eoffice_ta\models\SectionTeacher;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$comment = controllers::t( 'label', 'Comments');
$label_subj = controllers::t( 'label', 'Subject Enroll');
$label_subj_TA = controllers::t( 'label', 'Subject for TA');
$title = controllers::t( 'label', 'Ta Comments');
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;

//$person = EofficeMainUser::findOne(['id' => Yii::$app->user->id]);


//$modelSecTeacher = SectionTeacher::find()->where(['teacher_id'=>$person->person_id])->all();

?>
<div class="ta-comment-index">

    <!-- panel content -->
<div class="row">
    <div class="col-md-8">

            <div class="panel panel-default">
                <header class="panel-heading">
	<span class="title elipsis">
		<strong class="size-18">
            <span class="label label-warning width-30 height-40">
                <i class="glyphicon glyphicon-comment size-18">
                </i></span>
            <?php
            $std =  ViewStudentFull::findOne(['STUDENTID'=>$ta]);
            $std_id = $std->STUDENTCODE;
            $prefix = $std->PREFIXNAME;
            $std_name = $std->STUDENTNAME;
            $std_surname = $std->STUDENTSURNAME;
            $nickname = $std->student_nickname;
            $user = ViewPisUser::findOne(['id'=>Yii::$app->user->id]);
            ?>
            <?=$comment?>  ของ : <?=$prefix?> <?=$std_name?> <?=$std_surname?> &nbsp;(<?=$nickname?>)   </strong> <!-- panel title -->
	</span>
                </header>
                <div class="panel-body">

            <ul class="comment list-unstyled height-300">
                <li class="comment">
                <?php
                if (!empty($Comment)){
                foreach ($Comment as $item){

                $sec = $item->section;
                $feeling = $item->ta_comment_feeling;
                ?>
                <li class="comment comment-reply ">
                    <!-- comment body -->
                    <a href="#" class="comment-author">
                        <small class="text-muted pull-right">
                            <?php echo TimeAgo::widget(['timestamp' => $item->crtime . "GMT+7", 'language' => Yii::$app->language]) ?>
                        </small>
                        <span>วิชา<?= $item->subject_id ?></span>
                    </a>
                    <p>
                        <?= $item->ta_comment_text ?>
                        <i class="fa fa-commenting-o"></i>
                    </p>
                    <!-- options -->
                    <ul class="list-inline size-11 ">
                        <li>
                            <?php if ($feeling == '1') {
                                // ดีมาก มีความสุข  สนุกสนาน   ได้ความรู้  อยากงอแง  งง?>
                                <a href="#" class="text-success">
                                    <img src="<?= Yii::getAlias('@web') ?>/web_ta/images/feeling/elysium.png"
                                         height="20"/>
                                    รู้สึกสดใส</a>
                            <?php } elseif ($feeling == '2') { ?>
                                <a href="#" class="text-success">
                                    <img src="<?= Yii::getAlias('@web') ?>/web_ta/images/feeling/shy.png" height="20"/>
                                    รู้สึกเขิน</a>
                            <?php } elseif ($feeling == '3') { ?>
                                <a href="#" class="text-success">
                                    <img src="<?= Yii::getAlias('@web') ?>/web_ta/images/feeling/happy.png"
                                         height="20"/>
                                    รู้สึกสนุกสนาน</a>
                            <?php } elseif ($feeling == '4') { ?>
                                <a href="#" class="text-success">
                                    <img src="<?= Yii::getAlias('@web') ?>/web_ta/images/feeling/smart.png"
                                         height="20"/>
                                    รู้สึกได้ความรู้</a>
                            <?php } elseif ($feeling == '5') { ?>
                                <a href="#" class="text-success">
                                    <img src="<?= Yii::getAlias('@web') ?>/web_ta/images/feeling/cry.png" height="20"/>
                                    รู้สึกอยากงอแง</a>

                            <?php } elseif ($feeling == '6') { ?>
                                <a href="#" class="text-success">
                                    <img src="<?= Yii::getAlias('@web') ?>/web_ta/images/feeling/numb2.png"
                                         height="20"/>
                                    รู้สึกงง</a>
                            <?php } ?>
                        </li>

                        <li>
                        <li class="pull-right">
                         <strong> by : </strong>
                            <strong class="label label-info size-11"> Sec.<?=$sec?></strong>

                            <?php
                              if ($item->crby == $user->person_id){?>
                            <?= Html::a( ' Edit',
                                ['ta-comment/delete',
                                    'id'=>$item->ta_comment_id,
                                ],
                                ['class' => 'text-primary',
                                    'data' => [
                                        'confirm' => 'คุณแน่ใจแล้วหรือไม่ว่าคุณต้องลบความคิดเห็นนี้?',
                                        'method' => 'post',
                                    ]]) ?>
                            <?= Html::a( ' Delete',
                                ['ta-comment/delete',
                                    'id'=>$item->ta_comment_id,
                                ],
                                ['class' => 'text-danger',
                                    'data' => [
                                        'confirm' => 'คุณแน่ใจแล้วหรือไม่ว่าคุณต้องลบความคิดเห็นนี้?',
                                        'method' => 'post',
                                    ]]) ?>

                        </li>
                        <?php    } ?>

                    </ul><!-- /options -->

                </li>
                <?php } ?>
            </ul>


                    <!-- /COMMENT -->
                    <div id="custom-pagination" class="pull-right">
                        <?php

                        echo LinkPager::widget([
                            'pagination' => $pages,
                        ])
                        ?>
                    </div>
                    <?php
                    //}else {

                      //  echo "SORRY is ERROR!!!!!";
                       // echo Yii::$app->user->id;
                       // echo $person->person_id;
                    } ?>

        <div class="ta-comment-form">

            <?php $form = ActiveForm::begin(['action' => ['create','sec'=>$sec,'s'=>$s,'t'=>$t,'ta'=>$ta,'y'=>$y]]); ?>
            <label>ความคิดเห็น</label>
            <?= Html::textArea('ta_comment_text', '',
                ['class'=>'form-control'])?>
            <label>ความรู้สึก</label>

            <?= Html::dropDownList('ta_comment_feeling',[
                '1', '2', '3', '4', '5', '6',
            ],
                [
                    '1'=>'รู้สึกสดใส',
                    '2'=>'รู้สึกเขิน',
                    '3'=>'รู้สึกสนุกสนาน',
                    '4'=>'รู้สึกได้ความรู้',
                    '5'=>'รู้สึกอยากงอแง',
                    '6'=>'รู้สึกงง',
                ],['class'=>'form-control']
            );
            ?>


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

                </div>
        </div>
    </div>
    <!-- /panel content -->

    <!-- ***********************************  list Subject for Teacher  **************************** -->

