<?php

?>
<header id="page-header">
    <h1>Database </h1>
    <ol class="breadcrumb">
        <li><a href="#">Database</a></li>
        <li class="active">Infomation</li>
    </ol><br>
    <?php  //echo $active ;?>
 <br>
</header>
<div id="content" class="padding-20">
    <div class="row">
        <div class="">
            <div class="">
                <!-- tabs -->
                <ul class="nav nav-tabs" style="margin-left: 14px;">
                    <li class="active">
                        <a href="#tab1_nobg" data-toggle="tab">
                          หลักสูตร
                        </a>
                    </li>
                    <li class="<?php if(!empty($active)&& $active==2){echo "active";} ?>">
                        <a href="#tab2_nobg" data-toggle="tab">
                          ระดับการศึกษา
                        </a>
                    </li>
                    <li class="">
                        <a href="#tab3_nobg" data-toggle="tab">
                            โรงเรียน
                        </a>
                    </li>
                    <li class="">
                        <a href="#tab4_nobg" data-toggle="tab">
                            ภาควิชา
                        </a>
                    </li>
                    <li class="">
                        <a href="#tab5_nobg" data-toggle="tab">
                            คณะ
                        </a>
                    </li>
                </ul>
                <div class="tab-content transparent">
                    <div id="tab1_nobg" class="tab-pane active">
                       <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <br>
                                    <h4><span style="color:#428bca;">Program</span></h4>
                                    <?= \yii\grid\GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'layout' => '{items}{summary}{pager}',
                                        'tableOptions' => [
                                            'class' => 'table  table-bordered table-hover dataTable',
                                        ],
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],

                                            'PROGRAMID',
                                            'PROGRAMCODE',
                                            'PROGRAMNAME',
                                            'PROGRAMTYPE',
                                            'PROGRAMYEAR',
                                            'FACULTYID',
                                            'DEPARTMENTID',
                                            'LEVELID',
//                                            'PROGRAMNAMEENG',
//                                            'PROGRAMABB',
//                                            'PROGRAMABBENG',
                                            'CREDITTOTAL',
//                                            'STUDYYEARMAX',
//                                            'PROGRAMNAMECERTIFY',
//                                            'SEMESTERPERYEAR',
                                            'PROGRAMSTATUS',
                                        ],
                                    ]); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2_nobg" class="tab-pane  <?php if(!empty($active)&& $active==2){echo "active";} ?>">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <br>
                                    <h4><span style="color:#428bca;">Level</span></h4>
                                    <?= \yii\grid\GridView::widget([
                                        'dataProvider' => $dataProvider2,
                                        'filterModel' => $searchModel2,
                                        'layout' => '{items}{summary}{pager}',
                                        'tableOptions' => [
                                            'class' => 'table  table-bordered table-hover dataTable',
                                        ],
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],

                                            'LEVELID',
                                            'LEVELNAME',
                                            'LEVELNAMEENG',
                                            'LEVELABB',
                                            'LEVELABBENG',
                                            'CURRENTACADYEAR',
                                            'CURRENTSEMESTER',
                                            'ENROLLACADYEAR',
                                            'ENROLLSEMESTER',
                                            'FIRSTYEAR',

                                        ],
                                    ]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab3_nobg" class="tab-pane ">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <br>
                                    <h4><span style="color:#428bca;">School</span></h4>
                                    <?= \yii\grid\GridView::widget([
                                        'dataProvider' => $dataProvider3,
                                        'filterModel' => $searchModel3,
                                        'layout' => '{items}{summary}{pager}',
                                        'tableOptions' => [
                                            'class' => 'table  table-bordered table-hover dataTable',
                                        ],
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            'SCHOOLID',
                                            'SCHOOLNAME',
                                            'SCHOOLNAMEENG',
                                            'SCHOOLHEAD',
                                            'SCHOOLADDRESS1',
                                            //'SCHOOLADDRESS2',
                                            //'SCHOOLDISTRICT',
                                            //'SCHOOLZIPCODE',
                                            'SCHOOLPHONENO',
                                            //'SCHOOLPROVINCEID',
                                            'SCHOOLCODE',
                                            //'FLAG1',
                                            //'NATIONID',
                                            'SCHOOLCODE2',
                                            //'VALID',
                                            //'GROUPID',
                                        ],
                                    ]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab4_nobg" class="tab-pane ">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <br>
                                    <h4><span style="color:#428bca;">Department</span></h4>
                                    <?= \yii\grid\GridView::widget([
                                        'dataProvider' => $dataProvider4,
                                        'filterModel' => $searchModel4,
                                        'layout' => '{items}{summary}{pager}',
                                        'tableOptions' => [
                                            'class' => 'table  table-bordered table-hover dataTable',
                                        ],
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            'DEPARTMENTID',
                                            'FACULTYID',
                                            'DEPARTMENTNAME',
                                            'DEPARTMENTNAMEENG',
                                        ],
                                    ]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab5_nobg" class="tab-pane ">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <br>
                                    <h4><span style="color:#428bca;">Faculty</span></h4>
                                    <?= \yii\grid\GridView::widget([
                                        'dataProvider' => $dataProvider5,
                                        'filterModel' => $searchModel5,
                                        'layout' => '{items}{summary}{pager}',
                                        'tableOptions' => [
                                            'class' => 'table  table-bordered table-hover dataTable',
                                        ],
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],

                                            'FACULTYID',
                                            'FACULTYNAME',
                                            'FACULTYNAMEENG',
                                            'FACULTYABB',
//                                            'FACULTYABBENG',
                                            'DEAN',
                                            //'DEANENG',
                                            'FACULTYTYPE',
                                            'FACULTYGROUP',

                                        ],
                                    ]); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

