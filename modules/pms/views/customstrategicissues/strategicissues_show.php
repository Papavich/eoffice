<?php
use yii\widgets\ActiveForm;
?>

    <header id="page-header">
        <h1>ประเด็นยุทธศาสตร์</h1>
    </header>
    <div id="content" class="padding-20">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong>เพิ่มประเด็นยุทธศาสตร์</strong>
                    </div>
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin();?>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <label>กรอกลำดับประเด็นยุทธศาสตร์</label>
                                <?= $form->field($modelstrategicissues,'strategic_issues_id')->textInput()->label(false)?>
                                </div>
                                <div class="col-md-4 col-sm-4">

                                <label>กรอกชื่อประเด็นยุทธศาสตร์</label>
                                <?= $form->field($modelstrategicissues,'strategic_issues_name')->textInput()->label(false)?>
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
                        <strong>ประเด็นยุทธศาสตร์ทั้งหมด</strong>
                    </div>
                    <div class="panel-body">
                        <table id="strategic_all" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="15%">ประเด็นยุทธศาสตร์</th>
                                <th width="60%">ชื่อ</th>
                                <th width="20%">options</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($strategicissues as $key => $strategicissues) :?>
                                <tr>
                                    <td><?= $strategicissues->strategic_issues_id?></td>
                                    <td><?= $strategicissues->strategic_issues_name?></td>
                                    <td>
                                        <a href="../customstrategicissues/strategicissues-update?id=<?= $strategicissues->strategic_issues_id?>"><i class="glyphicon glyphicon-pencil"></i></a> |
                                        <a href="../customstrategicissues/strategicissues-delete?id=<?= $strategicissues->strategic_issues_id?>" class="delete"><i class="glyphicon glyphicon-trash"></i></a>
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