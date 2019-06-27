<?php

use app\modules\scholar_b\models\ScbYear;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\scholar_b\controllers;
use app\modules\scholar_b\components\AuthHelper;
use yii\helpers\Url;
use yii\timeago\TimeAgo;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use app\modules\scholar_b\models\model_main\EofficeCentralViewStudentFull;
use app\modules\scholar_b\models\Listactivity;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->registerJsFile('@web/web_scb/js/sweetalert.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/web_scb/js/tabmenu.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
    <style>
        * {
            box-sizing: border-box;
        }

        .zoom {
            padding: auto;
            background-color: white;
            transition: transform .2s;
            width: auto;
            height: auto;
            margin: 0 auto;
        }

        .zoom:hover {
            -ms-transform: scale(1.5); /* IE 9 */
            -webkit-transform: scale(1.5); /* Safari 3-8 */
            transform: scale(1.5);
        }
    </style>

<?= Html::csrfMetaTags() ?>
    <!-- page title -->
    <header id="page-header">
        <h1><?= controllers::t('label', 'Activity') ?></h1>
        <ol class="breadcrumb">
            <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
            <li class="active"><?= controllers::t('label', 'Activity Main') ?></li>
        </ol>
    </header>
    <!-- /page title -->

    <div class="scb-activity-main-index">
        <div id="content" class="padding-20">
            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <span>
                            <i class="fa fa-tag"></i>
                            <?= controllers::t('label', 'Activity') ?>
                            </a>
                        </span>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse in">
                            <div class="panel-body">
                                <div class="tabs nomargin">

                                    <!-- tabs -->
                                    <ul class="nav nav-tabs nav-justified tabmenu">
                                        <li class="active">
                                            <a href="#jtab1_nobg" data-toggle="tab" aria-expanded="false">
                                                <i class="fa fa-bars"></i> รายชื่อกิจกรรม
                                            </a>
                                        </li>
                                        <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Student) { ?>
                                            <li>
                                                <a href="#jtab2_nobg" data-toggle="tab" aria-expanded="false">
                                                    <i class="fa fa-image"></i> กิจกรรมที่ลงทะเบียน
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Staff) { ?>
                                            <li class="">
                                                <a href="#jtab3_nobg" data-toggle="tab" aria-expanded="false">
                                                    <i class="fa fa-cogs"></i> เพิ่มกิจกรรม
                                                </a>
                                            </li>

                                            <li class="">
                                                <a href="#jtab4_nobg" data-toggle="tab" aria-expanded="false">
                                                    <i class="fa fa-check-square-o"></i> เช็คสถานะเข้ากิจกรรม
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>

                                    <!-- tabs content -->
                                    <div class="tab-content transparent">
                                        <!--START TAB1 แสดงรายการกิจกรรมภาควิชา -->
                                        <div id="jtab1_nobg" class="tab-pane active">

                                            <div class="row">
                                                <div class="col-md-2 col-sm-2">
                                                    <?php $form = ActiveForm::begin([
                                                        'class' => 'horizontal',
                                                        'method' => 'get',
                                                    ]); ?>

                                                    <?php
                                                    $years = ScbYear::find()->orderBy(['year' => SORT_DESC])->all();
                                                    foreach ($years as $year) {

                                                    }
                                                    echo Select2::widget([
                                                        'name' => 'year',
                                                        'value' => $year->year,
                                                        'theme' => Select2::THEME_DEFAULT,
                                                        'data' => ArrayHelper::map(ScbYear::find()->all(), 'year', 'year'),
                                                        'options' => [
                                                            'placeholder' => 'Select type year',
                                                            'multiple' => false]
                                                    ]);
                                                    ?>
                                                </div>
                                                <div class="col-md-1 col-sm-1">
                                                    <?= Html::submitButton('<i class="fa fa-search"></i>' . controllers::t('label', 'Search'), ['class' => 'btn btn-blue']) ?>
                                                </div>

                                                <?php ActiveForm::end(); ?>
                                            </div>
                                            <br>

                                            <table class="table table-striped table-responsive">
                                                <thead>
                                                <tr>
                                                    <th width="20%">ชื่อกิจกรรม</th>
                                                    <th width="20%">ระยะเวลา</th>
                                                    <th width="15%">สถานที่</th>
                                                    <th width="10%">ประเภทกิจกรรม</th>
                                                    <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Staff) { ?>
                                                        <th width="10%">#</th>
                                                        <th width="10%"><?= controllers::t('label', 'Export') ?></th>
                                                    <?php } ?>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                foreach ($model as $key => $item) { ?>
                                                <tr>
                                                    <td>
                                                        <a href="<?php echo Url::toRoute(['activity/view', 'act_main_id' => $item->act_main_id, 'year' => $item->year]); ?>">
                                                            <ul class="list-unstyled list-icons margin-bottom-10">
                                                                <li class="margin-top-6"><i
                                                                            class="fa fa-angle-right"></i>
                                                                    <strong> <?php echo $item->act_main_name; ?> </strong>
                                                            </ul>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?= Yii::$app->formatter->asDatetime($item->act_main_date_start, 'short') ?>
                                                        - <?= Yii::$app->formatter->asDatetime($item->act_main_date_end, 'short') ?>
                                                    </td>
                                                    <td><?php echo $item->act_main_location ?></td>
                                                    <td>
                                                        <?php if ($item->actType->act_type_id == 1) {
                                                            echo '<span class="label label-danger">' . $item->actType->act_type_name . '</span>';
                                                        } else
                                                            echo '<span class="label label-success">' . $item->actType->act_type_name . '</span>'; ?>
                                                    </td>

                                                    <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Staff) { ?>
                                                    <td>

                                                        <a href="../activity/update?act_main_id=<?= $item->act_main_id ?>&year=<?= $item->year ?>&act_type_id=<?= $item->act_type_id ?>"
                                                           class="btn btn-info btn-xs">
                                                            <i class="fa fa-edit"></i> <?= controllers::t('label', 'Edit') ?>
                                                        </a>

                                                        <button onclick="deleteactivity('<?php echo $item->act_main_id ?>','<?= $key ?>')"
                                                                class="btn btn-danger btn-xs">
                                                            <i class="fa fa-trash"></i><?= controllers::t('label', 'Delete') ?>
                                                        </button>

                                                        <?= Html::a('<i class="fa fa-trash"></i> ', ['deleteactivity',
                                                            'act_main_id' => $item->act_main_id,
                                                            'year' => $item->year,
                                                            'act_type_id' => $item->act_type_id], [
                                                            'style' => 'display:none;', 'id' => 'delete' . $key,
                                                            'data' => [
                                                                'method' => 'post',
                                                            ],
                                                        ]) ?>

                                                    </td>
                                                    <td>
                                                        <input type="hidden" value="<?= $item->act_main_id ?>"
                                                               id="act_main_id">
                                                       <!-- <button class="btn btn-blue btn-xs">
                                                            <i class="fa fa-download" id="createreport"></i>
                                                        </button>-->
                                                        <?= Html::a(' <i class="fa fa-download" style="font-size:40px;color:green"></i>'
                                                            , ['excel' , 'act_main_id' => $item->act_main_id , 'year' => $item->year], ['class' => '','target' => '_blank']) ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                </tbody>


                                                <?php } ?>
                                            </table>
                                            <!-- pagination -->
                                            <div class="text-center">
                                                <?php
                                                echo LinkPager::widget([
                                                    'pagination' => $pages,
                                                ]);
                                                ?>
                                            </div>
                                        </div>
                                        <!-- END TAB 1 -->

                                        <!-- START TAB2 หน้าอัพโหลดหลักฐานการเข้าร่วมกิจกรรม-->
                                        <div id="jtab2_nobg" class="tab-pane">
                                            <table class="table table-striped table-responsive">
                                                <thead>
                                                <tr>
                                                    <th width="5%">ลำดับ</th>
                                                    <th width="20%">ชื่อกิจกรรม</th>
                                                    <th width="10%">สถานะ</th>
                                                    <th width="15%">อัพโหลดหลักฐานกิจกรรม</th>
                                                    <th width="5%"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $count = 1;
                                                foreach ($std as $key => $item) { ?>
                                                <tr>
                                                    <td><?= $count ?></td>
                                                    <td><?= $item->act_main_name ?></td>
                                                    <td><?php if ($item->select_activity_status == 0) {
                                                            echo '<span class="label label-danger">ยังไม่อนุมัติ</span>';
                                                        } else {
                                                            echo '<span class="label label-success">อนุมัติแล้ว</span>';
                                                        } ?>
                                                    </td>
                                                    <td><?php if ($item->select_activity_status == 0) { ?>
                                                            <a href="../uploadact/update?student_id=<?= $item->student_id ?>&activity_main_id=<?= $item->activity_main_id ?>&year=<?= $item->year ?>"
                                                               class="btn btn-xs btn-info">อัพโหลดหลักฐาน
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php if ($item->select_activity_status == 0) { ?>
                                                            <button onclick="cancelActivity('<?php echo $item->student_id ?>','<?= $key ?>')"
                                                                    class="btn btn-danger btn-xs"><i
                                                                        class="fa fa-trash"></i>
                                                                ยกเลิกกิจกรรม
                                                            </button>
                                                        <?php } ?>

                                                        <?= Html::a('<i class="fa fa-trash"></i>', [
                                                            'uploadact/delete', 'student_id' => $item->student_id,
                                                            'activity_main_id' => $item->activity_main_id,
                                                            'year' => $item->year], [
                                                            'style' => 'display:none;', 'id' => 'cancel' . $key,
                                                            'data' => [
                                                                'method' => 'post',
                                                            ],
                                                        ]) ?>

                                                    </td>
                                                </tr>
                                                </tbody>
                                                <?php $count++;
                                                } ?>
                                            </table>
                                        </div>

                                        <!-- END TAB 2 -->


                                        <!-- START TAB3 เพิ่มกิจกรรมทุน-->
                                        <div id="jtab3_nobg" class="tab-pane">
                                            <div class="container">

                                                <?php $form = ActiveForm::begin([
                                                    'action' => '../activity/addactindex',
                                                    'method' => 'post',
                                                ]); ?>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-2 col-sm-2">
                                                            <?= $form->field($model_activity, 'year')->dropDownList(controllers\GetModelController::getYear()) ?>
                                                        </div>

                                                        <div class="col-md-2 col-sm-2">
                                                            <?= $form->field($model_activity, 'act_type_id')->dropDownList(controllers\GetModelController::getActivitytype()) ?>
                                                        </div>


                                                        <div class="col-md-2 col-sm-2">
                                                            <?= $form->field($model_activity, 'act_main_id')->textInput(['maxlength' => true]) ?>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-8 col-sm-8">
                                                            <?= $form->field($model_activity, 'act_main_name')->textInput(['placeholder' => 'ชื่อกิจกรรม',]) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-8 col-sm-8">
                                                            <?= $form->field($model_activity, 'act_main_detail')->textarea([
                                                                'rows' => '8',
                                                                'placeholder' => 'รายละเอียดกิจกรรม']) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-8 col-sm-8">
                                                            <?= $form->field($model_activity, 'act_main_location')->textInput(['placeholder' => 'สถานที่']) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-4">
                                                            <?= $form->field($model_activity, 'act_main_date_start')->widget(DateTimePicker::classname(), [
                                                                'name' => 'dp_1',
                                                                'type' => DateTimePicker::TYPE_INPUT,
                                                                'pluginOptions' => [
                                                                    'autoclose' => true,
                                                                    'format' => 'yyyy-mm-dd hh:ii:ss'
                                                                ],
                                                                'options' => ['class' => 'form-control',
                                                                    'placeholder' => 'วันที่เริ่มกิจกรรม']
                                                            ]) ?>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <?= $form->field($model_activity, 'act_main_date_end')->widget(DateTimePicker::classname(), [
                                                                'name' => 'dp_1',
                                                                'type' => DateTimePicker::TYPE_INPUT,
                                                                'pluginOptions' => [
                                                                    'autoclose' => true,
                                                                    'format' => 'yyyy-mm-dd hh:ii:ss'
                                                                ],
                                                                'options' => ['class' => 'form-control',
                                                                    'placeholder' => 'วันที่จบกิจกรรม']
                                                            ]) ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-8" align="right">
                                                        <?= Html::submitButton('<i class="fa fa-save"></i>'
                                                            . controllers::t('label', 'Save') . '', ['class' => 'btn btn-success']) ?>
                                                    </div>
                                                </div>
                                                <?php ActiveForm::end(); ?>
                                            </div>
                                        </div>
                                        <!-- END TAB 3-->

                                        <!-- START TAB 4 อนุมัติการเข้าร่วมกิจกรรม-->
                                        <div id="jtab4_nobg" class="tab-pane">
                                            <table id="data-table" class="table table-bordered nomargin">
                                                <thead>
                                                <tr class="active">
                                                    <th width="5%">
                                                        <p align="center" style="margin: 0px">ลำดับ</p>
                                                    </th>
                                                    <th width="10%">
                                                        <p align="center" style="margin: 0px">
                                                            ชื่อกิจกรรม</p>
                                                    </th>
                                                    <th width="10%">
                                                        <p align="center" style="margin: 0px">
                                                            รหัสนักศึกษา</p>
                                                    </th>
                                                    <th width="15%">
                                                        <p align="center" style="margin: 0px">
                                                            ชื่อ-นามสกุล</p>
                                                    </th>
                                                    <th width="10%">
                                                        <p align="center" style="margin: 0px">สาขาวิชา</p>
                                                    </th>
                                                    <th width="10%">
                                                        <p align="center" style="margin: 0px">ประเภททุน</p>
                                                    </th>
                                                    <th width="10%">
                                                        <p align="center" style="margin: 0px">รูปภาพ</p>
                                                    </th>
                                                    <th width="5%">
                                                        <p align="center" style="margin: 0px">#</p>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <?php $count = 1;
                                                foreach ($data as $key => $item) { ?>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <p align="center"
                                                           style="margin: 0px"><?= $count ?></p>
                                                    </td>
                                                    <td><?= $item->activityMain->act_main_name ?></td>
                                                    <td><?= $item->student_id ?></td>
                                                    <td>
                                                        <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item->student_id])->one();
                                                        if ($data) {
                                                            echo $data->PREFIXNAME . ' ' . $data->STUDENTNAME . ' ' . $data->STUDENTSURNAME;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item->student_id])->one();
                                                        if ($data) {
                                                            echo $data->major_name;
                                                        } ?>
                                                    </td>
                                                    <td></td>
                                                    <td class="zoom">
                                                        <?php echo Html::img('@web/web_scb/uploads/activity/images/' . $item->activity_img, ['width' => 200]) ?>
                                                    </td>
                                                    <td>
                                                        <button onclick="approveActivity('<?php echo $item->student_id ?>','<?= $key ?>')"
                                                                class="btn btn-success btn-xs"><i
                                                                    class="fa fa-check-square-o"></i>
                                                            <?= controllers::t('label', 'Accept') ?>
                                                        </button>

                                                        <button onclick="disapproveActivity('<?php echo $item->student_id ?>','<?= $key ?>')"
                                                                class="btn btn-danger btn-xs"><i
                                                                    class="fa fa-trash"></i>
                                                            <?= controllers::t('label', 'Cancel') ?>
                                                        </button>


                                                        <?= Html::a('<i class="fa fa-check-square-o"></i>', [
                                                            'status', 'student_id' => $item->student_id,
                                                            'activity_main_id' => $item->activity_main_id,
                                                            'year' => $item->year],
                                                            ['style' => 'display:none;', 'id' => '0' . $key
                                                            ]) ?>

                                                        <?= Html::a('<i class="fa fa-trash"></i>', [
                                                            'deletestatus', 'student_id' => $item->student_id,
                                                            'activity_main_id' => $item->activity_main_id,
                                                            'year' => $item->year], [
                                                            'style' => 'display:none;', 'id' => '1' . $key,
                                                            'data' => [
                                                                'method' => 'post',
                                                            ],
                                                        ]) ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $count++;
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- END TAB 4-->


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--Get all flash messages and loop through them -->
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo \kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php endforeach; ?>

    <script>
      function deleteactivity (key, id) {
        swal({
          title: 'ยืนยันการลบกิจกรรม?',
          icon: 'warning',
          dangerMode: true,
          buttons: {
            okay: 'ตกลง',
            cancel: 'ยกเลิก'

          }
        }).then((value) => {
          switch (value) {
          case
            'okay'
          :
            $('#delete' + id).get(0).click()
            break

          case
            'cancel'
          :
            break
          }
        }
      )
      }

      function approveActivity (key, id) {
        swal({
          title: 'ยืนยันการอนุมัติคำร้อง?',
          icon: 'warning',
          buttons: {
            okay: 'ตกลง',
            cancel: 'ยกเลิก'

          }
        })
          .then((value) => {
          switch (value) {
          case
            'okay'
          :
            $('#0' + id).get(0).click()
            break

          case
            'cancel'
          :
            break
          }
        }
      )
      }

      function disapproveActivity (key, id) {
        swal({
          title: 'ยืนยันการลบคำร้อง?',
          icon: 'warning',
          dangerMode: true,
          buttons: {
            okay: 'ตกลง',
            cancel: 'ยกเลิก'

          }
        }).then((value) => {
          switch (value) {
          case
            'okay'
          :
            $('#1' + id).get(0).click()
            break

          case
            'cancel'
          :
            break
          }
        }
      )

      }

      function cancelActivity (key, id) {
        swal({
          title: 'ต้องการยกเลิกกิจกรรม?',
          icon: 'warning',
          dangerMode: true,
          buttons: {
            okay: 'ต้องการ',
            cancel: 'ยกเลิก'

          }
        }).then((value) => {
          switch (value) {
          case
            'okay'
          :
            $('#cancel' + id).get(0).click()
            break

          case
            'cancel'
          :
            break
          }
        }
      )

      }

    </script>
<?php

$this->registerJs(<<<JS
$("#createreport").click(function(){
  var act_main_id =  $('#act_main_id').val();
    $.ajax({
    url: '../activity/excel',
    data: {
      'act_main_id': act_main_id
    },
    type: "get",
});
});

JS
);
?>