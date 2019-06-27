<?php
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_consult\models\ConsultQa;
$data = [
    "red" => "red",
    "green" => "green",
    "blue" => "blue",
    "orange" => "orange",
    "white" => "white",
    "black" => "black",
    "purple" => "purple",
    "cyan" => "cyan",
    "teal" => "teal"
];?>




<?php $form = ActiveForm::begin(['action' => 'search']); ?>
<?php //$model->post_ans =  ['red', 'green']; // initial value

$tagging = [];
$long = '';
$query = ConsultQa::find()->select(['tag'])->all();
$i = 0;
foreach ($query as $item) {
  if($i == 0){
    $msg = $item->tag;
    $long = $long.''.$msg;
  }else{
    $msg = $item->tag;
    $long = $long.' '.$msg;
  }
$i++;
}

$tag = explode(' ', $long);
for($i = 0 ; $i < count($tag) ; $i++){
  $tagArray[''.$tag[$i]] = $tag[$i];
}


echo $form->field($model, 'post_ans')->widget(Select2::classname(), [
    'data' => $tagArray,
    'options' => ['placeholder' => 'Select ...', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
        'tokenSeparators' => [',', ' '],
        'maximumSelectionLength'=> 5,
        'minimumSelectionLength'=> 1,
        'maximumInputLength' => 15
    ],
])->label('ค้นหาตามคำสำคัญ'); ?>
<font color="red">ค้นหาได้ไม่เกิน 5 รายการ</font><br><br>
<?= Html::submitButton($model->isNewRecord ? 'ค้นหา' : 'Create', ['class' => $model->isNewRecord ? 'btn btn-green' : 'btn btn-green']) ?>


<?php ActiveForm::end(); ?>
