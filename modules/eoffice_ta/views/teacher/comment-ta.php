<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 25/11/2560
 * Time: 16:04
 */

use app\modules\eoffice_ta\models\SubjectOpen;
use app\modules\eoffice_ta\models\model_main\Studentreg;
use app\modules\eoffice_ta\models\model_main\PersonView;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;
use app\modules\eoffice_ta\models\model_main\ViewStudentFull;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaComment;
use app\modules\eoffice_ta\models\TaSchedule;
use app\modules\eoffice_ta\models\Term;
use app\modules\eoffice_ta\models\TaStatus;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRequest;
use app\modules\eoffice_ta\models\model_central\ViewPisOfficerClass;
use app\modules\eoffice_ta\models\model_central\ViewPisPerson;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\model_main\EofficeMainPrefix;
use app\modules\eoffice_ta\models\model_main\Level;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

use yii\data\Pagination;
?>
<?php
$label_subj = controllers::t( 'label', 'Subject of Teaching');
$label_ta_fail = 'รายชื่อผู้สมัครที่คัดออก';
$label_req = controllers::t( 'label', 'Request');
$title = controllers::t( 'label', 'View comment TA');
$view = controllers::t( 'label', 'View');
$back = controllers::t( 'label', 'Back');
$this->title = $title;
$request = Yii::$app->request;
$url_now = $request->url;

$u  = ViewPisPerson::findOne(['id' => Yii::$app->user->id]);
$t_name = $u->person_name;
$t_surname = $u->person_surname;
?>
<style>
    .circle{ /* ชื่อคลาสต้องตรงกับ <img class="circle"... */
       /* height: auto;*/  /* ความสูงปรับให้เป็นออโต้ */
       /* width: auto;*/  /* ความสูงปรับให้เป็นออโต้ */
        border: 3px solid #fff; /* เส้นขอบขนาด 3px solid: เส้น #fff:โค้ดสีขาว */
        border-radius: 50%; /* ปรับเป็น 50% คือความโค้งของเส้นขอบ*/
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); /* เงาของรูป */
    }
</style>
<div id="panel-3" class="panel panel-default">
    <div class="panel-heading">
	<span class="title elipsis">
		<strong class="size-18"><i class="glyphicon glyphicon-book"></i> <?=$label_subj?></strong> <!-- panel title -->
	</span>
    </div>
    <!-- panel content -->
    <div class="panel-body">
        <?php $form = ActiveForm::begin( [//\yii\helpers\Url::current(),
            'class' => 'horizontal',
            //'action' => ['test'],
            'method' => 'get', //['csrf' => false]
        ] ); ?>
        <fieldset>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-2 col-sm-2">
                            <span class="title elipsis size-16"><!-- panel title -->
								<strong>ปีการศึกษา</strong><strong class="text-blue">
                                   </strong>
							</span>
                        <?php
                        $terms = Term::find()->orderBy(['year'=>SORT_ASC])->all();
                        foreach ($terms as $term){
                        }
                        echo Select2::widget( [
                            'name' => 'term_name',
                            'value' => '',
                            'theme'=>Select2::THEME_DEFAULT,
                            'data' => ArrayHelper::map(Term::find()->
                            addOrderBy(['term_name'=>SORT_ASC])->
                            addOrderBy(['year'=>SORT_ASC])->all(), 'term_name', 'term_name' ),
                            'options' => [
                                'placeholder' => '-- เลือกปีการศึกษา --',
                                'multiple' => false ],
                        ] );

                        $term_name2 = \Yii::$app->request->get('term_name');
                        $term3 =  substr($term_name2, 0, -5);
                        $year3 = substr($term_name2, 2, 6);
                        ?>
                    </div>
                    <div class="col-md-2 col-sm-2">
                         <span class="title elipsis size-16"><!-- panel title -->
								<strong>ค้นหารายวิชา</strong><strong class="text-blue">
                                   </strong>
							</span>
                        <?php
                        $subjects = ViewPisOfficerClass::find()->where([
                                'SEMESTER'=>intval($term3),
                            'ACADYEAR'=>intval($year3)])->orderBy(['COURSECODE'=>SORT_ASC])->all();
                        foreach ($subjects as $subject){
                        }
                        echo Select2::widget( [
                            'name' => 'subject',
                            'value' => '',
                            'theme'=>Select2::THEME_DEFAULT,
                            'data' => ArrayHelper::map(ViewPisOfficerClass::find()->
                            addOrderBy(['COURSECODE'=>SORT_ASC])
                                ->select(
                                    ['COURSECODE','COURSENAME','SEMESTER','ACADYEAR'
                                    ])->distinct()->where(['OFFICERNAME'=>$t_name,'OFFICERSURNAME'=>$t_surname])->all(), 'COURSECODE', 'COURSECODE' ),
                            'options' => [
                                'placeholder' => '-- ค้นหารายวิชา --',
                                'multiple' => false ],
                        ] );
                        $subj = \Yii::$app->request->get('subject');
                        ?>
                    </div><br>
                    <div class="col-md-1 col-sm-1">
                        <?= Html::submitButton( '<i class="fa fa-search"></i>' . controllers::t( 'label', 'Search' ) , ['class' => 'btn btn-blue'] ) ?>
                    </div>
                    <div class="col-md-6 col-sm-6"></div>
                </div>
        </fieldset>
        <?php ActiveForm::end(); ?>
        <br>
                <div class="table-responsive">
                    <table class="table table-hover table-vertical-middle nomargin">
                        <thead>
                        <tr>
                            <th width="15%">Subject</th>
                            <th width="5%" class="text-center">จำนวนTA</th>
                            <th width="8%" class="text-center">Comment</th>
                        </tr>
                        </thead>
            <?php

            if (empty($term_name2)) {
                $query = ViewPisOfficerClass::find()->select(
                    ['COURSECODE', 'COURSENAME', 'REVISIONCODE', 'SEMESTER', 'ACADYEAR'
                    ])->distinct()->where(['OFFICERNAME'=>$t_name,'OFFICERSURNAME'=>$t_surname]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
                $model = $query->offset($pages->offset)
                    ->distinct('COURSECODE')
                    ->limit($pages->limit)
                    ->all();
            }elseif (!empty($subj)){
                $query = ViewPisOfficerClass::find()->select(
                    ['COURSECODE','COURSENAME','REVISIONCODE','SEMESTER','ACADYEAR'
                    ])->distinct()->where(['OFFICERNAME'=>$t_name,'OFFICERSURNAME'=>$t_surname,'COURSECODE'=>$subj,'SEMESTER'=>intval($term3),'ACADYEAR'=>intval($year3)]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
                $model = $query->offset($pages->offset)
                    ->distinct('COURSECODE')
                    ->limit($pages->limit)
                    ->all();
            }else{
                $query = ViewPisOfficerClass::find()->select(
                    ['COURSECODE','COURSENAME','REVISIONCODE','SEMESTER','ACADYEAR'
                    ])->distinct()->where(['OFFICERNAME'=>$t_name,'OFFICERSURNAME'=>$t_surname,'SEMESTER'=>intval($term3),'ACADYEAR'=>intval($year3)]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
                $model = $query->offset($pages->offset)
                    ->distinct('COURSECODE')
                    ->limit($pages->limit)
                    ->all();
            }




               foreach  ($model as $row) {
                   $s = $row->COURSECODE;
                   $version = $row->REVISIONCODE;
                   $subj_t = $row->SEMESTER;
                   $subj_y = $row->ACADYEAR;
                   $subj_name = $row->COURSENAME;




                   $reqs = TaRequest::find()->where(['subject_id' => $s,
                       'subject_version' => $version, 'term_id' => $subj_t, 'year' => $subj_y])->all();
            foreach  ($reqs as $req) {
                $ver = $req->subject_version;
                $ta = TaRegister::find()->where(['subject_id'=>$req->subject_id,
                    'term'=>$req->term_id,'year'=>$req->year,'ta_status_id'=>TaStatus::CHOOSE_TA])->all();
                $sum_ta = count($ta);
                $comments = TaComment::find()->where(['subject_id'=>$req->subject_id,
                    'term'=>$req->term_id,'year'=>$req->year])->all();
                $sum_comment = count($comments);
                    ?>
                        <tbody>
                        <tr>
                            <td>
                                <?=$s?> &nbsp; <?=$subj_name?>
                            </td>
                            <td class="text-center">
                            <strong style="color: #f39a0d">
                                <i class="fa fa-user"></i>
                                <?=$sum_ta?></strong>
                            </td>
                                <td class="text-center">

                                    <?=  Html::a(Html::tag('i', '',
                                            ['class' => 'glyphicon glyphicon-comment size-15'])
                                        .'<strong class="size-15">'. $sum_comment.'</strong>',
                                        ['comment-ta2','s' =>$s,'ver'=>$version,'t'=>$subj_t,'y'=>$subj_y],
                                        ['class' => 'btn btn-sm btn-info ']) ?>
                                </td>
                        </tr>
                        </tbody>

                  <?php  } }?>
                    </table>
                    <div id="custom-pagination" class="pull-right">
                        <?php

                        echo LinkPager::widget([
                            'pagination' => $pages,
                        ])
                        ?>
                    </div>
                </div>
        <div></div>
                <!-- /panel content -->
</div>
</div>
