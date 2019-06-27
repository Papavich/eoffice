<?php

?>
<section id="middle" style="color: black">
    <div id="content" class="padding-30">
        <div class="container">
            <div class="row">
                <h2>ทะเบียนหนังสือรับ</h2>
            </div>
            <form method="post" action="testmail">
                <input type="text" name="food[0][]" value="apple" />
                <input type="text" name="food[0][]" value="pear" />
                <input type="text" name="food[1][]" value="banana" />
                <button type="submit">xxx</button>
            </form>

        </div><!-- end container -->

    </div>
</section>
<?php
$this->registerJs(<<<JS
$(document).ready(function(){
    $("#wallmessages2").hide();
    $("#page2").click(function() {
        $("#wallmessages1").hide();
        $("#wallmessages2").slideDown();
        $("#page1").removeClass("active");
        $("#page2").addClass("active");
    });
     $("#page1").click(function() {
        $("#wallmessages2").hide();
        $("#wallmessages1").slideDown();
        $("#page2").removeClass("active");
        $("#page1").addClass("active");
    });
    
     $(".confirm-reply").click(function() {
       confirm("ต้องการยืนยันการตอบรับการรายงานผลการปฏิบัติงานใช่หรือไม่");
     });
});
JS
);
?>
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
                        <?= $this->render('../search/search_form', ['url' => 'search-receive?id=', 'searchData' => $searchData]) ?>

                    </div>
                    <!-- panel content -->
                    <div class="panel-body">
                        <?php
                        if (Yii::$app->controller->action->id == "receive-roll-in-all-folder") {
                            ?>
                            <div class="col-md-3 pull-right" style="margin: 15px;">
                                <!-- classic select2 -->
                                <select class="form-control" onchange="if (this.value) window.location=this.value">
                                    <option value="">--- เปลี่ยนมุนมองตาราง ---</option>
                                    <option value="receive-roll">
                                        แสดงแฟ้มทะเบียนหนังสือรับ
                                    </option>
                                    <option value="receive-roll-in-all-folder">
                                        แสดงหนังสือภายในทะเบียนหนังสือรับ
                                    </option>
                                </select>
                            </div>
                            <?php
                        }
                        ?>
                        <table id="" class="table table-striped table-hover table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th><?= controllers::t('menu', 'Registration number') ?></th>
                                <th class="col-sm-1"><?= controllers::t('menu', 'Receive Date') ?></th>
                                <th class="col-sm-1"><?= controllers::t('menu', 'Book number') ?></th>
                                <th class="col-sm-2"><?= controllers::t('menu', 'From') ?></th>
                                <th class="col-sm-2"><?= controllers::t('menu', 'To') ?></th>
                                <th class="col-sm-3"><?= controllers::t('menu', 'Subject') ?></th>
                                <th class="col-xs-1"><?= controllers::t('menu', 'Doing') ?></th>
                                <th class="col-xs-2"><?= controllers::t('menu', 'Status') ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($i = 0; $i < count($model_doc); $i++) {
                                foreach ($model_doc[$i] as $rows) {
                                    if (!empty($model_doc)) {
                                        ?>
                                        <tr>
                                            <td align="center">
                                                <?php
                                                foreach ($rows->cmsDocRollReceives as $receive) {
                                                    echo Html::a(substr($receive->doc_roll_receive_id, -4),
                                                        ['detail_book?id=' . $rows['doc_id']], ['class' => 'linksWithTarget', 'target' => '_blank']);
                                                }
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?= Html::a(controllers::DateThai($rows['receive_date']),
                                                    ['detail_book?id=' . $rows['doc_id']], ['class' => 'linksWithTarget', 'target' => '_blank']); ?>
                                            </td>
                                            <td class="center">
                                                <?= Html::a($rows['doc_id_regist'],
                                                    ['detail_book?id=' . $rows['doc_id']], ['class' => 'linksWithTarget', 'target' => '_blank']); ?>
                                            </td>
                                            <td>
                                                <?= Html::a($rows->docDept->doc_dept_name,
                                                    ['detail_book?id=' . $rows['doc_id']], ['class' => 'linksWithTarget', 'target' => '_blank']); ?>
                                            </td>
                                            <td align="center">
                                                <?php
                                                foreach ($rows->cmsInboxes as $items) {
                                                    if (count($rows->cmsInboxes) > 1) {
                                                        echo Html::a($items->user->prefix_th . $items->user->fname . " " . $items->user->lname . " และคนอื่น ๆ",
                                                            ['detail_book?id=' . $rows['doc_id']], ['class' => 'linksWithTarget', 'target' => '_blank']);
                                                        break;
                                                    } else {
                                                        echo Html::a($items->user->prefix_th . $items->user->fname . " " . $items->user->lname,
                                                            ['detail_book?id=' . $rows['doc_id']], ['class' => 'linksWithTarget', 'target' => '_blank']);;

                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?= Html::a($rows['doc_subject'], ['detail_book?id=' . $rows['doc_id']], ['class' => 'linksWithTarget', 'target' => '_blank']) ?>
                                            </td>
                                            <td align="center">
                                                <?php
                                                foreach ($rows->cmsDocRollReceives as $item) {
                                                    echo Html::a($item['doc_roll_receive_doing'],
                                                        ['detail_book?id=' . $rows['doc_id']], ['class' => 'linksWithTarget', 'target' => '_blank']);
                                                }
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?= controllers::t('menu', $rows->check->check_name) ?>
                                            </td>
                                            <td class="center">
                                                <?php
                                                echo Html::a("<i class=\"fa fa-edit\"></i><span>" . controllers::t('menu', 'Edit') . "</span>",
                                                    ['staff-receive/edit-receive-form?id=' . $rows['doc_id']], ['class' => 'btn btn-sm btn-3d btn-reveal btn-blue']);
                                                if ($rows->check->check_id != 2) { ?>
                                                    <a href="#" onclick="redirectDeleteRoll('<?= $rows['doc_id'] ?>')"
                                                       class="btn btn-sm btn-3d btn-reveal btn-red confirmCancelDocument">
                                                        <i class="glyphicon glyphicon-remove"></i>
                                                        <span> <?= controllers::t('menu', 'Cancel') ?></span>
                                                    </a>
                                                    <?php
                                                }
                                                ?>

                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <?php
                            // display pagination
                            // echo \yii\widgets\LinkPager::widget(['pagination' => $pages,]);
                            ?>
                        </div>
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

if ( $.fn.dataTable.isDataTable( '#example' ) ) {
    table = $('#example').DataTable();
}
else {
    table = $('#example').DataTable( {
        paging: false
    } );
}
    var count =0;
    //$("#searchByType").hide();
    $('#dateRange').click(function() {
       $('body').find('.daterangepicker').addClass('col-md-6 pull-right');
       $('body').find('.daterangepicker').css("left", "auto");
       $('body').find('.daterangepicker').css("right", "");
       $('body').find('.daterangepicker').css("width", "700px");
       $('.ranges').find('ul').remove();
       if(count == 0){
           $('.ranges').append('<br>กดปุ่ม Apply เพื่อเพิ่มช่วงเวลาในการค้นหา');
       }
       count++;
    });
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
                    swal(successSwal, { icon: "success", button: false,});
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
                    swal(successSwal, { icon: "success", button: false,});
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
