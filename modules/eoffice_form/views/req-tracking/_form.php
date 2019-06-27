<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\modules\eoffice_form\models\AttributeData;
use app\modules\eoffice_form\models\DesignAttribute;
use app\modules\eoffice_form\models\DesignSection;

//$this->title = 'Preview : '.$model->template_name;
//$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => 'Template : '.$model->template_name, 'url' => ['req-template/view','id' => ''.$model->template_id]];
//$this->params['breadcrumbs'][] = $this->title;

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
                <?php $form = ActiveForm::begin(['action' => 'show','id' => 'mainform', 'method' => 'post']); ?>
                <?php
                /**
                 * Created by PhpStorm.
                 * User: nutta
                 * Date: 23/4/2561
                 * Time: 2:15
                 */
                $session = Yii::$app->session;
                $getDesignSection = DesignSection::find()->where(['template_id' => $model->template_id ])->all();

                $i = 0;
                foreach ($getDesignSection as $item) {
                    $getDesignAttribute = DesignAttribute::find()->where(['design_section_id' => $item->design_section_id])->orderBy('attribute_order')->all();
                    foreach ($getDesignAttribute as $attribute) {

                        switch ($attribute->attributeType->attribute_type_name) {
                            case "Textbox":
                                echo '<label>' . $attribute->attribute_name . '</label>';
                                echo "<input type='text' class='form-control' value='";
                                echo $AllField[$i]['field_value'][0];
                                $i++;
                                echo "' disabled = 'disabled'/>";
                                echo "</br>";
                                break;
                            case "Areabox":
                                echo "<label>" . $attribute->attribute_name . "</label>";
                                echo "<textarea type='text' class='form-control' rows='8' ";
                                echo " disabled = 'disabled'/>";
                                echo $AllField[$i]['field_value'][0];
                                $i++;
                                echo "</textarea>";
                                echo "</br>";
                                break;
                            case "Checkbox":
                                echo "<label>" . $attribute->attribute_name . "";
                                echo "</label>";
                                echo "</br>";
                                echo "</br>";
                                $getAttributeList = AttributeData::find()->where(['attribute_ref' => $attribute->attribute_ref])->orderBy('attribute_order')->all();
                                $ListData = [];
                                foreach ($getAttributeList as $list){
                                    array_push($ListData,$list->attribute_data);
                                }
                                for($count = 0 ; $count < count($AllField[$i]['field_value']); $count++){
                                    for($listCount = 0 ; $listCount<count($ListData) ; $listCount++){
                                        if(count($AllField[$i]['field_value']) == 1){
                                            echo "<label  class='checkbox'>";
                                            echo "<input type='checkbox' disabled readonly checked='checked' name = $attribute->attribute_name[] value='$list->attribute_data'/>" ;
                                            echo "<i></i> ". $AllField[$i]['field_value'][0];
                                            echo "</label>";
                                            echo "</br>";
                                            break;
                                        }else if($AllField[$i]['field_value'][$count] == $ListData[$listCount]){
                                            echo "<label  class='checkbox'>";
                                            echo "<input type='checkbox' disabled readonly checked='checked' name = $attribute->attribute_name[] value='$list->attribute_data'/>" ;
                                            echo "<i></i> ". $ListData[$listCount];
                                            echo "</label>";
                                            echo "</br>";
                                            $count++;
                                        }else{
                                            echo "<label  class='checkbox'>";
                                            echo "<input type='checkbox' disabled readonly name = $attribute->attribute_name[] value='$list->attribute_data'/>" ;
                                            echo "<i></i> ". $ListData[$listCount];
                                            echo "</label>";
                                            echo "</br>";
                                        }
                                    }
                                }
                                echo "</br>";
                                $i++;
                                break;
                            case "Radiobox":
                                echo "<label  >" . $attribute->attribute_name . "";
                                echo "</label>";
                                echo "</br>";
                                echo "</br>";
                                $getAttributeList = AttributeData::find()->where(['attribute_ref' => $attribute->attribute_ref])->orderBy('attribute_order')->all();
                                $ListData = [];
                                foreach ($getAttributeList as $list){
                                    array_push($ListData,$list->attribute_data);
                                }
                                for($count = 0 ; $count < count($AllField[$i]['field_value']); $count++) {

                                    for ($listCount = 0; $listCount < count($ListData); $listCount++) {
                                        if (count($AllField[$i]['field_value']) == 1) {
                                            echo "<label  class='radio'>";
                                            echo "<input type='radio' disabled readonly checked='checked' name = $attribute->attribute_name[] value='$list->attribute_data'/>";
                                            echo "<i></i> " . $AllField[$i]['field_value'][0];
                                            echo "</label>";
                                            echo "</br>";
                                            break;
                                        }
                                    }
                                }
                                echo "</br>";
                                $i++;
                                break;
                            case "Selectbox":
                                $getAttributeList = AttributeData::find()->where(['attribute_ref' => $attribute->attribute_ref])->orderBy('attribute_order')->all();
                                foreach ($getAttributeList as $list) {
                                    if( $AllField[$i]['field_value'][0] == $list->attribute_data){
                                        echo 'I = '.$i;
                                        echo '<label>' . $attribute->attribute_name . '</label>';
                                        echo "<input type='text' class='form-control' value='";
                                        echo $AllField[$i]['field_value'][0];
                                        echo "' disabled = 'disabled'/>";
                                        echo "</br>";
                                        $i++;
                                    }
                                }
                                break;
                            case "Datepicker":
                                echo '<label>' . $attribute->attribute_name . '</label>';
                                echo "<input type='text' class='form-control' value='";
                                echo $AllField[$i]['field_value'][0];
                                echo "' disabled = 'disabled'/>";
                                echo "</br>";
                                $i++;
                                break;

                            case "File Upload":
                                echo '<label>' . $attribute->attribute_name . "</label>";
                                echo " <div class=\"fancy-file-upload fancy-file-success\">";
                                echo "<i class=\"fa fa-upload\"></i>";
                                echo "<input type=\"file\" class=\"form-control\" name=\"contact[attachment]\" onchange=\"jQuery(this).next('input').val(this.value);\" />";
                                echo "<input type=\"text\" class=\"form-control\" placeholder=\"no file selected\" readonly=\"\" />";
                                echo "<span class=\"button\">Choose File</span>";
                                echo "</br>";
                                $i++;
                                break;

                        }

                    }
                    //}
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
