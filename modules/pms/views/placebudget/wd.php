<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 30/1/2561
 * Time: 15:19
 */

use yii\bootstrap\ActiveForm;
//use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;


?>
<div class="">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']);?>

    <?php
        foreach ($year as $row){
            $array[$row->year_id]=$row->year_id;
        }
    ?>

    <label>year</label>
    <div class="form-group">
        <?php
        foreach ($year as $item) {
            $array[$item->year_id]=$item->year_id;
        }
        ?>
        <?= $form->field($year, 'year_id')->dropdownList(
            ArrayHelper::map(\app\modules\pms\models\Year::find()->all(),
                'year_id',
                'year_id'),
            [
                'id'=>'ddl-province',
                'prompt'=>'เลือกจังหวัด'
            ]); ?>




    <button type="submit" class="btn btn-success btn-3d">บันทึก</button>
    <?php ActiveForm::end(); ?>
</div>