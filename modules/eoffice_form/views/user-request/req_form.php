<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\modules\eoffice_form\models\AttributeData;
use app\modules\eoffice_form\models\DesignAttribute;
use app\modules\eoffice_form\models\DesignSection;
use app\modules\eoffice_form\models\ViewStudentFull;

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>

<h3><?= Html::encode($this->title) ?></h3>

<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>Request Form</strong>
                  </span>
        </div>
        <div class="panel-body">
            <div class="req-template-form">
                <?php $form = ActiveForm::begin(['action' => 'get-input','id' => 'mainform', 'method' => 'post']); ?>

                <?php
                $field_key = [];
                $getDesignSection = DesignSection::find()->where(['template_id' => $model->template_id])->orderBy('design_section_order')->all();
                foreach ($getDesignSection as $item) {
                    $DesignSection[] = $item->design_section_id;

                    $getDesignAttribute = DesignAttribute::find()->where(['design_section_id' => $item->design_section_id])->orderBy('attribute_order')->all();

                    foreach ($getDesignAttribute as $attribute) {

                        switch ($attribute->attributeType->attribute_type_name) {
                            case "Textbox":

                                if ($attribute->attributeFunction->attribute_function_name != 'ไม่ระบุ'){
                                    //echo getData($attribute->attributeFunction->attribute_function_name) ;
                                    echo '<label >' . $attribute->attribute_name . '</label>';
                                    echo "<input type='text' class='form-control' name = $attribute->attribute_name[] ";
                                    echo "value='". getData($attribute->attributeFunction->attribute_function_name)."'/>";
                                    echo "</br>";
                                }else{
                                    echo '<label >' . $attribute->attribute_name . '</label>';
                                    echo "<input type='text' class='form-control' name = $attribute->attribute_name[] />";
                                    //echo "<input type='hidden' name = 'field_key[]' value='". $attribute->attribute_name."'/>";
                                    echo "</br>";
                                }


                                array_push($field_key, $attribute->attribute_name);
                                break;
                            case "Areabox":
                                echo "<label>" . $attribute->attribute_name . "</label>";
                                echo "<textarea type='text' class='form-control' name = $attribute->attribute_name[] rows=\"8\" />";
                                //echo "<input type='text'/>";
                                echo "</textarea>";
                                echo "</br>";
                                array_push($field_key, $attribute->attribute_name);
                                break;
                            case "Checkbox":
                                $i = 0;
                                echo "<label>" . $attribute->attribute_name . "";
                                echo "</label>";
                                echo "</br>";echo "</br>";
                                //echo "<input type='checkbox' class='form-control'>";
                                $getAttributeList = AttributeData::find()->where(['attribute_ref' => $attribute->attribute_ref])->orderBy('attribute_order')->all();
                                foreach ($getAttributeList as $list) {
                                    $i++;
                                    //echo "</br>";
                                    echo "<label  class='checkbox'>";
                                    echo "<input type='checkbox' name = $attribute->attribute_name[] value='$list->attribute_data'/>" ;
                                    echo "<i></i> ". $list->attribute_data;
                                    echo "</label>";
                                    echo "</br>";
                                }
                                echo "</br>";
                                array_push($field_key, $attribute->attribute_name);
                                break;
                            case "Radiobox":
                                echo "<label  >" . $attribute->attribute_name . "";
                                echo "</label>";
                                echo "</br>";echo "</br>";
                                //echo "<input type='checkbox' class='form-control'>";
                                $getAttributeList = AttributeData::find()->where(['attribute_ref' => $attribute->attribute_ref])->orderBy('attribute_order')->all();

                                foreach ($getAttributeList as $list) {
                                    //echo "</br>";
                                    echo "<label  class='radio'>";
                                    echo "<input type='radio' name = $attribute->attribute_name[] value='". $list->attribute_data."'/>" ;
                                    echo "<i></i> ". $list->attribute_data;
                                    echo "</label>";
                                    echo "</br>";
                                }
                                echo "</br>";
                                array_push($field_key, $attribute->attribute_name);
                                break;
                            case "Selectbox":
                                echo "<label>" . $attribute->attribute_name . "</label>";
                                echo "<select  id='date' name = $attribute->attribute_name[]  class='form-control' style='text-align:'>";
                                $getAttributeList = AttributeData::find()->where(['attribute_ref' => $attribute->attribute_ref])->orderBy('attribute_order')->all();
                                foreach ($getAttributeList as $list) {
                                    echo '<option value="' . $list->attribute_data . '">' . $list->attribute_data . '</option>';
                                }
                                echo "</select>";
                                echo "</br>";
                                array_push($field_key, $attribute->attribute_name);
                                break;
                            case "Datepicker":
                                echo "<label>" . $attribute->attribute_name . "</label>";
                                echo "<input id='date' name = $attribute->attribute_name[]  class='form-control datepicker' data-format='dd-mm-yyyy'>";
                                echo "</br>";
                                array_push($field_key, $attribute->attribute_name);
                                break;
                            case "Paragraph":
                                echo "<p>";
                                echo str_replace("\n", "<br/>", $attribute->attribute_name);;
                                echo "</p>";
                                break;
                            case "File Upload":
                                echo '<label>' . $attribute->attribute_name . "</label>";
                                echo " <div class=\"fancy-file-upload fancy-file-success\">";
                                echo "<i class=\"fa fa-upload\"></i>";
                                echo "<input type=\"file\" class=\"form-control\" name = $attribute->attribute_name[] onchange=\"jQuery(this).next('input').val(this.value);\" />";
                                echo "<input type=\"text\" class=\"form-control\" placeholder=\"no file selected\" readonly=\"\" />";
                                echo "<span class=\"button\">Choose File</span>";
                                echo "</br>";
                                array_push($field_key, $attribute->attribute_name);
                                break;
                        }
                    }
                }
                $session = Yii::$app->session;
                $session['field_key'] = $field_key;

                function getData($function_name) {
                    $model = ViewStudentFull::find()->where(['STUDENTCODE' => Yii::$app->user->identity->username])->all();
                    foreach ($model as $item){
                    switch ($function_name) {
                        case "รหัสนักศึกษา":
                            return $item->STUDENTCODE;
                            break;
                        case "คำนำหน้า":
                            return $item->PREFIXNAME;
                            break;
                        case "ชื่อ(ภาษาไทย)":
                            return $item->STUDENTNAME;
                            break;
                        case "ชื่อ(ภาษาอังกฤษ)":
                            return $item->STUDENTNAMEENG;
                            break;
                        case "นามสกุล(ภาษาไทย)":
                            return $item->STUDENTSURNAME;
                            break;
                        case "นามสกุล(ภาษาอังกฤษ)":
                            return $item->STUDENTSURNAMEENG;
                            break;
                        case "ชั้นปี":
                            return $item->STUDENTYEAR;
                            break;
                        case "อีเมลล์":
                            return $item->STUDENTEMAIL;
                            break;
                        case "สาขาวิชา(ภาษาไทย)":
                            return $item->major_name;
                            break;
                        case "สาขาวิชา(ภาษาอังกฤษ)":
                            return $item->major_name_eng;
                            break;
                        case "คณะ(ภาษาไทย)":
                            return $item->FACULTYNAME;
                            break;
                        case "คณะ(ภาษาอังกฤษ)":
                            return $item->FACULTYNAMEENG;
                            break;
                        case "ภาควิชา(ภาษาไทย)":
                            return $item->DEPARTMENTNAME;
                            break;
                        case "ภาควิชา(ภาษาอังกฤษ)":
                            return $item->DEPARTMENTNAMEENG;
                            break;
                        case "ระดับการศึกษา(ภาษาอังกฤษ)":
                            return $item->LEVELNAMEENG;
                            break;
                        case "ระดับการศึกษา(ภาษาไทย)":
                            return $item->LEVELNAME;
                            break;
                        case "ชื่อปริญญา":
                            return $item->PROGRAMNAME;
                            break;
                        /*case "getTel":
                            return $item->STUDENTCODE;
                            break;*/
                        case "เกรด":
                            return $item->GPA;
                            break;
                        case "เพศ":
                            if($item->STUDENTSEX == 'M'){
                                return 'ชาย';
                            }elseif ($item->STUDENTSEX == 'F'){
                                return 'หญิง';
                            }
                            break;
                        case "บัตรประชาชน":
                            return $item->CITIZENID;
                            break;
                        case "ศาสนา(ภาษาไทย)":
                            return $item->RELIGIONNAME;
                            break;
                        case "ศาสนา(ภาษาอังกฤษ)":
                            return $item->RELIGIONNAMEENG;
                            break;
                        case "สัญชาติ":
                            return $item->NATIONNAME;
                            break;
                        case "ชื่อผู้ปกครอง":
                            return $item->PARENTNAME;
                            break;
                        case "ที่อยู่1":
                            return $item->HOMEADDRESS1;
                            break;
                        case "ที่อยู่2":
                            return $item->HOMEADDRESS2;
                            break;
                        case "อำเภอ":
                            return $item->HOMEDISTRICT;
                            break;
                        case "รหัสไปรษณีย์":
                            return $item->HOMEZIPCODE;
                            break;
                        case "เบอร์โทรศัพท์บ้าน":
                            return $item->HOMEPHONENO;
                            break;
                        case "วันที่ปัจจุบัน":
                            return date('Y-m-d');
                            break;
                    }
                    }
                }




                ?>

                <div class="form-group">
                    <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-check']) ?>
                </div>

                <?php ActiveForm::end(); ?>


            </div>
        </div>
    </div>
</div>
