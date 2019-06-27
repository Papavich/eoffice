<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use app\modules\eproject\models\User;
use kartik\select2\Select2;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

$this->title = controllers::t( 'label', 'Set Exam Group' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= controllers::t( 'label', 'Search Exam Group' ) ?></h3>

<fieldset>
    <!-- required [php action request] -->
    <input type="hidden" name="action" value="contact_send"/>
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
</div>

<br><br>
<div id="addGroup" style="display:none">
    <hr>
    <h3><?= controllers::t( 'label', 'Add Exam Group' ) ?></h3>
    <div class="col-md-6 col-sm-6">
        <label><?= controllers::t( 'label', 'Group Name' ) ?></label>

        <input type="text" id="group-name" class="form-control required">
    </div>
    <div class="col-md-6 col-sm-6">
        <label><?= controllers::t( 'label', 'Room' ) ?></label>

        <input type="text" id="room" class="form-control required">
    </div>
    <br>


    <div class="col-md-12 col-sm-12">
        <br>
        <button type="button" class="btn btn-3d btn-teal pull-right" onclick="addGroup()"><i
                    class="fa fa-save"></i><?= controllers::t( 'label', 'Save' ) ?></button>
    </div>


    <br><br>

    <div>
        <br><br>
        <hr>
        <h3><?= controllers::t( 'label', 'Add Teacher To Exam Group' ) ?></h3>
        <div class="col-md-6 col-sm-6">
            <label><?= controllers::t( 'label', 'Advisers' ) ?></label>
            <?php echo Select2::widget( [
                'name' => 'teacher',
                'id' => 'teacher',
                'data' => ArrayHelper::map( User::find()->where( ['user_type_id' => 1] )->all(), 'id', 'name' ),
                'theme' => Select2::THEME_DEFAULT
            ] );
            ?>
        </div>


        <div class="col-md-6 col-sm-6">
            <label><?= controllers::t( 'label', 'Exam Group' ) ?></label>

            <select id="tGroup" class="form-control pointer required">

            </select>
        </div>
        <br>


    </div>
    <div class="col-md-12 col-sm-12">
        <br>
        <button type="button" onclick="addTeacher()" class="btn btn-3d btn-teal pull-right"><i
                    class="fa fa-save"></i><?= controllers::t( 'label', 'Save' ) ?></button>
    </div>
</div>
<?php
$this->registerJs( <<<JS
  $(function () {
    getSubject()
  })

JS
    , \yii\web\View::POS_END ); ?>
<script>


  function getSubject () {

    let table = document.getElementById('table')
    let addGroup = document.getElementById('addGroup')
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
        select.html(' <option disabled selected> -- <?=controllers::t( 'label', 'Please Select Subject' ) ?> -- </option>')
        if (data.length === 0) {
          addGroup.style.display = 'none'
          table.style.display = 'none'
        } else {
          addGroup.style.display = 'block'
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
        let select = $('#tGroup')
        select.html('')
        result = ''
        if (data.responseJSON !== false) {
          data = data.responseJSON
          console.log(data)
          for (let i = 0; i < data.length; i++) {
            if (i === 0) {
              select.append('<option value="' + data[i]['id'] + '" selected>' + data[i]['name'] + '</option>')
            } else {
              select.append('<option value="' + data[i]['id'] + '">' + data[i]['name'] + '</option>')
            }
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
                  result += '<td rowspan="' + data[i]['advisers'].length + '" align=\'center\'>' + data[i]['name'] + '<a onclick=\'updateGroup(' + data[i]['id'] + ')\'><i class=\'fa fa-edit\' style=\'color:blue\' ></i> </a><a onclick=\'removeGroup(' + data[i]['id'] + ')\'><i class=\'fa fa-trash\'' +
                    'style=\'color:orangered\'></i></a></td>'
                }

                result += '<td><a onclick=\'removeTeacher(' + data[i]['id'] + ',' + data[i]['advisers'][j]['id'] + ')\'><i class=\'fa fa-trash\' style=\'color:orangered\'></i></a>' + data[i]['advisers'][j]['name'] + '</td>' +
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
                '<td  align=\'center\'>' + data[i]['name'] + '<a onclick=\'updateGroup(' + data[i]['id'] + ')\'><i class=\'fa fa-edit\' style=\'color:blue\'></i></a> <a onclick=\'removeGroup(' + data[i]['id'] + ')\'><i class=\'fa fa-trash\'' +
                'style=\'color:orangered\'></i></a></td>' +
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

  function addGroup () {
    let year = $('#year').val()
    let semester = $('#semester').val()
    let subject = $('#subject').val()
    let name = $('#group-name').val()
    let room = $('#room').val()
    $.ajax({
      url: 'ajax-add-group',
      type: 'POST',
      data: {
        year: year,
        semester: semester,
        subject: subject,
        room: room,
        name: name
      },
      beforeSend: function () {
        swalLoading()
      },
      complete: function (data, status) {
        if (data.responseJSON === true) {
          swal({
            title:  '<?=controllers::t( 'label', 'Data Saved Successful' )?>',
            text: '<?=controllers::t( 'label', 'The Exam Group Has Been Saved' )?>',
            icon: 'success',
            buttons: {
              okay: '<?=controllers::t( 'label', 'Okay' )?>',
            },
          })
            .then((value) => {
              $('#group-name').val('')
              $('#room').val('')
              search()

            })

        } else {
          console.log(data.responseJSON)
          swal({
            title: '<?=controllers::t( 'label', 'Something Went Wrong' )?>',
            text: '<?=controllers::t( 'label', 'Cannot Save The Exam Group' )?>',
            icon: 'warning',
            buttons: {
              okay: '<?=controllers::t( 'label', 'Okay' )?>',
            },
          })
            .then((value) => {
              search()
            })
        }
      }
    })

  }

  function updateGroup (id) {
    swal('<?=controllers::t( 'label', 'Group Name' )?>:', {
      content: 'input',
      buttons: {
        cancel: '<?=controllers::t( 'label', 'Cancel' )?>',
        confirm: '<?=controllers::t( 'label', 'Okay' )?>'
      },
    })
      .then((value) => {

        if (value !== null) {

          $.ajax({
            url: 'ajax-update-group',
            type: 'POST',
            data: {
              id: id,
              name: value,

            },
            beforeSend: function () {
              swalLoading()
            },
            complete: function (data, status) {
              if (data.responseJSON === true) {
                swal({
                  title: '<?=controllers::t( 'label', 'Data Saved Successful' )?>',
                  text: '<?=controllers::t( 'label', 'The Exam Group Has Been Saved' )?>',
                  icon: 'success',
                  buttons: {
                    okay: '<?=controllers::t( 'label', 'Okay' )?>',
                  },
                })
                  .then((value) => {

                    search()

                  })

              } else {
                console.log(data.responseJSON)
                swal({
                  title: '<?=controllers::t( 'label', 'Something Went Wrong' )?>',
                  text: '<?=controllers::t( 'label', 'Cannot Save The Exam Group' )?>',
                  icon: 'warning',
                  buttons: {
                    okay: '<?=controllers::t( 'label', 'Okay' )?>',
                  },
                })
                  .then((value) => {
                    search()
                  })
              }
            }
          })
        }
      })
  }

  function removeGroup (id) {
    swal({
      title: '<?=controllers::t( 'label', 'Remove The Exam Group?' )?>',
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
              url: 'ajax-remove-group',
              type: 'POST',
              data: {
                id: id,
              },
              beforeSend: function () {
                swalLoading()
              },
              complete: function (data, status) {
                if (data.responseJSON === true) {
                  swal({
                    title: '<?=controllers::t( 'label', 'Data Saved Successful' )?>',
                    text: '<?=controllers::t( 'label', 'The Exam Group Has Been Removed' )?>',
                    icon: 'success',
                    buttons: {
                      okay: '<?=controllers::t( 'label', 'Okay' )?>',
                    },
                  })
                    .then((value) => {
                      search()
                    })
                } else {
                  console.log(data.responseJSON)
                  swal({
                    title: '<?=controllers::t( 'label', 'Something Went Wrong' )?>',
                    text: '<?=controllers::t( 'label', 'Cannot Save The Exam Group' )?>',
                    icon: 'warning',
                    buttons: {
                      okay: '<?=controllers::t( 'label', 'Okay' )?>',
                    },
                  })
                    .then((value) => {
                      search()
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

  function addTeacher () {
    let year = $('#year').val()
    let semester = $('#semester').val()
    let subject = $('#subject').val()
    let teacher = $('#teacher').val()
    let group = $('#tGroup').val()
    $.ajax({
      url: 'ajax-add-teacher',
      type: 'POST',
      data: {
        year: year,
        semester: semester,
        subject: subject,
        teacher: teacher,
        group: group,
      },
      beforeSend: function () {
        swalLoading()
      },
      complete: function (data, status) {
        if (data.responseJSON === true) {
          swal({
            title: '<?=controllers::t( 'label', 'Data Saved Successful' )?>',
            text: '<?=controllers::t( 'label', 'The Exam Group Has Been Saved' )?>',
            icon: 'success',
            buttons: {
              okay: '<?=controllers::t( 'label', 'Okay' )?>',
            },
          })
            .then((value) => {
              $('#group-name').val('')
              $('#room').val('')
              search()

            })

        } else {
          console.log(data.responseJSON)
          swal({
            title: '<?=controllers::t( 'label', 'Something Went Wrong' )?>',
            text: '<?=controllers::t( 'label', 'Cannot Save The Exam Group' )?>',
            icon: 'warning',
            buttons: {
              okay: '<?=controllers::t( 'label', 'Okay' )?>',
            },
          })
            .then((value) => {
              search()
            })
        }
      }
    })

  }

  function removeTeacher (group, teacher) {
    swal({
      title: 'ลบอาจารย์?',
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
              url: 'ajax-remove-teacher',
              type: 'POST',
              data: {
                teacher: teacher,
                group: group,
              },
              beforeSend: function () {
                swalLoading()
              },
              complete: function (data, status) {
                if (data.responseJSON === true) {
                  swal({
                    title: '<?=controllers::t( 'label', 'Data Saved Successful' )?>',
                    text: '<?=controllers::t( 'label', 'Committee Has Been Removed' )?>',
                    icon: 'success',
                    buttons: {
                      okay: '<?=controllers::t( 'label', 'Okay' )?>',
                    },
                  })
                    .then((value) => {
                      search()
                    })
                } else {
                  console.log(data.responseJSON)
                  swal({
                    title: '<?=controllers::t( 'label', 'Something Went Wrong' )?>',
                    text: '<?=controllers::t( 'label', 'Cannot Remove Committee From The Exam Group' )?>',
                    icon: 'warning',
                    buttons: {
                      okay: '<?=controllers::t( 'label', 'Okay' )?>',
                    },
                  })
                    .then((value) => {
                      search()
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
