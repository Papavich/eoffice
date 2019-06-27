<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 14/3/2561
 * Time: 22:28
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;


$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>
<div id="content" class="padding-20">
    <div class="customer-form">

        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

        <div class="padding-v-md">
            <div class="line line-dashed"></div>
        </div>
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 100, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $model[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'condi_name',
                'condi_value',
            ],
        ]); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope"></i> Address Book
                <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add address</button>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body container-items"><!-- widgetContainer -->
                <?php foreach ($model as $index => $models): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <span class="panel-title-address">Address: <?= ($index + 1) ?></span>
                            <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
//                            if (!$modelAddress->isNewRecord) {
//                                echo Html::activeHiddenInput($modelAddress, "[{$index}]id");
//                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($models, "[{$index}]condi_name")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($models, "[{$index}]condi_value")->textInput(['maxlength' => true]) ?>
                                </div>
                            </div><!-- end:row -->


                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>

        <div class="form-group">
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
