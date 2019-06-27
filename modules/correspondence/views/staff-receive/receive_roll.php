<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use  \app\modules\correspondence\models\CmsDocument;
use app\modules\correspondence\controllers;
use yii\widgets\LinkPager;
use \yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Html::encode($this->title) . controllers::t('menu', 'Received Roll');
$this->registerCss("
table tbody tr td a {
  display: block;
  width: 100%;
  color: black;
}
tr.hover {
  cursor: pointer;
}
a:hover{
  color: black;
}
");
?>
<section id="middle">
    <div id="content" class="padding-20">
        <div id="panel-1" class="panel panel-default">
            <div class="document-index">
                <div id="content" class="padding-20">
                    <div id="panel-1" class="panel panel-default">
                        <h1><?= Html::encode(controllers::t('menu', 'Received Roll')) ?></h1>
                        <?=$this->render('../search/search_form',['url' => 'search-receive?id=','searchData'=>  $searchData])?>
                    </div>
                    <!-- panel content -->
                    <div class="panel-body table-responsive" style="margin-top: 0px">
                        <div class="col-md-3 pull-right" style="margin: 15px;">
                            <!-- classic select2 -->
                            <select class="form-control" onchange="if (this.value) window.location=this.value">
                                <option value="">---  <?=controllers::t('menu','Change views')?>  ---</option>
                                <option value="receive-roll">
                                    <?=controllers::t('menu','Show document file receive books')?>
                                </option>
                                <option value="receive-roll-in-all-folder">
                                    <?=controllers::t('menu','Show book in received roll')?>
                                </option>
                            </select>
                        </div>
                        <?= GridView::widget([
                            'tableOptions' => [
                                'class' => 'table table-striped table-hover table-bordered',
                                'width' => '100%',
                                'cellspacing' => '0'
                            ],
                            'dataProvider' => $dataProvider,
                            'columns' => $gridColumns,
                        ]); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- /MIDDLE -->
<!-- PAGE LEVEL SCRIPTS -->

<script>
    var pass_id;

    function myFunction() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function redirectDeleteRoll(id) {
        pass_id = id;

    }

</script>
<?php
/** @var TYPE_NAME $docid */
$this->registerJs(<<<JS
    $("#w1-container div").css('width','450px');
    $("#w1-container").css('float','right');
    $('.pagination').addClass('pull-right');
    $('.summary').detach();
    $('#example').DataTable();
    $("#searchByType").hide();
        $('input[type=radio]').change(function () {
            if (this.value == 'searchByType') {
                $("#searchByType").show();
                //$("#nameForSearch").hide()
            } else {
                $("#nameForSearch").show();
                $("#searchByType").hide();
            }
        });
        $("input[name='listmails[]']:checked").each(function () {
            if (this.value == 'searchByType') {
                $("#searchByType").show();
                //$("#nameForSearch").hide()
            }
        });        
        function test123(id){
            console.log(id);           
        }
        $(".confirmDeleteRoll").click(function(){
            swal({
                    title: "ท่านต้องการลบหนังสือใช่หรือไม่?",
                    text: "ท่านไม่สามารถกู้คืนข้อความของท่านได้หากยกเลิก",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ใช่ ฉันต้องการลบ",
                    cancelButtonText: "ไม่ ฉันไม่ต้องการลบ",
                    closeOnConfirm: false                   
                },
                function(){                
                         $.ajax({
                            url    : 'delete-receive',
                            type   : 'GET',                            
                            data   : {
                                'id' : pass_id
                            },
                            async: true,
                            beforeSend: function () {
                               // console.log(pass_id);   
                            swal({
                              title: 'กรุณารอสักครู่..',
                              text: "",
                              width: 600,
                              padding: 100,
                              showConfirmButton: false,
                              showLoaderOnConfirm: true,
                              imageUrl: '../../../@web/../modules/correspondence/style//images/Preloader_1.gif'
                            })                               
                            },
                            complete: function () {
                               // $("#loading").removeClass("se-pre-con");
                                window.location.reload();
                            }
                        });                         
                    
                });
        });
                
        $(".confirmCancelDocument").click(function(){
            swal({
                    title: "ท่านต้องการยกเลิกหนังสือใช่หรือไม่?",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ใช่ ฉันต้องการยกเลิก",
                    cancelButtonText: "ไม่ ฉันไม่ต้องการยกเลิก",
                    closeOnConfirm: false                   
                },
                function(){                
                         $.ajax({
                            url    : 'cancel-receive',
                            type   : 'GET',                            
                            data   : {
                                'id' : pass_id
                            },
                            async: true,
                            beforeSend: function () {
                               // console.log(pass_id);   
                            swal({
                              title: 'กรุณารอสักครู่..',
                              text: "",
                              width: 600,
                              padding: 100,
                              showConfirmButton: false,
                              showLoaderOnConfirm: true,
                              imageUrl: '../../../@web/../modules/correspondence/style//images/Preloader_1.gif'
                            })                               
                            },
                            complete: function () {
                               // $("#loading").removeClass("se-pre-con");
                                window.location.reload();
                            }
                        });                         
                    
                });
        });
                
       //$("#example_filter input").remove();
       //$("#example_filter label").remove();                 
JS
);
?>
