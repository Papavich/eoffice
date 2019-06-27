<div class="row">
    <div class="col-md-12 col-sm-12">
        <label>เพิ่มกิจกรรม</label>
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapperexecute', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-itemsexecute', // required: css class selector
            'widgetItem' => '.itemexecute', // required: css class
            'limit' => 10, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-itemexecutes', // css class
            'deleteButton' => '.remove-itemexecute', // css class
            'model' => $modelsExecute[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'execute_name',
            ],
        ]); ?>
        <div class="panel panel-default">

            <div class=" container-itemsexecute"><!-- widgetContainer -->
                <?php foreach ($modelsExecute as $execute => $modelsExecutes): ?>
                    <div class="itemexecute "><!-- widgetBody -->
                        <div class="panel-body row">
                            <div class="col-md-11 col-sm-11">

                                <?php
                                // necessary for update action.
                                //                        if (!$modelsExecutes->isNewRecord) {
                                //                            echo Html::activeHiddenInput($modelsExecutes, "[{$execute}]id");
                                //                        }
                                ?>
                                <div class="col-md-12 col-sm-12">
                                    <?= $form->field($modelsExecutes, "[{$executeId}][{$execute}]detail")->textInput(['maxlength' => true])->label(false) ?>
                                </div>

                            </div>
                            <div class="col-md-1 col-sm-1">
                                <button type="button" class="pull-right remove-itemexecute btn btn-danger btn-xs" onclick="remove_itemexecute()"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="">
                <button type="button" class="pull-right add-itemexecutes btn btn-success btn-xs" onclick="add_itemexecute()"><i class="fa fa-plus"></i>เพิ่มโครงการ / กิจกรรม</button>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>
    </div>
</div>



<?php
foreach ($comhasexecute as $key => $row) {
    $executeName = \app\modules\pms\models\PmsExecute::findOne($row->pms_execute_execute_id);
    $i = $key + 1;
    echo "<div class='col-md-12 col-sm-12'>กิจกรรมที่ " . $i . " " . $executeName->execute_name . "</div>";
    echo $this->render('compact_cost', [
        'form' => $form,
        'key' => $key,
        'modelsExecuteCost' => $modelsExecuteCost[$key],
    ]);
}
?>

<?php foreach ($modelsExecute as $execute => $modelsExecutes): ?>
    <?= $form->field($modelsExecute, "[{$execute}]execute_name")->label(false)->textInput(['maxlength' => true]) ?>
<?php endforeach; ?>
