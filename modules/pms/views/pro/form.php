<?php
use yii\widgets\ActiveForm;

?>

<?php
    $form = ActiveForm::begin();
?>
 <?=   $form->field($modelss,'project_name')->textInput();
?>

<button type="submit">add</button>

<?php
    ActiveForm::end();
?>
