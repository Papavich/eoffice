<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\eproject\models\ProjectDocument;
use app\modules\eproject\models\SubjectDocumentType;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;



$this->title = controllers::t( 'label', 'Group Do Not Send Project Document' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin( ['method' => 'get', 'action' => 'unsent-document'] ); ?>
<fieldset>
        <!-- required [php action request] -->
        <input type="hidden" name="action" value="contact_send"/>

        <div class="row">
            <div class="form-group">
                <div class="col-md-12 col-sm-12">
                    <label><?= controllers::t( 'label', 'Subjects' ) ?></label>

                    <?php
                    $data =ArrayHelper::map( \app\modules\eproject\models\Subject::getNowOpenSubjects(), 'id', 'name' );
                    $data[0] = controllers::t( 'label', 'All' );

                    echo Select2::widget( [
                        'name' => 'subject',
                        'theme'=>Select2::THEME_DEFAULT,
                        'value' => $oldData,
                        'data' => $data,
                        'options' => ['multiple' => false]
                    ] );
                    ?>
                    <br>
                    <?= Html::submitButton( '<i class="fa fa-search"></i>' . controllers::t( 'label', 'Search' ) . '', ['class' => 'btn btn-3d btn-teal pull-right'] ) ?>
                </div>
            </div>
        </div>

</fieldset>


<?php ActiveForm::end(); ?>
<!-- required [php action request] -->
<div id="unsentdoc" >
<input type="hidden" name="action" value="contact_send"/>

<?php if (count( $projects ) != 0) { ?>
    <div class="">
        <table class="table table-bordered nomargin">
            <thead>
            <tr class="active">
                <!--                <th><p align="center" style="margin: 0px"><b>--><?//= controllers::t( 'label', 'No.' ) ?><!--</b></p></th>-->
                <th><p align="center" style="margin: 0px"><b><?= controllers::t( 'label', 'Group No.' ) ?></b></p></th>
                <th width="50%"><p align="center" style="margin: 0px"><b><?= controllers::t( 'label', 'Project name' ) ?></b></p>
                </th>
                <th><p align="center" style="margin: 0px"><b><?= controllers::t( 'label', 'List of Student' ) ?></b></p>
                </th>
                <th><p align="center" style="margin: 0px"><b><?= controllers::t( 'label', 'No Submit Document' ) ?></b></p></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($projects as $key => $project) {
                $subjectDocumentTypes = SubjectDocumentType::find()
                    ->leftJoin( ProjectDocument::tableName()
                        , SubjectDocumentType::tableName() . '.document_type_id=' . ProjectDocument::tableName()
                        . '.document_type_id
                         AND ' . ProjectDocument::tableName() . '.project_id = ' . $project->id )
                    ->where( ['subject_id' => $project->subject] )
                    ->andWhere( ProjectDocument::tableName() . '.project_id is null' )
                    ->all();
                if (count( $subjectDocumentTypes ) != 0) {
                    ?>

                    <tr>
                        <!--                        <td><p align="center" style="margin: 0px"> --><?=""//= $key + 1 ?><!--</td>-->
                        <td><p align="center" style="margin: 0px"> <?= ($project->number==null)?'-': $project->number?></td>
                        <td> <?= $project->name_th ?></td>
                        <td>
                            <?php foreach ($project->students as $student) {
                                echo $student->name . '<br>';
                            } ?>

                        </td>
                        <td>
                            <?php
                            $tmp=[];
                            foreach ($subjectDocumentTypes as $subjectDocumentType) {
                                $tmp[]=$subjectDocumentType->documentType->name;
                            }
                            echo  implode(', ',$tmp);
                            ?>
                        </td>


                    </tr>
                <?php }
            } ?>


            </tbody>
        </table>

    </div>
<?php } else { ?>
    <div align="center" class="main-container">
        <?= controllers::t( 'label', 'Not Found' ) ?>
    </div>

<?php } ?>

</div>


<?php if (count( $projects) != 0) { ?>
    <?= Html::button( '<i class="fa fa-download"></i>' . controllers::t( 'label', 'Download' ) . '', ['class' => 'btn btn-3d btn-teal pull-right', 'onclick' => 'download()'] ) ?>
<?php }?>

<script>
  function download () {

    $.ajax({
      url: 'download-unsent-document',
      type: 'get',
      data: {
        subject: '<?=$oldData?>',
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
