<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\modules\correspondence\controllers;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Html::encode($this->title) . controllers::t('menu', 'Items within files');
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
                        <!-- เบสค้ำ -->
                        <?php
                        if (Yii::$app->controller->action->id == "receive-roll-in-all-folder"
                            || Yii::$app->controller->action->id == "search-receive") {
                            ?>
                            <h1><?= Html::encode(controllers::t('menu', 'Received Roll')) ?></h1>
                            <?php
                        } else {
                            ?>
                            <h2 style="margin-bottom: 0"><?= controllers::t('menu', 'Items within files') ?></h2>
                            <h4 style="margin-bottom: 0">
                                <?= Html::a(controllers::t('menu', 'Received Roll'), ['staff-receive/receive-roll']); ?>
                                >
                                <?= Html::a(\app\modules\correspondence\models\CmsAddress::findOne($_GET['id'])->address_name, ['staff-receive/receive-roll-in-folder?id=' . $_GET['id']]); ?>
                            </h4>
                            <?php
                        }
                        ?>
                        <br><br>
                        <?=$this->render('../search/search_form',['url' => 'search-receive?id=', 'searchData'=>  $searchData])?>

                    </div>
                    <!-- panel content -->
                    <div class="panel-body table-responsive">
                        <?php
                        if (Yii::$app->controller->action->id == "receive-roll-in-all-folder") {
                            ?>
                            <div class="col-md-3 pull-right" style="margin: 15px;">
                                <!-- classic select2 -->
                                <select class="form-control" onchange="if (this.value) window.location=this.value">
                                    <option value="">--- <?=controllers::t('menu','Change views')?>  ---</option>
                                    <option value="receive-roll">
                                        <?=controllers::t('menu','Show document file receive books')?>
                                    </option>
                                    <option value="receive-roll-in-all-folder">
                                        <?=controllers::t('menu','Show book in received roll')?>
                                    </option>
                                </select>
                            </div>
                            <?php
                        }
                        ?>
                        <?= \yii\grid\GridView::widget([
                            'tableOptions' => [
                                'class' => 'table table-striped table-hover table-bordered',
                                'width'=>'100%',
                                'cellspacing'=> '0'
                            ],
                            'rowOptions' => function ($model) {
                                return ['title' => controllers::t('menu','See more')];
                            },
                            'dataProvider' => $dataProvider,
                            'columns' => $gridColumns,
                        ]); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
if ( $.fn.dataTable.isDataTable( '#example' ) ) {
    table = $('#example').DataTable();
}
else {
    table = $('#example').DataTable( {
        paging: false
    } );
}
       //$("#searchByType").hide();
        $('input[type=radio]').change(function () {
            if (this.value == 'searchByType') {
                $("#searchByType").show();
                //$("#nameForSearch").hide()
            } else {
                $("#nameForSearch").show();
               // $("#searchByType").hide();
            }
        });
if ($('input[type=radio]:checked') && $('input[type=radio]:checked').val()=="searchByType") {
 $("#searchByType").show();
}        
        $(".confirmDeleteRoll").click(function(){
            swal({
                title: titleSwal,
                text: textSwal,
                icon: "warning",
                dangerMode: true,
                buttons: [buttonCancelSwal, buttonConfirmSwal],
            })
                .then(willDelete=> {
                if(willDelete) {
                    swal(successSwal , { icon: "success", button: false,});
                   return $.ajax({
                                 url    : 'delete-receive',
                                type   : 'POST',                            
                                data   : {
                                    'id' : pass_id
                                },
                                beforeSend: function () {
                                                              
                                },
                                success: function () {
                                   // $("#loading").removeClass("se-pre-con");
                                    window.location.reload();
                                }
                            }); 
                }
            }
            );
        });                  
        $(".confirmCancelDocument").click(function(){
            swal({
                title: titleSwal,
                text: textSwal,
                icon: "warning",
                dangerMode: true,
                buttons: [buttonCancelSwal, buttonConfirmSwal],
            })
                .then(willDelete=> {
                if(willDelete) {
                    swal(successSwal , { icon: "success", button: false,});
                   return $.ajax({
                            url    : 'cancel-receive',
                            type   : 'POST',                            
                            data   : {
                                'id' : pass_id
                            },
                            success: function () {
                               // $("#loading").removeClass("se-pre-con");
                                window.location.reload();
                            }
                        }); 
                }
            }
            );
        });
        $('.dataTables_info').html('');       
        $("#example_filter input").remove();
-       $("#example_filter label").remove();
JS
);
?>
