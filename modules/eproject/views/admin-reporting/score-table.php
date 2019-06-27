<?php

/* @var $this yii\web\View */


use app\modules\eproject\controllers;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = controllers::t( 'menu', 'Score Table' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
    <?php $form = ActiveForm::begin( ['method' => 'get', 'action' => ['score-table']] ); ?>

        <label><?= controllers::t( 'label', 'Subjects' ) ?></label>

        <?php
        echo Select2::widget( [
            'name' => 'id',
            'value' => $subjectId,
            'theme' => Select2::THEME_DEFAULT,
            'data' => ArrayHelper::map( \app\modules\eproject\models\Subject::getNowOpenSubjects(), 'id', 'name' ),
            'options' => ['multiple' => false]
        ] );
        ?>
        <br>
        <?= Html::submitButton( '<i class="fa fa-search"></i>' . controllers::t( 'label', 'Search' ) . '', ['class' => 'btn btn-3d btn-teal pull-right'] ) ?>

    <?php ActiveForm::end(); ?>
</div>
<div class="col-md-12">
    <?php if (count( $projects ) != 0) { ?>
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
                    <td colspan="4" style="background-color: #f7f7f7">
                        <strong><?= $project['header'] ?></strong></td>
                </tr>
                <?php
                foreach ($project['project'] as $item) {
                    ?>
                    <tr>
                        <td><?= $item['code'] ?></td>
                        <td><?= $item['name_th'] ?><br><?= $item['name_en'] ?></td>
                        <td><?= implode($item['teacher'],',<br> ') ?></td>
                        <td><?php foreach ($item['student'] as $std) { ?>
                                <?= $std['id'] ?> <?= $std['name'] ?><br>
                            <?php } ?>
                        </td>
                    </tr>

                    <?php
                }
            } ?>

            </tbody>
        </table>
    </div>

    <br>
        <?= Html::button( '<i class="fa fa-download"></i>' . controllers::t( 'label', 'Download' ) . '', ['class' => 'btn btn-3d btn-teal pull-right', 'onclick' => 'download()'] ) ?>

    <?php } else if ($projects !== null && count( $projects ) == 0) { ?>
    <div align="center" class="main-container">
        <?= controllers::t( 'label', 'Not Found' ) ?>

    </div>
<?php } ?>

</div>
<script>
  function download () {
    let pid = '<?=$subjectId?>'
    $.ajax({
      url: 'download-score-table',
      type: 'get',
      data: {
        id: pid,
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

