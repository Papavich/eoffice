<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\web\Controller;
use app\modules\requestform\models\ReqTemplate;
use yii\web\NotFoundHttpException;


/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = 'ยื่นแบบฟอร์มใหม่';
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $this->registerJs("
    var i = 0; /* Set Global Variable i */
    var col = 'col-md-4 col-sm-4';
    var type = [];
    var typeUsePush = 0;

    function increment(){
        i += 1;
    }

    function setAttributes(el, attrs){
        for(var key in attrs){
            el.setAttribute(key, attrs[key]);
        }
    }

    var req_att = '$req_att';
    var obj = JSON.parse(req_att);
    console.log(obj);
    var len = Object.keys(obj).length;
    for (num = 0 ; num < len ; num++){
        if ((obj[num].box_type) == 'areabox'){
            areaFunction();
        }else if((obj[num].box_type) == 'txtbox'){
            txtFunction();
        }
    }

    function txtFunction(){
    increment();
    var a = document.createElement('div');
    var b = document.createElement('div');
    var c = document.createElement('div');
    var d = document.createElement('div');
    var y = document.createElement('INPUT');
    var x = document.createElement('INPUT');
    var z = document.createElement('INPUT');
    var box = document.createElement('INPUT');


    setAttributes(a,{'class':'row','id':'id_' + i});
    setAttributes(b,{'class':'col-md-4 col-sm-4'});
    setAttributes(c,{'class':'col-md-4 col-sm-4'});
    setAttributes(d,{'class':'col-md-4 col-sm-4'});
    //setAttributes(x,{'name':'ref_code[]','type':'text','class':'form-control','value':obj[num].ref_code,'disabled':''});
    setAttributes(y,{'name':'box_name[]','type':'text','class':'form-control','value':obj[num].box_name,'readonly' : true,'text-align' : 'center'});
    setAttributes(z,{'name':'box_value[]','type':'text','class':'form-control'});
    setAttributes(box,{'name':'box_type[]','type':'hidden','value':'txtbox'});

    //b.appendChild(x);
    c.appendChild(y);
    d.appendChild(z);

    //a.appendChild(b);
    a.appendChild(c);
    a.appendChild(d);
    a.appendChild(box);

    document.getElementById('myForm').appendChild(a);
    }

    ");
    ?>


    <div class="col-md-9 col-lg-9">
        <?php $form = ActiveForm::begin(['action' => 'get-input','id' => 'mainform', 'method' => 'post',]);?>


            <div id="myForm" class="form-group">

            </div>
            <?= Html::submitButton($value->isNewRecord ? 'เสร็จสิ้น' : 'Update', ['class' => $value->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
