<?php
/* @var $this yii\web\View */

use yii\bootstrap\Tabs;
use yii\bootstrap\ActiveForm;
use app\modules\eoffice_eolmv2\controllers;

$this->title = controllers::t( 'label','Setting');
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $form = ActiveForm::begin(['id' => 'setting-form']); ?>
<?= Tabs::widget([
    'items' => [
        [
            'label' => controllers::t( 'label', 'signer'),
            'content' => $this->render('setting_signer', ['model1' => $model1,/*, 'form' => $form*/]),
            'options' => ['id' => 'tab1'],
            'active' => true
        ],
        [
            'label' => controllers::t( 'label', 'allowance'),
            'content' => $this->render('setting_allowance', ['model2' => $model2,/*, 'form' => $form*/]),
            'options' => ['id' => 'tab2'],
        ],
        [
            'label' => controllers::t( 'label', 'vehicle fee'),
            'content' => $this->render('setting_vehicle', ['model' =>$model/*, 'form' => $form*/]),
            'options' => ['id' => 'tab3'],
        ],
    ]]);


?>
