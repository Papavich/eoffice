<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\modules\correspondence\controllers;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'ทะเบียนหนังสือทำลาย';
function DateThaifull($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear $strHour:$strMinute:$strSeconds น.";
}

?>
<style>
</style>

<section id="middle">
    <div id="content" class="padding-20">
        <div id="panel-1" class="panel panel-default">
            <div class="document-index">
                <div id="content" class="padding-10">
                    <div id="panel-1" class="panel panel-default">
                        <h1 class="sendroll"><?= controllers::t('menu', 'Destroying Documents') ?></h1>
                    </div>
                    <!-- Add new list -->
                    <div style="padding-bottom: 15px;">
                        <a href="#NewListModal" class="btn btn-dirtygreen"
                           data-toggle="modal" data-whatever="@mdo"
                           id="modal"><?= controllers::t('menu', 'Create a new destroying') ?>
                        </a>
                    </div>
                    <!-- End add new list -->
                    <!-- panel content -->
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered example"style="font-size: 16px;">
                            <thead>
                            <tr>
                                <th style="width: 20px"><?= controllers::t('menu', 'Terms') ?></th>
                                <th style="width: 60px"><?= controllers::t('menu', 'Time start') ?></th>
                                <th style="width: 60px"><?= controllers::t('menu', 'Time end') ?></th>
                                <th style="width: 20px"><?= controllers::t('menu', 'Amount') ?></th>
                                <th style="width: 120px"><?= controllers::t('menu', 'Destroyer') ?></th>
                                <th style="width: 120px"><?= controllers::t('menu', 'Approver') ?></th>
                                <th style="width: 80px"><?= controllers::t('menu', 'Status') ?></th>
                                <th style="width: 70px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $model_roll = \app\modules\correspondence\models\CmsDeleteRoll::find()
                                ->select(['time_start', 'roll', 'status', 'time_end','user_id'])->distinct()
                                ->groupBy('roll')
                                ->orderBy(['cms_delete_roll.roll' => SORT_ASC])
                                ->all();
                            if ($model_roll) {
                                foreach ($model_roll as $rows) {
                                    $model_doc = \app\modules\correspondence\models\User::find()
                                        ->where(['id' => $rows['user_id']])
                                        ->one();
                                    $model_count = \app\modules\correspondence\models\CmsDeleteRoll::find()
                                        ->where(['roll' => $rows['roll']])
                                        ->count();
                                    $model_user_main= \app\modules\correspondence\models\model_main\EofficeCentralViewPisPerson::find()
                                        ->where(['eoffice_central.view_pis_person.person_id' => $model_doc->personcode])
                                        ->one();
                                    $model_head=\app\modules\correspondence\models\CmsDeleteRoll::find()
                                        ->where(['roll' => $rows['roll']])
                                        ->one();
                                    $model_head_id=substr($model_head->delete_id,7);
                                    $model_board= \app\modules\correspondence\models\model_main\EofficeCentralViewPisBoardOfDirectors::find()
                                       /* ->where("position_name ='หัวหน้าภาควิชาวิทยาการคอมพิวเตอร์'")
                                        ->andWhere("period_describe ='สมัยปัจจุบัน'")*/
                                       ->where(''.$model_head_id.'=person_id')
                                        ->one();
                                    echo '<tr>
                <td class="center">' . $rows['roll'] . '</td>
                <td class="center">' . DateThaifull($rows['time_start']) . '</td>
              ';
                                    if ($rows['status'] == 'รออนุมัติ' | $rows['status'] == 'กำลังทำลาย') {
                                        echo '  <td class="center">'.controllers::t('menu', 'Unfinished').'</td>';
                                    } else if ($rows['status'] == 'ทำลายเสร็จสิ้น') {
                                        echo '<td class="center">' . DateThaifull($rows['time_end']) . '';
                                    }
                                    //TODO ดึงข้อมูลจากวิว
                                    echo '</td>         
                <td class="center">' . $model_count . '</td>           
                <td class="center">' . $model_user_main->PREFIXABB.$model_user_main->person_name."&nbsp&nbsp".$model_user_main->person_surname . '</td>
                <td class="center"> ' . $model_board->academic_positions_abb_thai.$model_board->person_name."&nbsp&nbsp".$model_board->person_surname.'</td>
                <td class="center">' . $rows['status'] . '</td>';
                                    if ($rows['status'] == 'รออนุมัติ' | $rows['status'] == 'กำลังทำลาย') {
                                        echo '
                <td align="center">
               
                                         <input type="hidden" name="roll" id="roll" value="' . $rows['roll'] . '">
                                         
                                         <a href="#DetailEdit" class="btn-sm btn-warning margin-right-10 editroll" 
                                          data="' . $rows['roll'] . '"
                                                data-toggle="modal" data-whatever="@mdo" title="แก้ไข"
                                                ><i class="fa fa-pencil"></i>
                                        </a> 
                       
                                        <a href="#" onclick="redirectDeleteRoll(' . $rows['roll'] . ')"
                           class=" btn-sm btn-danger confirmDeleteRoll" title="ลบ" >
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                </tr>';
                                    } else {
                                        echo '
                <td align="center">
                                         <a href="#DetailModal" class=" btn-sm btn-success margin-right-10 seeroll"  
                                                data-toggle="modal" data-whatever="@mdo" title="ดูรายการ" data="' . $rows['roll'] . '"
                                               ><i class="fa fa-eye"></i>
                                        </a> 
                       
                                    </td>
                </tr>';
                                    }
                                }
                            }

                            ?>
                            </tbody>

                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /MIDDLE -->

<!-- Add new list modal -->
<div class="modal fade" id="NewListModal" role="dialog">
    <div class="modal-dialog" style="width: 80%;font-size: 16px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="close1">&times;</button>
                <h4 class="modal-title"><?= controllers::t('menu', 'Create a book list to destroy') ?></h4>
            </div>

            <div class="modal-body">
                <form action="createdeleteroll" data-method="get">
                    <div class="table-responsive">
                    <table class="table table-hover table-bordered example">
                        <thead>
                        <tr>
                            <th style="width:20px;"><?= controllers::t('menu', 'Select all') ?><br>
                                <input type="checkbox" id="choseall">
                            </th>
                            <th style="width:20px;"><?= controllers::t('menu', 'Address ID') ?></th>
                            <th><?= controllers::t('menu', 'Address Name') ?></th>
                            <th><?= controllers::t('menu', 'Book number') ?></th>
                            <th width="500"><?= controllers::t('menu', 'Title') ?></th>
                            <th><?= controllers::t('menu', 'Doc Date') ?></th>
                            <th><?= controllers::t('menu', 'Book Expire Date') ?></th>
                            <th><?= controllers::t('menu', 'Category') ?></th>
                        </tr>
                        </thead>
                        <tbody>


                        <?php
                        $datenow = date("Y-m-d h:m:s");
                        /* echo "วันนี้วันที่ : " . DateThaifull($datenow) . "<br>";*/
                        ?>
                        <?php
                        $model_create = \app\modules\correspondence\models\CmsDocument::find()
                            ->from(['cms_document'])
                            ->leftJoin('cms_delete_roll', ' cms_document.doc_id=cms_delete_roll.doc_id')
                            ->leftJoin('cms_doc_roll_send', ' cms_document.doc_id=cms_doc_roll_send.doc_id')
                            ->leftJoin('cms_outbox', ' cms_document.doc_id=cms_outbox.doc_id')
                            ->where('"' . $datenow . '"  >= doc_expire')
                            ->andWhere('cms_doc_roll_send.doc_id is null')
                            ->andWhere('cms_delete_roll.doc_id is null')
                            ->andWhere('cms_outbox.outbox_content IS null')
                            ->orderBy('address_id')
                            ->all();
                        foreach ($model_create as $rows) {
                            $model_add = \app\modules\correspondence\models\CmsAddress::find()->where(['address_id' => $rows['address_id']])->one();
                            $model_sub = \app\modules\correspondence\models\CmsDocSubType::find()->where(['sub_type_id' => $rows['sub_type_id']])->one();
                            if (!empty($model_doc)) {
                                ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkalllist" value="<?= $rows['doc_id'] ?>"
                                               id="<?= $rows['doc_id'] ?>" name="doc_id[]"/>

                                    </td>
                                    <!-- <td class="body">
                                    <? /*= $rows['doc_id']; */ ?>
                                </td>-->
                                    <td class="body">
                                        <?= $rows['address_id']; ?>
                                    </td>
                                    <td class="body">
                                        <?php
                                        echo $model_add->address_name;
                                        ?>
                                    </td>
                                    <td class="body">
                                        <?= $rows['doc_id_regist']; ?>
                                    </td>
                                    <td align="body">
                                        <?= Html::a($rows['doc_subject'],
                                            ['staff-receive/detail_book?id=' . $rows['doc_id']],['target' => '_blank']) ?>
                                    </td>
                                    <td class="body">
                                        <?= controllers::DateThai($rows['doc_date']); ?>
                                    </td>
                                    <td class="body">
                                        <?= controllers::DateThai($rows['doc_expire']); ?>
                                    </td>
                                    <td class="body">
                                        <?php
                                        echo $model_sub->sub_type_name;
                                        ?>
                                    </td>

                                </tr>

                            <?php }


                        }

                        ?>
                        </tbody>
                    </table>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success" id="createDelete"><?= controllers::t('menu', 'Save') ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Add new list modal -->
<!-- Detail modal -->
<div class="modal fade" id="DetailModal" role="dialog">
    <div class="modal-dialog" style="width: 80%;font-size: 16px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="close1">&times;</button>
                <h4 class="modal-title"><?= controllers::t('menu', 'List of destroyed book') ?> <span class="seerollnumber"
                                                                               style="color: black;font-family: sans-serif"></span>
                </h4>
            </div>
            <div class="modal-body">

                <table  class="table table-striped table-hover table-bordered seeTable">
                    <thead>
                    <tr>
                        <th><?= controllers::t('menu', 'Address ID') ?></th>
                        <th><?= controllers::t('menu', 'Address Name') ?></th>
                        <th><?= controllers::t('menu', 'Book number') ?></th>
                        <th width="500"><?= controllers::t('menu', 'Title') ?></th>
                        <th><?= controllers::t('menu', 'Sub Type Name') ?></th>
                        <th><?= controllers::t('menu', 'Book Date') ?></th>
                        <th><?= controllers::t('menu', 'Book Expire Date') ?></th>
                    </tr>
                    </thead>

                    <tbody class='seerolltable'></tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<!-- Detail modal -->

<!-- Edit modal -->
<div class="modal fade" id="DetailEdit" role="dialog">
    <div class="modal-dialog" style="width: 80%;font-size: 16px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="close1">&times;</button>
                <h4 class="modal-title"><?= controllers::t('menu', 'Edit Book List') ?>&nbsp;<span class="rolledit"
                                                                              style="color: black;font-family: sans-serif"></span>
                </h4>
            </div>
            <div class="modal-body">
                <span style="white-space:nowrap">
                    <label for="id1"><?= controllers::t('menu', 'Status') ?>:</label>
                    <select id="status">

                    </select>
                </span><br><br>
                <table class="table table-striped table-hover table-bordered editTable">
                    <thead>
                    <tr>
                        <!--<th>เลือกทั้งหมด
                           <input type="checkbox" id="choseall3" >
                        </th>-->
                        <th><?= controllers::t('menu', 'Address ID') ?></th>
                        <th><?= controllers::t('menu', 'Address Name') ?></th>
                        <th><?= controllers::t('menu', 'Book number') ?></th>
                        <th width="500"><?= controllers::t('menu', 'Title') ?></th>
                        <th><?= controllers::t('menu', 'Sub Type Name') ?></th>
                        <th><?= controllers::t('menu', 'Book Date') ?></th>
                        <th><?= controllers::t('menu', 'Book Expire Date') ?></th>
                    </tr>
                    </thead>

                    <tbody class='detail'></tbody>

                </table>
                <button type="submit" class="btn btn-success editDelete"><?= controllers::t('menu', 'Save') ?></button>
            </div>
        </div>
    </div>
</div>

<!--Edit Modal-->

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
 $('.example').DataTable();
    

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
        
        $('#choseall').click(function () {    
            $(':checkbox.checkalllist').prop('checked', this.checked);    
        });
       
$(".confirmDeleteRoll").click(function(){
        swal({
            title: titleSwal,
            text: textSwal,
            icon: "warning",
            dangerMode: true,
            buttons: [buttonCancelSwal, buttonConfirmSwal],
        })
            .then(willDelete => {
            if(willDelete) {
              swal(successSwal, { icon: "success", button: false,});
                return $.ajax({
                            url    : 'delete-destroyroll',
                            type   : 'GET',
                            data   : {
                                'roll' : pass_id
                            },
                            success: function () {
                               // $("#loading").removeClass("se-pre-con");
                                window.location.href = 'delete-roll';
                            }
                        }); 
                }
            }
        );    

});

$(".editroll").click(function () {
    
    let roll = $(this).attr("data");  
    $(".editDelete").attr("roll",roll);
    
    $('.rolledit').text($(this).attr("data"));
    
             $.ajax({
                url: '../staff/getroll',
                data: {
                    'roll': roll
                },
                type: "get", 
                beforeSend:function() {
                   $('.detail').html(''); 
                },
                success: function(data){
                     $('.detail').html(data);  
                     $('.editTable').DataTable();                
                }
                 
            });
              $.ajax({
                url: '../staff/getstatus',
                data: {
                    'roll': roll
                },
                type: "get", 
                success: function(data){
                     $('#status').html(data);   
                }
            });
            
    
    console.log(roll);
   

 });
$(".seeroll").click(function () {
    
    let roll = $(this).attr("data");  
   
    
    $('.seerollnumber').text($(this).attr("data"));
    
             $.ajax({
                url: '../staff/getroll',
                data: {
                    'roll': roll
                },
                type: "get", 
                beforeSend:function() {
                   $('.seerolltable').html(''); 
                },
                success: function(data){
                     $('.seerolltable').html(data);  
                     $('.seeTable').DataTable();                
                }
                 
            });
            
            
    
    console.log(roll);
   

 });

    $(".editDelete").click(function() {
      let roll = $(this).attr("roll");
      let select= $("#status").val();
        let remove = $("#remove").val();
     
    
      console.log('Remove1: '+ remove);
      console.log('Roll: '+roll)
      console.log('Select: '+select)
     
      
      $.ajax({
                url: '../staff/editdelete',
                data: {
                    'roll': roll,
                     'select': select,
                     
                },
                type: "get", 
                success: function(data){
                     console.log(data);           
               }
            });
       location.reload();
    });
       $("#removeroll").click(function() {
      var remove_doc_id = $(this).attr("remove_doc_id");

      console.log('Remove: '+ remove_doc_id[0]);

      $.ajax({
                url: '../staff/removeroll',
                data: {
                    'remove_doc_id': remove_doc_id     
                },
                type: "get", 
                success: function(data){
                     console.log(data);           
               }
            });
       location.reload();
    });

JS
);
?>