<?php

use yii\helpers\Html;
use app\modules\scholar_b\controllers;
use yii\widgets\LinkPager;
use app\modules\scholar_b\components\AuthHelper;
use app\modules\scholar_b\models\model_main\EofficeCentralViewStudentFull;



?>

<?= Html::csrfMetaTags() ?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Activity') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class=""><a href="../activity/index#jtab1_nobg"><?= controllers::t('label', 'Activity Main') ?></a></li>
        <li class="active"><?= controllers::t('label', 'View Activity') ?></li>
    </ol>
</header>
<!-- /page title -->
<div class="scb-activity-main-view">
    <div class="panel-body">
        <div class="col-md-12">
            <div class="group">

                <h1><?= $model->act_main_name ?></h1>
                <div align="right">
                    <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Staff) { ?>
                        <?= Html::a('<i class="fa fa-edit"></i> ' . controllers::t('label', 'Edit'), ['update',
                            'act_main_id' => $model->act_main_id,
                            'year' => $model->year, 'act_type_id' => $model->act_type_id], ['class' => '']) ?>
                        <?= Html::a('<i class="fa fa-trash"></i> ' . controllers::t('label', 'Delete'), ['deleteactivity',
                            'act_main_id' => $model->act_main_id, 'year' => $model->year, 'act_type_id' => $model->act_type_id], [
                            'style' => 'color:red;',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?php } ?>
                </div>
                <div id="content" class="padding-20">
                    <div id="panel-misc-portlet-color-r2" class="panel panel-primary padding-10">
                        <div class="row">
                            <div class="col-md-12">

                                <p>ปีการศึกษา : <?php echo $model->year ?></p>
                                <p>ประเภทกิจกรรม :
                                    <?php if ($model->actType->act_type_id == 1) {
                                        echo '<span class="label label-danger">' . $model->actType->act_type_name . '</span>';
                                    } else
                                        echo '<span class="label label-success">' . $model->actType->act_type_name . '</span>' ?>
                                </p>
                                <p>ชื่อกิจกรรม : <?php echo $model->act_main_name ?></p>
                                <p>รายละเอียด : <?php echo $model->act_main_detail ?></p>
                                <p>สถานที่ : <?php echo $model->act_main_location ?></p>
                                <p>
                                    ตั้งแต่วันที่ : <?= Yii::$app->formatter->asDatetime($model->act_main_date_start, 'medium') ?>
                                    ถึงวันที่ : <?= Yii::$app->formatter->asDatetime($model->act_main_date_end, 'medium') ?>
                                </p>

                            </div>
                        </div>
                    </div>

                    <div id="content" class="padding-20">
                        <div class="row">
                            <p>รายชื่อนักศึกษาที่เข้าร่วม
                                <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Student) { ?>
                                    <?= Html::a('<i class="fa fa-user-plus"></i> ' . controllers::t('label', 'Join'),
                                        ['select-act',
                                            'student_id' => Yii::$app->user->identity->username,
                                            'act_main_id' => $model->act_main_id,
                                            'year' => $model->year],
                                        ['class' => 'btn btn-info'
                                        ]) ?>
                                <?php } ?>
                            </p>

                            <table id="data-table" class="table table-bordered nomargin">
                                <thead>
                                <tr class="active">
                                    <th width="5%">
                                        <p align="center" style="margin: 0px">ลำดับ</p>
                                    </th>
                                    <th width="10%">
                                        <p align="center" style="margin: 0px">รหัสนักศึกษา</p>
                                    </th>
                                    <th width="20%">
                                        <p align="center" style="margin: 0px">ชื่อ-นามสกุล</p>
                                    </th>
                                    <th width="10%">
                                        <p align="center" style="margin: 0px">สาขาวิชา</p>
                                    </th>
                                    <th width="10%">
                                        <p align="center" style="margin: 0px">ประเภททุน</p>
                                    </th>
                                    <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Staff) { ?>
                                        <th width="5%">
                                            <p align="center" style="margin: 0px">#</p>
                                        </th>
                                    <?php } ?>
                                </tr>
                                </thead>
                                <?php $count = 1;
                                foreach ($std_select_act as $key => $item) { ?>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <p align="center" style="margin: 0px"><?= $count ?></p>
                                        </td>
                                        <td><?= $item->student_id ?></td>
                                        <td><?php $data = EofficeCentralViewStudentFull::find()->where(['STUDENTCODE' => $item->student_id])->one();
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
                                        <td>
                                            <p align="center" style="margin: 0px"></p>
                                        </td>
                                        <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Staff) { ?>
                                            <td>
                                                <button onclick="cancelactivity('<?php echo $item->activity_main_id ?>','<?= $key ?>')"
                                                        class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                                    Cancel
                                                </button>
                                                <?= Html::a('<i class="fa fa-trash"></i>',
                                                    ['cancelstatus',
                                                        'activity_main_id' => $item->activity_main_id,
                                                        'year' => $item->year], [
                                                        'style' => 'display:none;', 'id' => 'cancel' . $key,
                                                        'data' => [
                                                            'method' => 'post',
                                                        ],
                                                    ]) ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    </tbody>
                                    <?php
                                    $count++;
                                }
                                ?>
                            </table><br>
                            <span>จำนวนคนเข้าร่วมทั้งหมด : <?= $count-1 ?>  คน</span>
                            <!-- pagination -->
                            <div class="text-center">
                                <?php
                                echo LinkPager::widget(['pagination' => $pages,]);
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
  var dataTable = document.getElementById('data-table')
  var checkItAll = dataTable.querySelector('input[name="select_all"]')
  var inputs = dataTable.querySelectorAll('tbody>tr>td>input')

  checkItAll.addEventListener('change', function () {
    if (checkItAll.checked) {
      inputs.forEach(function (input) {
        input.checked = true
      })
    }
  })

  function cancelactivity (key, id) {
    swal({
      title: 'ยกเลิกกิจกรรม?',
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