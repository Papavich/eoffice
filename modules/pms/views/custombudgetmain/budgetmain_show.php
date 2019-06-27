<?php
use yii\widgets\ActiveForm;
?>

    <header id="page-header">
        <h1>งบประมาณหลัก</h1>
    </header>
    <div id="content" class="padding-20">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong>เพิ่มงบประมาณหลัก</strong>
                    </div>
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin();?>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <label>กรอกชื่องบประมาณหลัก</label>
                                <?= $form->field($modelbudgetmain,'budget_name')->textInput()->label(false)?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-sm btn-success btn-3d"><i class="glyphicon glyphicon-plus"> บันทึก</i></button>
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
                        <strong>งบประมาณหลักทั้งหมด</strong>
                    </div>
                    <div class="panel-body">
                        <table id="strategic_all" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="15%">ประเด็นยุทธศาสตร์</th>
                                <th width="60%">ชื่อ</th>
                                <th width="20%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($budgetmain as $key => $budgetmains) :?>
                                <?php $i = $key + 1;?>
                                <tr>
                                    <td><?= $i?></td>
                                    <td><?= $budgetmains->budget_name?></td>
                                    <td>
                                        <?php
                                            $data = \app\modules\pms\models\PmsProjectsubBudget::find()->where(['budget_main'=>$budgetmains->budget_id])->all();
                                        if(!$data){
                                            ?>
                                        <a href="../custombudgetmain/budgetmain-update?id=<?= $budgetmains->budget_id?>"><i class="glyphicon glyphicon-pencil"></i></a> |
                                        <a href="../custombudgetmain/budgetmain-delete?id=<?= $budgetmains->budget_id?>" class="delete"><i class="glyphicon glyphicon-trash"></i></a>
                                        <?php }?>
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