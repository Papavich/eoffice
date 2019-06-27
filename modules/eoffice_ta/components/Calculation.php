<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 29/3/2561
 * Time: 17:06
 */

namespace app\modules\eoffice_ta\components;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegClass;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegLevel;
use app\modules\eoffice_ta\models\model_central\ViewStudentFull;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaStatus;
use app\modules\eoffice_ta\models\TaWorking;
use app\modules\eoffice_ta\models\TaVariable;
use app\modules\eoffice_ta\models\TaEquation;
use app\modules\eoffice_ta\models\TaTypeRule;
use app\modules\eoffice_ta\models\Kku30Subject;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
use app\modules\eoffice_ta\models\model_central\ViewPisSubjectSection;
use app\modules\eoffice_ta\models\model_central\ViewPisOpenSubject;
use yii\base\Component;

class Calculation extends Component
{
    /*get ใช้ในการอ่านค่าของตัวแปรหรือเรียกใช้งานเมธอดอื่นภายในคลาส
     และเมธอด set เป็นเมธอดสำหรับกำหนดค่าจากภายนอกคลาสให้กับตัวแปรผ่าน Property
     ดังนั้นการใช้ Property จะช่วยในเรื่องของความปลอดภัยและความยืดหยุ่นของ*/

    /*public คือ สามารถเรียกได้ทุกที่ ทั้งภายในและภายนอกคลาส
      private คือ สามารถเรียกได้เฉพาะในคลาส
      protected คือ สามารถเรียกได้เฉพาะในคลาส และคลาสที่ขยายคลาสนี้
    */

    public function setCalculate()
    {
        $stack = new \SplStack();
    }

    public function getOperator($op, $var1, $var2)
    {
        if (!empty($op)) {
            switch ($op) {
                case '+':
                    return $var1 + $var2;
                case '-':
                    return $var1 - $var2;
                case '*':
                    return $var1 * $var2;
                case '/':
                    return $var1 / $var2;
            }
        } else {
            return false;
        }

    }

    public function getSymbol($symbol)
    {
        if (!empty($symbol)) {

            $find_ver = TaVariable::findOne(['ta_variable_name' => $symbol]);
            //   $find_equation = TaEquation::find()->where([''])->all();
            return $find_ver;
        } else {
            return false;
        }

    }

    public function getQueryEquation()
    {
        $find_equations = TaEquation::find()
            ->where([
                'ta_type_rule_id' => TaTypeRule::TYPE_R_WORK_LOAD_ALL,
                'active_status' => '1'
            ])->all();
        foreach ($find_equations as $find_equation) {
            $equation = $find_equation->ta_equation_name;
            if (!empty($find_equations)) {
                return $equation;
            }else{
                return false;
            }
        }
    }
    public function setCutMiniSymbol($a)
    {
        $arr_cut_bb_close = [];
        foreach ($arr_cut_bb_close as $arr_cut_bb_close_item) {
            if ($arr_cut_bb_close_item != NULL || $arr_cut_bb_close_item != '') {
                $find_symbol1 = TaVariable::findOne(['ta_variable_name' => $arr_cut_bb_close_item]);
                if (!empty($find_symbol1)) {
                    echo '<br> <span style="color: deeppink">$arr_cut_bb_close_item :' . $arr_cut_bb_close_item . '</span> <br>';
                    echo '<br> <span style="color: hotpink"> ค่า Variable:' . $find_symbol1->ta_variable_name . '--->' . $find_symbol1->ta_variable_value . '</span> <br>';
                } else {
                    echo '<br> <span style="color: #0000cc">$arr_cut_bb_close_item :' . $arr_cut_bb_close_item . '</span> <br>';

                }
            }
        }
    }
    public function setCreditAll(){

        $find_equations = TaEquation::findOne([
            'ta_type_rule_id'=>TaTypeRule::TYPE_R_CREDIT ,'active_status'=>'1']);
        $equation = $find_equations->ta_equation_name;
        //$eq7_1_array = [];
        //$op7_1_arr = [];

        //$b = explode(")", $equation);
       /* $a = $this->getA($subj_id);
        $b = $this->getB($subj_id);
        $this->getSubject($subj_id);
*/

        return $find_equations->ta_equation_name;
    }

    public function setWorkLoadLab($subj_id=NULL){
        $find_equations = TaEquation::find()
            ->where(['ta_type_rule_id'=>TaTypeRule::TYPE_R_CREDIT_LAB ,'active_status'=>'1'])->all();
    }
    public function setPayment($subj_id=NULL){
        $find_equations = TaEquation::find()
            ->where(['ta_type_rule_id'=>TaTypeRule::TYPE_R_PAY_MAAX_All ,'active_status'=>'1'])->all();
    }
    public function setAmountTa($student_amount=NULL){
        $find_equations = TaEquation::find()
            ->where(['ta_type_rule_id'=>TaTypeRule::TYPE_R_NUMBER_OF_TA ,'active_status'=>'1'])->all();
    }

    public function setVariable($ver=NULL){
        $find_var = TaVariable::findOne(['ta_variable_name'=>$ver]);
        $ver_value = $find_var->ta_variable_value;
        if (!empty($find_var)) {
            if (!empty($ver_value)){
                //กรณีถ้าตัวแปรมีค่าคงที่
                return $ver_value;

            }else{ //กรณีตัวแปรไม่มีค่าคงที่
                if ($find_var=='A'){
                    return $ver; //ยังคิด return ไม่ออก
                }elseif ($find_var=='B'){
                    return $ver; //ยังคิด return ไม่ออก
                }elseif ($find_var=='C') {
                    return $ver; //ยังคิด return ไม่ออก
                }elseif ($find_var=='Wload') {
                    return $ver; //ยังคิด return ไม่ออก
                }elseif ($find_var=='C') {
                    return $ver; //ยังคิด return ไม่ออก
                }elseif ($find_var=='C') {
                    return $ver; //ยังคิด return ไม่ออก
                }
            }

            }else{
           // แสดงว่าเป็นตัวเลข
           $number = (float)is_numeric($ver);
        }
    }


    public function getCLab($subj){

    }
    public function getWLoad($subj){

    }
//------------------------------------------------------------------------------------------------------
    // calculates the result of an expression in infix notation
    /*
     *
     ฟังก์ชัน mathexp_to_rpn () แปลงนิพจน์ทางคณิตศาสตร์มาบันทึกย่อเช่น "3 + 2" เพื่อแสดงออกในการขัดเงาแบบย้อนกลับ
     สัญกรณ์ (RPN): "3 2 +" นี้จะง่ายต่อการคำนวณซึ่งจะทำ โดยฟังก์ชัน calculate_rpn () ความสำคัญในการดำเนินการและวงเล็บ
     ถูกนำเข้าบัญชี ไม่มีการตรวจสอบว่ามีอินพุทหรือไม่ นิพจน์ที่ถูกต้อง การแบ่งไม่แม่นยำมาก
    *
    */
    public function calculate($equation,$subject,$version,$term,$year,$StdEnroll) {
        //*************** รับ function String ของสมการ  ***************
        //$ta = NULL;
            return $this->CalculateRPN($this->MathEquationRPN($equation,$subject,$version,$term,$year,$StdEnroll,$this->Ta($ta=NULL)));
    }
    public function calculate2($equation,$subject,$version,$term,$year,$ta) {
        //*************** รับ function String ของสมการ  ***************
       // $ta = NULL;
        return $this->CalculateRPN($this->MathEquationRPN($equation,$subject,$version,$term,$year,$this->StdEnroll($StdEnroll=NULL),$ta));
    }

    public function calculate3($equation,$subject,$version,$term,$year,$StdEnroll) {
        //*************** รับ function String ของสมการ  ***************
        //$ta = NULL;
        return $this->CalculateRPN($this->MathEquationRPN($equation,$subject,$version,$term,$year,$StdEnroll,$this->Ta($ta=NULL)));
    }

    // calculates the result of an expression in reverse polish notation
    public function CalculateRPN($RPN_Equation) {
        // แปลงคำนวณแบบ stack
        $stack = array();
        foreach($RPN_Equation as $item) {

            if ($this->is_operator($item)) {
                if ($item == '+') {
                    $j = array_pop($stack);
                    $i = array_pop($stack);
                    array_push($stack, $i + $j);
                }
                if ($item == '-') {
                    $j = array_pop($stack);
                    $i = array_pop($stack);
                    array_push($stack, $i - $j);
                }
                if ($item == '*') {
                    $j = array_pop($stack);
                    $i = array_pop($stack);
                    array_push($stack, $i * $j);
                }
                if ($item == '/') {
                    $j = array_pop($stack);
                    $i = array_pop($stack);
                    if ($i!=0) {
                        array_push($stack, $i / $j);
                    }
                }
                if ($item == '%') {
                    $j = array_pop($stack);
                    $i = array_pop($stack);
                    if ($i!=0) {
                        array_push($stack, $i % $j);
                    }}
            } else {
                array_push($stack, $item);
            }
        }
        return $stack[0];
    }
    // converts infix notation to reverse polish notation
    public function MathEquationRPN($MathEQ,$subject,$version,$term,$year,$StdEnroll,$ta) { //ถ้ารับ พารมิเตอร์วิชาด้วยล่ะ

        $precedence = array( //ตัวเลขเหล่านี้คือค่าที่อยู่ใน stack
            Tokens::PAREN_LEFT => 0,  // '('
            Tokens::MINUS => 3, // '-'
            Tokens::PLUS => 3, // '+'
            Tokens::MULT => 6, // '*'
            Tokens::DIV => 6, // '/'
            Tokens::MOD => 6  // '%'
        );




        $i = 0;
        $final_stack = array();
        $operator_stack = array();
        while ($i < strlen($MathEQ)) {
            $char = $MathEQ{$i}; //$char ลำดับ symbol แต่ละตัว

            if ($this->is_number($char)) {

                $num = $this->ReadNumber($MathEQ, $i);

                array_push($final_stack, $num);
                $i += strlen($num);  //ความยาวของ $num
                continue;
            }

            if ($char == Variable::A){ //{CLec}
                $symbol =  $this->getA($subject,$version);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::a){ //a or Is_a
                $symbol =  $this->getIs_a();
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::B){
                $symbol = $this->getB($subject,$version);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::b){
                $symbol = $this->getBP();
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::c){ //{NGSc} 60
                $symbol =  $this->getNGSc();
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::C){ //{CLec}
                $symbol = $this->getCreditLec($subject,$version,$term,$year,$StdEnroll,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::d){ // d
                $symbol = $this->getPaymentBN($subject,$version,$term,$year,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::D){ //D
                $symbol =  $this->getIs_D();
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::e){ // d
                $symbol = $this->getPaymentBS($subject,$version,$term,$year,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::E){ //E
                $symbol =  $this->getIs_E();
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::G){ //{HLb}
                $symbol = $this->getGP();
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::h){ //h
                $symbol = $this->getIs_h($subject,$version,$term,$year,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::H){ //{HLb}
                $symbol = $this->getH();
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::j){ // j
                $symbol = $this->getIs_j($term,$year,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::J){ // J
                $symbol = $this->getPaymentGN($subject,$version,$term,$year,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::k){ // k
                $symbol = $this->getIs_k($term,$year,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::K){ // K
                $symbol = $this->getPaymentGS($subject,$version,$term,$year,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::l){ //{NGSl} 30
                $symbol =  $this->getNGSl();
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }

            if ($char == Variable::L){ //{CLab}
                $symbol = $this->getCreditLab($subject,$version,$term,$year,$StdEnroll,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::n){ //n
                $symbol = $this->getIs_n();
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::N){ //{HCb}
                $symbol =  $this->getN($StdEnroll);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::P){ //กรอบ
                $symbol =  $this->getEstimatePaymentMaxALL($subject,$version,$term,$year,$StdEnroll,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::r){ //r
                $symbol = $this->getIs_r($subject,$version,$term,$year,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::R){ //{NGSl} 50 สัดส่วนผู้ช่วยสอนของบัณฑิตศึกษา
                $symbol =  $this->getR();
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::s){ //s
                $symbol =  $this->getIs_s();
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }

            if ($char == Variable::T){ //{NGSl} 50
                $symbol =  $this->getT();
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::V ){ //{HCb}
                $symbol =  $this->getH_Lab();
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::W){ //WORKLOAD ALL
                $symbol =  $this->getWorkLoadAll($subject,$version,$term,$year,$StdEnroll,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::x){ //t
                $symbol =  $this->getIs_x();
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::X){ //X  or CreditAll
                $symbol = $this->getCreditAll($subject,$version,$term,$year,$StdEnroll,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::y){ //WORKLOAD Lec
                $symbol =  $this->getWorkLoadLec($subject,$version,$term,$year,$StdEnroll,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::Y){ //ES Lec
                $symbol =  $this->getEstimatePaymentMaxLec($subject,$version,$term,$year,$StdEnroll,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::z){ //WORKLOAD LAB
                $symbol =  $this->getWorkLoadLab($subject,$version,$term,$year,$StdEnroll,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }
            if ($char == Variable::Z){ //ES LAB
                $symbol =  $this->getEstimatePaymentMaxLab($subject,$version,$term,$year,$StdEnroll,$ta);
                array_push($final_stack, $symbol);
                $i += strlen($char);
                continue;
            }

            if ($this->is_operator($char)) {
                $top = end($operator_stack);
                if ($top && $precedence[$char] <= $precedence[$top]) {
                    $oper = array_pop($operator_stack);
                    array_push($final_stack, $oper);
                }
                array_push($operator_stack, $char);
                $i++; continue;
            }
            if ($char === Tokens::PAREN_LEFT) { // '('
                array_push($operator_stack, $char);
                $i++; continue;
            }
            if ($char === Tokens::PAREN_RIGHT) {  // ')'
                // transfer operators to final stack
                do {
                    $operator = array_pop($operator_stack);
                    if ($operator == Tokens::PAREN_LEFT )
                        break; // '('
                    array_push($final_stack, $operator);
                } while ($operator);
                $i++; continue;
            }
            $i++;
        }
        while ($oper = array_pop($operator_stack)) {
            array_push($final_stack, $oper);
        }
        return $final_stack;
    }



    public function ReadNumber($string, $i) {
        $number = '';
        while ($this->is_number($string{$i})) {
            $number .= $string{$i};  //เชื่อมข้อความ $number ต่อท้าย $string
            $i++;
        }
        return $number;
    }

    public function is_operator($char) {
        static $operators = array(
            Tokens::PLUS, Tokens::MINUS, Tokens::DIV, Tokens::MULT, Tokens::MOD);
        return in_array($char, $operators);
    }

    public function is_number($char) {// FLOAT_POINT คือ .
            return (($char == Tokens::FLOAT_POINT) || ($char >= '0' && $char <= '9'));
    }
    public function is_variable($char) {
        return (($char == Variable::X) || ($char == Variable::A)
        ||($char == Variable::B) ||($char == Variable::WLoad) ||($char == Variable::HCb)
        ||($char == Variable::HLb) ||($char == Variable::NGSl) ||($char == Variable::CLec) ||($char == Variable::NRS)
        ||($char == Variable::NGSc) ||($char == Variable::Nsec) ||($char == Variable::P) ||($char == Variable::RB)
        ||($char == Variable::RG) ||($char == Variable::BP)||($char == Variable::GP)||($char == Variable::PHrn)
            ||($char == Variable::PHrs) ||($char == Variable::BN) ||($char == Variable::Hweek)
            ||($char == Variable::Nsec)||($char == Variable::hrD) ||($char == Variable::CLab)  );

    }
    public function getSubject($subj_id) {
        if (!empty($subj_id)){
            return $subj_id;
        }else{
            return false;
        }
    }
    public function getIs_a(){ //a
        $a = TaVariable::findOne(['ta_variable_name'=>'a','status'=>'fix']);
        return  $a->ta_variable_value;
    }
    public function getBP(){ //b เงิน ป.ตรี
        $R = TaVariable::findOne(['ta_variable_name'=>'b','status'=>'fix']);
        return  $R->ta_variable_value;
    }
    public function getNGSc(){ //c
        $c = TaVariable::findOne(['ta_variable_name'=>'c','status'=>'fix']);
        return  $c->ta_variable_value;
    }
    public function getIs_D(){ //D
        $D = TaVariable::findOne(['ta_variable_name'=>'D','status'=>'fix']);
        return  $D->ta_variable_value;
    }
    public function getIs_E(){ //E
        $E = TaVariable::findOne(['ta_variable_name'=>'E','status'=>'fix']);
        return  $E->ta_variable_value;
    }
    public function getGP(){ //G เงิน ป.โท+เอก ปก
        $G = TaVariable::findOne(['ta_variable_name'=>'G','status'=>'fix']);
        return  $G->ta_variable_value;
    }
    public function getH(){ //H
        $H = TaVariable::findOne(['ta_variable_name'=>'H','status'=>'fix']);
        return  $H->ta_variable_value;
    }
    public function getNGSl(){ //l
        $l = TaVariable::findOne(['ta_variable_name'=>'l','status'=>'fix']);
        return  $l->ta_variable_value;
    }
    public function getIs_n(){ //n
        $n = TaVariable::findOne(['ta_variable_name'=>'n','status'=>'fix']);
        return  $n->ta_variable_value;
    }
    public function getH_Lab(){ //V
        $V = TaVariable::findOne(['ta_variable_name'=>'V','status'=>'fix']);
        return  $V->ta_variable_value;
    }
    public function getIs_s(){ //s
        $s = TaVariable::findOne(['ta_variable_name'=>'s','status'=>'fix']);
        return  $s->ta_variable_value;
    }
    public function getIs_x(){ //s
        $x = TaVariable::findOne(['ta_variable_name'=>'x','status'=>'fix']);
        return  $x->ta_variable_value;
    }
    public function getT(){ //T
        $T = TaVariable::findOne(['ta_variable_name'=>'T','status'=>'fix']);
        return  $T->ta_variable_value;
    }
    public function getR(){ //R
        $R = TaVariable::findOne(['ta_variable_name'=>'R','status'=>'fix']);
        return  $R->ta_variable_value;
    }


    public function getA($subject,$version){ //A
        $find =  EofficeCentralRegCourse::findOne(['COURSECODE'=>$subject,'REVISIONCODE'=>$version]);
        $credit = $find->COURSEUNIT; //$find->REVISIONCODE;
        //.....ตัด string ด้วย
        $A = substr($credit,3,1);
        return (float)$A;
    }
    public function getB($subject,$version){ //B
        $find =  EofficeCentralRegCourse::findOne(['COURSECODE'=>$subject,'REVISIONCODE'=>$version]);
        $credit = $find->COURSEUNIT;
        //.....ตัด string ด้วย
        $B = substr($credit, 5, 1);
        return (float)$B;
    }
    public function getC($subject,$version){ //C
        $find =  EofficeCentralRegCourse::findOne(['COURSECODE'=>$subject,'REVISIONCODE'=>$version]);
        $credit = $find->COURSEUNIT;
        //.....ตัด string ด้วย
        $C = substr($credit,7,1);
        return (float)$C;
    }

    public function getN($StdEnroll){ //N
        $N = $StdEnroll;
        return $N;
    }

    public function getIs_j($term,$year,$ta){ //j รายวิชาที่เป็น TA ภาคปกติ
        $ta_Lv[] = 0;
        $j = 0;
        $Regis = TaRegister::find()->where(['person_id'=>$ta,'term'=>$term,'year'=>$year,
            'ta_status_id'=>TaStatus::CHOOSE_TA
        ])->all();
        foreach ($Regis as $regis) {
            $Secs1 = ViewPisSubjectSection::find()->select(
                ['COURSECODE'])->distinct()->where([
                'COURSECODE'=>$regis->subject_id,
                'REVISIONCODE'=>$regis->subject_version,
                'SEMESTER'=>$regis->term,
                'ACADYEAR'=>$regis->year,
                'LEVELID'=>31])->all();
            foreach ($Secs1 as $value) {
                $RegisSecs = TaRegisterSection::find()->select(
                    ['subject_id'])->distinct()->where([
                    'section' =>'0'.$value->SECTION,
                    'person_id' => $ta, 'subject_id' => $value->COURSECODE,
                    'subject_version' => $value->REVISIONCODE,
                    'term' => $value->SEMESTER, 'year' => $value->ACADYEAR,
                    'ta_status'=>TaStatus::CHOOSE_TA
                ])->all();
            }
            $ta_Lv[] = count($Secs1);
        }
        $j = array_sum($ta_Lv);
        return $j;
    }

    public function getIs_k($term,$year,$ta){ //j รายวิชาที่เป็น TA ภาคปกติ
        $ta_Lv[] = 0;
        $k = 0;
        $Regis = TaRegister::find()->where(['person_id'=>$ta,'term'=>$term,'year'=>$year,
            'ta_status_id'=>TaStatus::CHOOSE_TA
        ])->all();
        foreach ($Regis as $regis) {
            $Secs1 = ViewPisSubjectSection::find()->select(
                ['COURSECODE'])->distinct()->where([
                'COURSECODE'=>$regis->subject_id,
                'REVISIONCODE'=>$regis->subject_version,
                'SEMESTER'=>$regis->term,
                'ACADYEAR'=>$regis->year,
                'LEVELID'=>34])->all();
            foreach ($Secs1 as $value) {
                $RegisSecs = TaRegisterSection::find()->select(
                    ['subject_id'])->distinct()->where([
                    'section' =>'0'.$value->SECTION,
                    'person_id' => $ta, 'subject_id' => $value->COURSECODE,
                    'subject_version' => $value->REVISIONCODE,
                    'term' => $value->SEMESTER, 'year' => $value->ACADYEAR,
                    'ta_status'=>TaStatus::CHOOSE_TA
                ])->all();
            }
            $ta_Lv[] = count($Secs1);
        }
        $k = array_sum($ta_Lv);
        return $k;
    }

    public function getIs_h($subject,$version,$term,$year,$ta){ //h ชม.สอน ภาคปกติ
        $ta_hr[] = 0;
        $h = 0;
        $regis = TaRegister::findOne(['person_id'=>$ta,'term'=>$term,'year'=>$year,
            'ta_status_id'=>TaStatus::CHOOSE_TA
        ]);
       // foreach ($Regis as $regis) {
            $Secs1 = ViewPisSubjectSection::find()->where([
                'COURSECODE'=>$regis->subject_id,
                'REVISIONCODE'=>$regis->subject_version,
                'SEMESTER'=>$regis->term,
                'ACADYEAR'=>$regis->year,
                'LEVELID'=>31])->all();
            foreach ($Secs1 as $value) {
                $TaWorking1 = TaWorking::find()->where([
                    'section' => '0' . $value->SECTION,
                    'person_id' => $ta, 'subject_id' => $subject,
                    'subject_version' => $version,
                    'term_id' => $term, 'year_id' => $year,
                    'active_status' => TaWorking::STATUS_CONFIRM_Hr
                ])->all();
                foreach ($TaWorking1 as $record1) {
                    $ta_sec1 = substr($record1->section, 1, 2);
                    $subject1 = $record1->subject_id;
                    $ta_ver1 = $record1->subject_version;
                    $ta_term1 = $record1->term_id;
                    $ta_year1 = $record1->year_id;
                    $ta_typework = $record1->ta_type_work_id;

                    $ta_hr[] = $record1->hr_working;
                }
            }
        //}
        $h = array_sum($ta_hr);
        return $h;
    }

    public function getIs_r($subject,$version,$term,$year,$ta){ //h ชม.สอน ภาคปกติ
        $ta_hr[] = 0;
        $r = 0;
        $Secs1 = ViewPisSubjectSection::find()->where([
            'COURSECODE'=>$subject,
            'REVISIONCODE'=>$version,
            'SEMESTER'=>$term,
            'ACADYEAR'=>$year,
            'LEVELID'=>34])->all();
        foreach ($Secs1 as $value) {
            $TaWorking1 = TaWorking::find()->where([
                'section' =>'0'.$value->SECTION,
                'person_id' => $ta,
                'subject_id' =>$subject,
                'subject_version' => $version,
                'term_id' => $term, 'year_id' => $year,
                'active_status'=>TaWorking::STATUS_CONFIRM_Hr
            ])->all();
            foreach ($TaWorking1 as $record1) {
                $ta_sec1 = substr($record1->section, 1, 2);
                $subject1 = $record1->subject_id;
                $ta_ver1 = $record1->subject_version;
                $ta_term1 = $record1->term_id;
                $ta_year1 = $record1->year_id;
                $ta_typework = $record1->ta_type_work_id;

                $ta_hr[] = $record1->hr_working;
            }
        }
        $r = array_sum($ta_hr);
        return $r;
    }


    public function getCreditLec($subject,$version,$term,$year,$StdEnroll,$ta=NULL){ //C
        $find_equations = TaEquation::findOne(
            ['ta_type_rule_id'=>TaTypeRule::TYPE_R_CREDIT_LEC ,'active_status'=>'1']);
        return $this->calculate($find_equations->ta_equation_name,$subject,$version,$term,$year,$StdEnroll);

    }
    public function getCreditLab($subject,$version,$term,$year,$StdEnroll,$ta=NULL){ //L
        $find_equations = TaEquation::findOne(
            ['ta_type_rule_id'=>TaTypeRule::TYPE_R_CREDIT_LAB ,'active_status'=>'1']);
        return $this->calculate($find_equations->ta_equation_name,$subject,$version,$term,$year,$StdEnroll);
    }
    public function getCreditAll($subject,$version,$term,$year,$StdEnroll,$ta=NULL){ //X
        $find_equations = TaEquation::findOne(
            ['ta_type_rule_id'=>TaTypeRule::TYPE_R_CREDIT ,'active_status'=>'1']);
        return $this->calculate($find_equations->ta_equation_name,$subject,$version,$term,$year,$StdEnroll);
    }
    public function getWorkLoadAll($subject,$version,$term,$year,$StdEnroll,$ta=NULL){ //W
        $find_equations = TaEquation::findOne(
            ['ta_type_rule_id'=>TaTypeRule::TYPE_R_WORK_LOAD_ALL ,'active_status'=>'1']);
        return $this->calculate($find_equations->ta_equation_name,$subject,$version,$term,$year,$StdEnroll);
    }

    public function getWorkLoadLec($subject,$version,$term,$year,$StdEnroll,$ta=NULL){ //y
        $find_equations = TaEquation::findOne(
            ['ta_type_rule_id'=>TaTypeRule::TYPE_R_WORK_LOAD_Lec ,'active_status'=>'1']);
        return $this->calculate($find_equations->ta_equation_name,$subject,$version,$term,$year,$StdEnroll);
    }

    public function getWorkLoadLab($subject,$version,$term,$year,$StdEnroll,$ta=NULL){ //z
        $find_equations = TaEquation::findOne(
           ['ta_type_rule_id'=>TaTypeRule::TYPE_R_WORK_LOAD_Lab ,'active_status'=>'1']);
        return $this->calculate($find_equations->ta_equation_name,$subject,$version,$term,$year,$StdEnroll);
    }

    public function getEstimatePaymentMaxALL($subject,$version,$term,$year,$StdEnroll,$ta=NULL){ //P
        $find_equations = TaEquation::findOne(
            ['ta_type_rule_id'=>TaTypeRule::TYPE_R_PAY_MAAX_All ,'active_status'=>'1']);
        return $this->calculate($find_equations->ta_equation_name,$subject,$version,$term,$year,$StdEnroll);
    }
    public function getEstimatePaymentMaxLec($subject,$version,$term,$year,$StdEnroll,$ta=NULL){ //Y
        $find_equations = TaEquation::findOne(
            ['ta_type_rule_id'=>TaTypeRule::TYPE_R_PAY_MAAX_Lec ,'active_status'=>'1']);
        return $this->calculate($find_equations->ta_equation_name,$subject,$version,$term,$year,$StdEnroll);
    }
    public function getEstimatePaymentMaxLab($subject,$version,$term,$year,$StdEnroll,$ta=NULL){ //Z
        $find_equations = TaEquation::findOne(
            ['ta_type_rule_id'=>TaTypeRule::TYPE_R_PAY_MAAX_LAB ,'active_status'=>'1']);
        return $this->calculate($find_equations->ta_equation_name,$subject,$version,$term,$year,$StdEnroll);
    }


    public function getPaymentBN($subject,$version,$term,$year,$ta){ //d
        $find_equations = TaEquation::findOne(
            ['ta_type_rule_id'=>TaTypeRule::TYPE_R_PAY_BN ,'active_status'=>'1']);
        return $this->calculate2($find_equations->ta_equation_name,$subject,$version,$term,$year,$ta);
    }
    public function getPaymentBS($subject,$version,$term,$year,$ta){ //e
        $find_equations = TaEquation::findOne(
            ['ta_type_rule_id'=>TaTypeRule::TYPE_R_PAY_BS ,'active_status'=>'1']);
        return $this->calculate2($find_equations->ta_equation_name,$subject,$version,$term,$year,$ta);
    }

    public function getPaymentGN($subject,$version,$term,$year,$ta){ //J
        $find_equations = TaEquation::findOne(
            ['ta_type_rule_id'=>TaTypeRule::TYPE_R_PAY_GN ,'active_status'=>'1']);
        return $this->calculate2($find_equations->ta_equation_name,$subject,$version,$term,$year,$ta);
    }
    public function getPaymentGS($subject,$version,$term,$year,$ta){ //K
        $find_equations = TaEquation::findOne(
            ['ta_type_rule_id'=>TaTypeRule::TYPE_R_PAY_GS ,'active_status'=>'1']);
        return $this->calculate2($find_equations->ta_equation_name,$subject,$version,$term,$year,$ta);
    }


    public function getBalancePayMaxB($subject,$version,$term,$year,$StdEnroll){ //F เงินเหลือกรอบ ภาคปกติ
        $ta_Lv[] = 0;
        $k = 0;
        $Regis = TaRegister::find()->where(['subject_id'=>$subject,'subject_version'=>$version,'term'=>$term,'year'=>$year,
            'ta_status_id'=>TaStatus::CHOOSE_TA
        ])->all();
        foreach ($Regis as $regis) {
            $STDs =  ViewStudentFull::find()->where(['STUDENTID'=>$regis->person_id])
                ->andWhere(['<>','LEVELID', 31])
                ->andWhere(['<>','LEVELID',34])
                ->all();
            foreach ($STDs as $STD){

            $Secs1 = ViewPisSubjectSection::find()->select(
                ['COURSECODE'])->distinct()->where([
                'COURSECODE'=>$regis->subject_id,
                'REVISIONCODE'=>$regis->subject_version,
                'SEMESTER'=>$regis->term,
                'ACADYEAR'=>$regis->year,
                'LEVELID'=>34])->all();

            foreach ($Secs1 as $value) {


                $RegisSecs = TaRegisterSection::find()->select(
                    ['subject_id'])->distinct()->where([
                    'section' =>'0'.$value->SECTION,
                    'person_id' => $STD->STUDENTID,
                    'subject_id' => $value->COURSECODE,
                    'subject_version' => $value->REVISIONCODE,
                    'term' => $value->SEMESTER, 'year' => $value->ACADYEAR,
                    'ta_status'=>TaStatus::CHOOSE_TA
                ])->all();
            }
                $ta_Lv[] = count($Secs1);
            }

        }
        $k = array_sum($ta_Lv);
        return $k;
    }
    public function getBalancePayMaxS($subject,$version,$term,$year,$StdEnroll,$ta=NULL){ //F เงินเหลือกรอบ ภาคปกติ

    }


    public  function Ta($ta)
    {
        if (!empty($ta)){
            return $ta;
        }else{
            return $ta=NULL;
        }
    }
    public  function StdEnroll($StdEnroll)
    {
        if (!empty($StdEnroll)){
            return $StdEnroll;
        }else{
            return $StdEnroll=NULL;
        }
    }
}