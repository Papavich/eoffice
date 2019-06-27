<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = controllers::t( 'menu', 'Student Do Not Have Adviser' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$form = ActiveForm::begin( ['method' => 'get', 'action' => 'no-adviser-std'] );
$data = ArrayHelper::map( \app\modules\eproject\models\Major::find()->all(), 'id', 'name' );
$data[0] = controllers::t( 'label', 'All' );
ksort( $data );
?>
    <label><?= controllers::t( 'label', 'Subjects' ) ?></label>
    <select id="subject" name="subject" class="form-control pointer required">
        <option disabled value="0"> -- <?=controllers::t( 'label', 'Please Select Subject' )?> --</option>
        <?php foreach ($subject as $item) {
            ?>
            <option value="<?=$item->id?>" <?=($item->id==$subjectId?'selected':'')?>><?=$item->name?></option>
        <?php } ?>
    </select>
<?php
echo '' . Html::submitButton( '<i class="fa fa-search"></i>' . controllers::t( 'label', 'Search' ) . '',
        ['class' => 'btn btn-3d btn-teal pull-right'] );
ActiveForm::end();
?><br>
<br><br>

<div class="">
    <table class="table table-bordered nomargin">
        <thead>
        <tr class="active">

            <th style="width:5%"><p align="center" style="margin: 0px"><?= controllers::t( 'label', 'No.' ) ?></b></p>
            </th>
            <th style="width:10%"><p align="center" style="margin: 0px"><?= controllers::t( 'label', 'Code' ) ?></b></p>
            </th>

            <th style="width: 40%"><p align="center"
                                      style="margin: 0px"><?= controllers::t( 'label', 'Name' ) ?></b></p></th>
            <th style="width:5%"><p align="center" style="margin: 0px"><?= controllers::t( 'label', 'Major' ) ?></b></p>
            </th>


        </tr>
        </thead>
        <tbody>
        <?php foreach ($enrolls as $key => $enroll) {              ?>
                <tr>
                    <td><p align="center" style="margin: 0px"><?= $key + 1 ?></td>
                    <td><?= $enroll->student->user_id ?></td>
                    <td><?= $enroll->student->name ?></td>
                    <td><p align="center" style="margin: 0px"><?= $enroll->student->major->code ?></td>
                </tr>
            <?php
        } ?>
        </tbody>
    </table>
</div>
