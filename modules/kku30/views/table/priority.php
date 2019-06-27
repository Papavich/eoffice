<!--JS-->
<?php
$this->registerCssFile('@web/assets/plugins/footable/css/footable.core.min.css');
$this->registerCssFile('@web/assets/plugins/footable/css/footable.standalone.css');
$this->registerCssFile('@web/assets/plugins/fulltable/fulltable.css"');
$this->registerJs(<<<JS

loadScript(plugin_path + "footable/dist/footable.min.js", function(){
    loadScript(plugin_path + "footable/dist/footable.sort.min.js", function(){
        loadScript(plugin_path + "footable/dist/footable.paginate.min.js", function(){ /** remove if pagination not needed **/




            // footable
            var ftable = jQuery('.fooTableInit');


            /** 01. FOOTABLE INIT
             ******************************************* **/
            ftable.footable({
							breakpoints: {
                s300: 300,
								s600: 600
							}
						});


						/** 01. PER PAGE SWITCH
                         ******************************************* **/
						jQuery('#change-page-size').change(function (e) {
                            e.preventDefault();
                            var pageSize = jQuery(this).val();
                            ftable.data('page-size', pageSize);
                            ftable.trigger('footable_initialized');
                        });

						jQuery('#change-nav-size').change(function (e) {
                            e.preventDefault();
                            var navSize = jQuery(this).val();
                            ftable.data('limit-navigation', navSize);
                            ftable.trigger('footable_initialized');
                        });


						/** 02. BOOTSTRAP 3.x PAGINATION FIX
                         ******************************************* **/
						jQuery("div.pagination").each(function() {
                            jQuery("div.pagination ul").addClass('pagination');
                            jQuery("div.pagination").removeClass('pagination');
                        });

					});
    });
});

JS
);

?>
<!--JS-->

<section>
    <!-- page title -->
    <header id="page-header">
        <h1>จัดลำดับความสำคัญของข้อมูล</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าแรก</a></li>
            <li class="active"></li>
        </ol>
    </header>
    <!-- /page title -->


    <!--SHOW TABLE COMPARE TABLE-->

    <div id="show_teachtable" style="display: block">

        <!--SHOW TABLE COMPARE TABLE-->

        <!--XXXXXXXXXXXXXX-->
        <!--ADD SUBJECT-->
        <div class="col-md-12 col-sm-12">
            <div id="timetable_content" style="display: block;">
                <br><br>
                <label>เลือกชั้นปี</label>
                <select name="sub_type" id="sub_type" class="form-control pointer required
ย้ย">
                    <option value="" disabled="disabled" selected="selected"> - -
                        เลือกระดับชั้นปี - -
                    </option>
                    <option>ชั้นปีที่ 1</option>
                    <option>ชั้นปีที่ 2</option>
                    <option>ชั้นปีที่ 3</option>
                    <option>ชั้นปีที่ 4</option>
                </select>
                <label>ปีการศึกษา</label>
                <select name="sub_type" id="sub_type" class="form-control pointer required ">
                    <option value="" disabled="disabled" selected="selected"> - -
                        เลือกปีการศึกษา - -
                    </option>
                    <option>ปีการศึกษา 2560</option>
                    <option>ปีการศึกษา 2561</option>
                    <option>ปีการศึกษา 2562</option>
                    <option>ปีการศึกษา 2563</option>
                </select>
                <br/>
                <form action="">
                <div align="left">
                    <!-- page title -->
                    <header id="page-header">
                        <strong>จัดลำดับความสำคัญของสาขา</strong>
                    </header>
                    <!-- /page title -->
                </div>


                    <div id="content" class="padding-20">

                        <div class="panel-body">
                            <label>ความสำคัญลำดับที่ 1</label>
                            <select name="sub_type" id="sub_type" class="form-control pointer required ">
                                <option value="" disabled="disabled" selected="selected"> - -
                                    กรุณาความสำคัญลำดับที่ 1 - -
                                </option>
                                <optgroup label="== สาขาวิชาวิทยาการคอมพิวเตอร์ =="></optgroup>
                                <option>สาขาวิชาวิทยาการคอมพิวเตอร์ โครงการปกติ</option>
                                <option>สาขาวิชาวิทยาการคอมพิวเตอร์ โครงการพิเศษ</option>
                                <optgroup label="== สาขาวิชาเทคโนโลยีสารสนเทศ =="></optgroup>
                                <option>สาขาวิชาเทคโนโลยีสารสนเทศ โครงการปกติ</option>
                                <option>สาขาวิชาเทคโนโลยีสารสนเทศ โครงการพิเศษ</option>
                                <optgroup label="== สาขาวิชาภูมิสารสนเทศศาสตร ์ =="></optgroup>
                                <option>สาขาวิชาภูมิสารสนเทศศาสตร โครงการปกติ</option>
                                <option>สาขาวิชาภูมิสารสนเทศศาสตร โครงการพิเศษ</option>
                            </select>
                            <br/>
                            <label>ความสำคัญลำดับที่ 2</label>
                            <select name="sub_type" id="sub_type" class="form-control pointer required ">
                                <option value="" disabled="disabled" selected="selected"> - -
                                    กรุณาความสำคัญลำดับที่ 2 - -
                                </option>
                                <optgroup label="== สาขาวิชาวิทยาการคอมพิวเตอร์ =="></optgroup>
                                <option>สาขาวิชาวิทยาการคอมพิวเตอร์ โครงการปกติ</option>
                                <option>สาขาวิชาวิทยาการคอมพิวเตอร์ โครงการพิเศษ</option>
                                <optgroup label="== สาขาวิชาเทคโนโลยีสารสนเทศ =="></optgroup>
                                <option>สาขาวิชาเทคโนโลยีสารสนเทศ โครงการปกติ</option>
                                <option>สาขาวิชาเทคโนโลยีสารสนเทศ โครงการพิเศษ</option>
                                <optgroup label="== สาขาวิชาภูมิสารสนเทศศาสตร ์ =="></optgroup>
                                <option>สาขาวิชาภูมิสารสนเทศศาสตร โครงการปกติ</option>
                                <option>สาขาวิชาภูมิสารสนเทศศาสตร โครงการพิเศษ</option>
                            </select>
                            <br/>

                            <label>ความสำคัญลำดับที่ 3</label>
                            <select name="sub_type" id="sub_type" class="form-control pointer required ">
                                <option value="" disabled="disabled" selected="selected"> - -
                                    กรุณาความสำคัญลำดับที่ 3 - -
                                </option>
                                <optgroup label="== สาขาวิชาวิทยาการคอมพิวเตอร์ =="></optgroup>
                                <option>สาขาวิชาวิทยาการคอมพิวเตอร์ โครงการปกติ</option>
                                <option>สาขาวิชาวิทยาการคอมพิวเตอร์ โครงการพิเศษ</option>
                                <optgroup label="== สาขาวิชาเทคโนโลยีสารสนเทศ =="></optgroup>
                                <option>สาขาวิชาเทคโนโลยีสารสนเทศ โครงการปกติ</option>
                                <option>สาขาวิชาเทคโนโลยีสารสนเทศ โครงการพิเศษ</option>
                                <optgroup label="== สาขาวิชาภูมิสารสนเทศศาสตร ์ =="></optgroup>
                                <option>สาขาวิชาภูมิสารสนเทศศาสตร โครงการปกติ</option>
                                <option>สาขาวิชาภูมิสารสนเทศศาสตร โครงการพิเศษ</option>
                            </select>
                            <br/>

                            <label>ความสำคัญลำดับที่ 4</label>
                            <select name="sub_type" id="sub_type" class="form-control pointer required ">
                                <option value="" disabled="disabled" selected="selected"> - -
                                    กรุณาความสำคัญลำดับที่ 4 - -
                                </option>
                                <optgroup label="== สาขาวิชาวิทยาการคอมพิวเตอร์ =="></optgroup>
                                <option>สาขาวิชาวิทยาการคอมพิวเตอร์ โครงการปกติ</option>
                                <option>สาขาวิชาวิทยาการคอมพิวเตอร์ โครงการพิเศษ</option>
                                <optgroup label="== สาขาวิชาเทคโนโลยีสารสนเทศ =="></optgroup>
                                <option>สาขาวิชาเทคโนโลยีสารสนเทศ โครงการปกติ</option>
                                <option>สาขาวิชาเทคโนโลยีสารสนเทศ โครงการพิเศษ</option>
                                <optgroup label="== สาขาวิชาภูมิสารสนเทศศาสตร ์ =="></optgroup>
                                <option>สาขาวิชาภูมิสารสนเทศศาสตร โครงการปกติ</option>
                                <option>สาขาวิชาภูมิสารสนเทศศาสตร โครงการพิเศษ</option>
                            </select>
                            <br/>

                            <label>ความสำคัญลำดับที่ 5</label>
                            <select name="sub_type" id="sub_type" class="form-control pointer required ">
                                <option value="" disabled="disabled" selected="selected"> - -
                                    กรุณาความสำคัญลำดับที่ 5 - -
                                </option>
                                <optgroup label="== สาขาวิชาวิทยาการคอมพิวเตอร์ =="></optgroup>
                                <option>สาขาวิชาวิทยาการคอมพิวเตอร์ โครงการปกติ</option>
                                <option>สาขาวิชาวิทยาการคอมพิวเตอร์ โครงการพิเศษ</option>
                                <optgroup label="== สาขาวิชาเทคโนโลยีสารสนเทศ =="></optgroup>
                                <option>สาขาวิชาเทคโนโลยีสารสนเทศ โครงการปกติ</option>
                                <option>สาขาวิชาเทคโนโลยีสารสนเทศ โครงการพิเศษ</option>
                                <optgroup label="== สาขาวิชาภูมิสารสนเทศศาสตร ์ =="></optgroup>
                                <option>สาขาวิชาภูมิสารสนเทศศาสตร โครงการปกติ</option>
                                <option>สาขาวิชาภูมิสารสนเทศศาสตร โครงการพิเศษ</option>
                            </select>
                            <br/>

                            <label>ความสำคัญลำดับที่ 6</label>
                            <select name="sub_type" id="sub_type" class="form-control pointer required ">
                                <option value="" disabled="disabled" selected="selected"> - -
                                    กรุณาความสำคัญลำดับที่ 6 - -
                                </option>
                                <optgroup label="== สาขาวิชาวิทยาการคอมพิวเตอร์ =="></optgroup>
                                <option>สาขาวิชาวิทยาการคอมพิวเตอร์ โครงการปกติ</option>
                                <option>สาขาวิชาวิทยาการคอมพิวเตอร์ โครงการพิเศษ</option>
                                <optgroup label="== สาขาวิชาเทคโนโลยีสารสนเทศ =="></optgroup>
                                <option>สาขาวิชาเทคโนโลยีสารสนเทศ โครงการปกติ</option>
                                <option>สาขาวิชาเทคโนโลยีสารสนเทศ โครงการพิเศษ</option>
                                <optgroup label="== สาขาวิชาภูมิสารสนเทศศาสตร ์ =="></optgroup>
                                <option>สาขาวิชาภูมิสารสนเทศศาสตร โครงการปกติ</option>
                                <option>สาขาวิชาภูมิสารสนเทศศาสตร โครงการพิเศษ</option>
                            </select>
                            <br/>
                            <i class="fancy-arrow-"></i>
                            <br><br>
                            <div align="center"><a href="#saveModal" onclick="#" data-toggle="modal" data-target="#saveModal" class="btn btn-reveal btn-success"><span>เพิ่มวิชาเรียน</span></a></div>
                    </div>
                    </div>




                    </div>

                </form>
            </div>
        </div>
</section>