<?php

use yii\helpers\BaseStringHelper;

$this->title = 'Search';
?>

    <section id="middle" style="padding: 0px 1% 0px 1%">
        <div class="wizard">
            <div class="container-fluid">
                <?php $form = \yii\widgets\ActiveForm::begin([
                    'action' => ['search'],
                    'method' => 'get',
                    'options' => ['class' => 'form-inline'],
                ]); ?>
                <div class="form-group">

                    <label class="control-label" for="search">Search: </label>
                    <input style="float: left;margin-right: 10px;width: 400px;" type="text"
                           name="keyword"
                           class="form-control" placeholder="กรอกสิ่งที่ต้องการค้นหา...."
                           id="nameForSearch" value="<?php echo $searchData["keyword"] ?>">
                    <!-- range picker --><br>

                    <input type="text" class="form-control rangepicker"
                           data-format="yyyy-mm-dd" data-from="<?= date('Y') - 10 ?>-01-01"
                           data-to="<?= date('Y-m-d') ?>"
                           id="dateRange" name="range-date"
                           style="width: 400px;" autocomplete="off" value="<?php echo $searchData["range-date"] ?>"><br>
                    <div id="searchByType">

                        <select id="w0" class="form-control select2-hidden-accessible" name="type[]" multiple=""
                                size="4" data-s2-options="s2options_c4acac00" data-krajee-select2="select2_2ad88ba1"
                                style="display:none" tabindex="-1" aria-hidden="true">
                            <option value="">--- กรุณาเลือกประเภทหนังสือ ---</option>
                            <?php
                            $type = \app\modules\correspondence\models\CmsDocType::find()->all();
                            foreach ($type as $item) {
                                echo "<option value='" . $item['type_id'] . "'>" . $item['type_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <?php echo \kartik\select2\Select2::widget([
                            'name' => 'type',
                            'value' => $searchData["type"],
                            'data' => \yii\helpers\ArrayHelper::map(\app\modules\correspondence\models\CmsDocType::find()->all(), 'type_id', 'type_name'),
                            'options' => ['multiple' => true]
                        ]);
                        ?>

                        <i class="fancy-arrow-"></i>
                    </div>
                    <label style="padding-left: 0px;float: left;clear: left"
                           class="checkbox-inline"><input type="radio" value="searchByAddress"
                                                          name="search_by"
                            <?php if ("searchByAddress" == $searchData["search_by"]) echo 'checked'; ?>>ค้นหาจากแฟ้มเก็บเอกสาร</label>
                    <label style="padding-left: 5px;float: left;margin: auto"
                           class="checkbox-inline"><input type="radio" value="searchById"
                                                          name="search_by" id="searchById"
                            <?php if ("searchById" == $searchData["search_by"]) echo 'checked'; ?>>ค้นหาจากเลขหนังสือ</label>
                    <label style="padding-left: 5px;float: left;margin: auto"
                           class="checkbox-inline"><input type="radio"
                                                          value="searchBySubject"
                                                          name="search_by"
                                                          id="searchBySubject"
                            <?php if ("searchBySubject" == $searchData["search_by"]) echo 'checked'; ?> >ค้นหาจากชื่อเรื่อง</label>
                    <label style="padding-left: 5px;float: left;margin: auto"
                           class="checkbox-inline"><input type="radio"
                                                          value="searchByDept"
                                                          name="search_by"
                                                          id="searchByDept"
                            <?php if ("searchByDept" == $searchData["search_by"]) echo 'checked'; ?> >ค้นหาจากหน่วยงาน</label>
                    <div class="form-group">
                        <?= \yii\helpers\Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>

                    </div>

                    <?php \yii\widgets\ActiveForm::end(); ?>
                    <div style="float: right;margin-right: 10px">
                        <span>DATE: </span>
                        <br><br><br>
                        <label>ระหว่างวันที่:</label>
                    </div>
                    <h1>Search Result for <?php echo "<span class='label label-success'></span>" ?></h1>
                    <?php
                    echo \yii\helpers\Json::encode($raw);
                    for ($i = 0; $i < count($dataProvider); $i++) {
                        echo $i;
                        foreach ($dataProvider[$i] as $key) {
                            echo "<div class='row'>";

                            echo "<div class='panel panel-default'>";
                            echo "<div class='panel-heading'>" . $key['doc_subject'] . "</div>";
                            echo "<span>  " . $key['doc_id_regist'] . "  </span><br>";
                            echo "<span>  " . $key['doc_date'] . "  </span><br>";
                            echo "<span>  " . $key->address->address_name . "  </span><br>";
                            echo "<span>  " . $key->docDept->doc_dept_name . "  </span><br>";

                            echo "</div>";
                            echo "</div>";
                        }
                    }


                    ?>

                </div>
            </div>
    </section>
<?php
/** @var TYPE_NAME $docid */
$this->registerJs(<<<JS
var count =0;
    $('#example').DataTable();
   // $("#searchByType").hide();
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
        //
        // $('input[type=radio]').change(function () {
        //     if (this.value == 'searchByType') {
        //         $("#searchByType").show();
        //         //$("#nameForSearch").hide()
        //     } else {
        //         $("#nameForSearch").show();
        //         $("#searchByType").hide();
        //     }
        // });
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
                                type   : 'GET',                            
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
                buttons: [buttonCancelSwal,buttonConfirmSwal],
            })
                .then(willDelete=> {
                if(willDelete) {
                    swal(successSwal, { icon: "success", button: false,});
                   return $.ajax({
                            url    : 'cancel-receive',
                            type   : 'GET',                            
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
               
       $("#example_filter input").remove();
       $("#example_filter label").remove();
      
JS
);
?>