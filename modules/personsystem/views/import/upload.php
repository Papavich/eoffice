<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\personsystem\controllers;
?>
    <header id="page-header">
        <h1><?= controllers::t("label","Import Student Information") ?></h1>
        <ol class="breadcrumb">
            <li><a href="#">Import</a></li>
            <li class="active">Import Student Information</li>
        </ol>
    </header>
    <div id="content" class="padding-20">
        <div id="panel-ui-tan-l2" class="panel panel-default">
            <div class="panel-heading">
									<span class="elipsis"><!-- panel title -->
										<strong><?= controllers::t("label","Suggestion") ?> </strong>
									</span>
                <ul class="options pull-right list-inline">
                    <li class=""><a href="#" class="opt panel_colapse plus" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Colapse"></a></li>
                    <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand"></i></a></li>
                    </ul>
            </div>
            <div class="panel-body" style="display: block;">
                <div class="row tabs nomargin">
                   <b>คำแนะนำในการนำเข้าไฟล์ Excel ลง Database</b><br>
                    - ไฟล์ต้องนามสกุล .xlsx เท่านั้น <br>
                    - ลำดับการนำเข้าไฟล์ StudentMaster,StudentBio ตามลำดับ <br>
                    - เพื่อหลีกเลี่ยงการเกิด Error การนำเข้าข้อมูล ไฟล์ StudentBio.xlsx จะต้องมี STUDENTID ตรงกับ StudentMaster.xlsx<br>
                    - การอัพโหลดไฟล์ StudentMaster.xlsx ข้อมูลที่จำเป็นต้องมี PREFIXID,LEVELID,FACULTYID,DEPARTMENTID,PROGRAMID<br>
                    - การอัพโหลดไฟล์ StudentBio.xlsx ข้อมูลที่จำเป็นต้องมี CITIZENID<br>
                    - จำกัดขนาดไฟล์ 1576.96 KB<br>
                    - จำกัดเวลาอัพโหลด 30 Second<br>
                    - กรุณารอจนกว่าเว็บจะอัพโหลดเสร็จ<br><br>
                    เมื่ออัพโหลดไฟล์ลงตาราง reg_studentbio<br>
                    หากมีข้อมูลอยู่แล้วจะทำการ Update หากยังไม่มีข้อมูลจะทำการ Insert ข้อมูล และ Create User<br>
                    นักศึกษาที่ถูกนำเข้าข้อมูลจากสำนักทะเบียนแล้วสามารถเข้าใช้งานระบบ E-Office ได้โดย<br>
                    Username คือรหัสนักศึกษา Password คือรหัสนักศึกษา<br>
                    - การอัพโหลดข้อมูลลงตาราง reg_studentbio ควรอัพโหลดครั้งละไม่เกินสองร้อยเรคคอร์ดเนื่องจากมี Process มากจะทำให้เว็บทำงานมากเกินไปและเกิด Error ได้<br>
                </div>
            </div>
        </div>
        <div id="panel-ui-tan-l3" class="panel panel-default">
            <div class="panel-heading">
									<span class="elipsis"><!-- panel title -->
										<strong><?= \app\modules\personsystem\controllers::t("label","Import File") ?> </strong>
									</span>
                <ul class="options pull-right list-inline">
                    <li class=""><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Colapse"></a></li>
                    <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand"></i></a></li>
                </ul>
            </div>
            <div class="panel-body" style="display: block;">
                <div class="row tabs nomargin">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <?php $form = ActiveForm::begin(['id'=>'import','options' => ['enctype'=>'multipart/form-data']]); ?>
                                            <label ><b><?= \app\modules\personsystem\controllers::t("label","Select Database") ?></b></label>
                                            <select  name="database"  class="form-control">
                                                <option value="reg_studentmaster">REG STUDENT MASTER</option>
                                                <option value="reg_studentbio">REG STUDENT BIO</option>
                                                <option value="reg_level">LEVEL</option>
                                                <option value="reg_program">PROGRAM</option>
                                                <option value="reg_faculty">FACULTY</option>
                                                <option value="reg_department">DEPARTMENT</option>
                                                <option value="reg_officer">OFFICER</option>
                                                <option value="reg_enrollsummary">ENROLL SUMMARY</option>
                                                <option value="reg_course">COURSE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $form->field($model,'file')->fileInput()->label(controllers::t('label','Select File')) ?>
                                        <?= Html::submitButton(controllers::t('label','Save'),['class'=>'btn btn-3d btn-green','id'=>'form']) ?>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4><strong><?= controllers::t("label","Summary") ?></strong> <?= controllers::t("label","Details") ?></h4>
                        <div class="table-responsive">
                            <table class="table nomargin">
                                <thead>
                                <tr>
                                    <th>Import Database Table Name</th>
                                    <th>Submission</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?= $database ?></td>
                                    <td><?= $count ?> Rows</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>

    $('#import').submit(function (e) {
        if(document.getElementById("file-file").files.length == 0 ){
            swal("No File!", "..กรุณาเลือกไฟล์ก่อนบันทึก");
            e.preventDefault();
        }else{
            swalLoading()
        }
    });
</script>
<script type="text/javascript">var epro_path = "<?=Yii::getAlias( "@web" )?>";</script>
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo \kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php endforeach; ?>

