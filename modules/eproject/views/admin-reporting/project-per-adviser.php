<?php

/* @var $this yii\web\View */


use app\modules\eproject\controllers;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title =controllers::t( 'label', 'Advisory Status' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin( ['method' => 'get', 'action' => 'project-per-adviser'] );?>
<fieldset>

    <div class="row">
        <div class="form-group">
            <div class="col-md-6 col-sm-6">

                 <label><?= controllers::t( 'label', 'Major' ) ?></label>

<?php
  $data = ArrayHelper::map( \app\modules\eproject\models\Major::find()->all(), 'id', 'name' );
  $data[0] = controllers::t( 'label', 'All' );
ksort( $data );

echo Select2::widget( [
    'name' => 'major',
    'id'=>'major',
    'data' => $data,
    'theme'=>Select2::THEME_DEFAULT,
    'value' => $major
] ); ?>
            </div>
            <div class="col-md-3 col-sm-3">
                <label><?= controllers::t( 'label', 'Year' ) ?></label>
                <?php try {
                    echo Select2::widget( [
                        'name' => 'year',
                        'id' => 'year',
                        'data' => ArrayHelper::map( \app\modules\eproject\models\Year::find()->orderBy( ['id' => SORT_DESC] )->all(), 'id', 'id' ),
                        'theme' => Select2::THEME_DEFAULT,
//                        'options' => ['onchange' => 'getSubject()'],
                        'value' =>$year
                    ] );
                } catch (Exception $e) {
                } ?>
            </div>
            <div class="col-md-3 col-sm-3">
                <label><?= controllers::t( 'label', 'Semester' ) ?></label>
                <select name="semester" id="semester" class="form-control pointer required">
                    <option value="1" <?php if ($semester==1)echo "selected"?>>1</option>
                    <option value="2" <?php if ($semester==2)echo "selected"?>>2</option>
                </select>
            </div>

        </div>
    </div>
    <br>
    <?= Html::submitButton( '<i class="fa fa-search"></i>' . controllers::t( 'label', 'Search' ) . '', ['class' => 'btn btn-3d btn-teal pull-right'] ) ?>

</fieldset>
<?php ActiveForm::end();?>

<div id="unsentdoc" >
<div id="t2">
    <?php if (count( $requestAdvisee ) != 0)
    { ?>
        <table class="table table-bordered nomargin">
            <thead>

            <tr class="active">
                <th style="width: 40%"><p align="center" style="margin: 0px">
                        <b><?= controllers::t( 'label', 'Teacher Lists' ) ?></b></th>
                <th style="width: 10%"><p align="center" style="margin: 0px">
                        <b><?= controllers::t( 'label', 'Major' ) ?></b></th>
                <th width="10%"><p align="center" style="margin: 0px"><b><?= controllers::t( 'label', 'Need' ) ?></b>
                </th>
                <th width="10%"><p align="center" style="margin: 0px"><b><?= controllers::t( 'label', 'Added' ) ?></b>
                </th>
                <th width="10%"><p align="center" style="margin: 0px">
                        <b><?= controllers::t( 'label', 'Available' ) ?></b></th>

            </tr>

            </thead>
            <tbody>
            <?php foreach ($requestAdvisee as $item) { ?>

                <tr>
                    <td><?= $item->adviser->name ?></td>
                    <td><p align="center" style="margin: 0px"><?= $item->adviser->major->code ?></td>
                    <td><p align="center" style="margin: 0px"><?= $item->need ?></td>
                    <td><p align="center" style="margin: 0px"><?= $item->added ?></td>
                    <td style="color: <?= (($item->need - $item->added) == 0) ? 'red' : 'green' ?>;"><p align="center" style="margin: 0px"><?= $item->need - $item->added ?>
                    </td>
                </tr>

            <?php } ?>

            </tbody>

        </table>
    <?php } else { ?>

        <div align="center" class="main-container">
            <?= controllers::t( 'label', 'Not Found' ) ?>
        </div>

    <?php } ?>
    <br>


</div>
</div>


<?php if (count( $requestAdvisee) != 0) { ?>
    <?= Html::button( '<i class="fa fa-download"></i>' . controllers::t( 'label', 'Download' ) . '', ['class' => 'btn btn-3d btn-teal pull-right', 'onclick' => 'download()'] ) ?>

<?php }?>

<script>
  function download () {
    let year = $('#year').val()
    let semester = $('#semester').val()
    let major = $('#major').val()
    $.ajax({
      url: 'download-ppa',
      type: 'get',
      data: {
        year: year,
        semester: semester,
        major: major,
        // subject: subject,
      },
      beforeSend: function () {
        swalLoading()
      },
      complete: function (data, status) {
        data = data.responseJSON
        window.location.href=data;
        swal.close()

      }
    })
  }
</script>
