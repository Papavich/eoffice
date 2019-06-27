<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>
    <div align="center" >
        <br><br>
        <table border="1">

            <tr>
                <td align="center">
                    <img src="<?= Yii::$app->homeUrl ?>web_kku30/images/kku30_logo_black.png" alt="admin panel"/>
                    <br><br>
                    <h1>ระบบจัดการตารางเรียน มข.30</h1>
                    <h2>Class Scheduling Management</h2>
                </td>
            </tr>
        </table>
    </div>
<?php $form = ActiveForm::end(); ?>