<?php

/* @var $this yii\web\View */


use app\modules\eproject\controllers;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = controllers::t( 'menu', 'Advisee Management' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-8">

    <?php if (count( $project ) == 0) { ?>
        <div align="center" class="main-container">
            <?= controllers::t( 'label', 'Not Found' ) ?>

        </div>
    <?php }
    foreach ($project as $item) { ?>
        <div class="panel panel-clean" id="panel-misc-portlet-l4" style="text-overflow: ellipsis;">

            <div class="panel-heading">
                <strong style="font-size: large">
									<span style="overflow: hidden; text-overflow: ellipsis"><!-- panel title -->

                                        <?= $item->name ?>
									</span>
                </strong>

            </div>

            <!-- panel content -->
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-4 col-md-4" style="font-weight: bold"
                         align="right"><?= controllers::t( 'label', 'Project Number' ) ?> :
                    </div>
                    <div class="col-xs-8 col-md-8"> <?= ($item->projectNumber) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-md-4" style="font-weight: bold"
                         align="right"><?= controllers::t( 'label', 'Project Name (Thai)' ) ?> :
                    </div>
                    <div class="col-xs-8 col-md-8"><?= $item->name_th ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-md-4" style="font-weight: bold"
                         align="right"><?= controllers::t( 'label', 'Project Name (English)' ) ?> :
                    </div>
                    <div class="col-xs-8 col-md-8"><?= $item->name_en ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-md-4" style="font-weight: bold"
                         align="right"><?= controllers::t( 'label', 'Owner' ) ?> :
                    </div>
                    <div class="col-xs-8 col-md-8">
                        <?php foreach ($item->students as $std) { ?>
                            <a href="#"> <?= $std->name ?></a><br>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-md-4" style="font-weight: bold"
                         align="right"><?= controllers::t( 'label', 'No Submit Document' ) ?> :
                    </div>
                    <div class="col-xs-8 col-md-8">
                        <?php if (count( $item->unsentDocument ) == 0) { ?>
                            <i style="color: green;">ไมมี</i>
                        <?php } else {
                            $tmp = [];
                            foreach ($item->unsentDocument as $subjectDocumentType) {
                                $tmp[] = $subjectDocumentType->documentType->name;
                            }
                            ?>
                            <i style="color: red;"><?= implode( ', ', $tmp ) ?></i>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-md-4" style="font-weight: bold"
                         align="right"><?= controllers::t( 'label', 'Project Description' ) ?> :
                    </div>
                    <div class="col-xs-8 col-md-8">
                        <?= Html::a( '[' . controllers::t( 'label', 'See More' ) . ']', ['project/view', 'id' => $item->id] ) ?>

                    </div>
                    <div class="col-xs-4 col-md-4" style="font-weight: bold"
                         align="right"><?= controllers::t( 'label', 'Project History' ) ?> :
                    </div>
                    <div class="col-xs-8 col-md-8">
                        <?= Html::a( '[' . controllers::t( 'label', 'See' ) . ']', ['project/log', 'id' => $item->id] ) ?>

                    </div>
                </div>
                <!-- /panel content -->
            </div>
        </div>


    <?php } ?>
</div>
<div class="col-md-4">
    <div class="panel panel-info" id="panel-misc-portlet-l4">

        <div class="panel-heading">

									<span class="elipsis"><!-- panel title -->
										<strong style="font-size: large"><?= controllers::t( 'label', 'Project Statistics' ) ?> </strong>
									</span>


        </div>

        <!-- panel content -->
        <div class="panel-body">
            <h4><?= controllers::t( 'label', 'General Information' ) ?></h4>
            <div class="row">
                <div class="col-xs-8 col-md-9">
                    <?= controllers::t( 'label', 'Year' ) ?> :
                </div>
                <div class="col-xs-4 col-md-3">
                    <?= \app\modules\eproject\components\ModelHelper::getNowYear() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8 col-md-9">
                    <?= controllers::t( 'label', 'Semester' ) ?> :
                </div>
                <div class="col-xs-4 col-md-3">
                    <?= \app\modules\eproject\components\ModelHelper::getNowSemester() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8 col-md-9">
                    <?= controllers::t( 'label', 'Need' ) ?> :
                </div>
                <div class="col-xs-4 col-md-3">
                    <?= $adviseeRequest->need ?> <?= Html::a( '<i class="fa fa-edit"></i>', false, ['onclick' => 'updateNeed()'] ) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8 col-md-9">
                    <?= controllers::t( 'label', 'Added' ) ?> :
                </div>
                <div class="col-xs-4 col-md-3">
                    <?= $adviseeRequest->added ?>
                </div>
            </div>
            <hr>
            <h4><?= controllers::t( 'label', 'Project Publication' ) ?></h4>

            <?php foreach (\app\modules\eproject\models\PublicType::find()->all() as $publicType) { ?>
                <div class="row">
                    <div class="col-xs-8 col-md-10">
                        <?= $publicType->name ?> :
                    </div>
                    <div class="col-xs-4 col-md-2">
                        <?= $publicType->projectCountByUserId ?>
                    </div>
                </div>
            <?php } ?>
            <hr>
            <h4><?= controllers::t( 'label', 'Project Type' ) ?></h4>
            <?php foreach (\app\modules\eproject\models\ProjectType::find()->all() as $projectType) { ?>
                <div class="row">
                    <div class="col-xs-8 col-md-10">
                        <?= Html::a( $projectType->name, ['project/index', 'type[]' => $projectType->id,
                            'teacher[]' => Yii::$app->user->id,
                            'keyword' => "",
                            'branch' => 0,
                            'year' => 9999,
                            'semester' => 0,
                            'search_by' => 1], ['class' => 'profile-link'] ) ?>:

                    </div>
                    <div class="col-xs-4 col-md-2">
                        <?= $projectType->projectCountByUserId ?>
                    </div>
                </div>
            <?php } ?>
            <!-- /panel content -->
            <hr>
            <div align="center">
                <?= Html::a( controllers::t( 'label', 'View Project History' ), ['adviser/history'] ) ?>
            </div>

        </div>
    </div>
</div>
<script>
  function updateNeed () {
    swal('<?=controllers::t( 'label', 'Need' )?>:', {
      content: 'input',
      buttons: {
        cancel: '<?=controllers::t( 'label', 'Cancel' )?>',
        confirm: '<?=controllers::t( 'label', 'Okay' )?>'
      },
    })
      .then((value) => {

        if (value !== null && value !== '') {

          $.ajax({
            url: 'ajax-update-need',
            type: 'POST',
            data: {
              value: value,
            },
            beforeSend: function () {
              swalLoading()
            },
            complete: function (data, status) {
              if (data.responseJSON === true) {
                swal({
                  title: '<?=controllers::t( 'label', 'Data Saved Successful' )?>',
                  icon: 'success',
                  buttons: {
                    okay: '<?=controllers::t( 'label', 'Okay' )?>',
                  },
                })
                  .then((value) => {
                    location.reload()

                  })

              } else {
                console.log(data.responseJSON)

                swal({
                  title: '<?=controllers::t( 'label', 'Something Went Wrong' )?>',
                  icon: 'warning',
                  buttons: {
                    okay: '<?=controllers::t( 'label', 'Okay' )?>',
                  },
                })
                  .then((value) => {
                    location.reload()
                  })
              }
            }
          })
        }
      })

  }


</script>