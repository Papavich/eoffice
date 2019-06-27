<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 21/4/2561
 * Time: 22:13
 */
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>

<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>เพิ่มเอกสารขออนุมัติจัดโครงการ</strong>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['action'=>'../compact/addcompactplan']);?>
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <label>เลือกโครงการย่อย</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-sm-5">
                            <select class="form-control select2" name="id">
                                <option disabled selected>เลือกโครงการย่อย</option>
                                <?php
                                foreach ($listProsub as $row){
                                    $data = \app\modules\pms\models\PmsCompactHasProsub::find()->where(['pms_project_sub_prosub_code'=>$row->prosub_code])->one();
                                    if($data){

                                    }else{
                                        echo "<option value='".$row->prosub_code."'>".$row->prosub_name."</option>";
                                    }

                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-sm btn-success btn-3d"><i class="glyphicon glyphicon-plus"> เพิ่ม</i></button>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
