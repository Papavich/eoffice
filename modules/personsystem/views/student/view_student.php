<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\personsystem\controllers;
use yii\widgets\ActiveForm;
use kartik\dialog\Dialog;
/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\ViewStudentFull */

$this->title = $modelStudent->STUDENTID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'View Student Fulls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label','Student Information'); ?> : <?= $modelStudent->STUDENTCODE ?></h1>
    <ol class="breadcrumb">
        <li><a href="#">Forms</a></li>
        <li class="active">Form  Add Infomation</li>
    </ol>
    <div class="row">
        <div class="col-md-6" ><br/>
            <a href="admin-edit-student-list" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
        </div>
        <div class="col-md-6" align="right">
            <br>
        <?= Html::csrfMetaTags() ?>
        <?= Dialog::widget(['overrideYiiConfirm' => true]); ?>
        <?=  Html::a(Yii::t('app', 'Delete'), ['admin-delete-student', 'id' => $modelStudent->STUDENTID], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' =>controllers::t('label','Are you sure you want to delete this item?'),
            'method' => 'post',
            'params' => ['id'=>$modelStudent->STUDENTID]
        ],
    ]) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['admin-update-student', 'id' => $modelStudent->STUDENTID], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</header>
<!-- /page title -->
<div id="content" class="padding-20">
    <div class="row">
        <div class="">
            <div class="">
                <!-- tabs -->
                <ul class="nav nav-tabs" style="margin-left: 14px;">
                    <li class="active">
                        <a href="#tab1_nobg" data-toggle="tab">
                            <i class="fa fa-pencil-square-o"></i> ระบบข้อมูลบุคคล
                        </a>
                    </li>
                    <li class="">
                        <a href="#tab2_nobg" data-toggle="tab">
                            <i class="fa fa-cogs"></i> ระบบสำนักทะเบียน
                        </a>
                    </li>
                </ul>
                <div class="tab-content transparent">
                    <div id="tab1_nobg" class="tab-pane active">
                        <!------------------------------------------- แถบระบบข้อมูลบุคคล ----------------------------------------------------------------->								  <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form class="validate" data-toastr-position="top-right">
                                        <fieldset>
                                            <h4 ><span style="color:#428bca;"><?= controllers::t('label','Student Information'); ?></span></h4><hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Person ID')?></b></label>
                                                        <div class="line" name="person_id" value="">
                                                            <?= $modelStudent->STUDENTID ;  ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Student Code') ?></b></label>
                                                        <div class="line" name="student_code" value="">
                                                            <?= $modelStudent->STUDENTCODE ;?>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?=controllers::t( 'label','ID Card') ?></b></label>
                                                        <div class="line" name="card_id" value="">
                                                            <?= $modelStudent->CITIZENID ; ?>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Prefix') ?></b></label>
                                                        <div class="line" name="prefix" value="">
                                                            <?= $modelStudent->PREFIXNAME ;  ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Gender') ?></b></label>
                                                        <div class="line" name="gender" value="">
                                                            <?php
                                                            if($modelStudent->STUDENTSEX == "F"){
                                                                echo "หญิง" ;
                                                            }else if($modelStudent->STUDENTSEX == "M"){
                                                                echo "ชาย" ;
                                                            }else{
                                                                echo "<span style='color:red;'>N/A</span>" ;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Name') ?></b></label>
                                                        <div class="line" name="person_name" value="">
                                                            <?= $modelStudent->STUDENTNAME ;
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Surname') ?></b></label>

                                                        <div class="line" name="person_surname" value="">
                                                            <?= $modelStudent->STUDENTSURNAME ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Name (Eng)') ?></b></label>

                                                        <div class="line" name="person_name_eng" value="">
                                                            <?= $modelStudent->STUDENTNAMEENG ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Surname (Eng)') ?></b></label>

                                                        <div class="line" name="person_surname_eng" value="">
                                                            <?= $modelStudent->STUDENTSURNAMEENG ; ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Age') ?></b></label>
                                                        <div class="line" name="age" value="">
                                                            <?php
                                                            if($modelStudent->BIRTHDATE=="<span style='color:red'>N/A</span>"){
                                                                echo "<span style='color:red;'>N/A</span>" ;
                                                            }else{
                                                               $dateK = str_replace("-","/",$modelStudent->BIRTHDATE);
                                                               $dateT = date("Y-m-d", strtotime($dateK));
                                                                $date=date_create($dateT);
                                                                $birthDate = date_format($date,"m/d/Y");
                                                                $birthDate = explode("/", $birthDate);
                                                                $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                                                                    ? ((date("Y") - $birthDate[2]) - 1)
                                                                    : (date("Y") - $birthDate[2]));
                                                                echo $age;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Birth Date') ?></b></label>
                                                        <div class="line" name="birthdate" value="">
                                                            <?= $modelStudent->BIRTHDATE ; ?>
                                                        </div>
                                                        <!--			 <input type="text" class="form-control masked" data-format="99/99/9999" data-placeholder="_" placeholder="DD/MM/YYYY" value="04/07/1996"> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Height') ?></b></label>

                                                        <div class="line" name="height" value="">
                                                            <?= $modelStudent->student_height ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Weight') ?></b></label>

                                                        <div class="line" name="weight" value="">
                                                            <?= $modelStudent->student_weight ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Marital Status') ?></b></label>

                                                        <div class="line" name="marital_status" value="">
                                                            <?= $modelStudent->student_marital_status ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Blood Group') ?></b></label>

                                                        <div class="line" name="blood_type" value="">
                                                            <?= $modelStudent->student_blood_group ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Underlying Disease') ?></b></label>
                                                        <div class="line" name="health_problem" value="">
                                                            <?= $modelStudent->student_underlying_disease ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Religion') ?></b></label>
                                                        <div class="line" name="religion" value="">
                                                            <?= $modelStudent->RELIGIONNAME ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Nation') ?></b></label>
                                                        <div class="line" name="nationality" value="">
                                                            <?= $modelStudent->NATIONNAME ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                    </div>
                                                </div>
                                            </div>
                                            <!------------------------------------------- ข้อมูลติดต่อ ----------------------------------------------------------------->
                                            <br><h4><span style="color:#428bca;"><?= controllers::t( 'label','Contact Informatio') ?></span></h4><hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Phone Number (In Register)') ?></b></label>
                                                        <div class="line" name="mobile_phone_register" value="">
                                                            <?= $modelStudent->STUDENTMOBILE ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Phone Number (In System)') ?></b></label>
                                                        <div class="line" name="mobile_phone" value="">
                                                            <?= $modelStudent->student_mobile_phone ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Email (In Register)') ?></b></label>
                                                        <div class="line" name="person_email_register" value="">
                                                            <?= $modelStudent->STUDENTEMAIL  ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Email (In System)') ?></b></label>
                                                        <div class="line" name="person_email" value="">
                                                            <?= $modelStudent->student_email ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Line ID') ?></b></label>
                                                        <div class="line" name="line_id" value="">
                                                            <?= $modelStudent->student_line_id ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Facebook') ?></b></label>

                                                        <div class="line" name="facebook_name" value="">
                                                            <a href="<?= $modelStudent->student_facebook_url ; ?>"><?= $modelStudent->student_facebook_url ; ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------------------------------------------- ที่อยู่ ----------------------------------------------------------------->
                                            <br><h4><span style="color:#428bca;"><?= controllers::t( 'label','Address') ?></span></h4><hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label><b><?= controllers::t( 'label','Address (Register Home)') ?></b></label>
                                                        <div class="line" name="address" value="">
                                                            <?= $modelStudent->student_home_address ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','District') ?></b></label>
                                                        <div class="line" name="district" value="">
                                                            <?php
                                                            if(empty($District->DISTRICT_NAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $District->DISTRICT_NAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Amphur') ?></b></label>
                                                        <div class="line" name="amphur" value="">
                                                            <?php
                                                            if(empty($Amphur->AMPHUR_NAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Amphur->AMPHUR_NAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Province') ?></b></label>
                                                        <div class="line" name="province" value="">
                                                            <?php
                                                            if(empty($Province->PROVINCE_NAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Province->PROVINCE_NAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Zipcode') ?></b></label>
                                                        <div class="line" name="zipcode" value="">
                                                            <?= $modelStudent->student_home_zipcode_id;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label><b><?= controllers::t( 'label','Address (Current Address)') ?></b></label>
                                                        <div class="line" name="current_address" value="">
                                                            <?= $modelStudent->student_current_address ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','District') ?></b></label>
                                                        <div class="line" name="current_district" value="">
                                                            <?php
                                                            if(empty($Current_District->DISTRICT_NAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Current_District->DISTRICT_NAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Amphur') ?></b></label>
                                                        <div class="line" name="current_amphur" value="">
                                                            <?php
                                                            if(empty($Current_Amphur->AMPHUR_NAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Current_Amphur->AMPHUR_NAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Province') ?></b></label>
                                                        <div class="line" name="current_province" value="">
                                                            <?php
                                                            if(empty($Current_Province->PROVINCE_NAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Current_Province->PROVINCE_NAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Zipcode') ?></b></label>
                                                        <div class="line" name="current_zipcode" value="">
                                                            <?= $modelStudent->student_current_zipcode_id; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------------------------------------------- บุคคลที่สามารถติดต่อได้ ----------------------------------------------------------------->
                                            <br><h4><span style="color:#428bca;"><?= controllers::t( 'label','Person Contact') ?></span></h4><hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Name') ?></b></label>
                                                        <div class="line" name="person_contact_name" value="">
                                                            <?= $modelStudent->contact_name ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Relation') ?></b></label>
                                                        <div class="line" name="person_contact_relationship" value="">
                                                            <?= $modelStudent->contact_relation ;  ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Phone Number') ?></b></label>
                                                        <div class="line" name="person_contact_mobile_register" value="">
                                                            <?= $modelStudent->contact_mobile ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                    </div>
                                                </div>
                                            </div>
                                            <br><h4><span style="color:#428bca;"><?= controllers::t( 'label','Work Information') ?></span></h4><hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Work Status') ?></b></label>
                                                        <div class="line" name="person_contact_mobile_register" value="">
                                                            <?= $modelStudent->student_working_status ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Work Place') ?></b></label>
                                                        <div class="line" name="person_contact_mobile_register" value="">
                                                            <?= $modelStudent->student_working_place ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <br>
                                                        <label><b><?= controllers::t( 'label','Salary') ?></b></label>
                                                        <div class="line" name="person_contact_mobile_register" value="">
                                                            <?= $modelStudent->student_working_salary ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><h4><span style="color:#428bca;"><?= controllers::t( 'label','Skill') ?></span></h4><hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label><b><?= controllers::t( 'label','Skill Programming') ?></b></label>
                                                        <div class="line" name="person_contact_mobile_register" value="">
                                                            <?php
                                                            if($modelSkill!=null){
                                                                foreach ($modelSkill as $item){
                                                                    echo $item->skill->skill_name."&nbsp;&nbsp;";
                                                                }
                                                            }else{
                                                                echo "<span style='color:red'>N/A</span>"; //เพื่อความสวยงานอิอิ
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form class="validate"   data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                <fieldset>
                                            <!-- required [php action request] -->
                                            <input type="hidden" name="action" value="contact_send" />
                                            <!------------------------------------------- ข้อมูลการศึกษา ----------------------------------------------------------------->
                                                    <h4><span style="color:#428bca;"><?= controllers::t( 'label','Education Information') ?></span></h4><hr>
                                            <div class="col-md-12 col-sm-12">
                                                <?php if($modelStudent->student_img!="<span style='color:red'>N/A</span>"){?>
                                                    <img class="img-thumbnail" width="150" height="150" alt="" src="<?= Yii::getAlias('@web') ?>/web_personal/upload/System/<?= $modelStudent->student_img ?>" height="34" ALIGN=LEFT>
                                                <?php  }else{?>
                                                    <img class="img-thumbnail" width="150" height="150" alt="" src="<?= Yii::getAlias('@web') ?>/web_personal/upload/noavatar.jpg" height="34" ALIGN=LEFT>
                                                <?php } ?></div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <br><label><b><?= controllers::t( 'label','Student Status') ?></b></label>
                                                        <div class="line" name="student_status" value="">
                                                            <?= $modelStudent->STUDENTSTATUS ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <br><label><b><?= controllers::t( 'label','Adviser') ?></b></label>

                                                        <div class="line" name="advisor" value="">
                                                            <?php echo $modelStudent->OFFICERNAME."  ";if($modelStudent->OFFICERSURNAME!="<span style='color:red'>N/A</span>"){echo $modelStudent->OFFICERSURNAME ;} ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Major') ?></b></label>
                                                        <div class="line" name="student_status" value="">
                                                            <?= $modelStudent->major_name ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Student Year') ?></b></label>

                                                        <div class="line" name="advisor" value="">
                                                            <?= $modelStudent->STUDENTYEAR ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Faculty Name') ?></b></label>
                                                        <div class="line" name="facalty_name" value="">
                                                            <?= $modelStudent->FACULTYNAME ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Level Name') ?></b></label>
                                                        <div class="line" name="level_name" value="">
                                                            <?= $modelStudent->LEVELNAME ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label><b><?= controllers::t( 'label','Program') ?></b></label>
                                                        <div class="line" name="program_name" value="">
                                                            <?= $modelStudent->PROGRAMNAME ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Admitacad year') ?></b></label>
                                                        <div class="line" name="admit_academic_year" value="">
                                                            <?= $modelStudent->ADMITACADYEAR ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Admit Semester') ?></b></label>
                                                        <div class="line" name="admit_academic_semester" value="">
                                                            <?= $modelStudent->ADMITSEMESTER ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Entry Degree') ?></b></label>
                                                        <div class="line" name="pre_certificate" value="">
                                                            <?= $modelStudent->ENTRYDEGREE ; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Entry GPA') ?></b></label>
                                                        <div class="line" name="pre_certificate_grade" value="">
                                                            <?= $modelStudent->ENTRYGPA ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Entry School') ?></b></label>
                                                        <div class="line" name="graduated_from" value="">
                                                            <?= $modelStudent->SCHOOLNAME ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------------------------------------------ ผลการศึกษา ----------------------------------------------------------------->
                                                    <br><h4><span style="color:#428bca;"><?= controllers::t( 'label','Transcript') ?></span></h4><hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','GPA') ?></b></label>

                                                        <div class="line" name="gpa" value="3.80">
                                                            <?= $modelStudent->GPA ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------------------------------------------- ข้อมูลผู้ปกครอง ----------------------------------------------------------------->
                                                    <br><h4><span style="color:#428bca;"><?= controllers::t( 'label','Parent Information') ?></span></h4><hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Father Name') ?></b></label>
                                                        <div class="line" >
                                                        <div class="line" name="father_name" value="">
                                                            <?= $modelStudent->STUDENTFATHERNAME ; ?>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Birthday') ?></b></label>
                                                        <div class="line" name="father_birthdate" value="">
                                                            <?= $modelStudent->father_birthday ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Highest Qualification') ?></b></label>
                                                        <div class="line" name="father_highest_qualification" value="">
                                                            <?= $modelStudent->father_highest_qualification ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Career') ?></b></label>
                                                        <div class="line" name="father_career" value="">
                                                            <?= $modelStudent->father_career ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Work Place') ?></b></label>
                                                        <div class="line" name="father_work_place" value="">
                                                            <?= $modelStudent->father_work_place ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Income Per Month') ?></b></label>
                                                        <div class="line" name="father_income_per_month" value="">
                                                            <?= $modelStudent->father_income_per_month ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Phone Number') ?></b></label>
                                                        <div class="line" name="father_mobile_register" value="">
                                                            <?= $modelStudent->father_mobile ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label><b><?= controllers::t( 'label','Address') ?></b></label>
                                                        <div class="line" name="father_address" value="">
                                                            <?= $modelStudent->father_address ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','District') ?></b></label>
                                                        <div class="line" name="father_district" value="">
                                                            <?php
                                                            if(empty($Father_District->DISTRICT_NAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Father_District->DISTRICT_NAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Amphur') ?></b></label>
                                                        <div class="line" name="father_amphur" value="">
                                                            <?php
                                                            if(empty($Father_Amphur->AMPHUR_NAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Father_Amphur->AMPHUR_NAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Province') ?></b></label>
                                                        <div class="line" name="father_province" value="">
                                                            <?php
                                                            if(empty($Father_Province->PROVINCE_NAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Father_Province->PROVINCE_NAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Zipcode') ?></b></label>
                                                        <div class="line" name="father_zipcode" value="">
                                                            <?= $modelStudent->father_zipcode_id;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Religion') ?></b></label>
                                                        <div class="line" name="father_religion" value="">
                                                            <?php
                                                            if(empty($Father_Religion->RELIGIONNAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Father_Religion->RELIGIONNAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Nation') ?></b></label>
                                                        <div class="line" name="father_nationality" value="">
                                                            <?php
                                                            if(empty($Father_Nation->NATIONNAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Father_Nation->NATIONNAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Mother Name') ?></b></label>
                                                        <div class="line" >
                                                        <div class="line" name="motherName" value="">
                                                            <?= $modelStudent->STUDENTMOTHERNAME ?>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Birthday') ?></b></label>
                                                        <div class="line" name="mother_birthdate" value="">
                                                            <?= $modelStudent->mother_birthday ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Highest Qualification') ?></b></label>
                                                        <div class="line" name="mother_highest_qualification" value="">
                                                            <?= $modelStudent->mother_highest_qualification ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Career') ?></b></label>
                                                        <div class="line" name="mother_career" value="">
                                                            <?= $modelStudent->mother_career ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Work Place') ?></b></label>
                                                        <div class="line" name="mother_work_place" value="">
                                                            <?= $modelStudent->mother_work_place ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Income Per Month') ?></b></label>
                                                        <div class="line" name="mother_income_per_month" value="">
                                                            <?= $modelStudent->mother_income_permonth ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Phone Number') ?></b></label>
                                                        <div class="line" name="mother_mobile_register" value="">
                                                            <?= $modelStudent->mother_mobile ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label><b><?= controllers::t( 'label','Address') ?></b></label>

                                                        <div class="line" name="mother_address" value="">
                                                            <?= $modelStudent->mother_address ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','District') ?></b></label>
                                                        <div class="line" name="mother_district" value="">
                                                            <?php
                                                            if(empty($Mother_District->DISTRICT_NAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Mother_District->DISTRICT_NAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Amphur') ?></b></label>
                                                        <div class="line" name="mother_amphur" value="">
                                                            <?php
                                                            if(empty($Mother_Amphur->AMPHUR_NAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Mother_Amphur->AMPHUR_NAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Province') ?></b></label>
                                                        <div class="line" name="mother_province" value="">
                                                            <?php
                                                            if(empty($Mother_Province->PROVINCE_NAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Mother_Province->PROVINCE_NAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Zipcode') ?></b></label>

                                                        <div class="line" name="mother_zipcode" value="">
                                                            <?=$modelStudent->mother_zipcode_id; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Religion') ?></b></label>
                                                        <div class="line" name="mother_religion" value="">
                                                            <?php
                                                            if(empty($Mother_Religion->RELIGIONNAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Mother_Religion->RELIGIONNAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Nation') ?></b></label>
                                                        <div class="line" name="mother_nationality" value="">
                                                            <?php
                                                            if(empty($Mother_Nation->NATIONNAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Mother_Nation->NATIONNAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Marital Status') ?></b></label>
                                                        <div class="line" name="marital_status_parent" value="">
                                                            <?= $modelStudent->marital_status_parents ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Parent Name') ?></b></label>
                                                        <div class="line" >
                                                        <div class="line" name="parent_name" value="">
                                                            <?= $modelStudent->PARENTNAME ;?>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Career') ?></b></label>

                                                        <div class="line" name="parent_career" value="">
                                                            <?= $modelStudent->parent_career ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Phone Number (In Register)') ?></b></label>
                                                        <div class="line" name="parent_mobile_register" value="">
                                                            <?= $modelStudent->PARENTPHONENO ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Phone Number (In System)') ?></b></label>
                                                        <div class="line" name="parent_mobile" value="">
                                                            <?= $modelStudent->parent_mobile ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label><b><?= controllers::t( 'label','Address') ?></b></label>
                                                        <div class="line" name="parent_address" value="">
                                                            <?= $modelStudent->parent_address ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Amphur') ?></b></label>
                                                        <div class="line" name="parent_amphur" value="">
                                                            <?php
                                                            if(empty($Parent_Amphur->AMPHUR_NAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Parent_Amphur->AMPHUR_NAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Province') ?></b></label>
                                                        <div class="line" name="parent_province" value="">
                                                            <?php
                                                            if(empty($Parent_Province->PROVINCE_NAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Parent_Province->PROVINCE_NAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','District') ?></b></label>

                                                        <div class="line" name="parent_country" value="">
                                                            <?php
                                                            if(empty($Parent_District->DISTRICT_NAME)){
                                                                echo "<span style='color:red;'>N/A</span>";
                                                            }else{
                                                                echo $Parent_District->DISTRICT_NAME;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Zipcode') ?></b></label>

                                                        <div class="line" name="parent_zipcode" value="">
                                                            <?= $modelStudent->parent_zipcode_id;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2_nobg" class="tab-pane">
                        <!------------------------------------------- แถบระบบสำนักทะเบียน ----------------------------------------------------------------->
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <!------------------------------------------- Student form ----------------------------------------------------------------->
                                <div class="panel-body">
                                    <form class="validate" data-toastr-position="top-right">
                                        <fieldset>
                                            <input type="hidden" name="action" value="contact_send" />
                                            <h4><span style="color:#428bca;"><?= controllers::t( 'label','Student Information') ?></span></h4><hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Person ID') ?></b></label>
                                                        <div class="line" name="person_id" value="">
                                                            <?= $modelStudent->STUDENTID ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Student Code') ?></b></label>
                                                        <div class="line" name="student_code" value="">
                                                            <?= $modelStudent->STUDENTCODE ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Prefix') ?></b></label>
                                                        <div class="line" name="prefix" value="">
                                                            <?= $modelStudent->PREFIXNAME ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','ID Card') ?></b></label>
                                                        <div class="line" name="card_id" value="">
                                                            <?= $modelStudent->CITIZENID ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Name') ?></b></label>
                                                        <div class="line" name="person_name" value="">
                                                            <?= $modelStudent->STUDENTNAME ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Surname') ?></b></label>
                                                        <div class="line" name="person_surname" value="">
                                                            <?= $modelStudent->STUDENTSURNAME ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Name (Eng)') ?></b></label>
                                                        <div class="line" name="person_name_eng" value="">
                                                            <?= $modelStudent->STUDENTNAMEENG ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Surname (Eng)') ?></b></label>

                                                        <div class="line" name="person_surname_eng" value="">
                                                            <?= $modelStudent->STUDENTSURNAMEENG ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Birth Date') ?></b></label>
                                                        <div class="line" name="blood_type" value="">
                                                            <?= $modelStudent->BIRTHDATE ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Religion') ?></b></label>
                                                        <div class="line" name="religion" value="">
                                                            <?= $modelStudent->RELIGIONNAME ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Nation') ?></b></label>

                                                        <div class="line" name="nationality" value="">
                                                            <?= $modelStudent->NATIONNAME ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------------------------------------------- ข้อมูลติดต่อ ----------------------------------------------------------------->
                                            <br><h4><span style="color:#428bca;"><?= controllers::t( 'label','Contact Information') ?></span></h4><hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Phone Number') ?></b></label>

                                                        <div class="line" name="mobile_phone_register" value="">
                                                            <?= $modelStudent->STUDENTMOBILE ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Email') ?></b></label>
                                                        <div class="line" name="person_email_register" value="">
                                                            <?= $modelStudent->STUDENTEMAIL ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------------------------------------------- บุคคลที่สามารถติดต่อได้ ----------------------------------------------------------------->
                                            <br><h4><span style="color:#428bca;"><?= controllers::t( 'label','Person Contact') ?></span></h4><hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Name') ?></b></label>
                                                        <div class="line" name="person_contact_name" value="">
                                                            <?= $modelStudent->CONTACTPERSON ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Relation') ?></b></label>
                                                        <div class="line" name="person_contact_relationship" value="">
                                                            <?= $modelStudent->CONTACTRELATION ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Phone Number') ?></b></label>
                                                        <div class="line" name="person_contact_mobile_register" value="">
                                                            <?= $modelStudent->CONTACTPHONENO ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                        <fieldset>
                                            <!------------------------------------------- ข้อมูลการศึกษา ----------------------------------------------------------------->
                                            <h4><span style="color:#428bca;"><?= controllers::t( 'label','Education Information') ?></span></h4><hr>
                                            <div class="col-md-12 col-sm-12">
                                                <?php if($modelStudent->student_img!="<span style='color:red'>N/A</span>"){?>
                                                    <img class="img-thumbnail" width="150" height="150" alt="" src="<?= Yii::getAlias('@web') ?>/web_personal/upload/System/<?= $modelStudent->student_img ?>" height="34" ALIGN=LEFT>
                                                <?php  }else{?>
                                                    <img class="img-thumbnail" width="150" height="150" alt="" src="<?= Yii::getAlias('@web') ?>/web_personal/upload/noavatar.jpg" height="34" ALIGN=LEFT>
                                                <?php } ?></div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <br><label><b><?= controllers::t( 'label','Student Status') ?></b></label>
                                                        <div class="line" name="student_status" value="">
                                                            <?= $modelStudent->STUDENTSTATUS ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <br><label><b><?= controllers::t( 'label','Adviser') ?></b></label>
                                                        <div class="line" name="advisor" value="">
                                                            <?= $modelStudent->OFFICERNAME." ".$modelStudent->OFFICERSURNAME ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Faculty Name') ?></b></label>
                                                        <div class="line" name="facalty_name" value="">
                                                            <?= $modelStudent->FACULTYNAME ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Level Name') ?></b></label>
                                                        <div class="line" name="level_name" value="">
                                                            <?= $modelStudent->LEVELNAME ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label><b><?= controllers::t( 'label','Program') ?></b></label>
                                                        <div class="line" name="program_name" value="">
                                                            <?= $modelStudent->PROGRAMNAME ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Admitacad year') ?></b></label>
                                                        <div class="line" name="admit_academic_year" value="">
                                                            <?= $modelStudent->ADMITACADYEAR ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Admit Semester') ?></b></label>
                                                        <div class="line" name="admit_academic_semester" value="">
                                                            <?= $modelStudent->ADMITSEMESTER ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Entry Degree') ?></b></label>
                                                        <div class="line" name="pre_certificate" value="">
                                                            <?= $modelStudent->ENTRYDEGREE ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Entry GPA') ?></b></label>
                                                        <div class="line" name="pre_certificate_grade" value="">
                                                            <?= $modelStudent->ENTRYGPA ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','School') ?></b></label>
                                                        <div class="line" name="graduated_from" value="">
                                                            <?= $modelStudent->SCHOOLNAME ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------------------------------------------- ผลการศึกษา ----------------------------------------------------------------->
                                            <br><h4><span style="color:#428bca;"><?= controllers::t( 'label','Transcript') ?></span></h4><hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','GPA') ?></b></label>

                                                        <div class="line" name="gpa" value="">
                                                            <?= $modelStudent->GPA ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------------------------------------------- ข้อมูลผู้ปกครอง ----------------------------------------------------------------->
                                            <br><h4><span style="color:#428bca;"><?= controllers::t( 'label','Parent Information') ?></span></h4><hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Father Name') ?></b></label>
                                                        <div class="line" name="father_name" value="">
                                                            <?= $modelStudent->STUDENTFATHERNAME ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Mother Name') ?></b></label>
                                                        <div class="line" name="motherName" value="">
                                                            <?= $modelStudent->STUDENTMOTHERNAME ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Home Phone Number') ?></b></label>

                                                        <div class="line" name="" value="">
                                                            <?= $modelStudent->HOMEPHONENO ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label><b><?= controllers::t( 'label','Address') ?></b></label>
                                                        <div class="line" name="mother_address" value="">
                                                            <?= $modelStudent->HOMEADDRESS1 ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','District') ?></b></label>
                                                        <div class="line" name="mother_amphur" value="">
                                                            <?= $modelStudent->HOMEADDRESS2 ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Zipcode') ?></b></label>
                                                        <div class="line" name="zipcode" value="">
                                                            <?= $modelStudent->HOMEZIPCODE ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Parent Name') ?></b></label>
                                                        <div class="line" name="parent_name" value="">
                                                            <?= $modelStudent->PARENTNAME ;?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label><b><?= controllers::t( 'label','Phone Number') ?></b></label>
                                                        <div class="line" name="parent_mobile_register" value="">
                                                            <?= $modelStudent->PARENTPHONENO ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
</div>
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