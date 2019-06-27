<?php
use yii\widgets\ActiveForm;
?>

    <header id="page-header">
        <h1>หลักธรรมาภิบาล</h1>
    </header>
    <div id="content" class="padding-20">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong>เพิ่มหลักธรรมาภิบาล</strong>
                    </div>
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin();?>
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <label>กรอกชื่อหลักธรรมาภิบาล</label>
                                <?= $form->field($modelgovernance,'governance_name')->textInput()->label(false)?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-sm btn-success btn-3d"><i class="glyphicon glyphicon-plus"> บันทึก</i></button>
                                <a class="btn btn-sm btn-blue btn-3d" href="../customgovernance/governance-check"><i class="glyphicon glyphicon-arrow-right"></i>หลักธรรมาภิบาลประจำปีงบประมาณ</a>
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
                        <strong>หลักธรรมาภิบาลหลักทั้งหมด</strong>
                    </div>
                    <div class="panel-body">
                        <table id="governance_all" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="20%">ลำดับ</th>
                                <th width="60%">ชื่อ</th>
                                <th width="20%">options</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($governance as $key => $governance) :?>
                                <tr>
                                    <td><?= $key+1?></td>
                                    <td><?= $governance->governance_name?></td>
                                    <td>
                                        <a href="../customgovernance/governance-update?id=<?= $governance->governance_id?>"><i class="glyphicon glyphicon-pencil"></i></a> |
                                        <a href="../customgovernance/governance-delete?id=<?= $governance->governance_id?>" class="delete"><i class="glyphicon glyphicon-trash"></i></a>
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