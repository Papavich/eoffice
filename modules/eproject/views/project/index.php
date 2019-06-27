<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use app\modules\eproject\models\Major;
use app\modules\eproject\models\ProjectType;
use app\modules\eproject\models\User;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = controllers::t( 'label', 'Project Search' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $form = ActiveForm::begin( ['id' => 'search-form', 'method' => 'get', 'action' => 'index'] ); ?>
<fieldset>
    <div class="row">
        <div class="form-group">
            <div class="col-md-3 col-sm-3">
                <label><?= controllers::t( 'label', 'Search from' ) ?></label>
                <select name="search_by" class="form-control pointer">
                    <option value="1" <?php if (1 == $searchData["search_by"]) echo 'selected'; ?>><?= controllers::t( 'label', 'Keywords' ) ?></option>
                    <option value="2" <?php if (2 == $searchData["search_by"]) echo 'selected'; ?>><?= controllers::t( 'label', 'Project Name' ) ?></option>
                    <option value="3" <?php if (3 == $searchData["search_by"]) echo 'selected'; ?>><?= controllers::t( 'label', 'Owner' ) ?></option>
                </select>
            </div>
            <div class="col-md-9 col-sm-9">
                <label><?= controllers::t( 'label', 'Keywords' ) ?></label>
                <input type="text" name="keyword" class="form-control"
                       value="<?php echo $searchData["keyword"] ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-md-6 col-sm-6">
                <label><?= controllers::t( 'label', 'Major' ) ?></label>
                <select name="branch" class="form-control pointer">


                    <option value="0"><?= controllers::t( 'label', 'All' ) ?></option>
                    <?php foreach (Major::find()->all() as $item) { ?>
                        <option value="<?= $item->id ?>" <?php if ($item->id == $searchData["branch"]) echo 'selected'; ?>>
                            <?php if (Yii::$app->language == "en") {
                                echo $item->name_en;
                            } else {
                                echo $item->name_th;
                            } ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3 col-sm-3">
                <label><?= controllers::t( 'label', 'Semester' ) ?></label>
                <select name="semester" class="form-control pointer required">
                    <option value="0"><?= controllers::t( 'label', 'All' ) ?></option>
                    <option value="1" <?php if (1 == $searchData["semester"]) echo 'selected'; ?>>1</option>
                    <option value="2" <?php if (2 == $searchData["semester"]) echo 'selected'; ?>>2</option>
                </select>
            </div>
            <div class="col-md-3 col-sm-3">
                <?php
                $data = ArrayHelper::map( \app\modules\eproject\models\Project::find()->distinct()->select( 'year_id' )->orderBy( ['year_id' => SORT_DESC] )->all(), 'year_id', 'year_id' );
                $data[9999] = controllers::t( 'label', 'All' );
                krsort( $data ); ?>
                <label><?= controllers::t( 'label', 'Year' ) ?></label>
                <select name="year" class="form-control pointer required">
                    <?php
                    foreach ($data as $key => $x) { ?>
                        <option value="<?= $key ?>" <?php if ($x == $searchData["year"]) echo 'selected'; ?>><?= $x ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-md-6 col-sm-6">
                <label><?= controllers::t( 'label', 'Project Types' ) ?></label>
                <?php echo Select2::widget( [
                    'name' => 'type',
                    'value' => $searchData["type"],
                    'data' => ArrayHelper::map( ProjectType::find()->all(), 'id', 'name' ),
                    'options' => ['multiple' => true,'placeholder'=>controllers::t( 'label', 'All' )]
                ] );
                ?>

                <i class="fancy-arrow-"></i>
            </div>
            <div class="col-md-6 col-sm-6">
                <label><?= controllers::t( 'label', 'Advisers' ) ?></label>
                <?php echo Select2::widget( [
                    'name' => 'teacher',
                    'value' => $searchData["teacher"],
                    'data' => ArrayHelper::map( User::find()->where( ['user_type_id' => 1] )->all(), 'id', 'name' ),
                    'options' => ['multiple' => true,'placeholder'=>controllers::t( 'label', 'All')]
                ] );
                ?>

            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-3d btn-teal pull-right"><i
                class="fa fa-search"></i><?= controllers::t( 'label', 'Search' ) ?>
    </button>
</fieldset>
<?php ActiveForm::end(); ?>
<div id="t1">
    <div id="panel-misc-portlet-l1" class="panel panel-default">
        <div class="panel-heading">

									<span class="elipsis"><!-- panel title -->
										<strong><?= controllers::t( 'label', 'Search Result' ) ?></strong>
									</span>

        </div>
    </div>

    <div class="panel-body">


        <!--<div class="table-responsive">-->
        <div class="">
            <?php if (count( $projectData ) == 0) { ?>
                <div align="center" class="main-container">
                    <?= controllers::t( 'label', 'Not Found' ) ?>

                </div>
            <?php } else { ?>
                <table class="table table-bordered nomargin">
                    <thead>
                    <tr class="active">
                        <th><p align="center" style="margin: 0px"><b><?= controllers::t( 'label', 'Picture' ) ?></b></p>
                        </th>
                        <th><p align="center" style="margin: 0px"><b><?= controllers::t( 'label', 'Description' ) ?></b>
                            </p></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($projectData

                                   as $item) { ?>
                        <tr>
                            <td align="center"><?php if ($item->image == "") {
                                    echo Html::img( '@web/images/demo/portfolio/thumb/small_a5.png', ['style' => 'max-width:150px;max-height:150px;'] );
                                } else {
                                    echo Html::img( '@web/web_eproject/uploads/project_images/' . $item->image, ['style' => 'max-width:150px;max-height:150px;'] );
                                } ?></td>
                            <td>
                                <div class="row">
                                    <div class="col-xs-4 col-lg-3" style="padding: 0px">
                                        <p align="right" style="margin: 0px">
                                            <b><?= controllers::t( 'label', 'Project ID' ) ?>:</b></p>
                                    </div>
                                    <div class="col-xs-8 col-lg-9 ">
                                        <p style="margin: 0px">
                                            <?= $item->projectNumber ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-lg-3" style="padding: 0px">
                                        <p align="right" style="margin: 0px">
                                            <b><?= controllers::t( 'label', 'Project Name (Thai)' ) ?>:</b></p>
                                    </div>
                                    <div class="col-xs-8 col-lg-9">
                                        <p style="margin: 0px"><?= $item->name_th ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-4 col-lg-3" style="padding: 0px">
                                        <p align="right" style="margin: 0px">
                                            <b><?= controllers::t( 'label', 'Project Name (English)' ) ?>:</b></p>
                                    </div>
                                    <div class="col-xs-8 col-lg-9">
                                        <p style="margin: 0px"><?= $item->name_en ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-lg-3" style="padding: 0px">
                                        <p align="right" style="margin: 0px">
                                            <b><?= controllers::t( 'label', 'Advisers' ) ?>:</b></p>
                                    </div>
                                    <div class="col-xs-8 col-lg-9">
                                        <?php if ($item->advises != null) {
                                            foreach ($item->advises as $advise) { ?>
                                                <p style="margin: 0px"><a href="#"><?= $advise->adviser->name ?></a>
                                                <?php if ($advise->adviser_type_id == 1) { ?>
                                                    (<?= controllers::t( 'label', 'Main Adviser' ) ?>)</p>
                                                <?php } else if ($advise->adviser_type_id == 2) { ?>
                                                    (<?= controllers::t( 'label', 'Co-Adviser' ) ?>)</p>
                                                <?php }
                                                if ($advise->adviser_type_id == 3) {
                                                    echo "(" . controllers::t( 'label', 'External Adviser' ) . ")";
                                                }
                                            }
                                        } else {
                                            echo "<br>";
                                        } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 col-lg-3" style="padding: 0px">
                                        <p align="right" style="margin: 0px">
                                            <b><?= controllers::t( 'label', 'Project Description' ) ?>: </b></p>
                                    </div>
                                    <div class="col-xs-8 col-lg-9">
                                        <p style="margin: 0px"><a href="view?id=<?= $item->id ?>">
                                                [<?= controllers::t( 'label', 'Project Document' ) ?>]</a>
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
            <?php } ?>
            <div class="text-center">
                <?php

                echo LinkPager::widget( [
                    'pagination' => $pages,
                ] );

                ?>
            </div>
        </div>
    </div>
</div>
<script>
  function myFunction () {
    var x = document.getElementById('t1')

    x.style.display = 'block'

  }
</script>