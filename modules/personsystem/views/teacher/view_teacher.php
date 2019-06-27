<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\personsystem\controllers;
use yii\widgets\ActiveForm;
use kartik\dialog\Dialog;
/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\Person */
Yii::$app->formatter->locale = 'th_TH';
$this->title = $model->person_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<header id="page-header">
    <h1><?= controllers::t('label','Teacher Information'); ?> </h1>
    <ol class="breadcrumb">
        <li><a href="#">Forms</a></li>
        <li class="active">Form  Add Infomation</li>
    </ol>
        <div class="row">
            <div class="col-md-6" ><br/>
        <a href="admin-edit-teacher-list" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
            </div>
            <div align="right" class="col-md-6" >
            <?= Html::csrfMetaTags() ?>
        <?= Dialog::widget(['overrideYiiConfirm' => true]); ?>
        <?=  Html::a(Yii::t('app', 'Delete'), ['admin-delete-teacher', 'id' => $model->person_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => controllers::t('label','Are you sure you want to delete this item?'),
                'method' => 'post',
                'params' => ['id'=>$model->person_id]
            ],
        ]) ?>
            <?= Html::a(Yii::t('app', 'Update'), ['admin-update-teacher', 'id' => $model->person_id], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
</header>
<div id="content" class="padding-20">
    <div class="row">
        <!-- tabs -->
        <ul class="nav nav-tabs" style="margin-left: 14px;">
            <li class="active">
                <a href="#tab1_nobg" data-toggle="tab">
                    <i class="fa fa-user"></i> <?php echo controllers::t( 'label','Basic Information'); ?>
                </a>
            </li>
            <li class="">
                <a href="#tab2_nobg" data-toggle="tab">
                    <i class="fa fa-graduation-cap"></i> <?php echo controllers::t( 'label','History Of Education'); ?>
                </a>
            </li>
            <li class="">
                <a href="#tab3_nobg" data-toggle="tab">
                    <i class="fa fa-area-chart"></i> <?php echo controllers::t( 'label','Expertise'); ?>
                </a>
            </li>
            <li class="">
                <a href="#tab4_nobg" data-toggle="tab">
                    <i class="fa fa-pie-chart"></i> <?php echo controllers::t( 'label','Research'); ?>
                </a>
            </li>
            <li class="">
                <a href="#tab5_nobg" data-toggle="tab">
                    <i class="fa fa-newspaper-o"></i> <?php echo controllers::t( 'label','Academic Works'); ?>
                </a>
            </li>
        </ul>
        <!-- tabs1 content -->
        <div class="tab-content transparent">
            <div id="tab1_nobg" class="tab-pane <?php if(empty($_GET["active"])){echo "active";} ?>">
                <!------------------------------------------- แถบ1 ----------------------------------------------------------------->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <!------------------------------------------- Teacher view ----------------------------------------------------------------->
                                    <div class="panel-body">
                                        <form class="validate"  data-toastr-position="top-right">
                                            <fieldset>
                                                <input type="hidden" name="action" value="contact_send" />
                                                <h4><span style="color:#428bca;"><?php echo controllers::t('label','Teacher Information'); ?></span></h4><hr>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Teacher ID'); ?></b></label>
                                                            <div class="line" name="person_id">
                                                                <?php echo $model->person_card_id;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','ID Card'); ?></b></label>
                                                            <div class="line" name="card_id">
                                                                <?php echo $model->person_citizen_id;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Prefix'); ?></b></label>
                                                            <div class="line" name="prefix">
                                                                <?php echo  $model_Prefix->PREFIXNAME;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Gender'); ?></b></label>
                                                            <div class="line" name="gender">
                                                                <?php
                                                                if($model->person_gender=="M"){
                                                                    $model->person_gender = "ชาย";
                                                                }else if($model->person_gender=="F"){
                                                                    $model->person_gender = "หญิง";
                                                                }else{
                                                                    $model->person_gender = "N/A";
                                                                } ?>
                                                                <?php echo $model->person_gender;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Academic Ranks'); ?></b></label>
                                                            <div class="line" name="academic_positions">
                                                                <?php if($Academic != null){
                                                                  echo $Academic;
                                                                }else{
                                                                    echo"<span style='color:red'>N/A</span>";
                                                                }?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Academic Ranks abbreviation'); ?></b></label>
                                                            <div class="line" name="academic_positions_abb_eng" value="Asst. Prof.">
                                                                <?php if($Academic != null){
                                                                    echo $Academic;
                                                                }else{
                                                                    echo"<span style='color:red'>N/A</span>";
                                                                }?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Name'); ?></b></label>
                                                            <div class="line" name="person_name" >
                                                                <?php echo $model->person_name;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Surname'); ?></b></label>
                                                            <div class="line" name="person_surname">
                                                                <?php echo $model->person_surname;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Name (Eng)'); ?></b></label>
                                                            <div class="line" name="person_name_eng">
                                                                <?php echo $model->person_name_eng;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Surname (Eng)'); ?></b></label>
                                                            <div class="line" name="person_surname_eng">
                                                                <?php echo $model->person_surname_eng;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Lecturer'); ?></b></label>
                                                            <div class="line" name="dept_name" >
                                                                <?php echo $model->major->major_name;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Faculty Name'); ?></b></label>
                                                            <div class="line" name="faculty_name" value="วิทยาศาสตร์">
                                                                <?php echo $model->faculty->FACULTYNAME;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Age'); ?></b></label>
                                                            <div class="line" name="age">
                                                                <?php
                                                                if($model->person_birthdate!="<span style='color:red'>N/A</span>"){
                                                                    $date=date_create($model->person_birthdate);
                                                                    $birthDate = date_format($date,"m/d/Y");
                                                                    $birthDate = explode("/", $birthDate);
                                                                    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                                                                        ? ((date("Y") - $birthDate[2]) - 1)
                                                                        : (date("Y") - $birthDate[2]));
                                                                    echo $age; ;
                                                                }else{
                                                                    echo "<span style='color:red'>N/A</span>" ;
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Birth Date'); ?></b></label>
                                                            <div class="line" name="birthdate">
                                                                <?php echo $model->person_birthdate ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Marital Status'); ?></b></label>
                                                            <div class="line" name="marital_status">
                                                                <?php echo $model->person_marital_status;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Blood Group'); ?></b></label>
                                                            <div class="line" name="blood_type">
                                                                <?php echo $model->person_group_blood;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Underlying Disease'); ?></b></label>
                                                            <div class="line" name="health_problem">
                                                                <?php echo $model->person_underlying_disease;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Religion'); ?></b></label>
                                                            <div class="line" name="religion">
                                                                <?php echo $model->personReligion->RELIGIONNAME;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?= controllers::t('label','Nation'); ?></b></label>
                                                            <div class="line" name="nationality">
                                                                <?= $model->personNation->NATIONNAME;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!------------------------------------------- ข้อมูลติดต่อ ----------------------------------------------------------------->

                                                <br><h4><span style="color:#428bca;"><?php echo controllers::t('label','Contact Information'); ?></span></h4><hr>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Phone Number'); ?></b></label>
                                                            <div class="line" name="mobile_phone">
                                                                <?=$model->person_mobile;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?= controllers::t('label','Fax Number'); ?></b></label>
                                                            <div class="line" name="fax_number">
                                                                <?=$model->person_fax;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?= controllers::t('label','Email'); ?></b></label>
                                                            <div class="line" name="person_email">
                                                                <?= $model->person_email;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?= controllers::t('label','Web Site'); ?></b></label>
                                                            <div class="line" name="personal_website">
                                                                <?= $model->person_website;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b>Line ID</b></label>
                                                            <div class="line" name="line_id">
                                                                <?= $model->person_line;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b>Facebook</b></label>
                                                            <div class="line" name="facebook_name">
                                                               <a href="<?=$model->person_facbook;?>"><?=$model->person_facbook;?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!------------------------------------------- ที่อยู่ ----------------------------------------------------------------->
                                                <br><h4><span style="color:#428bca;"><?php echo controllers::t('label','Address'); ?></span></h4><hr>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-12 col-sm-12">
                                                            <label><b><?php echo controllers::t('label','Address (Register Home)'); ?></b></label>
                                                            <div class="line" name="address">
                                                                <?php echo $model->person_home_address;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','District'); ?></b></label>
                                                            <div class="line" name="amphur">
                                                                <?php
                                                                if($home_district!=null){
                                                                    echo $home_district->DISTRICT_NAME;
                                                                }else{
                                                                    echo "<span style='color:red'>N/A</span>";
                                                                }
                                                                 ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Amphur'); ?></b></label>
                                                            <div class="line" name="province">
                                                                <?php
                                                                if($home_amphur!=null){
                                                                    echo $home_amphur->AMPHUR_NAME;
                                                                }else{
                                                                    echo "<span style='color:red'>N/A</span>";
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Province'); ?></b></label>
                                                            <div class="line" name="zipcode">
                                                                <?php
                                                                if($home_province!=null){
                                                                    echo $home_province->PROVINCE_NAME;
                                                                }else{
                                                                    echo "<span style='color:red'>N/A</span>";
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Zipcode'); ?></b></label>
                                                            <div class="line" name="country">
                                                                <?= $model->person_home_zipcode; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-12 col-sm-12">
                                                            <label><b><?php echo controllers::t('label','Address (Current Address)'); ?></b></label>
                                                            <div class="line" name="current_address" >
                                                                <?php echo $model->person_current_address;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','District'); ?></b></label>
                                                            <div class="line" name="current_amphur">
                                                                <?php
                                                                if($current_district!=null){
                                                                    echo $current_district->DISTRICT_NAME;
                                                                }else{
                                                                    echo "<span style='color:red'>N/A</span>";
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Amphur'); ?></b></label>
                                                            <div class="line" name="current_province" >
                                                                <?php
                                                                if($current_amphur!=null){
                                                                    echo $current_amphur->AMPHUR_NAME;
                                                                }else{
                                                                    echo "<span style='color:red'>N/A</span>";
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Province'); ?></b></label>
                                                            <div class="line" name="current_zipcode">
                                                                <?php
                                                                if($current_province!=null){
                                                                    echo $current_province->PROVINCE_NAME;
                                                                }else{
                                                                    echo "<span style='color:red'>N/A</span>";
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Zipcode'); ?></b></label>
                                                            <div class="line" name="current_country">
                                                                <?= $model->person_current_zipcode; ?>
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
                                        <form class="validate" data-toastr-position="top-right">
                                            <fieldset>
                                                <!------------------------------------------- ประวัติการศึกษา ----------------------------------------------------------------->
                                                <h4><span style="color:#428bca;"><?php echo controllers::t('label','Basic Information'); ?></span></h4><hr>
                                                <div class="col-md-12 col-sm-12">
                                                <?php if($model->person_img!="<span style='color:red'>N/A</span>"){?>
                                                    <div class="img-resize"> <img class="img-thumbnail" width="150" height="150" alt="" src="<?= Yii::getAlias('@web') ?>/web_personal/upload/person/<?= $model->person_img ?>" height="34" ALIGN=LEFT></div>
                                              <?php  }else{?>
                                                    <div class="img-resize"><img class="img-thumbnail" width="150" height="150" alt="" src="<?= Yii::getAlias('@web') ?>/web_personal/upload/noavatar.jpg" height="34" ALIGN=LEFT></div>
                                               <?php } ?>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <br><label><b><?php echo controllers::t('label','Operational Status'); ?></b></label>
                                                            <div class="line">
                                                                <?php echo $model->person_operate_status;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <br><label><b><?php echo controllers::t('label','Start Date'); ?></b></label>
                                                            <div class="line">
                                                                <?php
                                                                echo $model->person_start_date ;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Contract Date'); ?></b></label>
                                                            <div class="line" >
                                                                <?php echo $model->person_contract_date;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Expire Date'); ?></b></label>
                                                            <div class="line">
                                                                <?php echo $model->person_confirmed_date;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Confirmed Date'); ?></b></label>
                                                            <div class="line">
                                                                <?php echo $model->person_confirmed_date;?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Pass Probation Date'); ?></b></label>
                                                            <div class="line">
                                                                <?php echo $model->person_pass_probation_date; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                           <label><b><?php echo controllers::t('label','Retire Date'); ?></b></label>
                                                            <div class="line">
                                                                <?php echo $model->person_retire_date;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                           <label><b><?php echo controllers::t('label','Official Age (Year)'); ?></b></label>
                                                            <div class="line">
                                                                <?php
                                                                if($model->person_birthdate!="<span style='color:red'>N/A</span>"){
                                                                    $date=date_create($model->person_birthdate);
                                                                    $birthDate = date_format($date,"m/d/Y");
                                                                    $birthDate = explode("/", $birthDate);
                                                                    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                                                                        ? ((date("Y") - $birthDate[2]) - 1)
                                                                        : (date("Y") - $birthDate[2]));
                                                                    echo $age; ;
                                                                }else{
                                                                    echo $model->person_start_date ;
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Decommission Date'); ?></b></label>
                                                            <div class="line">
                                                                <?php echo $model->person_decommission_date;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Position Type'); ?></b></label>
                                                            <div class="line">
                                                                <?php echo $model->person_position_type;  ?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Current Work Place'); ?></b></label>
                                                            <div class="line">
                                                                <?php echo $model->person_current_work_place;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Account Hold'); ?></b></label>
                                                            <div class="line">
                                                                <?php echo $model->person_account_hold;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <br><label><b><?php echo controllers::t('label','Person Type'); ?></b></label>
                                                            <div class="line">
                                                                <?php echo $model->person_person_type;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <br><label><b><?php echo controllers::t('label','Salary'); ?></b></label>
                                                            <div class="line">
                                                                <?php echo $model->person_salary;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Salary Position'); ?></b></label>
                                                            <div class="line">
                                                                <?php echo $model->person_salary_position;  ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','Pension'); ?></b></label>
                                                            <div class="line" name="graduate_year" value="2544">
                                                                <?php echo $model->person_pension;  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                        <div class="row">
                                                            <div class="form-group">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label','pension Withdraw'); ?></b></label>
                                                            <div class="line" name="graduate_year" value="2544">
                                                                <?php echo $model->person_pension_withdraw;  ?>
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
            </div>
            </div>
            <div id="tab2_nobg" class="tab-pane <?php if(!empty($_GET["active"])&& $_GET["active"]==2){echo "active";} ?>">
                <!------------------------------------------- แถบ1 ----------------------------------------------------------------->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive"><br>
                                <h4><span style="color:#428bca;"><?= controllers::t('label','Tabel History Education') ?></span></h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><p align="center" style="margin: 0px">#</th>
                                        <th><?php echo controllers::t('label','Level Education'); ?></th>
                                        <th><?php echo controllers::t('label','Education Background'); ?></th>
                                        <th><?php echo controllers::t('label','Education Institution'); ?></th>
                                        <th><?php echo controllers::t('label','Graduate Year'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php   foreach ($modelEduca as $key=> $value){  ?>
                                    <tr>
                                        <td align="center"><?= $key + 1 ?></td>
                                        <td><?php echo $value->level_education;  ?></td>
                                        <td><?php echo $value->educational_background;  ?></td>
                                        <td><?php echo $value->educational_institution;  ?></td>
                                        <td><?php echo $value->graduate_year;  ?></td>
                                    </tr>
                                    <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab3_nobg" class="tab-pane <?php if(!empty($_GET["active"])&& $_GET["active"]==3){echo "active";} ?>">
                <!------------------------------------------- แถบ1 ----------------------------------------------------------------->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive"><br>
                                <h4><span style="color:#428bca;"><?= controllers::t('label','Tabel Expertise') ?></span></h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><p align="center" style="margin: 0px">#</th>
                                        <th><?php echo controllers::t('label','Expertise'); ?></th>
                                        <th><?php echo controllers::t('label','Expertise (Eng)'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php   foreach ($modelExpertise as $key => $value){  ?>
                                        <tr>
                                            <td align="center"><?= $key + 1 ?></td>
                                            <td><?php echo $value->expertise_field_name;  ?></td>
                                            <td><?php echo $value->expertise_field_name_eng;  ?></td>
                                        </tr>
                                    <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab4_nobg" class="tab-pane <?php if(!empty($_GET["active"])&& $_GET["active"]==4){echo "active";} ?>">
                <!------------------------------------------- แถบ1 ----------------------------------------------------------------->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive"><br>
                                <h4><span style="color:#428bca;"><?= controllers::t('label','Tabel Research') ?></span></h4>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab5_nobg" class="tab-pane <?php if(!empty($_GET["active"])&& $_GET["active"]==5){echo "active";} ?>">
                <!------------------------------------------- แถบ1 ----------------------------------------------------------------->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive"><br>
                                <h4><span style="color:#428bca;"><?= controllers::t('label','Tabel Academic Works') ?></span></h4>

                            </div>
                        </div>
                    </div>
                </div>
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



