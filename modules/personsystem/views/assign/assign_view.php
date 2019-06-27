<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\personsystem\controllers;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $form yii\widgets\ActiveForm */
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/8/2018
 * Time: 11:54 PM
 */
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="list-group">
                    <a class="list-group-item" href="<?= Yii::getAlias('@web') . '/admin/user' ?>"><i
                            class="glyphicon glyphicon-chevron-right pull-right"></i><span><?= yii::t('app', 'Users'); ?></span></a>
                    <a class="list-group-item" href="<?= Yii::getAlias('@web') . '/admin/assignment' ?>"><i
                            class="glyphicon glyphicon-chevron-right pull-right"></i><span><?= yii::t('app', 'Assignments'); ?></span></a>
                    <a class="list-group-item" href="<?= Yii::getAlias('@web') . '/admin/role' ?>"><i
                            class="glyphicon glyphicon-chevron-right pull-right"></i><span><?= yii::t('app', 'Roles'); ?></span></a>
                    <a class="list-group-item" href="<?= Yii::getAlias('@web') . '/admin/permission' ?>"><i
                            class="glyphicon glyphicon-chevron-right pull-right"></i><span><?= yii::t('app', 'Permissions'); ?></span></a>
                    <a class="list-group-item" href="<?= Yii::getAlias('@web') . '/admin/route' ?>"><i
                            class="glyphicon glyphicon-chevron-right pull-right"></i><span><?= yii::t('app', 'Routes'); ?></span></a>
                    <a class="list-group-item" href="<?= Yii::getAlias('@web') . '/admin/rule' ?>"><i
                            class="glyphicon glyphicon-chevron-right pull-right"></i><span><?= yii::t('app', 'Rules'); ?></span></a>
                    <a class="list-group-item" href="<?= Yii::getAlias('@web') . '/admin/menu' ?>"><i
                            class="glyphicon glyphicon-chevron-right pull-right"></i><span><?= yii::t('app', 'Menus'); ?></span></a>
                    <a class="list-group-item active" href="<?= Yii::getAlias('@web') . '/personsystem/assign/assign-student' ?>"><i
                            class="glyphicon glyphicon-chevron-right pull-right"></i><span><?= yii::t('app', 'Assignment Student'); ?></span></a>
                    <a class="list-group-item" href="<?= Yii::getAlias('@web') . '/personsystem/assign/revoke-student' ?>"><i
                            class="glyphicon glyphicon-chevron-right pull-right"></i><span><?= yii::t('app', 'Revoke Student'); ?></span></a>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="assignment-index">
                    <h1><?= yii::t('app', 'Assignment Student'); ?></h1>
                    <br/>            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],'id' => 'assign','action' => 'assign-view', 'method' => 'get']); ?>
                    <div class="row">
                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group">
                                    <label><b><?= controllers::t('label','Select Major') ?></b></label>
                                    <select  name="major" id="major"  class="form-control">
                                        <?php
                                        if($Major!=null){
                                            foreach ($Major as $key => $item) { ?>
                                                <option id="<?= $item->major_code ?>"value="<?= $item->major_id ?>" <?php if($item->major_id==$majorCheck && $majorCheck!=null){echo "selected";} ?>><?= $item->major_name ?></option>
                                                <?php
                                            }
                                        }?>
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-3">
                            <fieldset>
                                <div class="form-group2">
                                    <label><b><?= controllers::t('label','Level') ?></b></label>
                                    <select name="level" id="level" class="form-control">
                                        <?php
                                        if($Level!=null){
                                            foreach ($Level as $key => $item) { ?>
                                                <option value="<?= $item->LEVELID ?>" <?php if($item->LEVELID==$levelCheck && $levelCheck!=null){echo "selected";} ?>><?= $item->LEVELNAME?></option>
                                            <?php }} ?>
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-2">
                            <fieldset>
                                <div class="form-group2">
                                    <label><b><?= controllers::t('label','Year') ?></b></label>
                                    <select name="year" id="year" class="form-control">
                                        <?php
                                        if($StudentYear!=null){
                                            foreach ($StudentYear as $key => $item) { ?>
                                                <option value="<?= $item->ADMITACADYEAR ?>" <?php if($item->ADMITACADYEAR==$yearCheck && $yearCheck!=null){echo "selected";} ?>><?php echo $item->ADMITACADYEAR ?></option>
                                            <?php }} ?>
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-2">
                            <fieldset>
                                <div class="form-group2">
                                    <label><b><?= controllers::t('label','Semester') ?></b></label>
                                    <select name="semester" id="semester" class="form-control">
                                        <?php
                                        if($Admitsemester!=null){
                                            foreach ($Admitsemester as $key => $item) { ?>
                                                <option value="<?= $item->ADMITSEMESTER ?>" <?php if($item->ADMITSEMESTER==$semesterCheck && $semesterCheck!=null){echo "selected";} ?>><?php echo $item->ADMITSEMESTER ?></option>
                                            <?php }} ?>
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-2">
                            <label><b><?= controllers::t('label','View') ?></b></label><br/>
                            <button type="submit" class="btn btn-success">View <i class="fa fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive"><br/>
                                <b>รายชื่อนักศึกษา</b>
                                <table class="table table-bordered nomargin">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= controllers::t('label','Student ID') ?></th>
                                        <th><?= controllers::t('label','Name') ?></th>
                                        <th><?= controllers::t('label','Major') ?></th>
                                        <th><?= controllers::t('label','Level') ?></th>
                                        <th><?= controllers::t('label','Year') ?></th>
                                        <th><?= controllers::t('label','Semester') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($student as $value=>$item){
                                        echo "<tr><td>$value</td><td>$item->STUDENTCODE</td><td>$item->STUDENTNAME   $item->STUDENTSURNAME</td><td>$item->major_name</td><td>$item->LEVELNAME</td><td>$item->ADMITACADYEAR</td><td>$item->ADMITSEMESTER</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
                <br/>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            "use strict";
            $('#submit').click(function(e){
                e.preventDefault();
                // 12,13,11 (สภาพนักศึกษา พ้นสภาพ,ลาพัก)
                var arayval = new Array();
                var toBox = document.getElementById("toBox");
                var major = document.getElementById("major");
                var year = document.getElementById("year");
                var level = document.getElementById("level");
                var semester = document.getElementById("semester");
                var form = document.getElementById("assign");
                var i,j;
                var major1 = major.value; var year1 = year.value; var level1 = level.value; var semester1 = semester.value;
                //ลูป for วนiคือเอาค่า academic_positions_abb(ค่าใน Database) วนjคือเอาค่า อีเมล (ค่าใน Select)
                for (i = 0; i < toBox.length; i++) {
                    arayval[i] = toBox.options[i].value; //VALUE //
                }
                // alert(major1);
                $.ajax({
                    //   url: '../assign/assign-student',
                    url: '../assign/tobox-assign',
                    data: {
                        'toVal': arayval,
                        'major': major1,
                        'year': year1,
                        'level': level1,
                        'semester': semester1,
                    },
                    type: "get",
                    success: function (data) {
                        if (data) {

                            //  $( "#submit" ).click();
                            // $( "#assign" ).submit();
                            swal("Success!",data);
                            //  location.reload();
                            //window.location.href ="../assign/assign-student";
                        }
                    }
                });
            });

        });
        $(document).ready(function(){
            "use strict";
            $('#major').change(function(e){
                e.preventDefault();
                $( "#assign-form" ).submit();
            });
            $('#level').change(function(e){
                e.preventDefault();
                $( "#assign-form" ).submit();
            });
            $('#year').change(function(e){
                e.preventDefault();
                $( "#assign-form" ).submit();
            });
            $('#semester').change(function(e){
                e.preventDefault();
                $( "#assign-form" ).submit();
            });
        });
    </script>
    <script type="text/javascript">var plugin_path = '<?= Yii::getAlias('@web') ?>/plugins/';</script>
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo \kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? \yii\helpers\Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? \yii\helpers\Html::encode($message['message']) : 'Message Not Set!',
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