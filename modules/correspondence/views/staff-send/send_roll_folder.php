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
    <?php Pjax::begin(['linkSelector' => 'a:not(.linksWithTarget)']); ?>
    <div id="content" class="padding-20">
        <div id="panel-1" class="panel panel-default">
            <div class="document-index">
                <div id="content" class="padding-20">
                    <div id="panel-1" class="panel panel-default">
                        <!-- เบสค้ำ -->
                        <?php
                        if (Yii::$app->controller->action->id == "send-roll-in-all-folder"
                            ||Yii::$app->controller->action->id == "search-send") {
                            ?>
                            <h1><?= Html::encode(controllers::t('menu', 'Send Roll')) ?></h1>
                            <?php
                        } else {
                            ?>
                            <h2 style="margin-bottom: 0"><?= controllers::t('menu', 'Items within files') ?></h2>
                            <h4 style="margin-bottom: 0">
                                <?= Html::a(controllers::t('menu', 'Send Roll'), ['staff-send/send-roll']); ?> >
                                <?= Html::a(\app\modules\correspondence\models\CmsAddress::findOne($_GET['id'])->address_name, ['staff-send/send-roll-in-folder?id=' . $_GET['id']]); ?>
                            </h4>
                            <?php
                        }
                        ?>
                        <?=$this->render('search_form',[ 'searchData'=>  $searchData])?>
                        <!-- /SEARCH FORM -->

                    </div>

                    <!-- panel content -->
                    <div class="panel-body">
                        <?php
                        if (Yii::$app->controller->action->id == "send-roll-in-all-folder") {
                            ?>
                            <div class="col-md-3 pull-right" style="margin: 15px;">
                                <!-- classic select2 -->
                                <select class="form-control" onchange="if (this.value) window.location=this.value">
                                    <option value="">--- เปลี่ยนมุนมองตาราง ---</option>
                                    <option value="send-roll">
                                        แสดงแฟ้มทะเบียนหนังสือรับ
                                    </option>
                                    <option value="send-roll-in-all-folder">
                                        แสดงหนังสือภายในทะเบียนหนังสือรับ
                                    </option>
                                </select>
                            </div>
                            <?php
                        }
                        ?>
                        <table id="example" class="table table-striped table-hover table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th class="col-sm-1"><?= controllers::t('menu', 'Sending number') ?></th>
                                <th><?= controllers::t('menu', 'Book number') ?></th>
                                <th><?= controllers::t('menu', 'Sent Date') ?></th>
                                <th class="col-sm-2"><?= controllers::t('menu', 'From') ?></th>
                                <th class="col-sm-2"><?= controllers::t('menu', 'To') ?></th>
                                <th class="col-sm-3"><?= controllers::t('menu', 'Subject') ?></th>
                                <th class="col-xs-1"><?= controllers::t('menu', 'Doing') ?></th>
                                <th class="col-xs-2"><?= controllers::t('menu', 'Status') ?></th>
                                <th class="col-sm-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            foreach ($model_doc as $rows) {
                                if (!empty($model_doc)) {
                                    ?>
                                    <tr>
                                        <td align="center">
                                            <?php
                                            foreach ($rows->cmsDocRollSends as $send){
                                                echo Html::a(substr($send->doc_roll_send_id, -4),
                                                    ['detail_book?id=' . $rows['doc_id']], ['class'=>'linksWithTarget','target' => '_blank']);
                                            }
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?= Html::a($rows['doc_id_regist'],
                                                ['detail_book?id=' . $rows['doc_id']], ['class'=>'linksWithTarget','target' => '_blank']); ?>
                                        </td>
                                        <td align="center">
                                            <?= Html::a(controllers::DateThai($rows['sent_date']),
                                                ['detail_book?id=' . $rows['doc_id']], ['class'=>'linksWithTarget','target' => '_blank']); ?>
                                        </td>
                                        <td>
                                            <?= Html::a($rows['doc_from'],
                                                ['detail_book?id=' . $rows['doc_id']], ['class'=>'linksWithTarget','target' => '_blank']); ?>
                                        </td>
                                        <td>
                                            <?= Html::a($rows->docDept->doc_dept_name,
                                                ['detail_book?id=' . $rows['doc_id']], ['class'=>'linksWithTarget','target' => '_blank']); ?>
                                        </td>
                                        <td>
                                            <?= Html::a($rows['doc_subject'], ['detail_book?id=' . $rows['doc_id']], ['class'=>'linksWithTarget','target' => '_blank']) ?>
                                        </td>
                                        <td align="center">
                                            <?php
                                            foreach ($rows->cmsDocRollSends as $item) {
                                                echo Html::a($item['doc_roll_send_doing'],
                                                    ['detail_book?id=' . $rows['doc_id']], ['class'=>'linksWithTarget','target' => '_blank']);
                                            }
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?= controllers::t('menu', $rows->check->check_name) ?>
                                        </td>
                                        <td align="center">
                                            <?= Html::a("<i class=\"fa fa-edit\"></i>
                                            <span>" . controllers::t('menu', 'Edit') . "</span>",
                                                ['staff-send/edit-send-form?id=' . $rows['doc_id']], ['class' => 'btn btn-3d btn-xs btn-reveal btn-blue btnw']) ?>
                                            <a href="#" onclick="redirectDeleteRoll('<?= $rows['doc_id'] ?>')"
                                               class="btn btn-3d btn-xs btn-reveal btn-red btnw confirmDeleteRoll">
                                                <i class="fa fa-trash"></i>
                                                <span><?= controllers::t('menu', 'Delete') ?></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }

                            ?>
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <?php
                            // display pagination
                            echo \yii\widgets\LinkPager::widget([
                                'pagination' => $pages,
                            ]);
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
$('.pagination').addClass('pull-right');
var count =0;
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
                                url    : 'delete-send',
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
        $('.dataTables_info').html('');       
        $("#example_filter input").remove();
        $("#example_filter label").remove();
JS
);
?>
<?php Pjax::end(); ?>
