<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 4/3/2561
 * Time: 21:39
 */

?>

<div id="content" class="padding-20">
    <div class="panel-body">
        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <h3>เพิ่มแผนงานนักศึกษา</h3>
                    <div class="form-group">
                        <div class="row">

                            <div class="col-md-4">
                                <label>ชื่อแผนงาน</label>
                                <input type="text" name="contact[province]" value=""
                                       class="form-control required">
                            </div>
                            <div class="col-md-3">
                                <label>วันที่เริ่ม</label>
                                <input type="text" name="port_date1" value=""
                                       class="form-control datepicker"
                                       data-format="yyyy-mm-dd"
                                       data-lang="en" data-RTL="false"
                                       placeholder="yyyy-mm-dd"
                                       style="width: 250px;">
                            </div>
                            <div class="col-md-3">
                                <label>วันที่สิ้นสุด</label>
                                <input type="text" name="port_date1" value=""
                                       class="form-control datepicker"
                                       data-format="yyyy-mm-dd"
                                       data-lang="en" data-RTL="false"
                                       placeholder="yyyy-mm-dd"
                                       style="width: 250px;">
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <label>รายละเอียด</label>
                            <div class="fancy-form">
                                            <textarea rows="5" class="form-control word-count" data-maxlength="200"
                                                      data-info="textarea-words-info"
                                                      placeholder="รายละเอียดกิจกรรม"></textarea>

                                <i class="fa fa-comments"><!-- icon --></i>

                                <span class="fancy-hint size-11 text-muted">
		<strong>Hint:</strong> 200 words allowed!
		<span class="pull-right">
			<span id="textarea-words-info">0/200</span> Words
		</span>
	</span>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 pull-right">
                            <button type="button" class="btn btn-success">บันทึก</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


