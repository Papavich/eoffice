<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


$this->title = controllers::t( 'label', 'Exam Group' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= controllers::t( 'label', 'Search Exam Group' ) ?></h3>

<fieldset>

    <div class="row">
        <div class="form-group">
            <!--            <div class="col-md-6 col-sm-6">-->
            <!--                --><?php
            //                echo '<label class="control-label">' . controllers::t( 'label', 'Major' ) . '</label>';
            //                try {
            //                    echo Select2::widget( [
            //                        'name' => 'major',
            //                        'id' => 'major',
            //                        'data' => ArrayHelper::map( \app\modules\eproject\models\Major::find()->all(), 'id', 'name' ),
            //                        'theme' => Select2::THEME_DEFAULT,
            //                        'options' => ['onchange' => 'getSubject()']
            //                        //                        'value' => $major
            //                    ] );
            //                } catch (Exception $e) {
            //                }
            //                ?>
            <!--                <i class="fancy-arrow-"></i>-->
            <!--            </div>-->
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
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </div>


            <div class="col-md-6 col-sm-6">
                <label><?= controllers::t( 'label', 'Subjects' ) ?></label>
                <select id="subject" name="subject" class="form-control pointer required" onchange="search()">
                    <option disabled selected value="0"> -- กรุณาเลือกรายวิขา --</option>
                </select>
            </div>
        </div>
    </div>

    <?= Html::button( '<i class="fa fa-search"></i>' . controllers::t( 'label', 'Search' ) . '', ['class' => 'btn btn-3d btn-teal pull-right', 'onclick' => "search()"] ) ?>
</fieldset>

<div id="table" style="display:none">
    <br><br>


    <table class="table table-bordered nomargin">
        <thead>
        <tr class="active">
            <th rowspan="2" style="width: 10%"><p align="center"
                                                  style="margin: 0px"><?= controllers::t( 'label', 'Exam Group' ) ?>
            </th>
            <th rowspan="2" style="width: 40%"><p align="center"
                                                  style="margin: 0px"><?= controllers::t( 'label', 'Adviser' ) ?></th>
            <th colspan="4" style="width: 5%"><p align="center"
                                                 style="margin: 0px"><?= controllers::t( 'label', 'Number of Groups' ) ?>
            </th>
            <th rowspan="2" style="width: 20%"><p align="center"
                                                  style="margin: 0px"><?= controllers::t( 'label', 'Number of Projects in Group' ) ?></p>
            </th>


        </tr>


        <tr>
            <th><p align="center">CS</p></th>
            <th><p align="center">ICT</p></th>
            <th><p align="center">GIS</p></th>
            <th><p align="center"><?= controllers::t( 'label', 'Total' ) ?></p></th>


        </tr>
        </thead>
        <tbody id="result">

        </tbody>
    </table>
    <?= Html::button( '<i class="fa fa-download"></i>' . controllers::t( 'label', 'Download' ) . '', ['class' => 'btn btn-3d btn-teal pull-right', 'onclick' => 'download()'] ) ?>

</div>
<script>
  function download () {
    let year = $('#year').val()
    let semester = $('#semester').val()
    // let major = $('#major').val()
    let subject = $('#subject').val()
    $.ajax({
      url: 'download-group',
      type: 'get',
      data: {
        year: year,
        semester: semester,
        // major: major,
        subject: subject,
      },
      beforeSend: function () {
        swalLoading()
      },
      complete: function (data, status) {
        data = data.responseJSON
        window.location.href = data
        swal.close()

      }
    })
  }
</script>
<?php
$this->registerJs( <<<JS
$(function() {
        getSubject()
})
JS
    , \yii\web\View::POS_END ); ?>


<script>
  function getSubject () {

    let table = document.getElementById('table')
    let year = $('#year').val()
    let semester = $('#semester').val()
    $.ajax({
      url: 'ajax-get-subject',
      type: 'POST',
      data: {
        year: year,
        semester: semester,
      },
      beforeSend: function () {
        swalLoading()
      },
      complete: function (data, status) {

        data = data.responseJSON
        let select = $('#subject')
        select.html('<option disabled selected> -- <?=controllers::t("label", "Please Select Subject")?> -- </option>')
        if (data.length === 0) {
          table.style.display = 'none'
        } else {
          for (let i = 0; i < data.length; i++) {
            if (i === 0) {
              select.append('<option value="' + data[i]['id'] + '" selected>' + data[i]['name'] + '</option>')
            } else {
              select.append('<option value="' + data[i]['id'] + '">' + data[i]['name'] + '</option>')
            }

          }
          search()
        }
        swal.close()

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
          console.log(data)
          for (let i = 0; i < data.length; i++) {

            let total = 0
            if (data[i].hasOwnProperty('advisers')) {
              for (let j = 0; j < data[i]['advisers'].length; j++) {
                total += data[i]['advisers'][j]['total']
              }
            }
            if (data[i].hasOwnProperty('advisers')) {
              for (let j = 0; j < data[i]['advisers'].length; j++) {
                result += '<tr>'
                if (j === 0) {
                  result += '<td rowspan="' + data[i]['advisers'].length + '" align=\'center\'>' + data[i]['name'] + '</td>'
                }

                result += '<td>' + data[i]['advisers'][j]['name'] + '</td>' +
                  '            <td align="center">' + data[i]['advisers'][j]['cs'] + '</td>' +
                  '            <td align="center">' + data[i]['advisers'][j]['ict'] + '</td>' +
                  '            <td align="center">' + data[i]['advisers'][j]['gis'] + '</td>' +
                  '            <td align="center">' + data[i]['advisers'][j]['total'] + '</td>'

                if (j === 0) {
                  result += ' <td rowspan="' + data[i]['advisers'].length + '" align="center">' + total + '</td>'
                }
                result += '</tr>'

              }
            } else {

              result += '' +
                '<tr>' +
                '<td  align=\'center\'>' + data[i]['name'] +
                '</td>' +
                '<td></td>' +
                '            <td align="center">0</td>' +
                '            <td align="center">0</td>' +
                '            <td align="center">0</td>' +
                '            <td align="center">0</td>' +

                ' <td rowspan="0" align="center">' + total + '</td>' +
                '        </tr>'

            }
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

</script>

