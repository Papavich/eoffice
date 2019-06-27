<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 29/11/2560
 * Time: 1:32
 */

use app\modules\eoffice_ta\models\TaRuleApproach;
use app\modules\eoffice_ta\models\TaTypeRule;
use app\modules\eoffice_ta\models\TaCalculation;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRequest;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\Person;
use app\modules\eoffice_ta\models\Subject;
use app\modules\eoffice_ta\models\Kku30Section;
use app\modules\eoffice_ta\models\model_main\PersonView;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\model_main\EofficeMainPerson;
use app\modules\eoffice_ta\models\model_main\EofficeMainPrefix;
use app\modules\eoffice_ta\models\Kku30SectionTeacher;
use app\modules\eoffice_ta\models\ViewKku30SectionProgram;
use app\modules\eoffice_ta\models\Kku30SectionProgram;
use yii\helpers\Url;
use app\modules\eoffice_ta\components\NextPage;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\Term;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?php
$this->title = 'กรอบค่าตอบแทนผู้ช่วยสอน';
?>
<div class="check-max-payment">
<div class="panel-body">
    <div class="navbar navbar-default">
        <div class="navbar-header">
            <?= Menu::widget([
                'items' => [
                    ['label' => 'ตรวจสอบการร้องขอTA', 'url' => ['check-request']],
                    ['label' => 'ตรวจสอบชั่วโมงปฏิบัติงาน','url'=>['staff/check-working']],
                    ['label' => 'กรอบค่าตอบแทนผู้ช่วยสอน', 'url' => ['check-max-payment']],
                ],
                'options' => [
                    'class' => 'navbar-nav nav',
                    'id'=>'navbar-id',
                    'style'=>'font-size: 14px;',
                    'data-tag'=>'yii2-menu',
                ],
            ]);
            ?>
        </div>
    </div>
    <div id="content" class="padding-10">
        <div id="panel-1" class="panel panel-default">
            <div class="panel-heading">
							<span class="title elipsis size-20"><!-- panel title -->
								<strong>รายวิชาที่มีผู้ช่วยสอน</strong><strong class="text-blue">
                                   </strong>
							</span>
            </div>
            <div class="panel-body">
                <!--  ขณะนี้เวลา : <?php //date('H:i:s');?><br>   -->
                <?php $form = ActiveForm::begin( [//\yii\helpers\Url::current(),
                    'class' => 'horizontal',
                    //'action' => ['test'],
                    'method' => 'get', //['csrf' => false]
                ] ); ?>
                <fieldset>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2 col-sm-2">
                            <span class="title elipsis size-16"><!-- panel title -->
								<strong>ปีการศึกษา</strong><strong class="text-blue">
                                   </strong>
							</span>
                                <?php
                                $terms = Term::find()->orderBy(['year'=>SORT_ASC])->all();
                                foreach ($terms as $term){
                                }
                                echo Select2::widget( [
                                    'name' => 'term_name',
                                    'value' => '',
                                    'theme'=>Select2::THEME_DEFAULT,
                                    'data' => ArrayHelper::map(Term::find()->
                                    addOrderBy(['term_name'=>SORT_ASC])->
                                    addOrderBy(['year'=>SORT_ASC])->all(), 'term_name', 'term_name' ),
                                    'options' => [
                                        'placeholder' => '-- เลือกปีการศึกษา --',
                                        'multiple' => false ],
                                ] );

                                $term_name2 = \Yii::$app->request->get('term_name');
                                $term3 =  substr($term_name2, 0, -5);
                                $year3 = substr($term_name2, 2, 6);
                                ?>
                            </div><br>
                            <div class="col-md-1 col-sm-1">
                                <?= Html::submitButton( '<i class="fa fa-search"></i>' . controllers::t( 'label', 'Search' ) , ['class' => 'btn btn-blue'] ) ?>
                            </div>
                            <div class="col-md-8 col-sm-8"></div>
                        </div>
                </fieldset>
                <?php ActiveForm::end(); ?>
                <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-vertical-middle nomargin" >
        <thead>
        <tr > <!-- class="btn-aqua"-->
            <th class="table-checkbox" width="1%" rowspan = 2>
                <input type="checkbox" class="group-checkable" data-set="#datatable_sample .checkboxes"/>
            </th>
            <th width="10%" rowspan = 2><center>วิชา</center></th>
            <th width="7%" rowspan = 2><center>อาจารย์ประจำวิชา</center></th>
            <th width="2%" rowspan = 2><center>หน่วยกิต</center></th>
            <th width="3%" rowspan = 2><center>ประเภทงานที่ร้องขอ</center></th>  <!--  ประเภทงานที่ร้องขอ -->
            <th width="9%" colspan = 2 class="info"><center>ภาคปกติ</center></th>
            <th width="9%" colspan = 2 class="info"><center>โครงการพิเศษ</center></th>
            <th width="2%" rowspan = 2><center>รายละเอียด</center></th>
        </tr>
        <tr>
            <td class="text-center"> จำนวนนักศึกษา</td>
            <td  class="warning text-center" >กรอบเงิน</td>
            <td class="text-center">จำนวนนักศึกษา</td>
            <td class="warning text-center">กรอบเงิน</td>
        </tr>
        </thead>
        <?php
              foreach ($model as $item){
                $subj_id =  $item->subject_id;
        $subject = \app\modules\eoffice_ta\models\Kku30Subject::findOne(['subject_id'=>$subj_id]);
        $subj_name = $subject->subject_nameeng;
                $subj_ver = $item->subject_version;
                $term = $item->subopen_semester;
                $year = $item->subopen_year;
                $credit = $subject->subject_credit.'('.$subject->subject_time.')';

                $req = TaRequest::findOne(['subject_id'=>$subj_id,'subject_version' => $subj_ver,
                    'term_id'=>$term,'year'=>$year ]);
                ?>
            <tbody>
            <tr class="odd gradeX">
                <td><input type="checkbox" name="listmails[]"
                           value="<?= $item['subject_id'] ?>"></td>
                <!-- *********************** วิชา ****************** -->
                <td><a><strong><?=$subj_id?></strong></a> <?=$subj_name?></td>
                <td >
                    <?php
                    $t_secs = Kku30SectionTeacher::findOne([
                        'subject_id'=>$subject->subject_id]);
                    //$person = PersonView::findOne(['person_id' => $t_secs->teacher_id]);
                    if (!empty($t_secs)) {
                        $per = ViewPisUser::findOne(['person_id' => $t_secs->teacher_no]);
                        /* $t_secs = Kku30SectionTeacher::findOne([
                             'subject_id'=>$subj_id]);
                        */
                        //$person = PersonView::findOne(['person_id' => $t_secs->teacher_id]);
                        /*  $person = EofficeMainUser::findOne(['person_id' => $t_secs->teacher_no]);
                          $per = EofficeMainPerson::findOne(['person_id'=>$person->person_id]);
                        */
                        // $prefix = EofficeMainPrefix::findOne(['PREFIXID'=>$per->prefix_id]);

                        echo $per->PREFIXNAME . ' ' . $per->person_fname_th . ' ' . $per->person_lname_th;
                    }else { echo '  <strong style="color: red" class="size-13">
                            <i class="fa fa-exclamation-triangle"></i>   ยังไม่ดึงข้อมูลเข้า</strong>
                       ';
                    }
                    ?>
                </td>
                <td class="text-center"><?=$credit?></td>
                 <?php
                    if (!empty($req)){
                        $type_work = $req->ta_type_work_id;
                        ?>
                <td class="text-center">
                    <?php
                       if ($type_work == 'C'){ ?>
                           <span class="label label-warning size-14"><?=$req->taTypeWork->ta_type_work_name?></span>
                    <?php   }elseif ($type_work == 'L'){ ?>
                           <span class="label label-success size-14"><?=$req->taTypeWork->ta_type_work_name?></span>
                    <?php   }else{   //C&L ?>
                           <span class="label label-info size-14"><?=$req->taTypeWork->ta_type_work_name?></span>
                    <?php  }  ?>
                </td>
                <td class="text-center">
                        <?php
                        $std_num1 =0;
                        $sec_programs1 = ViewKku30SectionProgram::find()->where([
                            'program_class'=>1,
                            'subject_id'=>$subj_id,'subject_version' => $subj_ver,
                            'subopen_semester'=>$term,'subopen_year'=>$year])->all();
                        foreach ($sec_programs1 as $sec_program1) {
                            $Sec1 = Kku30Section::findOne(['section_no'=>$sec_program1->section_no,
                                'subject_id'=>$subj_id,'subject_version' => $subj_ver,
                                'term_id'=>$term,'year_id'=>$year]);
                            //echo  $Sec1->section_no.'//';
                            $std_num1 += (int)$Sec1;
                        }
                        echo  '<strong style="color: darkmagenta" class="size-13">
                                <i class="fa fa-user"></i>'.$std_num1.'</strong>'; ?>
                </td>
                <td class="warning text-center">
                        <?php
                   //------------------------------------- เริ่มคำนวณ เฉพาะ LECTURE ------------------------------------
                        if ($type_work == 'C'){

                         //--------------------------------  คำนวณจาก Database  ---------------------------------------------
                           /* $Rule_WloadLec = TaRuleApproach::findOne(['ta_rule_approach_id'=>TaTypeRule::TYPE_R_WORK_LOAD_Lec]);
                            $brackets = TaCalculation::find()->where(
                                ['ta_rule_id'=>$Rule_WloadLec->ta_rule_approach_id,
                                    'status_symbol'=>TaCalculation::SYMBOL_PARENTHESES
                                ])->all();// หา symbol ที่เป็นวงเล็บทั้งหมด
                            $count = count($brackets);    // นับจำนวนวงเล็บทั้งหมดของสูตรนี้
                            // echo 'วงเล็บทั้งหมด ='. $count;

                              $b_dff_order = 4;     // ค่าระยะห่างของ order ในวงเล็บ (ตัวแปร1  ตัวดำเนินการ ตัวแปร2)  -->ห่างกัน 4

                        $bracket_opens = TaCalculation::find()->where(['symbol' => '(','ta_rule_id' =>
                            $Rule_WloadLec->ta_rule_approach_id,])->all();    // หาวงเล็บเปิดของสูตรนี้ทั้งหมด
                        foreach ($bracket_opens as $bracket_open) {
                            $b_open_order = $bracket_open->order;       //เก็บ order
                            $order_ver1 = $bracket_open->order + ($b_dff_order - 3);  //หา ลำดับ order ของตัวแปร1
                            $order_op1 = $bracket_open->order + ($b_dff_order - 2);   //หา ลำดับ order ของตัวดำเนินการ
                            $order_ver2 = $bracket_open->order + ($b_dff_order - 1);  //หา ลำดับ order ของตัวแปร2
                           //------------------------------------- หาตัวแปรและ operator----------------------------------------------------
                          //---------------------- หาตัว แปรที่1 ----------------------------------------------------
                            $ver1 = TaCalculation::findOne(['ta_rule_id' => $Rule_WloadLec->ta_rule_approach_id,
                                'order' => $order_ver1, 'status_symbol' => TaCalculation::SYMBOL_VARIABLE]);

                            $ver1_value = $ver1->symbol_value;     // ตัวแปรที่1

                            if (empty($ver1_value)){
                                $ver1_value = $credit_lec;
                            }
                          //---------------------- หาตัว operator ----------------------------------------------------
                            $op1 = TaCalculation::findOne(['ta_rule_id' => $Rule_WloadLec->ta_rule_approach_id,
                                'order' => $order_op1, 'status_symbol' => TaCalculation::SYMBOL_OPERATOR]);
                            $oper = $op1->symbol;
                            //---------------------- หาตัว แปรที่2 ----------------------------------------------------
                            $ver2 = TaCalculation::findOne(['ta_rule_id' => $Rule_WloadLec->ta_rule_approach_id,
                                'order' => $order_ver2, 'status_symbol' => TaCalculation::SYMBOL_VARIABLE]);
                            $ver2_value = $ver2->symbol_value;
                            $count2 = $count/2;     //-------------- ให้คำนวณในวงเล็บที่ละคู่  มีกี่คู่ก็คำนวณวนไป--------
                          for ($i=1; $i<$count2; $i++){
                                switch ($op1->symbol) {
                                case "+":
                                    $result = $ver1_value + $ver2_value;
                                    break;
                                case "-":
                                    $result = $ver1_value - $ver2_value;
                                    break;
                                case "*":
                                    $result = $ver1_value * $ver2_value;
                                    break;
                                case "/":
                                    $result = $ver1_value / $ver2_value;
                                    break;
                            }
                            $total[] = (float)$result; //---- เก็บค่าเป็น array เอาไว้กระทำต่อ

                            }
                     }  // ปิด loop (ลง) $bracket_opens

                        $open_count = count($bracket_opens);  //  นับจำนวณวงเล็บเปิด
                      //---------------------- หาวงเล็บปิด -----------------------------
                             $bracket_closes = TaCalculation::find()->where(['symbol' => ')',
                    'ta_rule_id'=>$Rule_WloadLec->ta_rule_approach_id])->all();

                foreach ($bracket_closes as $bracket_close) {
                    $b_close_order = $bracket_close->order;  // order ของวงเล็บปิด
                    $close_count = count($bracket_closes);     //นับจำนวณวงเล็บปิด
                    $order_after_close = $b_close_order+1;      // order หลังจากวงเล็บ ปิด คือหาตัว operator กลาง
                    $order_next_open = TaCalculation::find()->where(['symbol' => '(',
                        'ta_rule_id' => $Rule_WloadLec->ta_rule_approach_id,'order'=>$order_after_close+1
                    ])->all();     // หาวงเล็บถัดไป
                    //----------------------------------------------------------------------------------------


                    if(!empty($order_next_open)){

                     //   echo '<br>order ='.$order_after_close.'<br>';   // แสดง operator กลาง

                        $opertor_main = TaCalculation::find()->where([
                            'ta_rule_id' => $Rule_WloadLec->ta_rule_approach_id
                            ,'status_symbol'=>TaCalculation::SYMBOL_OPERATOR,
                            'order'=>$order_after_close])->all();   // ------- ค้นหา operator กลาง ------
                        $op_count = count($opertor_main);  // --------- นับจำนวณ operator กลาง -----------
                        //-------------------------- loop เอา operator กลาง ----------------------------
                        foreach ($opertor_main as $op_main){
                            $operator_m = $op_main->symbol;

                           // echo '<br>operator final :'.$operator_m.'<br>';  //แสดงค่า operator กลาง

                            for ($i=1; $i< sizeof($total); $i++){  // ----- loop คำตอบแต่ละวงเล็บ -------

                                switch ($operator_m) {
                                    case "+":
                                        $total_credit = (float)$total[$i-1] + (float)$total[$i];  // $i-1 เพราะ array เก็บ indexเริ่มต้นจาก0
                                        break;
                                    case "-":
                                        $total_credit = (float)$total[$i-1] - (float)$total[$i];
                                        break;
                                    case "*":
                                        $total_credit = (float)$total[$i-1] * (float)$total[$i];
                                        break;
                                    case "/":
                                        $total_credit = (float)$total[$i-1] / (float)$total[$i];
                                        break;

                                }

                                //echo '<br>ผลรวม ='.$total_credit;
                            }

                        }
                    }
                }*/


                            //------------------------------------- code แบบฝัง ------------------------------------
                         //   echo $credit;
                            $credit_lec1 = substr($credit, 2,2);
                            $credit_lec1 = (int)$credit_lec1* 1;
                            $wload_n = ($credit_lec1*$Hlec)*($std_num1/60);
                          //  echo $credit_lec1;
                            //echo $Hlec;
                          //   echo 'ภาระงาน = '.$wload;
                            $Max_pay_n = ($wload_n*($RB/100)*$BP)+($wload_n*($RG/100)*$BG);
                            $Max_pay_term = $Max_pay_n*4;
                            echo  ' <strong style="color: limegreen" class="size-13">
                            <i class="glyphicon glyphicon-usd"></i>
                            '.Yii::$app->formatter->asDecimal($Max_pay_term).'</strong>';
                        }
                        //------------------------------------- เริ่มคำนวณ เฉพาะ LAB ------------------------------------
                        elseif ($type_work == 'L'){
                          //  echo $credit;
                            $credit_lab = substr($credit, 2,2);
                            $credit_lab = (float)$credit_lab* 0.5;
                         //   echo $credit_lab;
                            $wload_n = ($credit_lab*$Hlab)*($std_num1/30);
                         //   echo 'ภาระงาน = '.$wload;
                            $Max_pay_n = ((float)$wload_n*($RB/100)*$BP)+((float)$wload_n*($RG/100)*$BG);
                            $Max_pay_term = $Max_pay_n*4;
                            echo  ' <strong style="color: limegreen" class="size-13">
                            <i class="glyphicon glyphicon-usd"></i>
                            '.Yii::$app->formatter->asDecimal($Max_pay_term).'</strong>';
                        }
                        //------------------------------------- เริ่มคำนวณ LECTURE + LAB ------------------------------------
                        else{
                           // echo $credit;
                            $credit_lec = substr($credit, 2,2);
                            $credit_lec = (float)$credit_lec* 1;

                            $credit_lab = substr($credit, 4,2);
                            $credit_lab = (float)$credit_lab* 0.5;
                          //  echo $credit_lab;
                            $wload_n = (($credit_lec*$Hlec)*($std_num1/60))+(($credit_lab*$Hlab)*($std_num1/30));
                          //  echo 'ภาระงาน = '.$wload;
                            $Max_pay_n = ($wload_n*($RB/100)*$BP)+($wload_n*($RG/100)*$BG);

                            $Max_pay_term = $Max_pay_n*4;
                            echo  ' <strong style="color: limegreen" class="size-13">
                            <i class="glyphicon glyphicon-usd"></i>
                            '.Yii::$app->formatter->asDecimal($Max_pay_term).'</strong>';
                        }

                        ?></td>
                <td class="text-center">
                    <?php
                    $std_num2 =0;
                         $sec_programs2 = ViewKku30SectionProgram::find()->where([
                                'program_class'=>2,
                                'subject_id'=>$subj_id,'subject_version' => $subj_ver,
                                'subopen_semester'=>$term,'subopen_year'=>$year])->all();
                        foreach ($sec_programs2 as $sec_program2) {
                            $Sec2 = Kku30Section::findOne(['section_no'=>$sec_program2->section_no,'subject_id'=>$subj_id,'subject_version' => $subj_ver,
                                'term_id'=>$term,'year_id'=>$year]);
                            //echo  $Sec2->section_no.'//';
                            $std_num2 += (int)$Sec2;
                            }
                    echo  '<strong style="color: darkmagenta" class="size-13">
                                <i class="fa fa-user"></i>'.$std_num2.'</strong>'; ?>
                </td><td class="warning text-center">
                    <?php
                    if ($type_work == 'C'){
                        $credit_lec = substr($credit, 2,2);
                        $credit_lec = (float)$credit_lec* 1;
                        $wload_v = (float)($credit_lec*$Hlec)*($std_num2/60);
                      //  echo 'ภาระงาน = '.$wload;
                        $Max_pay_v = ((float)$wload_v*($RB/100)*$BP)+($wload_v*($RG/100)*$BG);
                        $Max_pay_term = $Max_pay_v*4;
                        echo  ' <strong style="color: limegreen" class="size-13">
                            <i class="glyphicon glyphicon-usd"></i>
                            '.Yii::$app->formatter->asDecimal($Max_pay_term).'</strong>';
                    }elseif ($type_work == 'L'){

                        $credit_lab = substr($credit, 2,2);
                        $credit_lab = (float)$credit_lab* 0.5;

                        $wload_v = (float)($credit_lab*$Hlab)*($std_num2/30);
                       // echo 'ภาระงาน = '.(float)$wload;
                        $Max_pay_v =  ((float)$wload_v*($RB/100)*$BP)+((float)$wload_v*($RG/100)*$BG);
                       // echo $Max_pay;
                        $Max_pay_term = $Max_pay_v*4;
                        echo  ' <strong style="color: limegreen" class="size-13">
                            <i class="glyphicon glyphicon-usd"></i>
                            '.Yii::$app->formatter->asDecimal($Max_pay_term).'</strong>';
                    }else{
                        $credit_lec = substr($credit, 2,2);
                        $credit_lec = (float)$credit_lec* 1;

                        $credit_lab = substr($credit, 4,2);
                        $credit_lab = (float)$credit_lab* 0.5;

                        $wload_v = (float)(($credit_lec*$Hlec)*($std_num2/60))
                            +(($credit_lab*$Hlab)*($std_num2/30));
                       // echo 'ภาระงาน = '.$wload;
                        $Max_pay_v = (float)($wload_v*($RB/100)*$BP)+($wload_v*($RG/100)*$BG);
                        $Max_pay_term = $Max_pay_v*4;
                        echo  ' <strong style="color: limegreen" class="size-13">
                            <i class="glyphicon glyphicon-usd"></i>
                            '.Yii::$app->formatter->asDecimal($Max_pay_term).'</strong>';
                    }
                        ?>
                </td>
                        <td class="text-center">
                            <?= Html::a(Html::tag('i', '',
                                ['class' => 'glyphicon glyphicon-eye-open size-16']),
                                ['check-max-payment-view',
                                    's'=>$subj_id,'ver'=>$subj_ver,'t'=>$term,'y'=>$term,
                                    'wn'=>$wload_n,'wv'=>$wload_v,
                                    'pn'=>$Max_pay_n,'pv'=>$Max_pay_v,
                                    'stdn'=>$std_num1,
                                    'stdv'=>$std_num2
                                ],
                                ['class' => 'btn btn-sm btn-dirtygreen',])
                            ?>
                        </td>

                    <?php }else{ ?>
                        <td class="text-center">
                          <span class="label label-danger size-14">
                              NON-REQUEST</span>
                        </td>
                        <td class="text-center">
                            <strong style="color: red" class="size-13">
                                <i class="fa fa-exclamation-triangle"></i>
                                NON-REQUEST
                            </strong>
                        </td>
                        <td class="text-center">
                            <strong style="color: red" class="size-13">
                                <i class="fa fa-exclamation-triangle"></i>
                                NON-REQUEST
                            </strong>
                        </td>
                        <td class="text-center">
                            <strong style="color: red" class="size-13">
                                <i class="fa fa-exclamation-triangle"></i>
                                NON-REQUEST
                            </strong>
                        </td>
                        <td class="text-center">
                            <strong style="color: red" class="size-13">
                                <i class="fa fa-exclamation-triangle"></i>
                                NON-REQUEST
                            </strong>
                        </td>
                        <td class="text-center">
                            <strong style="color: red" class="size-13">
                                <i class="fa fa-exclamation-triangle"></i>
                                NON-REQUEST
                            </strong>
                        </td>
                    <?php }?>




                <!-- *********************** Secที่สอน ****************** -->
                <!-- *********************************** จัดการ ******************************* -->
            </tr>
            </tbody>
        <?php } ?>
    </table>
</div>

    <div id="custom-pagination" class="pull-right">
        <?php
        echo LinkPager::widget([
            'pagination' => $pages,
        ])
       ?>
    </div>
    </div>
</div>