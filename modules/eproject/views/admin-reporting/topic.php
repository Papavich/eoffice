<?php

/* @var $this yii\web\View */


use app\modules\eproject\controllers;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = controllers::t( 'label', 'Project Title' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
    <?php $form = ActiveForm::begin( ['method' => 'get', 'action' => ['topic']] ); ?>
    <?php $data = ArrayHelper::map( \app\modules\eproject\models\Major::find()->all(), 'id', 'name' );
    $data[0] = controllers::t( 'label', 'All' );
    ksort( $data );
    echo '<label class="control-label">' . controllers::t( 'label', 'Major' ) . '</label>';
    echo Select2::widget( [
        'name' => 'major',
        'id' => 'major',
        'data' => $data,
        'theme' => Select2::THEME_DEFAULT,
        'value' => $major
    ] );
    ?>
    <div class="form-group">
        <?= Html::submitButton( '<i class="fa fa-search"></i>' . controllers::t( 'label', 'Search' ) . '', ['class' => 'btn btn-3d btn-teal pull-right'] ) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered nomargin">
            <thead>
            <tr>
                <th><?= controllers::t( 'label', 'Project Number' ) ?></th>
                <th width="50%"><?= controllers::t( 'label', 'Project Name' ) ?></th>
                <th><?= controllers::t( 'label', 'Adviser' ) ?></th>
                <th><?= controllers::t( 'label', 'Students' ) ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($projects as $project) {
                ?>

                <tr>
                    <td> <?= $project->projectNumber ?></td>
                    <td><?= $project->name_th . "<br>" . $project->name_en ?></td>
                    <td><?php
                        $keyTeacher = 0;
                        $teacherStr = [];
                        if ($project->mainAdviser != null) {
                            $teacherStr[$keyTeacher] = $project->mainAdviser->name;
                            $keyTeacher++;
                        }
                        foreach ($project->coAdvisers as $coAdviser) {
                            $teacherStr[$keyTeacher] = $coAdviser->name . ' (ร่วม)';
                            $keyTeacher++;
                        }
                        echo implode($teacherStr,'<br>')
                        ?></td>
                    <td><?php foreach ($project->currentStudents as $item) { ?>
                            <?= $item->user_id . ' ' . $item->name ?><br>
                        <?php } ?></td>
                </tr>


                <?php

            } ?>

            </tbody>
        </table>
    </div>
    <br>
    <?= Html::button( '<i class="fa fa-download"></i>' . controllers::t( 'label', 'Download' ) . '', ['class' => 'btn btn-3d btn-teal pull-right', 'onclick' => 'download()'] ) ?>
</div>
<script>
  function download () {
    let major = $('#major').val()
    $.ajax({
      url: 'download-topic',
      type: 'get',
      data: {
        major: major,
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

