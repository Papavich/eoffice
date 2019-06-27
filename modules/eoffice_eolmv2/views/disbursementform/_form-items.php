<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\JuiAsset;
use yii\web\JsExpression;
use kartik\widgets\FileInput;
//use app\modules\yii2extensions\models\Image;
use wbraganca\dynamicform\DynamicFormWidget;

use app\modules\eoffice_eolmv2\controllers;
?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-rooms',
    'widgetItem' => '.room-item',
   // 'limit' => 4,
    'min' => 1,
    'insertButton' => '.add-room',
    'deleteButton' => '.remove-room',
    'model' => $modelsDetail[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'eolm_dis_detail_date',
        'eolm_dis_detail_detail',
        'eolm_dis_detail_type',
        'eolm_dis_detail_amout',
        'eolm_dis_detail_note',
        'eolm_dis_detail_bill',
        //'eolm_dis_bill_id'
    ],
]); ?>

    <table class="table table-bordered">
        <thead>
        <tr  class="warning">
            <th><?php echo controllers::t( 'label', 'Details of expenses')?></th>
            <!--<th style="width: 188px;">Image</th>-->
            <th style="width: 50px;">
                <button type="button" class="add-room btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
            </th>
        </tr>
        </thead>
        <tbody class="container-rooms">
        <?php foreach ($modelsDetail as $indexDetail => $modelDetail): ?>
            <tr class="room-item warning">
                <td>
                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <?= $form->field($modelDetail, "[{$indexDisburse}][{$indexDetail}]eolm_dis_detail_date")->label(controllers::t( 'label', 'Date'))->input('date') ?>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <?= $form->field($modelDetail, "[{$indexDisburse}][{$indexDetail}]eolm_dis_detail_detail")->label(controllers::t( 'label', 'Details of expenses'))->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <?= $form->field($modelDetail, "[{$indexDisburse}][{$indexDetail}]eolm_dis_detail_amout")->label(controllers::t( 'label', 'Amount'))->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <?= $form->field($modelDetail, "[{$indexDisburse}][{$indexDetail}]eolm_dis_detail_bill")->label('***')->radioList(['1'=>controllers::t( 'label', 'Have a bill'),2=>controllers::t( 'label', 'No bill')]) ?>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <?= $form->field($modelDetail, "[{$indexDisburse}][{$indexDetail}]eolm_dis_detail_note")->label(controllers::t( 'label', 'Note'))->textInput(['maxlength' => true]) ?>
                        </div>


                    </div>
                </td>

                <td class="text-center">

                    <button type="button" class="remove-room btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php DynamicFormWidget::end(); ?>
<?php
$js = <<<'EOD'

$(".optionvalue-img").on("filecleared", function(event) {
    var regexID = /^(.+?)([-\d-]{1,})(.+)$/i;
    var id = event.target.id;
    var matches = id.match(regexID);
    if (matches && matches.length === 4) {
        var identifiers = matches[2].split("-");
        $("#optionvalue-" + identifiers[1] + "-deleteimg").val("1");
    }
});

var fixHelperSortable = function(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
};

$(".form-options-body").sortable({
    items: "tr",
    cursor: "move",
    opacity: 0.6,
    axis: "y",
    handle: ".sortable-handle",
    helper: fixHelperSortable,
    update: function(ev){
        $(".dynamicform_wrapper").yiiDynamicForm("updateContainer");
    }
}).disableSelection();

EOD;

JuiAsset::register($this);
$this->registerJs($js);
?>
