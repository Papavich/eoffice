<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 5/3/2561
 * Time: 2:54
 */
?>
<div id="content" class="padding-20">
    <div class="panel-body">
        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <h3>ลงความเห็น</h3>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label><b>ชื่อโครงงาน : โปรแกรมการหาตำแหน่งม่านตา ปีการศึกษา 2560</b></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                        <div class="col-md-4">
                            <label>ลงในนาม</label>
                            <select name="contact[position]" class="form-control pointer required">
                                <option disabled selected>------</option>
                                <option value="2559">กรรมการทุน</option>
                                <option value="2558">อาจารย์ที่ปรึกษาทุน</option>
                                <option value="2557">อาจารย์ที่ปรึกษาโครงงาน</option>
                            </select>
                        </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-11">
                            <br>
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
