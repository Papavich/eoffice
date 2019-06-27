<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use app\modules\eproject\models\User;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

$this->title = controllers::t( 'menu', 'Dashboard' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <!-- General -->
    <div id="panel-misc-portlet-r1" class="panel panel-clean" xmlns="">

        <div class="panel-heading">
            <span class="elipsis"><span class="fa fa-newspaper-o"></span>
                <strong><?= controllers::t( 'label', 'General' ) ?></strong>
            </span>

            <ul class="options pull-right list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Collapse"
                       data-placement="bottom"></a></li>
            </ul>
        </div>

        <!-- panel content -->
        <div class="panel-body">
            <div class="col-md-12">
                <button type="button" onclick="reindexProjet()" class="btn btn-3d btn-teal"><i
                            class="fa fa-repeat"></i><?= controllers::t( 'label', 'Reindex Project' ) ?></button>
                <button type="button" onclick="regeneration()" class="btn btn-3d btn-teal"><i
                            class="fa fa-plus"></i><?= controllers::t( 'label', 'Add New Enrolled Student' ) ?></button>
            </div>

 <?php $form = ActiveForm::begin( ['id' => 'regeneration','action'=>['admin-dashboard/regeneration']] );?>
            <?php ActiveForm::end();?>
        </div>
        <!-- /panel content -->

    </div>
    <!-- /General -->

    <!-- Year Semester -->
    <div id="panel-misc-portlet-r1" class="panel panel-clean">

        <div class="panel-heading">
            <span class="elipsis"><span class="fa fa-newspaper-o"></span>
                <strong><?= controllers::t( 'label', 'Semester Manager' ) ?></strong>
            </span>

            <ul class="options pull-right list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Collapse"
                       data-placement="bottom"></a></li>
            </ul>
        </div>

        <!-- panel content -->
        <div class="panel-body">
            <?php $form = ActiveForm::begin( ['id' => 'year-semester-form'] );
            $year = \app\modules\eproject\components\ModelHelper::getNowYear();
            $oldYear = $year;
            $semester = \app\modules\eproject\components\ModelHelper::getNowSemester();
            $oldSemester = $semester;
            if ($semester == 2) {
                $year++;
                $semester = 1;
            } else {
                $semester = 2;
            }
            ?>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="year"><?= controllers::t( 'label', 'Year' ) ?></label>
                    <input name="year" id="year" type="number" min="<?= $year ?>" class="form-control"
                           value="<?= $year ?>"
                           onchange="changeYear(this.value);getSubject();">
                </div>

            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="semester"><?= controllers::t( 'label', 'Semester' ) ?></label>
                    <input name="semester" id="semester" type="number" min="<?= $semester ?>" class="form-control"
                           value="<?= $semester ?>" max="2" onchange="getSubject()">
                </div>
            </div>
            <?php foreach (\app\modules\eproject\models\Major::find()->all() as $major) { ?>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="adviser-<?= $major->id ?>"><?= controllers::t( 'label', 'Default Project Per Adviser' ) . " : " . $major->code ?></label>
                        <input name="adviser-<?= $major->id ?>" id="adviser-<?= $major->id ?>" type="number"
                               class="form-control" value="5">
                    </div>
                </div>

            <?php } ?>

            <!--                <label class="switch switch-success switch-round">-->
            <!--                    <input type="checkbox" checked="" name="transferExamGroup">-->
            <!--                    <span class="switch-label" data-on="-->
            <? //= controllers::t( 'label', 'Yes' ) ?><!--" data-off="-->
            <? //= controllers::t( 'label', 'No' ) ?><!--"></span>-->
            <!--                    --><? //= controllers::t( 'label', 'Transfer Exam Groups' ) ?>
            <!--                </label>-->
            <div class="col-md-12">
                <button type="button" onclick="saveYearSemester()" class="btn btn-3d btn-teal pull-right"><i
                            class="fa fa-save"></i><?= controllers::t( 'label', 'Save' ) ?></button>
            </div>


            <?php ActiveForm::end() ?>

        </div>
        <!-- /panel content -->

    </div>
    <!-- /Year Semester -->
    <div id="panel-misc-portlet-r1" class="panel panel-clean">

    <div class="panel-heading">
            <span class="elipsis"><span class="fa fa-users"></span>
                <strong><?= controllers::t( 'label', 'Transfer Exam Groups' ) ?></strong>
            </span>

        <ul class="options pull-right list-inline">
            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Collapse"
                   data-placement="bottom"></a></li>
        </ul>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin( ['action'=>['admin-dashboard/transfer-exam-group'],'id'=>'transfer-project-examination-form'] );?>
    <div class="col-md-12">
        <div class="col-md-6" align="center">
            <strong>
            <?=\app\modules\eproject\components\ModelHelper::getRecentlyYearSemester()->semester_id?> /
            <?=\app\modules\eproject\components\ModelHelper::getRecentlyYearSemester()->year_id?>
            </strong>
        </div>
        <div class="col-md-6" align="center">
            <strong>
            <?=\app\modules\eproject\components\ModelHelper::getNowSemester()?> /
            <?=\app\modules\eproject\components\ModelHelper::getNowYear()?>
            </strong>

        </div>
    </div>
        <br>
        <br>
        <?php
        foreach ($subjects as $key => $subject) {
            ?>

            <div class="col-md-12">
                <div class="col-md-6">
                    <label for="from-<?= $key ?>"><?= controllers::t( 'label', 'From' ) ?></label>
                    <select class="form-control" id="from-<?= $key ?>" name="from[]" disabled>
                        <option value="<?= $subject->id ?>"><?= $subject->name ?></option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="to-<?= $key ?>"><?= controllers::t( 'label', 'To' ) ?></label>
                    <select class="form-control" id="to-<?= $key ?>" name="to[]">
                        <option value="0" selected>---Not Transfer---</option>
                    </select>
                </div>
            </div>
        <?php } ?>
        <div class="col-md-12">

            <br>
            <button type="button" onclick="transferExamGroup()" class="btn btn-3d btn-teal pull-right"><i
                        class="fa fa-save"></i><?= controllers::t( 'label', 'Save' ) ?></button>
        </div>
        <?php ActiveForm::end() ?>
    </div>
    </div>


    <script>
      function transferExamGroup() {
        swal({
          title: '<?=controllers::t( 'label', 'Do You Want To Transfer Examination Group?' )?>',
          text: '<?=controllers::t( 'label', 'This Action is not Undo' )?>',
          icon: 'warning',
          buttons: {
            okay: '<?=controllers::t( 'label', 'Okay' )?>',
            cancel: '<?=controllers::t( 'label', 'Cancel' )?>'
          },
        })
          .then((value) => {
            switch (value) {
              case 'okay':
                $('#transfer-project-examination-form').submit()
                break
              case 'cancel':
                break
              default:
                break
            }

          })

      }


      function changeYear (val) {
        console.log('test')

        if (val ><?=\app\modules\eproject\components\ModelHelper::getNowYear()?>) {
          $('#semester').attr({
            'min': 1,
            'value': 1
          })
        } else {
          $('#semester').attr({
            'min': <?=\app\modules\eproject\components\ModelHelper::getNowSemester()?>,
            'value': <?=\app\modules\eproject\components\ModelHelper::getNowSemester()?>
          })
        }
      }
      function regeneration () {
        swal({
          title: '<?=controllers::t( 'label', 'Do You Want To Add New Enrolled Student?' )?>',
          text: '<?=controllers::t( 'label', 'This Action is not Undo' )?>',
          icon: 'warning',
          buttons: {
            okay: '<?=controllers::t( 'label', 'Okay' )?>',
            cancel: '<?=controllers::t( 'label', 'Cancel' )?>'
          },
        })
          .then((value) => {
            switch (value) {
              case 'okay':
                $('#regeneration').submit()
                break
              case 'cancel':
                break
              default:
                break
            }

          })

      }

      function saveYearSemester () {
        swal({
          title: '<?=controllers::t( 'label', 'Do You Want To Change Semester?' )?>',
          text: '<?=controllers::t( 'label', 'This Action is not Undo' )?>',
          icon: 'warning',
          buttons: {
            okay: '<?=controllers::t( 'label', 'Okay' )?>',
            cancel: '<?=controllers::t( 'label', 'Cancel' )?>'
          },
        })
          .then((value) => {
            switch (value) {
              case 'okay':
                $('#year-semester-form').submit()
                break
              case 'cancel':
                break
              default:
                break
            }

          })

      }

      function reindexProjet () {
        swal({
          title: '<?=controllers::t( 'label', 'Reindex Project?' )?>',
          text: '<?=controllers::t( 'label', 'This Action is not Undo' )?>',
          icon: 'warning',
          buttons: {
            okay: '<?=controllers::t( 'label', 'Okay' )?>',
            cancel: '<?=controllers::t( 'label', 'Cancel' )?>'
          },
        })
          .then((value) => {
            switch (value) {

              case 'okay':
                $.ajax({
                  url: 'ajax-reindex-project',
                  type: 'POST',
                  data: {},
                  beforeSend: function () {
                    swalLoading()
                  },
                  complete: function (data, status) {
                    if (data.responseJSON === true) {
                      swal({
                        title: '<?=controllers::t( 'label', 'Data Saved Successful' ) ?>',
                        text: '<?=controllers::t( 'label', 'Project Index Has Been Generated' ) ?>',
                        icon: 'success',
                        buttons: {
                          okay: '<?=controllers::t( 'label', 'Okay' )?>',
                        },
                      })
                    } else {
                      swal({
                        title: '<?=controllers::t( 'label', 'Something Went Wrong' )?>',
                        text: '<?=controllers::t( 'label', 'Cannot Save This Project' )?>',
                        icon: 'warning',
                        buttons: {
                          okay: '<?=controllers::t( 'label', 'Okay' )?>',
                        },
                      })
                    }
                  }
                })
                break

              case 'cancel':
                break
            }
          })
      }
    </script>
<?php
$this->registerJs( <<<JS
$(function() {
        getSubject()
});
      function getSubject () {
        let year = $('#year').val()
        let semester = $('#semester').val()
        $.ajax({
          url: 'ajax-get-subject',
          type: 'POST',
          data: {
           
          },
          beforeSend: function () {
            swalLoading()
          },
          complete: function (data, status) {
            data = data.responseJSON
            for (let i=0;i<$('select[name*="to[]"]').length;i++){
                let select = $('#to-'+i)
                select.html('  <option value="0" selected>---Not Transfer---</option>')
                if(data.length===0){
                 
                }else {
                  for (let i = 0; i < data.length; i++) {
                       select.append('<option value="' + data[i]['id'] + '">' + data[i]['name'] + '</option>')
                     
                }
                }
             }
            swal.close()
            
          }
        })

      }
      $('#year-semester-form').submit(function (e) {
            swalLoading()
    });
      $('#regeneration').submit(function (e) {
            swalLoading()
    });
       $('#transfer-project-examination-form').submit(function (e) {
            swalLoading()
    });
JS

    , \yii\web\View::POS_END ); ?>