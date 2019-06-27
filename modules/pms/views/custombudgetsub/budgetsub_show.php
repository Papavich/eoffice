<?php
use yii\widgets\ActiveForm;
?>



    <header id="page-header">
        <h1>เพิ่มงบประมาณย่อย</h1>
    </header>
    <div id="content" class="padding-20">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong>เพิ่มกลยุทธ์</strong>
                    </div>
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin();?>
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <label>เลือกงบประมาณหลัก</label>
                                    <?php
                                    foreach ($modelBudgetmain as $key => $item) {
                                        if($key == 2 ){
                                            continue;
                                        }else{
                                            $array[$item->budget_id]=$item->budget_name;
                                        }

                                    }
                                    ?>
                                    <?= $form->field($modelbudgetsub,'budget_main_budget_id')
                                        ->dropDownList($array)
                                        ->label(false)?>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <label>กรอกชื่องบประมาณย่อย</label>
                                    <?= $form->field($modelbudgetsub,'budget_name')->textInput()->label(false)?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-sm btn-success btn-3d"><i class="glyphicon glyphicon-plus"> บันทึก</i></button>
<!--                                    <a class="btn btn-sm btn-blue btn-3d" href="../custombudgetsub/budgetsub-check"><i class="glyphicon glyphicon-arrow-right"></i>กลยุทธ์ประจำปีงบประมาณ</a>-->
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
                        <strong>งบประมาณหลัก และงบประมาณย่อยทั้งหมด</strong>
                    </div>
                    <div class="panel-body">
                        <table id="strategic_issues_all" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="15%">ชื่องบประมาณหลัก</th>
                                <th width="40%">ชื่องบประมาณย่อย</th>
                                <th width="15%">options</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($budgetsub as $key => $budgetsubs) :?>
                                <tr>
                                    <td><?=\app\modules\pms\models\BudgetMain::findOne($budgetsubs->budget_main_budget_id)->budget_name;?></td>
                                    <td><?= $budgetsubs->budget_name?></td>
                                    <td>
                                        <?php
                                            $data = \app\modules\pms\models\PmsProjectsubBudget::find()->where(['budget_main'=>$budgetsubs->budget_id])->all();
                                            if(!$data) {
                                                ?>
                                                <a href="../custombudgetsub/budgetsub-update?id=<?= $budgetsubs->budget_id ?>_<?= $budgetsubs->budget_main_budget_id ?>"><i
                                                            class="glyphicon glyphicon-pencil"></i></a> |
                                                <a href="../custombudgetsub/budgetsub-delete?id=<?= $budgetsubs->budget_id ?>_<?= $budgetsubs->budget_main_budget_id ?>"
                                                   class="delete"><i class="glyphicon glyphicon-trash"></i></a>
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
//$this->registerJS("$('.delete').click(function(){
//        if(!confirm('ต้องการลบข้อมูลหรือไม่')){
//            return false;
//        }
//    });
//");
?>