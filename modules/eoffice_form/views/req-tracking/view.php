<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\modules\eoffice_form\models\AttributeData;
use app\modules\eoffice_form\models\DesignAttribute;
use app\modules\eoffice_form\models\DesignSection;
use app\modules\eoffice_form\models\ReqApproval;
use app\modules\eoffice_form\models\ReqApproveGroup;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ReqTracking */

$this->title = $model->user->template->template_name;
$this->params['breadcrumbs'][] = ['label' => 'ติดตามคำร้อง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<h3><?= Html::encode($this->title) ?></h3>
<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
                  <span class="title elipsis">
                    <strong></strong>
                  </span>
        </div>
        <div class="panel-body">
            <div class="req-tracking-view">
                <p>

                    <?php if(($model->req_status) == 'ผ่านการพิจารณา'){ ?>

                        <?= Html::a('พิมพ์ใบคำร้อง', ['word-report', 'user_id' => $model->user_id, 'template_id' => $model->template_id, 'cr_date' => $model->cr_date, 'cr_term' => $model->cr_term, 'cr_year' => $model->cr_year], ['class' => 'btn btn-primary']) ?>

                    <?php } ?>

                    <?php if(($model->req_status) == 'กำลังดำเนินการ'){ ?>
                        <?= Html::a('ยกเลิกใบคำร้อง', ['canceled', 'user_id' => $model->user_id, 'template_id' => $model->template_id, 'cr_date' => $model->cr_date, 'cr_term' => $model->cr_term, 'cr_year' => $model->cr_year], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                            ],
                        ])?>


                    <?php  } ?>


                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'username.STUDENTCODE',
                        'user.template.template_name',
                        'cr_date',
                        'cr_term',
                        'cr_year',
                        'req_status',
                        'req_enddate',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>










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
                $session = Yii::$app->session;
                $getDesignSection = DesignSection::find()->where(['template_id' => $model->template_id ])->orderBy('design_section_order')->all();

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
                                echo "<label  >" . $attribute->attribute_name . "";
                                echo "</label>";
                                echo "</br>";
                                echo "</br>";
                                for ($listCount = 0; $listCount < count($AllField[$i]['field_value']); $listCount++) {
                                    echo "<label class='checkbox'>";
                                    echo "<input type='checkbox' disabled readonly checked='checkbox' name = $attribute->attribute_name[] />";
                                    echo "<i></i> " . $AllField[$i]['field_value'][$listCount];
                                    echo "</label>";
                                    echo "</br>";
                                }
                                echo "</br>";
                                $i++;
                                break;
                            case "Radiobox":
                                echo "<label  >" . $attribute->attribute_name . "";
                                echo "</label>";
                                echo "</br>";
                                echo "</br>";

                                echo "<label  class='radio'>";
                                echo "<input type='radio' disabled readonly checked='checked' name = $attribute->attribute_name[] />";
                                echo "<i></i> " . $AllField[$i]['field_value'][0];
                                echo "</label>";
                                echo "</br>";

                                echo "</br>";
                                $i++;
                                break;
                            case "Selectbox":
                                echo '<label>' . $attribute->attribute_name . '</label>';
                                echo "<input type='text' class='form-control' value='";
                                echo $AllField[$i]['field_value'][0];
                                echo "' disabled = 'disabled'/>";
                                echo "</br>";
                                $i++;
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

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>








<?php
    $getApprove = ReqApproval::find()->where([
            'user_id' => $user_id,
            'template_id' => $template_id,
            'cr_date' => $cr_date,
            'cr_term' => $cr_term,
            'cr_year' => $cr_year])
        ->andWhere(['<>','approve_status','กำลังดำเนินการ'])
        ->orderBy('approve_queue')
        ->all();
    foreach ($getApprove as $item){
//        echo $item->approve_status;
//        echo $item->approve_comment;
        echo '<div id="content" class="dashboard">';
        echo '<div id="panel-1" class="panel panel-primary">';
        echo '<div class="panel-heading">';
        echo '<span class="title elipsis">';
        echo '<strong>'.$item->approve_name.'</strong>';
        echo '</span>';
        echo '</div>';
        echo '<div class="panel-body">';

        echo '<label>การพิจารณา</label>';
        echo "<input type='text' class='form-control' value='";
        echo $item->approve_status;
        echo "' disabled = 'disabled'/>";
        echo "</br>";

        echo "<label>รายละเอียด</label>";
        echo "<textarea type='text' class='form-control' rows='8' ";
        echo " disabled = 'disabled'/>";
        echo $item->approve_comment;
        echo "</textarea>";

        echo '</div>';
        echo '</div>';
        echo '</div>';



    }



?>



