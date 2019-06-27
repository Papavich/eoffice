<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_exam\models\ExamTeacherExchangeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'กระทู้แลกเปลี่ยนวันคุมสอบ';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="exam-teacher-exchange-index">


     <div id="content" class="">

   <div class="row">

     <!-- LEFT -->
     <div class="col-md-12">

       <!-- Panel Tabs -->
       <div id="panel-ui-tan-l1" class="panel panel-default">

         <div class="panel-heading">

           <!-- tabs nav -->
           <ul class="nav nav-tabs pull-right">
             <li class="active"><!-- TAB 1 -->
               <a href="#tab1" data-toggle="tab"><span class="fa fa-comments-o ">กระทู้แลกเปลี่ยนวันคุมสอบ</span></a>
             </li>
             <li class=""><!-- TAB 2 -->
               <a href="#tab2" data-toggle="tab"><span class="fa fa-plus-square ">ข้อมูลการแลกเปลี่ยนวันคุมสอบ</span></a>
             </li>
           </ul>
           <!-- /tabs nav -->

         </div>

         <!-- panel content -->
         <div class="panel-body">

             <!-- tabs content -->
             <div class="tab-content transparent">

               <div id="tab1" class="tab-pane active"><!-- แท็บที่ 1 กระทู้แลกเปลี่ยนวันคุมสอบ  -->
                 <blockquote>
                 <h3><?= Html::encode($this->title) ?></h3>

               </blockquote>

               <div class="col-sm-6 col-md-12">
               <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div>
              <!-- วิวแสดงข้อมูลของกระทู้จากตาราง exam_teacher_exchange  -->
               <?= GridView::widget([
               'dataProvider' => $dataProvider,
               //'filterModel' => $searchModel,
               'columns' => [
                   ['class' => 'yii\grid\SerialColumn'],

                   'exam_exchange_date',
                   'exam_exchange_start_time',
                   'exam_exchange_end_time',
                   'rooms_id',
                   'positions.academic_positions_abb_thai',
                   'name.person_name',
                   'surname.person_surname',
                   'mobile.person_mobile',
                   //'person_id',
                   'exam_exchange_note',
                   //'exam_per_exchange',
                   //'exam_type_namethai',
                   //'subopen_year',
                   //'subopen_semester',
                   //'eaxm_exchange_tel',
                   //'exam_exchange_status',
                  [
                     'class' => 'yii\grid\ActionColumn',
                     'buttonOptions'=>['class'=>'btn btn-3d btn-default'],
                     'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {view}</div>',],
                   ],
           ]); ?>

           <p>
               <?= Html::a('เพิ่มข้อมูลการแลกเปลี่ยนการคุมสอบ', ['create'], ['class' => 'btn btn-blue btn-3d fa fa-pencil-square-o']) ?>
           </p>

         </div> <!--จบแท็บแรก -->



               <div id="tab2" class="tab-pane"><!-- แท็บที่สอง ข้อมูข้อมูลการแลกเปลี่ยนวันคุมสอบ -->
                 <blockquote>
                 <h3>ข้อมูลการแลกเปลี่ยนวันคุมสอบ</h3>
                 </blockquote>


                 <!-- วิวแสดงข้อมูลของกระทู้จากตาราง exam_teacher_exchange แบบเฉพาะจารที่ login  -->
                 <?= GridView::widget([
                      'dataProvider' => $dataProvider2,
                      //'filterModel' => $searchModel,
                      'columns' => [
                          ['class' => 'yii\grid\SerialColumn'],

                          'exam_exchange_date',
                          'exam_exchange_start_time',
                          'exam_exchange_end_time',
                          'exam_exchange_note',
                          'rooms_id',
                          //'person_id',
                          //'exchangname.person_name',


                          //'exam_per_exchange',
                          //'exam_type_namethai',
                          //'subopen_year',
                          //'subopen_semester',
                          //'eaxm_exchange_tel',
                          //'exam_exchange_status',
                          'mobile.person_mobile',


                          [
                            'class' => 'yii\grid\ActionColumn',
                            'buttonOptions'=>['class'=>'btn btn-3d btn-default'],
                            'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {view}</div>',],
                          ],

                  ]); ?>


               </div><!-- /TAB 1 CONTENT -->

             </div>
             <!-- /tabs content -->

         </div>
         <!-- /panel content -->

       </div>
       <!-- /Panel Tabs -->
</div>
