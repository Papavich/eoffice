<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = controllers::t( 'label', 'Run Project Number' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h3><?= controllers::t( 'label', 'Run Project Number' ) ?></h3>

<fieldset>
    <!-- required [php action request] -->
    <input type="hidden" name="action" value="contact_send"/>
    <div class="row">
        <div class="form-group">

            <div class="col-md-3 col-sm-3">
                <label><?= controllers::t( 'label', 'Year' ) ?></label>
                <?php try {
                    echo Select2::widget( [
                        'name' => 'year',
                        'id' => 'year',
                        'data' => ArrayHelper::map( \app\modules\eproject\models\Year::find()->orderBy( ['id' => SORT_DESC] )->all(), 'id', 'id' ),
                        'theme' => Select2::THEME_DEFAULT,
                        'options' => ['onchange' => 'getSubject()'],
                        'value' => \app\modules\eproject\models\Year::find()->orderBy( ['id' => SORT_DESC] )->one()->id
                    ] );
                } catch (Exception $e) {
                } ?>
            </div>
            <div class="col-md-3 col-sm-3">
                <label><?= controllers::t( 'label', 'Semester' ) ?></label>
                <select name="semester" id="semester" class="form-control pointer required" onchange="getSubject()">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                </select>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6">
                    <label><?= controllers::t( 'label', 'Subjects' ) ?></label>
                    <select id="subject" name="subject" class="form-control pointer required" onchange="search()">
                        <option disabled selected value> -- <?= controllers::t( 'label', 'Please Select Subject' ) ?>
                            --
                        </option>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">

                </div>
            </div>

        </div>
    </div>
    <div class="row">

    </div>
    <?= Html::button( '<i class="fa fa-search"></i>' . controllers::t( 'label', 'Search' ) . '', ['class' => 'btn btn-3d btn-teal pull-right', 'onclick' => "search()"] ) ?>


</fieldset>

<div id="table" style="display: none">
    <br>
    <br>
    <table class="table table-bordered">
        <thead>
        <tr class="active">

            <th style="width: 10% "><p align="center" style="margin: 0px"><?= controllers::t( 'label', 'Code' ) ?>
            </th>
            <th width="40%"><p align="center" style="margin: 0px"><?= controllers::t( 'label', 'Project name' ) ?>
            </th>
            <th style="width: 35%"><p align="center"
                                      style="margin: 0px"><?= controllers::t( 'label', 'Adviser' ) ?>
            </th>
            <th width="10%"><p align="center" style="margin: 0px"><?= controllers::t( 'label', 'Exam Group' ) ?>
            </th>


        </tr>
        </thead>
        <tbody id="result">

        </tbody>
    </table>
    <br>
    <?= Html::button( '<i class="fa fa-sort-numeric-asc"></i>' . controllers::t( 'label', 'Run number' ) . '', ['class' => 'btn btn-3d btn-teal pull-right', 'onclick' => "runningNumber()"] ) ?>


    <br><br><br><br>
</div>
<!--    <hr>-->
<!--    <div>-->
<!--        <h3>--><? //= controllers::t( 'label', 'Manual Addition' ) ?><!--</h3>-->
<!--        <div class="col-md-12 col-sm-12">-->
<!--            <br><label>--><? //= controllers::t( 'label', 'Project' ) ?><!--</label>-->
<!--            <select name="contact[position]" class="form-control pointer required">-->
<!---->
<!--                <option value="1">ระบบจัดการวัสดุ</option>-->
<!--                <option value="2"> ระบบจัดการงานสารบรรณ</option>-->
<!--                <option value="2"> ระบบการจัดการบัณฑิตศึกษา</option>-->
<!--            </select>-->
<!--        </div>-->
<!---->
<!--        <div class="col-md-12 col-sm-12">-->
<!--            <br>-->
<!--            <button type="button" class="btn btn-3d btn-teal  pull-right"><i-->
<!--                        class="fa fa-save"></i>--><? //= controllers::t( 'label', 'Save' ) ?><!--</button>-->
<!---->
<!--        </div>-->
<!--    </div>-->

<?php
$this->registerJs( <<<JS
       $(function() {
        getSubject()
});

JS
    , \yii\web\View::POS_END ); ?>
<script>
  function add (id) {
    let year = $('#year').val()
    let semester = $('#semester').val()
    let major = $('#major').val()
    let subject = $('#subject').val()
    swal({
      title: '<?= controllers::t( 'label', 'Add Project Number?' ) ?>',
      text: '<?= controllers::t( 'label', 'This Action is not Undo' ) ?>',
      icon: 'warning',
      buttons: {
          okay: '<?= controllers::t( 'label', 'Okay' ) ?>',
        cancel: '<?= controllers::t( 'label', 'Cancel' ) ?>'
      },
    })
      .then((value) => {
        switch (value) {

          case 'okay':
            $.ajax({
              url: 'ajax-add',
              type: 'POST',
              data: {
                id: id,
                year: year,
                semester: semester,
                major: major,
                subject: subject,
              },
              beforeSend: function () {
                swalLoading()
              },
              complete: function (data, status) {
                console.log(data)
                swal({
                  title: '<?=controllers::t('label','Data Saved Successful')?>',
                  text: '<?=controllers::t('label','Project Number Has Been Saved')?>',
                  icon: 'success',
                  buttons: {
                    okay: '<?= controllers::t( 'label', 'Okay' ) ?>',
                  },
                })
                  .then((value) => {
                    search()
                  })
              }
            })
            break
          case 'cancel':
            break
        }
      })

  }

  function search () {

    let year = $('#year').val()
    let semester = $('#semester').val()
    let major = $('#major').val()
    let subject = $('#subject').val()
    $.ajax({
      url: 'ajax-search',
      type: 'POST',
      data: {
        year: year,
        semester: semester,
        major: major,
        subject: subject,
      },
      beforeSend: function () {
        swalLoading()
      },
      complete: function (data, status) {
        let table = document.getElementById('table')
        result = ''
        if (data.responseJSON !== false) {
          data = data.responseJSON

          for (let i = 0; i < data.length; i++) {
            result += '' +
              '<tr>' +
              ' <td><p align="center" style="margin: 0px">' + data[i]['code'] + '</td>' +
              '<td>' + data[i]['name'] + '</td>' +
              '<td>' + data[i]['adviser'] + '</td>' +
              '<td style="color: green;"><p align="center" style="margin: 0px">' + data[i]['exam_group'] + '</td>' +
              '</tr>'
          }
          table.style.display = 'block'
        } else {
          table.style.display = 'none'
          swalNotFound()
        }
        $('#result').html(result)
        swal.close()
      }
    })
  }

  function x () {
    let year = $('#year').val()
    let semester = $('#semester').val()
    let major = $('#major').val()
    let subject = $('#subject').val()
    let sort = $('#sort').val()
    $.ajax({
      url: 'ajax-running-number',
      type: 'POST',
      data: {
        year: year,
        semester: semester,
        major: major,
        subject: subject,
        sort: sort
      },
      beforeSend: function () {
        swalLoading()
      },
      complete: function (data, status) {
        let table = document.getElementById('table')
        let notfound = document.getElementById('notfound')
        result = ''
        if (data.responseJSON !== false) {
          data = data.responseJSON

          for (let i = 0; i < data.length; i++) {
            result += '' +
              '<tr>' +
              ' <td><p align="center" style="margin: 0px">' + data[i]['code'] + '</td>' +
              '<td>' + data[i]['name'] + '</td>' +
              '<td>' + data[i]['adviser'] + '</td>' +
              '<td style="color: green;"><p align="center" style="margin: 0px">' + data[i]['exam_group'] + '</td>' +
              '</tr>'
          }
          table.style.display = 'block'
        } else {
          table.style.display = 'none'
          swalNotFound()
        }
        $('#result').html(result)
        swal.close()
      }
    })
  }

  function runningNumber () {
    let year = $('#year').val()
    let semester = $('#semester').val()
    let major = $('#major').val()
    let subject = $('#subject').val()
    let sort = $('#sort').val()
    swal({
      title: '<?= controllers::t( 'label', 'Do You Want To Project Number?' ) ?>',
      text: '<?= controllers::t( 'label', 'This Action is not Undo' ) ?>',
      icon: 'info',
      buttons: {
        okay:'<?= controllers::t( 'label', 'Okay' ) ?>',
        cancel: '<?= controllers::t( 'label', 'Cancel' ) ?>',
      },
    })
      .then((value) => {
        switch (value) {

          case 'okay':
            $.ajax({
              url: 'ajax-save-number',
              type: 'POST',
              data: {
                year: year,
                semester: semester,
                major: major,
                subject: subject,
                sort: sort
              },
              beforeSend: function () {
                swalLoading()
              },
              complete: function (data, status) {
                let table = document.getElementById('table')
                result = ''
                if (data.responseJSON !== false) {
                  data = data.responseJSON

                  for (let i = 0; i < data.length; i++) {
                    result += '' +
                      '<tr>' +
                      ' <td><p align="center" style="margin: 0px">' + data[i]['code'] + '</td>' +
                      '<td>' + data[i]['name'] + '</td>' +
                      '<td>' + data[i]['adviser'] + '</td>' +
                      '<td style="color: green;"><p align="center" style="margin: 0px">' + data[i]['exam_group'] + '</td>' +
                      '</tr>'
                  }
                  table.style.display = 'block'
                } else {
                  table.style.display = 'none'
                  swalNotFound()
                }
                $('#result').html(result)
                swal.close()
                swal({
                  title: '<?=controllers::t('label','Data Saved Successful')?>',
                  text: '<?= controllers::t( 'label', 'Project Number Has Been Saved' ) ?>',
                  icon: 'success',
                  buttons: {
                    okay: '<?= controllers::t( 'label', 'Okay' ) ?>',
                  },
                })

              }
            })
            break

          case 'cancel':
            break
        }
      })

  }

  function getSubject () {
    let year = $('#year').val()
    let semester = $('#semester').val()
    let major = $('#major').val()
    $.ajax({
      url: 'ajax-get-subject',
      type: 'POST',
      data: {
        year: year,
        semester: semester,
        major: major
      },
      beforeSend: function () {
        swalLoading()
      },
      complete: function (data, status) {

        data = data.responseJSON
        let select = $('#subject')
        select.html(' <option disabled selected value> --<?= controllers::t( 'label', 'Please Select Subject' )?> -- </option>')
        for (let i = 0; i < data.length; i++) {
          select.append('<option value="' + data[i]['id'] + '">' + data[i]['name'] + '</option>')
        }
        swal.close()
      }
    })

  }

  //id is element of select2
  //data is select option : id,name
  function addSelect2 (id, data) {
    let select = $('#' + id)

// save current config. options
    let options = select.data('select2').options.options

// delete all items of the native select element
    select.html('')

// build new items
    let items = []
    for (let i = 0; i < data.length; i++) {
      items.push({
        'id': data[i]['id'],
        'text': data[i]['name']
      })
      select.append('<option value="' + data[i]['id'] + '">' + data[i]['name'] + '</option>')
    }
// add new items
    options.data = items
    select.select2(options)
  }

  function myFunction () {
    let x = document.getElementById('t4')

    x.style.display = 'block'

  }
</script>