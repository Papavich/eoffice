<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_consult\models\ConsultFaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FAQ';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php

$this->pageTitle = Yii::app()->name;
$model = ConsultTopic::model()->findAll(); // ดึงข้อมูล ทั้งหมด
// เลือก Field ที่ต้องการแสดง ตัวอย่าง id = ค่าที่เราจะเก็บในฐานข้อมูล , name = ชื่อที่แสดงใน dropDownList
$data = CHtml::listData($model,'consult_topic_id','consult_topic_name');
echo CHtml::label('Product List : ',null);
echo CHtml::dropDownList('product','',$data); // แสดง dropDownList
