<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 2/3/2561
 * Time: 21:45
 */
use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
$js = '
jQuery(".dynamicform_wrappercost").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrappercost .panel-title-address").each(function(cost) {
        jQuery(this).html("กิจกรรมที่: " + (cost + 1))
    });
});

jQuery(".dynamicform_wrappercost").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapperecost .panel-title-address").each(function(cost) {
        jQuery(this).html("กิจกรรมที่: " + (cost + 1))
    });
})
';
$this->registerJs($js);
?>

<?php
    //echo var_dump($modelsExecuteCost)."<br><br>";
?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_inner', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-itemscost', // required: css class selector
            'widgetItem' => '.itemcost', // required: css class
            'limit' => 10, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-itemcosts', // css class
            'deleteButton' => '.remove-itemcost', // css class
            'model' => $modelsExecuteCost[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'detail',
                'cost',
            ],
        ]); ?>
        <div class="panel panel-default">

            <div class=" container-itemscost"><!-- widgetContainer -->
                <?php foreach ($modelsExecuteCost as $cost => $modelsExecuteCosts): ?>
                    <div class="itemcost "><!-- widgetBody -->
                        <div class=" row">
                            <div class="col-md-11 col-sm-11">

                                <?php
                                // necessary for update action.
                                //                                if (! $modelsExecuteCosts->isNewRecord) {
                                //                                    echo Html::activeHiddenInput($modelsExecuteCosts, "[{$key}][{$cost}]id");
                                //                                    echo Html::activeHiddenInput($modelsExecuteCosts, "[{$key}][{$cost}]pms_compact_has_prosub_id");
                                //                                    echo Html::activeHiddenInput($modelsExecuteCosts, "[{$key}][{$cost}]pms_execute_execute_id");
                                //                                }
                                ?>
                                <div class="col-md-6 col-sm-6">
                                    <label>ค่าใช้จ่าย</label>
                                    <?= $form->field($modelsExecuteCosts, "[{$key}][{$cost}]detail")->textInput(['maxlength' => true])->label(false) ?>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>เป็นเงิน</label>
                                    <?= $form->field($modelsExecuteCosts, "[{$key}][{$cost}]cost")->textInput(['maxlength' => true])->label(false) ?>
                                </div>

                            </div>
                            <div class="col-md-1 col-sm-1">
                                <button type="button" style="margin-right: 10px !important;" class="pull-right remove-itemcost btn btn-danger btn-xs" ><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="">
                <button type="button" style="margin-right: 10px !important;" class="pull-right add-itemcosts btn btn-success btn-xs" ><i class="fa fa-plus"></i>เพิ่ม</button>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>
    </div>
</div>

