<?php

/* @var $this yii\web\View */


use app\modules\eproject\controllers;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = controllers::t( 'menu', 'Student Status' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
    <?php $form = ActiveForm::begin( ['method' => 'get', 'action' => ['student-status']] ); ?>

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
    <?php if (count( $students ) != 0) { ?>
    <div class="table-responsive">
        <table class="table table-bordered nomargin">
            <thead>
            <tr>
                <th><?= controllers::t( 'label', 'Student Code' ) ?></th>
                <th width="50%"><?= controllers::t( 'label', 'Students' ) ?></th>
                <th><?= controllers::t( 'label', 'Status' ) ?></th>
                <th><?= controllers::t( 'label', 'Detail' ) ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($students as $key=> $student) {
            ?>
            <tr>
                <td><?=$student->username?></td>
                <td>
                    <strong><?= $student->name ?></strong></td>
                <td><?php
                    $status=$student->getAdviseStatus($subjectId)['status'];
                    if($status=='yes'){
                        echo "<span style='color:green'>มีที่ปรึกษาแล้ว</span>";
                    }else if($status=='pending'){
                        echo "<span style='color:blue'>กำลังดำเนินการ</span>";
                    }else if($status=='no'){
                        echo "<span style='color:red'>ยังไม่มีที่ปรึกษา</span>";
                    }
                    ?></td>
                <td><a href="<?=\yii\helpers\Url::toRoute(['student/view','id'=>$student->id])?>" ><span class="glyphicon glyphicon-eye-open"></span></a></td>

            </tr>
<?php }?>
        </table>
    </div>

    <br>
    <?= Html::button( '<i class="fa fa-download"></i>' . controllers::t( 'label', 'Download' ) . '', ['class' => 'btn btn-3d btn-teal pull-right', 'onclick' => 'download()'] ) ?>

    <?php } else if ($students !== null && count( $students ) == 0) { ?>
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

