<?php

use yii\helpers\Html;
use app\modules\eoffice_asset\assets\AppAssetAsset;
AppAssetAsset::register($this);
use yii\widgets\ActiveForm;
use yii\jui\DatePicker ;
use kartik\time\TimePicker;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetBorrowRescript */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>

    <div id="panel-misc-portlet-color-r2" class="panel panel-warning">
        <div class="panel-heading">
            <span class="elipsis"><!-- panel title -->
                <strong>รอนุมัติการยืม</strong>
            </span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6 col-sm-6">
                        <?= $form->field($model, 'borrow_rescript_date')->widget(DatePicker::classname(), [
                            'language' => 'th',
                            'dateFormat' => 'yyyy-MM-dd',
                            'clientOptions'=>[
                                'changeMonth'=>true,
                                'changeYear'=>true,
                            ],
                            'options'=>['class'=>'form-control']
                        ]) ?>
                    </div>
                    <div class="col-md-6 col-sm-6">

                        <?= $form->field($model, 'borrow_rescript_time')->widget(TimePicker::className(),[
                            'name' => 'start_time',
                            'value' => '11:24',
                            'pluginOptions' => [
                              //  'showSeconds' => true
                            ],
                           // 'options'=>['class'=>'form-control']
                        ]) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6">
                        <?= $form->field($model, 'borrow_rescript_location')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <label>เจ้าหน้าที่รับผิดชอบ</label><br>
                        <?php echo $person['person_fname_th'].'&nbsp'. $person['person_lname_th']; ?>
                    </div>
                </div>

            </div>
    <!-- Modal Foter -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                <?= Html::submitButton('ยืนยันการอนุมัติ', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>


