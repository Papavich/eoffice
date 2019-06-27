<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = 'อนุมัติคำร้องใหม่';
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-create">
    <style>
        textarea {
            resize: none;
        }
    </style>
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
    
    var form_value = '$form_value';
    var objValue = JSON.parse(form_value);
    console.log(objValue);

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
    setAttributes(y,{'name':'box_name[]','type':'text','class':'form-control','value':obj[num].box_name,'readonly' : true});
    setAttributes(z,{'name':'box_value[]','type':'text','class':'form-control','value':objValue[num].box_value,'readonly' : true});
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

        <div id="mainform" class="form-group">
            <div id="myForm" class="form-group">

            </div>
        </div>

    </div>

    <div id="accept" class="form-group">

    </div>
<?php
    $this->registerJs("
    var i = 0; /* Set Global Variable i */
    var col = 'col-md-4 col-sm-4';
    var type = [];
    var typeUsePush = 0;

    function increment(){
    i += 1;
    }

    var AllConsider = '$AllConsider';
    var objValue = JSON.parse(AllConsider);
    console.log(objValue);
    
    var len = Object.keys(objValue).length;
    for (num = 0 ; num < len ; num++){
        testFunction();
    }
    

    
    
    function testFunction(){
    increment();
    var a = document.createElement('div');
    var b = document.createElement('div');
    var head = document.createElement('span')
        head.setAttribute('class','');
        head.textContent = \"ผู้พิจารณาลำดับที่ \"+i;
    var d = document.createElement('div');  
    var r1 = document.createElement('div'); 
    var r2 = document.createElement('div'); 
    var e = document.createElement('div'); 
    var f = document.createElement('div'); 
    var comment = document.createElement('TEXTAREA'); 
    
    
    var selectBox = document.createElement('select'); 

    setAttributes(a,{'class':'panel panel-default','id':'panel-2'});
    setAttributes(b,{'class':'panel-heading'});
    setAttributes(d,{'class':'panel-body'});
    setAttributes(r1,{'class':'row'});
    setAttributes(r2,{'class':'row'});
    setAttributes(comment,{'type':'text','class':'form-control','readonly' : true});
    comment.textContent = \"\"+objValue[num].comment;
    setAttributes(f,{'class':'col-md-8 col-sm-8'});
    setAttributes(e,{'class':'col-md-8 col-sm-8'});
    setAttributes(selectBox,{'class':'form-control','disabled' : 'disabled'});
    
    
    b.appendChild(head);
    a.appendChild(b);
    
    e.appendChild(selectBox);
    r1.appendChild(e);
    f.appendChild(comment);
    r2.appendChild(f);
    d.appendChild(r1);
    d.appendChild(r2);
    
    a.appendChild(d);
    
    document.getElementById('content').appendChild(a);
    }

    ");
    ?>