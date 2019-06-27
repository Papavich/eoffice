<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 29/11/2560
 * Time: 1:32
 */


use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRequest;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\Person;
use app\modules\eoffice_ta\models\TaWorkLoad;
use app\modules\eoffice_ta\models\Subject;
use app\modules\eoffice_ta\models\model_main\PersonView;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;
use app\modules\eoffice_ta\models\model_main\EofficeMainPerson;
use app\modules\eoffice_ta\models\model_main\EofficeMainPrefix;
use app\modules\eoffice_ta\models\SectionTeacher;
use yii\helpers\Url;
use app\modules\eoffice_ta\components\NextPage;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use app\modules\eoffice_ta\models\TaCalculation;
use app\modules\eoffice_ta\models\TaRuleApproach;
use app\modules\eoffice_ta\models\TaTypeRule;
use yii\widgets\ActiveForm;

use app\modules\eoffice_ta\models\TaVariable;
use app\modules\eoffice_ta\models\TaEquation;

use app\modules\eoffice_ta\components\Calculation as Calculate;
?>

<?php
$this->title = 'คำนวณประมาณ';
?>

<div class="panel-body">
    <?php
    /*
     * strlen() หาความยาวของข้อความ
       strpos() หาตำแหน่งข้อความที่ค้นพบอยู่ในขณะนั้น
       strrchr() ตัดข้อความจากตัวสุดท้ายที่พบจนถึงตัวท้ายสุด
       str_repeat() แสดงข้อความซ้ำ ๆ ตามความต้องการ
       strrev() เรียงสลับข้อความจากหลังไปหน้า
       strrpos() หาต่ำแหน่งสุดท้ายที่ค้นพบ
       strstr() ตัดข้อความบางส่วนตั้งแต่ตัวแรกที่ค้นพบจนถึงตัวสุดท้าย
       strtolower() แปลงข้อความให้เป็นตัวพิมพ์เล็ก
       strtoupder() แปลงข้อความให้เป้นตัวพิมพ์ใหญ่
       str_replace() เปลี่ยนข้อความที่ค้นพบด้วยข้อความใหม่ที่ต้องการ
       strtr() แปลงตัวอักษรที่แน่นอน
       substr() ตัดตัวอักษรที่ต้องการใช้ออกมา     <<<<<<<<<<<<<<
       substr_replace() เปลี่ยนข้อความภายในส่วนของข้อความ
       trim() ตัดช่องว่างด้านหน้าและด้านหลังข้อความ   <<<<<<<<<<<<<<
       ucfirst() เปลี่ยนตัวอักษรตัวแรกของข้อความให้เป็นตัวพิมพ์ใหญ่
       ucwords() เปลี่ยนอักษรตัวแรกของแต่ละคำในข้อความ
       stristr() ตัดข้อความบางส่วนตั้งแต่ตัวแรกที่พบจนถึงตัวสุดท้าย ทั้งตัวพิมพ์เลก็กและพิมพ์ใหญ่
       strip_tags() ตัดแท็ก php และ Html ออกจากข้อความ
       strchr() ตัดข้อความบางส่วนตั้งแต่ตัวแรกที่พบจนถึงตัวสุดท้าย
       sprintf() ให้ค่าของข้อความที่มีรูปแบบ
       similar_text() คำนวณความเหมือนระหว่าง 2 ข้อความ
       setlocale() ปรับค่าข้อมูลท้องถิ่น
       prinf() แสดงผลข้อความที่มีรูปแบบ
       prin() แสดงผลข้อความ
       parse_str() รับค่าข้อความใว้ในตัวแปร
       Ord() แปลงตัวอักษรเป็นรหัส ASCII
       ltrim() ตัดข้อความด้านหน้าข้อความออกไป   <<<<<<<<<<<<<<<<<
       join() รวม Array เป็นข้อความ
       implode() รวม Array เป็นข้อความ
       htmlspecialchars() แสดงแท็ก Html
       flush() เคลียร์บัฟฟอร์
       eregi_replace() แทนที่ข้อความที่ค้นพบด้วยคำที่ต้องการ โดยไม่สนใจว่าจะเป็นตัวพิมพ์เล็กหรือใหญ่
       ereg_replace() แทนที่ข้อความที่พบด้วยคำที่ต้องการ
       explode() แยกข้อความโดยใช้เครื่องหมายแยก   <<<<<<<<<<<<<<<<
       echo() แสดงผลข้อความ
       Chr() แปลงรหัส ASCII เป็นตัวอักษร
       Chop() ตัดช่องว่างท้ายข้อความออกไป      <<<<<<<<<<<<<<<<<
     * */
    ?>
    <!-- panel content -->
    <?php
    echo '<br>------------------------------------------------------------------------------------------------------- --------------------------------------<br>'
    ?>
    <?php
    // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    $find_equations = TaEquation::find()->where(['ta_type_rule_id'=>TaTypeRule::TYPE_R_CREDIT ,'active_status'=>'1'])->all();
    foreach ($find_equations as $find_equation){
        $equation =  $find_equation->ta_equation_name;
        if (!empty($find_equations)){
    // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            ?>
            <strong class="label-warning">
                <?=$equation?></strong><br>
            <?php
            $count = strlen($equation);
            $braces_open = '{';
            $braces_close = '}';
            echo substr($equation,0,1)."<br>";
            echo 'ความยาวของสมการ = '.strlen($equation);
            echo"หาตำแหน่งตัวแรกที่ค้นพบ { อยู่ที่ ".strpos($equation,$braces_open);
            $braces_open2 = strpos($equation,$braces_open);
            echo"<br>หาตำแหน่งตัวสุดท้ายที่ค้นพบ } อยู่ที่ ".strpos($equation,$braces_close);


            $op_array = [];
            $bracket_array = [];
            $bracket_arr_open = [];
            $bracket_arr_close = [];
            $cn_close = 0;
            $cn_open = 0;
            $cn_all=0; //จำนวนวงเล็บทั้งหมด
            $c_op=0;
            $array  = str_split($equation);
            $count_eq = count($array)-1;
            $end_g = strrpos($equation,')');
            echo '<br>ตำแหน่งวงเล็บตัวสุดท้าย : >>>'.$end_g.'<<<';
            echo '<br>จำนวน index สุดท้ายคือ  : '.$count_eq;
            foreach ($array as $item){

                echo '<br>'.$item.'<br>';

                if ($item == $end_g) {

                    if (/*$item== ')'&&($item == '(')||*/
                        $item == ')') {
                        $n_close = strpos($equation, ')');
                        $n_open = strpos($equation, '(');
                        echo '<br>++!!!' . $n_close . '!!!!!++<br>';
                        echo '<br>$count_eq - $n_close = ' . ($count_eq - ($n_close + 1)) . ' หน่วย<br>';  //($n_close+1)   ที่+1เพราะต้องการหา operator หลังวงเล็บปิด
                        echo '<br>หรือ ' . $count_eq . '-' . ($n_close + 1) . '= ' . ($count_eq - ($n_close + 1)) . 'หน่วย<br>';
                        $value_deff = $count_eq - ($n_close + 1); //เราสามารถเอาค่า operator ตัวแรก ไปหา()สมการตัวถัดไปได้
                        //หาผลต่างหลังวงเล็บปิดเพื่อหาจำนวน ความยาว index ของ array ที่เหลือ *********
                        $test_deff = substr($equation, $n_close + 1, 1);
                        echo 'ผลจากการลบ ได้อักษรดังนี้ = ' . $test_deff . ';<br>';
                        //$op1 = substr($equation,$n_close+1,$n_close); //ตัดส่วนหน้าขอ operator ออก
                        //echo '<br>op1 = '.$op1.'<br>';

                        $n3 = substr($equation, $n_open + 1, $n_close - 1);
                        $arr_n2 = str_split($n3);  //array start index[0]
                        $c_n2 = sizeof($arr_n2) - 1;  //นับเริ่ม จาก1
                        echo '<br>!!!' . $c_n2 . '???<br>';
                        $n2 = substr($equation, $c_n2 + 2, count($array));
                        //$n2 = substr($n1,0,$n_open-1);
                        //echo '<br>!!!'.$n2.'!!!!!';
                        // echo '!!!'.$n2.'!!!!!';
                        /*  if ($n2 == '+'||$n2 == '-'||$n2 == '*'||$n2 == '/'){
                              $op1 = $n2;
                              $op2 = strpos($item,$op1);
                             echo '<strong>>>>>>>'.$c_n2.'<<<<<<<</strong>';
                          }
                        */

                    }
                }
                //-----------------------  หาจำนวน วงเล็บปิด ')' ทั้งหมด ----------------
                if ($item == ')'){
                    $bracket_arr_close[] = $item;
                    $cn_close = $cn_close+1;
                    //ถ้าจะแสดงค่าให้แสดงนอก loop
                }
                //-----------------------  หาจำนวน วงเล็บเปิด '(' ทั้งหมด ----------------
                if ($item == '('){
                    $cn_open = $cn_open+1;
                    //ถ้าจะแสดงค่าให้แสดงนอก loop
                }
                //-----------------------  หาจำนวน operator ทั้งหมด ----------------
                if ($item == '+'||$item=='-'||$item=='*'||$item=='/'){
                    $op_array[] = $item;
                    $c_op = $c_op+1;


                    //ถ้าจะแสดงค่าให้แสดงนอก loop
                }


            }
            //-----------------------  หาจำนวน วงเล็บเปิด-ปิด '(,)' ทั้งหมด ----------------
            echo '<br>------------------------------------------------------------------------------------------------------- --------------------------------------<br>';

            echo '<br> ขนาดของ $op_array :'.count($op_array).'ตัว<br>';
            echo '<br>จำนวนวงเล็บปิดทั้งหมด : '.$cn_close.'ตัว<br>';
            echo '<br>จำนวนวงเล็บเปิดทั้งหมด : '.$cn_open.'ตัว<br>';
            echo '<br>จำนวน operator ทั้งหมด : '.$c_op.'ตัว<br>';
            echo '<strong style="color: red">ดังนั้นจำนวนตัว symbol ทั้งหมดจะ = operator+1 <br>สำหรับสมการนี้จะได้ symbol = '.($c_op+1).' ตัว</strong><br>';
            echo '<br>------------------------------------------------------------------------------------------------------- --------------------------------------<br>';

            // bracket = วงเล็บ
            if ($cn_open == $cn_open) {
                $cn_all = $cn_open+$cn_close;
                echo '<br>วงเล็บทั้งหมด' .$cn_all. 'ตัว<br>';
                foreach ($array as $item2) {
                    for ($i = 1; $i <= $cn_all; $i++) {
                     //   echo 'วงเล็บตัวที่' . $i . '<br>';

                        $n_close2 = strpos($equation, ')');
                        $n_open2 = strpos($equation, '(');
                     //   echo '<br>'.$n_open2.','.$n_close2.'<br>';
                      //  echo '<br><strong style="color: blue">'.$array[$n_close2].'</strong> <br>';
                        if ($item2== $array[$n_close2]){
                            $cut_b = substr($equation, $n_open2+1, $n_close2);
                           // $cut_close = substr($equation, $item2[$item2+1], 1);
                    //        echo '<br>สมการที่ตัด : '.$cut_b.'<br>';
                        }

                        //if ($item2==$n_close2&&$item2==$n_open2){

                       // }
                    }
                }
            }


          /*  echo '<br>------------------------------------------------------------------------------------------------------- --------------------------------------<br>';


            foreach ($array as $item3) {
              for ($k=1;$k<=count($equation);$k++) {
          */
                  /*if ($item3[$k-1] == '(') {
                      echo '<br>____'.$k.'____<br>';
                  }*/
                  /*if ($item3 == '('){
                      $cn_open = $cn_open+1;
                      substr($equation,$i-1,$i);
                      //ถ้าจะแสดงค่าให้แสดงนอก loop
                  }*/
                  // $op_all = '+'||'-'||'*'||'/';


                /*  $op_pass = strpos($equation, '+');//คือหาเครื่องหมาย + ตังแรกไง !!!!
                  $op_minus = strpos($equation, '-');//คือหาเครื่องหมาย - ตังแรกไง !!!!
                  $op_multi = strpos($equation, '*');//คือหาเครื่องหมาย * ตังแรกไง !!!!
                  $op_divide = strpos($equation, '/');//คือหาเครื่องหมาย / ตังแรกไง !!!!
                */
                  //กูมาผิดทางแล้ว!!!!!!
                 // if ($op==$item3[$k])
                /*  if ($item3 == '+') {
                      //$op_1 = strpos($equation, '+');
                      echo '<br><span style="color: green">opตัวแรก : ' . $op_pass . '</span> <br>';

                  } elseif ($item3 == '-') {
                      $op_1 = strpos($equation, '-');
                      echo '<br><span style="color: green">opตัวแรก : ' . $op_minus . '</span> <br>';

                  } elseif ($item3 == '*') {
                      $op_1 = strpos($equation, '*');
                      echo '<br><span style="color: green">opตัวแรก : ' . $op_multi . '</span> <br>';

                  } elseif ($item3 == '/') {
                      $op_1 = strpos($equation, '/');
                      echo '<br><span style="color: green">opตัวแรก : ' . $op_divide . '</span> <br>';
                  }


              }*/

                /*  $a = $equation;
                  $b1 = explode("(", $a) ;
                  echo count($b1);
                  for ($j = 0; $j < count($b1); $j++) {
                      echo "$b1[$j]<br>";
                  }*/
          //  }
         /*   for ($p=1; $p< sizeof($op_array); $p++){
                echo '<br>op'.[$p+1].'<br>';
            }*/


           /* for($i=0;$i<=$count;$i++){


                 echo substr($equation,$i-1,$i)."<br>";

             }*/
           //--------------------------------ลองเขียน loop ตัดวงเล็บ------------------------------------------



            //--------------------------------ลองเขียน loop ตัดวงเล็บ------------------------------------------
        }else {
            echo 'not found';
        }
    }
    //$find_ver = TaVariable::findOne(['ta_variable_name'=>]);

    ?>
    <?php
    echo '<br>------------------------------------------------------------------------------------------------------- --------------------------------------<br>';

    $symbol1='';
    $deff4=0;
    $oper4=0;
    $cut_start=0;
    $cut_start2=0;
    $cut_back=0;
    $cut_back2=0;
    $open_B4=0;
    $close_B4=0;
    $equation2 = $equation;
    $count_eq2 = $count_eq+1;
    foreach ($op_array as $value ) {
        echo '<br>op :' . $value . '<br>';

        $equation2 = substr($equation2,strlen($symbol1),$count_eq2);
        echo '<br>$equation2 คือ: '.$equation2.'<br>';
         foreach ($array as $item4) {

        if ($item4==$value){
        $oper4 = strpos($equation2, $item4);
       //  echo '<br>||||||'.$oper4.'|||||<br>';
        $deff4 = $count_eq2-$oper4;
        //  echo '<br>$count_eq-$oper4 = '.$deff4.'<br>';
        // echo '<br>หรือ '.$count_eq.'-'.$oper4 .' = '.$deff4.'<br>';
        // echo '<br>$deff4มีค่า = '.$deff4.'<br>';
        $cut_back = substr($equation2,$oper4,$deff4);
        // echo '<br>$cut_backมีค่า = '.$cut_back.'<br>';
        $close_B4 = strpos($cut_back, ')');
        // echo '<br>วงเล็บปิดตัวแรก มีค่า = '.$close_B4.'<br>';
        $cut_back2 = substr($cut_back,0,$close_B4);
        // echo '<br>$cut_back2มีค่า = '.$cut_back2.'<br>';
        //    echo '<br>***********************************************************<br>';

        $cut_start = substr($equation2,0,$oper4);
        // echo '<br>$cut_startมีค่า = '.$cut_start.'<br>';
        $open_B4 = strrpos($cut_start, '(');
        // echo '<br>วงเล็บเปิดตัวสุดท้าย มีค่า = '.$open_B4.'<br>';
        $cut_start2 = substr($cut_start,$open_B4+1,$oper4);
        // echo '<br>$cut_start2 มีค่า = '.$cut_start2.'<br>';

         }
         }
        $symbol1 = $cut_start2.$cut_back2;

        //  }
        echo '<br>||||||'.$oper4.'|||||<br>';
        echo '<br><strong style="color: #ad2bee">แยกสมการแล้ว ได้ = '.$symbol1.'</strong><br>';
        echo '<br>ขนาด $symbol1 :'.strlen($symbol1).'<br>';
    }
        echo '<br>***********************************************************<br>';


        echo '<br>$count_eq-$oper4 = '.$deff4.'<br>';
        echo '<br>หรือ '.$count_eq2.'-'.$oper4 .' = '.$deff4.'<br>';
        echo '<br>$deff4มีค่า = '.$deff4.'<br>';
        echo '<br>$cut_backมีค่า = '.$cut_back.'<br>';
        echo '<br>วงเล็บปิดตัวแรก มีค่า = '.$close_B4.'<br>';
        echo '<br>$cut_back2มีค่า = '.$cut_back2.'<br>';

        echo '<br>***********************************************************<br>';
        echo '<br>$cut_startมีค่า = '.$cut_start.'<br>';
        echo '<br>วงเล็บเปิดตัวสุดท้าย มีค่า = '.$open_B4.'<br>';
        echo '<br>$cut_start2 มีค่า = '.$cut_start2.'<br>';
        echo '<br>***********************************************************<br>';
?>


    <?php
    echo '<br>-----------------------------------วิธีการที่5-------------------------------------------------------------------- --------------------------------------<br>';

    $symbol5='';
    $deff5=0;
    $oper5=0;
    $opertor_main5 = 0;
    $cut_start51=0;
    $cut_start52=0;
    $cut_back51=0;
    $cut_back52=0;
    $open_B5=0;
    $close_B5=0;
    $count_eq5=$count_eq+1;
    $count_sym1=0;
    $count_sym2=0;
    $equation5 = $equation;
    $cn_all5 =$cn_all/2;
   /* echo '<br>$bracket_arr_close :'.count($bracket_arr_close).'<br>';
    echo '<br>$equation5 :'.$equation5.'<br>';
    echo '<br>$count_eq5 : '.$count_eq5.'<br>';
   */
        foreach ($bracket_arr_close as $value5) {

          foreach ($array as $item5) {
              if($item5==$value5){
                  echo  '<br>ตำแหน่งของวงเล็บปิด :'.strpos($equation5, $item5).'<br>';
              }
          }
                // $equation5 = substr($equation5,$count_sym1,$count_eq5);

                echo '<br>***********************************************************<br>';
            echo '<br>bracket OR ) :>>  ' . $value5 . '<<<br>';
                //if ($value5==')') {
                    $count_eq5;

                    if ($count_sym2==NULL ||$count_sym2==0){
                        $close_B5 = strpos($equation5, $value5); //เช็ควงเล็บ )
                        $cut_start51 = substr($equation5, $count_sym2, $close_B5+1);
                    }else{
                        $close_B5 = strpos($cut_start51, $value5); //เช็ควงเล็บ )
                        $cut_start51 = substr($equation5, $close_B5, $count_sym2);
                    }

                    echo '<br>$close_B5 : ' . $close_B5. '<br>';
                    echo '<br>$cut_start51 : ' . $cut_start51 . '<br>';


                    $count_sym1 = (int)strlen($cut_start51); //ที่-1 เพราะ หาขนาดของstring มันเริ่มต้นที่ 1 แต่เราต้องการค่าแบบarrayเลยต้องใส่-1
                    echo '<br>$count_sym1 (ขนาดของสมการตัวแรก): ' . $count_sym1 . '<br>';
                    $count_eq5 = $count_eq - (int)strlen($cut_start51);

                    echo '<br>$count_eq5 : '.$count_eq5.'<br>';
                    //$opertor_main5 = substr($equation5, $close_B5+1, 1);
                    //echo '<br>$opertor_main5 : ' . $opertor_main5 . '<br>';
                    //$close_B52 = substr($equation5, $count_sym1 + 2, $count_eq5);
                    //$cut_back51 = substr($equation,$count_eq5,$count_eq5);
                    // $open_B5 = strrpos($equation, '(');
                    // $cut_back51 = substr($equation5, $count_sym1+2, $close_B5 + 1);
                   // echo '<br>$cut_back51 : ' . $cut_back51 . '<br>';

                    //$count_sym2 = (int)strlen($cut_start51) +2;
                    $count_sym2 = $count_eq5;
              //  }
    }
   //

  /*

    echo '<br>strlen($cut_start51) : '.strlen($cut_start51).'<br>';


  */
   // echo '<br>$open_B5 : '.$open_B5.'<br>';
    ?>
    <?php
    echo '<br>-----------------------------------วิธีการที่6-------------------------------------------------------------------- --------------------------------------<br>';

    $cn_all6 = $cn_all/2;
    $cut_one=0;
    $LB1_open=0;
    $LB1_close=0;
    $count_cut=0;
    $count_cut2=0;
    $equation6 = $equation;
    //foreach ($cn_all as $item6) {

    for ($h=1;$h<= $cn_all6;$h++){
        //if ($item6 == '('){

        $equation6 = substr($equation6, $LB1_close+1, $count_eq-$count_cut);
          //  echo '<br>$item6 :'.$item6.'<br>';
         $LB1_open = strpos($equation6, '(');
          echo  '<br>ตำแหน่งของวงเล็บเปิด :'.$LB1_open.'<br>';
        //}
       // if ($item6 == ')'){
         //   echo '<br>$item6 :'.$item6.'<br>';
           $LB1_close = strpos($equation6, ')');
           echo  '<br>ตำแหน่งของวงเล็บปิด :'.$LB1_close.'<br>';

       $cut_one = substr($equation6, $LB1_open, $LB1_close+1);

        echo  '<br>$cut_one :'.$cut_one.'<br>';
        $count_cut = (int)strlen($cut_one)-1;
        echo  '<br>$count_cut :'.$count_cut.'<br>';
        //$count_cut2 = $count_eq-$count_cut;
        echo '<br>///////////////////////////////////////////////<br>';
       // }
    }
    ?>

    <?php
    echo '<br>-----------------------------------วิธีการที่7-------------------------------------------------------------------- --------------------------------------<br>';
    $a = $equation;
    $eq7_1_array = [];
    $op7_1_arr = [];
    $b = explode(")", $a);
    $cut_op_divide1='';
    $eq6_array = [];
    $index_op=0;
    $num_op_var1=0;
    $op_v1_point=0;
    $op_v2_point=0;
    $index_symbol2=' ';
    $index_symbol1=' ';
    $string_var1=' ';
    $string_var2=' ';
    $op_arr_point=[];
    $arr_cut_op_multi1=[];
    $arr_cut_op_divide1=[];
    $arr_cut_op_divide17=[];
    $var2_array = [];
    for($i=0;$i<count($b);$i++)
    {
        //echo "$b[$i]<br>";
        $c = explode("(", $b[$i]);
        for($j=0;$j<count($c);$j++){
            $eq6_array[] = $c[$j];
            echo "$c[$j]<br>";
        }
    }
    echo '<br>$eq6_array : '.count($eq6_array).'<br>';
    echo '<br>*******************************[ วิธีการที่7.1 ]*******************************<br>';
    foreach ($eq6_array as $value6){
        if ($value6!=NULL ||$value6!='') {
            $eq7_1_array[] = $value6;
            echo '<br>$eq6_array : ' . $value6 . '<br>';

        }
    }
    echo '<br>*********************************[ ใช่อยู่ๆๆ ]****************************************<br>';
    echo '<br>$eq7_1_array : '.count($eq7_1_array).'<br>';
    echo '<br>$eq7_1_array : '.(4%2).'<br>';
    for($e=0;$e<count($eq7_1_array);$e++)
    {
            echo "<br>".$eq7_1_array[$e].'['.$e.']'."<br>"; //แสดง index array และค่าใน array
        if ($eq7_1_array[$e]=='+'||$eq7_1_array[$e]=='-'||$eq7_1_array[$e]=='*'||$eq7_1_array[$e]=='/'){
            echo "<br> op : ".$e."<br>";
            $op7_1 = $eq7_1_array[$e];
            $op7_1_arr[] = $eq7_1_array[$e];
            $index_op = $e;
            echo '<br>*************************************************************************<br>';
            echo '<br>.count($op7_1_arr) : '.count($op7_1_arr).'<br>';
            echo '<br>.mod Operator : '.(count($op7_1_arr)%2).'<br>';
            if (count($op7_1_arr)%2==1) {
                echo '<br>index var1 :' . $eq7_1_array[$index_op - 1] . '<br>'; //นี่คือตัวที่อยู่ในวงเล็บ
                echo '<br>index var2 :' . $eq7_1_array[$index_op + 1] . '<br>'; //นี่คือตัวที่อยู่ในวงเล็บ
                $string_var1 = $eq7_1_array[$index_op - 1];
                $string_var2 = $eq7_1_array[$index_op + 1];
                $var1_array = str_split($string_var1);
                $var2_array = str_split($string_var2);
                echo '<br>count($var1_array) : ' . count($var1_array) . '<br>';
                echo '<br>count($var2_array) : ' . count($var2_array) . '<br>';
                //------------------------------- ตัด $var1_array--------------------------------------------------
                for($pv1=0;$pv1<count($var1_array);$pv1++) {
                    if ($var1_array[$pv1] == '+' || $var1_array[$pv1] == '-' || $var1_array[$pv1] == '*' || $var1_array[$pv1] == '/') {
                        // $op_v1_point = $pv1;
                        $var1_array[$pv1];
                        $op_v1_point = $pv1;
                        echo '<br>$op_v1_point : '.$op_v1_point.'<br>';
                        $num_op_var1 = $num_op_var1 + 1;
                        $op_arr_point[] = $pv1;
                    }
                }
                  echo '<br>$num_op_var1 : '.$num_op_var1.'<br>';
                echo '<br>$op_arr_point : '.count($op_arr_point).'<br>';
                for($i2=0;$i2<count($var1_array);$i2++) {
                    //echo "$b[$i]<br>";
                    //$cut_op_pass1 = explode("+", $string_var1);
                   // $cut_op_minus1 = explode("-", $string_var1);
                   // echo '<br>*************************************************************************<br>';
                    //$cut_op_divide1 = explode("/", $string_var1);
                }
               /* for($e2=0;$e2<count($arr_cut_op_divide17);$e2++){
                    echo '<br>$arr_cut_op_divide17 : ' . $arr_cut_op_divide17[$e2]. '<br>';
                }*/

                echo '<br>***********************/////////////////////**************************<br>';

                    echo '<br>*************************************************************************<br>';

              //  foreach ($var1_array as $item_var1){
                  for($v1=0;$v1<count($op_arr_point);$v1++){ //หาจำนวน operator
                      //  if ($var1_array[$v1]=='+'||$var1_array[$v1]=='-'||$var1_array[$v1]=='*'||$var1_array[$v1]=='/') {

                            $index_symbol1 = substr($string_var1, 0,$op_arr_point[$v1]);

                            $index_symbol2 = substr($string_var1,(int)strlen($index_symbol1) + 1 , (int)strlen($index_symbol1) - (int)strlen($index_symbol2)); //$op_arr_point[$v1] - 1);

                            // echo '<br>$index_symbol1 :' . $var1_array[$v1-$op_v1_point]. '<br>';
                            echo '<br>*************************************************************************<br>';
                            echo '<br>$op_v1_pointt : '.$op_arr_point[$v1].'<br>';
                            echo '<br>$index_symbol1 :' . $index_symbol1 . '<br>';
                            echo '<br>$index_symbol2 :' . $index_symbol2 . '<br>';
                            echo '<br>ขนาด $index_symbol2 :' . strlen($index_symbol2) . '<br>';
                            echo '<br>*************************************************************************<br>';
                      }

                    //}
            //    }

            }elseif(count($op7_1_arr)%2==0){
                $string_var2 = $eq7_1_array[$index_op + 1];
                $var2_array = str_split($string_var2);
                echo '<br>index var2 :' . $eq7_1_array[$index_op + 1] . '<br>'; //นี่คือตัวที่อยู่ในวงเล็บ
            }
            echo '<br>*************************************************************************<br>';
        }
    }
    /*for($i=0;$i<count($b);$i++)
                  {
                      //echo "$b[$i]<br>";
                      $c = explode("(", $b[$i]); //********** สำคัญ
                      for($j=0;$j<count($c);$j++){
                          $eq6_array[] = $c[$j];
                          echo "$c[$j]<br>";
                      }
                  }*/
   //---------------------------------------Start function ตัด symbol1 -------------------------------------------------------- --------------------------------------<br>'
    $arr_cut_op_minus1=[];
    $arr_cut_op_pass1=[];
    $arr_cut_bb_open=[];
    $arr_cut_bb_close=[];
    $cut_op_multi1 = explode("*", $string_var1);//ตัดเฉพาะคูณ
    for($m=0;$m<count($cut_op_multi1);$m++){
        $arr_cut_op_multi1[] = $cut_op_multi1[$m];
        echo '<br> $arr_cut_op_multi1 :'.$cut_op_multi1[$m].'<br>';
        $cut_op_divide1 = explode("/", $cut_op_multi1[$m]);

        for($d=0;$d<count($cut_op_divide1);$d++) {
            echo '<br>********|||||||*******||||||*********||||||||********<br>';

            $arr_cut_op_divide1[] = $cut_op_divide1[$d];
            echo '<br> <span style="color: red">$cut_op_divide1 :' . $cut_op_divide1[$d] . '</span> <br>';

            $cut_op_pass1 = explode("+", $cut_op_divide1[$d]);
            for($p=0;$p<count($cut_op_pass1);$p++) {
                echo '<br>********|||||||*******||||||*********||||||||********<br>';

                $arr_cut_op_pass1[] = $cut_op_pass1[$p];
                echo '<br> <span style="color: #660e7a">$cut_op_pass1 :' . $cut_op_pass1[$p] . '</span> <br>';

                $cut_op_minus1 = explode("-", $cut_op_pass1[$p]);
                for($n=0;$n<count($cut_op_minus1);$n++) {
                    echo '<br>********|||||||*******||||||*********||||||||********<br>';

                    $arr_cut_op_minus1[] = $cut_op_minus1[$n];
                    echo '<br> <span style="color: limegreen">$cut_op_minus1 :' . $cut_op_minus1[$n] . '</span> <br>';
                }
            }
        }
    }
    echo '<br> <span style="color: #0f74a8">count ของ $arr_cut_op_divide1 : '.count($arr_cut_op_divide1).'</span> <br>';

    foreach ($arr_cut_op_minus1 as $arr_cut_op_minus1_item) {
        echo '<br>***********************/////////////////////**************************<br>';

        // if ($arr_cut_op_divide1_item != NULL || $arr_cut_op_divide1_item != '') {
        // $arr_cut_op_divide17[] = $arr_cut_op_divide1_item;
        echo '<br>symbol cutttttttt : ' . $arr_cut_op_minus1_item . '<br>';  // Symbol ครึ่งแรก ที่ได้ ที่ตัด opereator แล้ว
        $cut_bb_open = explode("{", $arr_cut_op_minus1_item);
        for($n=0;$n<count($cut_bb_open);$n++) {

            $arr_cut_bb_open[] = $cut_bb_open[$n];
            echo '<br> <span style="color: #ff8800">$cut_bb_open :' . $cut_bb_open[$n] . '</span> <br>';
            $cut_bb_close = explode("}", $cut_bb_open[$n]);
            for($nc=0;$nc<count($cut_bb_close);$nc++) {

                $arr_cut_bb_close[] = $cut_bb_close[$nc];
                echo '<br> <span style="color: #ff8800">$cut_bb_close :' . $cut_bb_close[$nc] . '</span> <br>';
            }
        }
    }
    echo '<br><span style="color: deeppink">***********************/////////////////////**************************</span> <br>';

    foreach ($arr_cut_bb_close as $arr_cut_bb_close_item) {
    if ($arr_cut_bb_close_item!=NULL ||$arr_cut_bb_close_item!='') {
         $find_symbol1 = TaVariable::findOne(['ta_variable_name'=>$arr_cut_bb_close_item]);
        if (!empty($find_symbol1)) {
            echo '<br> <span style="color: deeppink">$arr_cut_bb_close_item :' . $arr_cut_bb_close_item . '</span> <br>';
            echo '<br> <span style="color: hotpink"> ค่า Variable:' .'-------------['. $find_symbol1->ta_variable_name . '] มีค่าเท่ากับ------------>' . $find_symbol1->ta_variable_value . '</span> <br>';
        }else{
            echo '<br> <span style="color: #0000cc">$arr_cut_bb_close_item :' . $arr_cut_bb_close_item . '</span> <br>';
        }
    }
    }
    echo '<br><span style="color: deeppink">***********************/////////////////////**************************</span> <br>';

    //--------------------------------------- END function ตัด symbol1 -------------------------------------------------------- --------------------------------------<br>'



    //------------------------------- ตัด $var1_array--------------------------------------------------
    for($pv1=0;$pv1<count($var2_array);$pv1++) {
        if ($var2_array[$pv1] == '+' || $var2_array[$pv1] == '-' || $var2_array[$pv1] == '*' || $var2_array[$pv1] == '/') {
            // $op_v1_point = $pv1;
            $var2_array[$pv1];
            $op_v2_point = $pv1;
            echo '<br>$op_v2_point : '.$op_v2_point.'<br>';
            $num_op_var1 = $num_op_var1 + 1;
            $op_arr_point[] = $pv1;
        }
    }
    echo '<br>$num_op_var1 : '.$num_op_var1.'<br>';
    echo '<br>$op_arr_point : '.count($op_arr_point).'<br>';
    for($i2=0;$i2<count($var2_array);$i2++) {
        //echo "$b[$i]<br>";
        //$cut_op_pass1 = explode("+", $string_var1);
        // $cut_op_minus1 = explode("-", $string_var1);
        // echo '<br>*************************************************************************<br>';
        //$cut_op_divide1 = explode("/", $string_var1);
    }
    /* for($e2=0;$e2<count($arr_cut_op_divide17);$e2++){
         echo '<br>$arr_cut_op_divide17 : ' . $arr_cut_op_divide17[$e2]. '<br>';
     }*/

    echo '<br>***********************/////////////////////**************************<br>';

    echo '<br>*************************************************************************<br>';

    //  foreach ($var1_array as $item_var1){
    for($v1=0;$v1<count($op_arr_point);$v1++){ //หาจำนวน operator
        //  if ($var1_array[$v1]=='+'||$var1_array[$v1]=='-'||$var1_array[$v1]=='*'||$var1_array[$v1]=='/') {

        $index_symbol1 = substr($string_var1, 0,$op_arr_point[$v1]);

        $index_symbol2 = substr($string_var1,(int)strlen($index_symbol1) + 1 , (int)strlen($index_symbol1) - (int)strlen($index_symbol2)); //$op_arr_point[$v1] - 1);

        // echo '<br>$index_symbol1 :' . $var1_array[$v1-$op_v1_point]. '<br>';
        echo '<br>*************************************************************************<br>';
        echo '<br>$op_v1_pointt : '.$op_arr_point[$v1].'<br>';
        echo '<br>$index_symbol1 :' . $index_symbol1 . '<br>';
        echo '<br>$index_symbol2 :' . $index_symbol2 . '<br>';
        echo '<br>ขนาด $index_symbol2 :' . strlen($index_symbol2) . '<br>';
        echo '<br>*************************************************************************<br>';
    }
    /*for($i=0;$i<count($b);$i++)
                  {
                      //echo "$b[$i]<br>";
                      $c = explode("(", $b[$i]); //********** สำคัญ
                      for($j=0;$j<count($c);$j++){
                          $eq6_array[] = $c[$j];
                          echo "$c[$j]<br>";
                      }
                  }*/
    //---------------------------------------Start function ตัด symbol1 -------------------------------------------------------- --------------------------------------<br>'
    $arr_cut_op_minus2=[];
    $arr_cut_op_pass2=[];
    $arr_cut_bb_open2=[];
    $arr_cut_bb_close2=[];
    $cut_op_multi2 = explode("*", $string_var2);//ตัดเฉพาะคูณ
    for($m=0;$m<count($cut_op_multi2);$m++){
        $arr_cut_op_multi1[] = $cut_op_multi2[$m];
        echo '<br> $arr_cut_op_multi1 :'.$cut_op_multi2[$m].'<br>';
        $cut_op_divide1 = explode("/", $cut_op_multi2[$m]);

        for($d=0;$d<count($cut_op_divide1);$d++) {
            echo '<br>********|||||||*******||||||*********||||||||********<br>';

            $arr_cut_op_divide1[] = $cut_op_divide1[$d];
            echo '<br> <span style="color: red">$cut_op_divide1 :' . $cut_op_divide1[$d] . '</span> <br>';

            $cut_op_pass1 = explode("+", $cut_op_divide1[$d]);
            for($p=0;$p<count($cut_op_pass1);$p++) {
                echo '<br>********|||||||*******||||||*********||||||||********<br>';

                $arr_cut_op_pass1[] = $cut_op_pass1[$p];
                echo '<br> <span style="color: #660e7a">$cut_op_pass1 :' . $cut_op_pass1[$p] . '</span> <br>';

                $cut_op_minus1 = explode("-", $cut_op_pass1[$p]);
                for($n=0;$n<count($cut_op_minus1);$n++) {
                    echo '<br>********|||||||*******||||||*********||||||||********<br>';

                    $arr_cut_op_minus1[] = $cut_op_minus1[$n];
                    echo '<br> <span style="color: limegreen">$cut_op_minus1 :' . $cut_op_minus1[$n] . '</span> <br>';
                }
            }
        }
    }
    echo '<br> <span style="color: #0f74a8">count ของ $arr_cut_op_divide1 : '.count($arr_cut_op_divide1).'</span> <br>';

    foreach ($arr_cut_op_minus1 as $arr_cut_op_minus1_item) {
        echo '<br>***********************/////////////////////**************************<br>';

        // if ($arr_cut_op_divide1_item != NULL || $arr_cut_op_divide1_item != '') {
        // $arr_cut_op_divide17[] = $arr_cut_op_divide1_item;
        echo '<br>symbol cutttttttt : ' . $arr_cut_op_minus1_item . '<br>';  // Symbol ครึ่งแรก ที่ได้ ที่ตัด opereator แล้ว
        $cut_bb_open2 = explode("{", $arr_cut_op_minus1_item);
        for($n=0;$n<count($cut_bb_open2);$n++) {

            $arr_cut_bb_open[] = $cut_bb_open2[$n];
            echo '<br> <span style="color: #ff8800">$cut_bb_open :' . $cut_bb_open2[$n] . '</span> <br>';
            $cut_bb_close2 = explode("}", $cut_bb_open2[$n]);
            for($nc=0;$nc<count($cut_bb_close2);$nc++) {

                $arr_cut_bb_close2[] = $cut_bb_close2[$nc];
                echo '<br> <span style="color: #ff8800">$cut_bb_close :' . $cut_bb_close2[$nc] . '</span> <br>';
            }
        }
    }
    echo '<br><span style="color: darkmagenta">***********************/////////////////////**************************</span> <br>';

    foreach ($arr_cut_bb_close2 as $arr_cut_bb_close_item2) {
        if ($arr_cut_bb_close_item2!=NULL ||$arr_cut_bb_close_item2!='') {
            $find_symbol1 = TaVariable::findOne(['ta_variable_name'=>$arr_cut_bb_close_item2]);
            if (!empty($find_symbol1)) {
                echo '<br> <span style="color: darkmagenta">$arr_cut_bb_close_item :' . $arr_cut_bb_close_item2 . '</span> <br>';
                echo '<br> <span style="color: #ad2bee"> ค่า Variable:' .'-------------['. $find_symbol1->ta_variable_name . '] มีค่าเท่ากับ------------>' . $find_symbol1->ta_variable_value . '</span> <br>';
            }else{
                echo '<br> <span style="color: #0000cc">$arr_cut_bb_close_item :' . $arr_cut_bb_close_item2 . '</span> <br>';
            }
        }
    }
    echo '<br><span style="color: #ad2bee">***********************/////////////////////**************************</span> <br>';

    //--------------------------------------- END function ตัด symbol2 -------------------------------------------------------- --------------------------------------<br>'


    ?>
    <?php
    echo '<br>------------------------------------------------------------------------------------------------------- --------------------------------------<br>'
    ?>
    <?php $form = ActiveForm::begin([//\yii\helpers\Url::current(),
            'class' => 'form-horizontal',
            'action' => ['estimate-payment-ta'],
            'method' => 'get', //['csrf' => false]
        ]); ?>
        <?php // $form->field($model, 'symbol_value') ?>
        <?=Html::input('number', 'symbol_value'/*, $t*/)?>
        <?= Html::submitButton('Precess', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>
        <?php

          $Calculate = TaCalculation::find()->where(['ta_rule_id' => $RuleApproach->ta_rule_approach_id])
              ->orderBy(['order'=>SORT_ASC])->all();  //rule_id = 2 คือติดภาระงาน
        $result= 0;
        $total = array();
       // $total_credit = 0;
        foreach ($Calculate as $calculate){   //ดึงเอาสูตรนี้ออกมา
            $cal_id =  $calculate->ta_calculate_id;
            $cal_symbol = $calculate->symbol;
            $status_symbol = $calculate->status_symbol;
        }
            if($status_symbol == TaCalculation::SYMBOL_MAIN_OR_ANSWER){ //
                $M_symbol = $cal_symbol.' = '; //ถ้าเป็น main ให้แสดง
                echo $M_symbol;
            }else{
                $N_symbol = $cal_symbol;   // ถ้าเป็น symbol ธรรมดา
                echo $N_symbol;


       //--------------------------------  คำนวณจาก Database  ---------------------------------------------

                $brackets = TaCalculation::find()->where(
                    ['ta_rule_id'=>$RuleApproach->ta_rule_approach_id,'status_symbol'=>TaCalculation::SYMBOL_PARENTHESES])->all();// หา symbol ที่เป็นวงเล็บทั้งหมด
                $count = count($brackets);    // นับจำนวนวงเล็บทั้งหมดของสูตรนี้
              //  for ($i=0; $i <= $count; $i++) {
                   /* foreach ($brackets as $bracket) {
                        $b_id = $bracket->ta_calculate_id;
                        $b_symbol = $bracket->symbol;
                        $b_order = $bracket->order;
                   */
                        $b_dff_order = 4;     // ค่าระยะห่างของ order ในวงเล็บ (ตัวแปร1  ตัวดำเนินการ ตัวแปร2)  -->ห่างกัน 4

                        $bracket_opens = TaCalculation::find()->where(['symbol' => '(','ta_rule_id' =>
                            $RuleApproach->ta_rule_approach_id,])->all();    // หาวงเล็บเปิดของสูตรนี้ทั้งหมด
                        foreach ($bracket_opens as $bracket_open) {
                            $b_open_order = $bracket_open->order;       //เก็บ order
                            $order_ver1 = $bracket_open->order + ($b_dff_order - 3);  //หา ลำดับ order ของตัวแปร1
                            $order_op1 = $bracket_open->order + ($b_dff_order - 2);   //หา ลำดับ order ของตัวดำเนินการ
                            $order_ver2 = $bracket_open->order + ($b_dff_order - 1);  //หา ลำดับ order ของตัวแปร2
                           //------------------------------------- หาตัวแปรและ operator----------------------------------------------------
                          //---------------------- หาตัว แปรที่1 ----------------------------------------------------
                            $ver1 = TaCalculation::findOne(['ta_rule_id' => $RuleApproach->ta_rule_approach_id,
                                'order' => $order_ver1, 'status_symbol' => TaCalculation::SYMBOL_VARIABLE]);

                            $ver1_value = $ver1->symbol_value;     // ตัวแปรที่1
                            //---------------------- หาตัว operator ----------------------------------------------------
                            $op1 = TaCalculation::findOne(['ta_rule_id' => $RuleApproach->ta_rule_approach_id,
                                'order' => $order_op1, 'status_symbol' => TaCalculation::SYMBOL_OPERATOR]);
                            $oper = $op1->symbol;
                            //---------------------- หาตัว แปรที่2 ----------------------------------------------------
                            $ver2 = TaCalculation::findOne(['ta_rule_id' => $RuleApproach->ta_rule_approach_id,
                                'order' => $order_ver2, 'status_symbol' => TaCalculation::SYMBOL_VARIABLE]);
                            $ver2_value = 9;   // อันนี้กำหนดเอง่ะ จริงๆตั้งรับค่าจาก หน่วยกิตมาจากดาต้าเบสอื่น

                            echo '<br>'.$order_ver1 . ' ' . $order_op1 . ' ' . $order_ver2.'<br>';
                            echo 'ค่า symbol='.$ver1->symbol;
                            echo $op1->symbol;

                            echo $ver2->symbol.'<br>';
                            $count2 = $count/2;     //-------------- ให้คำนวณในวงเล็บที่ละคู่  มีกี่คู่ก็คำนวณวนไป--------
                          for ($i=1; $i<$count2; $i++){
                              // foreach ($brackets as $value){
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
                            }  /*return $this->render('estimate-payment-ta', [
                                'result' => $result,
                                'total' => $total[$result],
                            ]);*/

                            $total[] = (float)$result; //---- เก็บค่าเป็น array เอาไว้กระทำต่อ

                             echo ' ผล = ' . $result;
                        }
                     }  // ปิด loop (ลง) $bracket_opens

                        $open_count = count($bracket_opens);  //  นับจำนวณวงเล็บเปิด
                //---------------------- หาวงเล็บปิด -----------------------------
                $bracket_closes = TaCalculation::find()->where(['symbol' => ')',
                    'ta_rule_id'=>$RuleApproach->ta_rule_approach_id])->all();

                foreach ($bracket_closes as $bracket_close) {
                    $b_close_order = $bracket_close->order;  // order ของวงเล็บปิด
                    $close_count = count($bracket_closes);     //นับจำนวณวงเล็บปิด
                    $order_after_close = $b_close_order+1;      // order หลังจากวงเล็บ ปิด คือหาตัว operator กลาง
                    $order_next_open = TaCalculation::find()->where(['symbol' => '(',
                        'ta_rule_id' => $RuleApproach->ta_rule_approach_id,'order'=>$order_after_close+1
                    ])->all();     // หาวงเล็บถัดไป
                    //----------------------------------------------------------------------------------------
                    if(!empty($order_next_open)){
                        echo '<br>order ='.$order_after_close.'<br>';   // แสดง operator กลาง
                        $opertor_main = TaCalculation::find()->where([
                                'ta_rule_id' => $RuleApproach->ta_rule_approach_id
                            ,'status_symbol'=>TaCalculation::SYMBOL_OPERATOR,
                            'order'=>$order_after_close])->all();   // ------- ค้นหา operator กลาง ------
                        $op_count = count($opertor_main);  // --------- นับจำนวณ operator กลาง -----------
                        //-------------------------- loop เอา operator กลาง ----------------------------
                        foreach ($opertor_main as $op_main){
                             $operator_m = $op_main->symbol;
                             echo '<br>operator final :'.$operator_m.'<br>';  //แสดงค่า operator กลาง

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

                        }echo '<br>ผลรวม ='.$total_credit;
                            }

                    }
                    }
                }



                //   echo '<br> จำนวน operator='.$op_count;
                        $bracket_result = $b_close_order - $b_open_order;
                //   echo 'จำนวนวงเล็บเปิด =' . $open_count . 'จำนวนวงเล็บปิด =' . $close_count . '<br>';

                    //    echo '<br>' . $count . '<br>';
                    //    echo 'ผลต่าง order :' . $bracket_result . '<br>';

            }
        ?>

    <?php
    echo '<br>------------------------------------------------------------------------------------------------------- --------------------------------------<br>'
    ?>



    <?php
    $obj = new Calculate();

    $obj_var = $obj->getSymbol('A');
    foreach ($obj_var as $ob){
        echo '<br>********************************[ TEST OBJ ]*****************************************<br>';
        echo '<br>$obj_name : '.$ob.'<br>';
        echo '<br>********************************[ TEST OBJ ]*****************************************<br>';
    }

    ?>



        <br>
        <?php   //การแสดงค่าที่ได้จาก text inputออกมา คำรสณหรือแสดงได้
       // $number_std = \Yii::$app->request->get('symbol_value');
       // echo $number_std/$L->symbol_value;
        ?>

        <br><br>
    <hr/>

    <!-- /panel content -->
</div>