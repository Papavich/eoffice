<?php
use yii\widgets\ActiveForm;
?>



    <header id="page-header">
        <h1>เพิ่มกลยุทธ์</h1>
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
                                    <label>เลือกประเด็นยุทธศาสตร์</label>
                                    <?php
                                    foreach ($modelstrategicissues as $item) {
                                        $array[$item->strategic_issues_id]=$item->strategic_issues_id.'. '.$item->strategic_issues_name;
                                    }
                                    ?>
                                    <?= $form->field($modelstrategic,'strategic_issues_strategic_issues_id')
                                        ->dropDownList($array)
                                        ->label(false)?>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <label>กรอกลำดับกลยุทธ์</label>
                                    <?= $form->field($modelstrategic,'strategic_id')->textInput()->label(false)?>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <label>กรอกชื่อกลยุทธ์</label>
                                    <?= $form->field($modelstrategic,'strategic_name')->textInput()->label(false)?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-sm btn-success btn-3d"><i class="glyphicon glyphicon-plus"> บันทึก</i></button>
                                    <a class="btn btn-sm btn-blue btn-3d" href="../customstrategic/strategic-check"><i class="glyphicon glyphicon-arrow-right"></i>กลยุทธ์ประจำปีงบประมาณ</a>
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
                        <strong>ประเด็นยุทธศาสตร์ และกลยุทธ์ทั้งหมด</strong>
                    </div>
                    <div class="panel-body">
                        <table id="strategic_issues_all" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="15%">ประเด็นยุทธศาสตร์</th>
                                <th width="10%">กลยุทธ์</th>
                                <th width="60%">ชื่อ</th>
                                <th width="15%">options</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($strategic as $key => $strategic) :?>
                                <tr>
                                    <td><?= $strategic->strategic_issues_strategic_issues_id?></td>
                                    <td><?= $strategic->strategic_id?></td>
                                    <td><?= $strategic->strategic_name?></td>
                                    <td>
                                        <a href="../customstrategic/strategic-update?id=<?= $strategic->strategic_id?>_<?= $strategic->strategic_issues_strategic_issues_id?>"><i class="glyphicon glyphicon-pencil"></i></a> |
                                        <a href="../customstrategic/strategic-delete?id=<?= $strategic->strategic_id?>_<?= $strategic->strategic_issues_strategic_issues_id?>" class="delete"><i class="glyphicon glyphicon-trash"></i></a>
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