<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\modules\eoffice_form\models\AttributeData;
use app\modules\eoffice_form\models\DesignAttribute;
use app\modules\eoffice_form\models\DesignSection;

$this->title = 'Preview : '.$model->template_name;
$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Template : '.$model->template_name, 'url' => ['req-template/view','id' => ''.$model->template_id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
                  <span class="title elipsis">
                    <strong><?= Html::encode($this->title) ?></strong>
                  </span>
        </div>
        <div class="panel-body">
            <div class="req-template-form">

                <?php
                /**
                 * Created by PhpStorm.
                 * User: nutta
                 * Date: 23/4/2561
                 * Time: 2:15
                 */



                $getDesignSection = DesignSection::find()->where(['template_id' => $model->template_id])->orderBy('design_section_order')->all();
                foreach ($getDesignSection as $item) {
                    $DesignSection[] = $item->design_section_id;
                    //echo '&nbsp;&nbsp;&nbsp;&nbsp'.'Design Section ID : '.$item->design_section_id.' -  Design Section Name : '.$item->sectionType->section_type_name.'</br>';

//                    if($item->sectionType->section_type_name == 'รายวิชา'){
//                        echo '<div class="row">';
//
//                        echo '<div class="col-lg-2">';
//
//                        echo '<label>รหัสวิชา</label>';
//                        echo "<input type='text' class='form-control' onKeyPress=\"if(this.value.length==6) return false;\" >";
//                        echo '</div>';
//
//                        echo '<div class="col-lg-4">';
//
//                        echo '<label>ชื่อวิชา</label>';
//                        echo "<input type='text' class='form-control'>";
//                        echo '</div>';
//
//
//                        echo '<div class="col-lg-2">';
//                        echo '<label>จำนวนหน่วยกิต</label>';
//                        echo "<input type='text' class='form-control'>";
//                        echo '</div>';
//
//                        echo '<div class="col-lg-2">';
//                        echo '<label>กลุ่ม</label>';
//                        echo "<input type='text' class='form-control'>";
//                        echo '</div>';
//
//                        echo '<div class="col-lg-2">';
//                        echo '<label>แบบการลงทะเบียน</label>';
//                        echo "<select type='text' class='form-control'>";
//                        echo "<option value='Credit'>Credit</option>";
//                        echo "<option value='Audit'>Audit</option>";
//                        echo "<option value='Visit'>Visit</option>";
//                        echo "</select>";
//                        echo '</div>';
//
//                        echo '</div>';
//
//                        echo '<div class="row">';
//
//                        echo '<div class="col-lg-2">';
//
//                        echo '<label>รหัสวิชา</label>';
//                        echo "<input type='text' class='form-control' onKeyPress=\"if(this.value.length==6) return false;\" >";
//                        echo '</div>';
//
//                        echo '<div class="col-lg-4">';
//
//                        echo '<label>ชื่อวิชา</label>';
//                        echo "<input type='text' class='form-control'>";
//                        echo '</div>';
//
//                        echo '<div class="col-lg-2">';
//                        echo '<label>จำนวนหน่วยกิต</label>';
//                        echo "<input type='text' class='form-control'>";
//                        echo '</div>';
//
//                        echo '<div class="col-lg-2">';
//                        echo '<label>กลุ่ม</label>';
//                        echo "<input type='text' class='form-control'>";
//                        echo '</div>';
//
//                        echo '<div class="col-lg-2">';
//                        echo '<label>แบบการลงทะเบียน</label>';
//                        echo "<select type='text' class='form-control'>";
//                        echo "<option value='Credit'>Credit</option>";
//                        echo "<option value='Audit'>Audit</option>";
//                        echo "<option value='Visit'>Visit</option>";
//                        echo "</select>";
//                        echo '</div>';
//
//                        echo '</div>';
//                        echo '<div class="row">';
//
//                        echo '<div class="col-lg-2">';
//
//                        echo '<label>รหัสวิชา</label>';
//                        echo "<input type='text' class='form-control' onKeyPress=\"if(this.value.length==6) return false;\" >";
//                        echo '</div>';
//
//                        echo '<div class="col-lg-4">';
//
//                        echo '<label>ชื่อวิชา</label>';
//                        echo "<input type='text' class='form-control'>";
//                        echo '</div>';
//
//                        echo '<div class="col-lg-2">';
//                        echo '<label>จำนวนหน่วยกิต</label>';
//                        echo "<input type='text' class='form-control'>";
//                        echo '</div>';
//
//                        echo '<div class="col-lg-2">';
//                        echo '<label>กลุ่ม</label>';
//                        echo "<input type='text' class='form-control'>";
//                        echo '</div>';
//
//                        echo '<div class="col-lg-2">';
//                        echo '<label>แบบการลงทะเบียน</label>';
//                        echo "<select type='text' class='form-control'>";
//                        echo "<option value='Credit'>Credit</option>";
//                        echo "<option value='Audit'>Audit</option>";
//                        echo "<option value='Visit'>Visit</option>";
//                        echo "</select>";
//                        echo '</div>';
//
//                        echo '</div>';
//                    }


                    $getDesignAttribute = DesignAttribute::find()->where(['design_section_id' => $item->design_section_id])->orderBy('attribute_order')->all();
                    foreach ($getDesignAttribute as $attribute) {
                        //echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp'.'Attribute ID : '.$attribute->attribute_ref.' -  Design Section Name : '.$attribute->attribute_name.'</br>';
                        switch ($attribute->attributeType->attribute_type_name) {
                            case "Textbox":
                                echo '<label>' . $attribute->attribute_name . '</label>';
                                echo "<input type='text' class='form-control'/>";
                                echo "</br>";
                                break;
                            case "Areabox":
                                echo "<label>" . $attribute->attribute_name . "</label>";
                                echo "<textarea type='text' class='form-control' rows=\"8\" />";
                                //echo "<input type='text'/>";
                                echo "</textarea>";
                                echo "</br>";
                                break;
                            case "Checkbox":
                                echo "<label>" . $attribute->attribute_name . "";
                                echo "</label>";
                                echo "</br>";echo "</br>";
                                //echo "<input type='checkbox' class='form-control'>";
                                $getAttributeList = AttributeData::find()->where(['attribute_ref' => $attribute->attribute_ref])->orderBy('attribute_order')->all();
                                foreach ($getAttributeList as $list) {
                                    //echo "</br>";
                                    echo "<label  class='checkbox'>";
                                    echo "<input type='checkbox' name='" . $attribute->attribute_ref . "' />" ;
                                    echo "<i></i> ". $list->attribute_data;
                                    echo "</label>";
                                    echo "</br>";
                                }
                                echo "</br>";
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
                                    echo "<input type='radio' name='" . $attribute->attribute_ref . "' />" ;
                                    echo "<i></i> ". $list->attribute_data;
                                    echo "</label>";
                                    echo "</br>";
                                }
                                echo "</br>";
                                break;
                            case "Selectbox":
                                echo "<label>" . $attribute->attribute_name . "</label>";
                                echo "<select  id='date' name='date'  class='form-control' style='text-align:'>";
                                $getAttributeList = AttributeData::find()->where(['attribute_ref' => $attribute->attribute_ref])->orderBy('attribute_order')->all();
                                foreach ($getAttributeList as $list) {
                                    echo '<option value="' . $list->attribute_data . '">' . $list->attribute_data . '</option>';
                                }
                                echo "</select>";
                                echo "</br>";
                                break;
                            case "Datepicker":
                                echo "<label>" . $attribute->attribute_name . "</label>";
                                echo "<input type='date' id='date' name='date' class='form-control datepicker'>";
                                echo "</br>";
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
                                echo "<input type=\"file\" class=\"form-control\" name=\"contact[attachment]\" onchange=\"jQuery(this).next('input').val(this.value);\" />";
                                echo "<input type=\"text\" class=\"form-control\" placeholder=\"no file selected\" readonly=\"\" />";
                                echo "<span class=\"button\">Choose File</span>";
                                echo "</br>";
                                break;

                            case "Picture":
                                echo "Picture";
                                break;
                        }
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>
