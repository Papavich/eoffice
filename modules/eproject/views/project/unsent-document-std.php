<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use app\modules\eproject\models\ProjectDocument;
use app\modules\eproject\models\SubjectDocumentType;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;


$this->title = controllers::t( 'menu', 'Not Submit Document Group' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
//$this->params['breadcrumbs'][] =['label' => 'โครงงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin( ['method' => 'get', 'action' => 'unsent-document-std'] ); ?>
<fieldset>
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

                if (count( $project->currentUnsentDocument ) != 0) {
                    ?>

                    <tr>
<!--                        <td><p align="center" style="margin: 0px"> --><?=""//= $key + 1 ?><!--</td>-->
                        <td><p align="center" style="margin: 0px"> <?= ($project->projectNumber)?></td>
                        <td> <?= $project->name_th ?></td>
                        <td>
                            <?php foreach ($project->students as $student) {
                                echo $student->name . '<br>';
                            } ?>

                        </td>
                        <td>
                            <?php
                                $tmp=[];
                            foreach ($project->currentUnsentDocument as $subjectDocumentType) {
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

