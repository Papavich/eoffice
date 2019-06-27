<?php
use yii\widgets\ActiveForm;
use richardfan\widget\JSRegister;
use yii\helpers\Url;
Yii::getAlias('@mat_assets');
$this->registerCssFile('@web/assets/plugins/dropzone/css/dropzone.css');
$this->registerJsFile('@mat_assets/dropfile.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJs(<<<JS
loadScript('/e-office/web/assets/plugins/dropzone/dropzone.js', function() {
        Dropzone.options.myDropzone = {
            init: function() {
                this.on("addedfile", function(file) {
                    // Create the remove button
                    var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-default fullwidth margin-top-10'>Remove file</button>");

                    // Capture the Dropzone instance as closure.
                    var _this = this;

                    // Listen to the click event
                    removeButton.addEventListener("click", function(e) {
                        // Make sure the button click doesn't submit the form:
                        e.preventDefault();
                        e.stopPropagation();

                        // Remove the file preview.
                        _this.removeFile(file);
                        // If you want to the delete the file on the server as well,
                        // you can do the AJAX request here.
                    });

                    // Add the button to the file preview element.
                    file.previewElement.appendChild(removeButton);
                });
            }
        }

    });
loadScript(plugin_path + "datatables/js/jquery.dataTables.js", function(){
	loadScript(plugin_path + "datatables/dataTables.bootstrap.js", function(){

		if (jQuery().dataTable) {

			var table = jQuery("#datatable_sample");
			table.dataTable({
				"columns": [{
					"orderable": true
				},{
					"orderable": true
				},{
					"orderable": false
				},{
					"orderable": false
				}, {
					"orderable": false
				}, {
					"orderable": true
				}, {
					"orderable": true
				}, {
					"orderable": true
				}, {
					"orderable": true
				}],
				"lengthMenu": [
					[5, 15, 20, -1],
					[5, 15, 20, "All"] // change per page values here
				],
				// set the initial value
				"pageLength": -1,
				"pagingType": "bootstrap_full_number",
				"language": {
					"lengthMenu": "  _MENU_ records",
					"paginate": {
						"previous":"Prev",
						"next": "Next",
						"last": "Last",
						"first": "First"
					}
				},
				"columnDefs": [{  // set default column settings
					"orderable": false,
					"targets": [0]
				}, {
					"searchable": false,
					"targets": [0]
				}],
				"order": [
					[1, "asc"]
				] // set first column as a default sort by asc
			});

			var tableWrapper = jQuery("#datatable_sample_wrapper");

			table.find(".group-checkable").change(function () {
				var set = jQuery(this).attr("data-set");
				var checked = jQuery(this).is(":checked");
				jQuery(set).each(function () {
					if (checked) {
						jQuery(this).attr("checked", true);
						jQuery(this).parents("tr").addClass("active");
					} else {
						jQuery(this).attr("checked", false);
						jQuery(this).parents("tr").removeClass("active");
					}
				});
				jQuery.uniform.update(set);
			});

			table.on("change", "tbody tr .checkboxes", function () {
				jQuery(this).parents("tr").toggleClass("active");
			});

			tableWrapper.find(".dataTables_length select").addClass("form-control input-xsmall input-inline"); // modify table per page dropdown

		}

	});
});
JS
);
?>

<div id="content" class="dashboard padding-20">
    <header id="page-header">
        <h1>นำเข้าข้อมูล</h1>
    </header>
    <div id="panel-2" class="panel panel-default cs-remargin" style="margin-top: 20px">
        <div class="panel-body">
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="active">
                            <button href="#step1" data-toggle="tab" disabled="disabled" aria-controls="step1" role="tab"
                                    title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-folder-open"></i>
                            </span>
                            </button>
                            <button href="#step1" data-toggle="tab" aria-controls="step1" class="cs-hidded"></button>
                        </li>
                        <li role="presentation" class="disabled">
                            <button href="#step2" data-toggle="tab" disabled="disabled" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-th-list"></i>
                            </span>
                            </button>
                            <button href="#step2" data-toggle="tab" aria-controls="step2" class="cs-hidded" ></button>
                        </li>
                        <li role="presentation" class="disabled">
                            <button href="#step3" data-toggle="tab" disabled="disabled" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                            </button>
                            <button href="#step3" data-toggle="tab" aria-controls="step3" class="cs-hidded"></button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                        <?php $form = ActiveForm::begin([
                            'action' => 'drop_file',
                            'id' => 'myDropzone',
                            'options' => [
                                'class' => 'dropzone',
                            ],
                        ]) ?>
                        <?php ActiveForm::end() ?>
                        <ul class="list-inline pull-right">
                            <li>
                                <button type="button" name="show" onclick="nextpage(2)"
                                        class="btn btn-success next-step">ถัดไป
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
                        <!-- HTML DATATABLE -->
                        <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                            <thead>
                            <tr>
                                <th class="col-md-1">ลำดับ</th>
                                <th class="col-md-2">ชื่อวัสดุ</th>
                                <th class="col-md-1">รูปภาพ</th>
                                <th class="col-md-2">นำเข้าสู่</th>
                                <th class="col-md-2">ประเภท</th>
                                <th class="col-md-1">จำนวน</th>
                                <th class="col-md-1">หน่วยนับ</th>
                                <th class="col-md-1">ราคา/หน่วย</th>
                                <th class="col-md-1">ราคารวม</th>
                            </tr>
                            </thead>

                            <tbody>
                                <tr></tr>
                            </tbody>
                        </table>
                        <ul class="list-inline pull-right">
                            <li>
                                <button type="button" onclick="nextpage(1)" class="btn btn-default prev-step">ย้อนกลับ
                                </button>
                            </li>
                            <li>
                                <button type="button" class="btn btn-success next-step" data-toggle="modal" data-target="#myModal">
                                    ยืนยันรายการ
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">
                        <div align="center">
                            <h1>ทำรายการสำเสร็จ <i class="fa fa-check" aria-hidden="true"></i></h1>
                        </div><br><br>
                        <ul class="list-inline pull-right">
                            <li>
                                <button type="button" class="btn btn-primary btn-info-full next-step" onclick="location.href='<?= Yii::$app->homeUrl ?>/material/default/list'">รายการทั้งหมด
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">ยืนยันการทำรายการ</h4>
            </div>
            <div class="modal-footer">
                <div align="center">
                    <button type="button" name="commit" class="btn btn-success" onclick="nextpage(3)" data-dismiss="modal">ยืนยัน</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>
</div>

