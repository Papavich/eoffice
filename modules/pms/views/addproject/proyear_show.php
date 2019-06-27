<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 29/1/2561
 * Time: 16:27
 */
?>
<?php
use yii\widgets\ActiveForm;
?>

<header id="page-header">
    <h1>โครงการหลัก</h1>
</header>
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>เพิ่มโครงการหลักประจำปีงบประมาณ</strong>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin();?>
                    <?php
                    $year = date("Y");
                    $year = $year + 542;
                    for($i =0 ; $i < 5 ; $i++){
                        $array[$year+$i]=$year+$i;
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label>เลือกปีงบประมาณ</label>
                            <?= $form->field($modelproject,'project_year')
                                ->dropDownList($array)
                                ->label(false)?>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label>กรอกรหัสโครงการหลัก</label>
                            <?= $form->field($modelproject,'project_code')->textInput()->label(false)->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => '99-99-99-99-99-99',
                            ])?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label>กรอกชื่อโครงการหลัก</label>
                            <?= $form->field($modelproject,'project_name')->textInput()->label(false)?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <button type="submit" class=" btn btn-sm btn-success btn-3d"><i class="glyphicon glyphicon-plus"> บันทึก</i></button>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>



<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>โครงการหลักทั้งหมด</strong>
                </div>
                <div class="panel-body">
                    <table id="pro_year" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="10%">ประจำปี</th>
                            <th width="20%">รหัสโครงการ</th>
                            <th width="60%">ชื่อโครงการ</th>
                            <th width="10%">options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($project as $key => $projects) :?>
                            <tr>
                                <td><?= $projects->project_year?></td>
                                <td><?= $projects->project_code?></td>
                                <td><?= $projects->project_name?></td>
                                <td>
                                    <?php
                                        $model = \app\modules\pms\models\PmsProjectSub::find()->where(['pms_project_project_code'=>$projects->project_code])->one();
                                        if($model){

                                        }else{?>
                                            <a href="../addproject/projectyear-update?id=<?= $projects->project_code?>"><i class="glyphicon glyphicon-pencil"></i></a> |
                                            <a href="../addproject/projectyear-delete?id=<?= $projects->project_code?>" class="delete"><i class="glyphicon glyphicon-trash"></i></a>
                                            <?php
                                        }
                                    ?>
                                    </td>

                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
?>