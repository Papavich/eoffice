<?php
/* @var $this yii\web\View */
?>

<div id="panel-1" class="panel panel-default">
    <div class="panel-heading">
      <span class="title elipsis">
        <strong class="size-20">การจัดทำรายงาน</strong> <!-- panel title -->
      </span>


    </div>

    <!-- panel content -->
    <div class="panel-body">


          <strong>ประเภทรายงาน</strong>
          <div class="fancy-form fancy-form-select">
	           <select class="form-control">
		             <option value="">---เลือกประเภทรายงาน ---</option>
		             <option value="1">รายงานนักศึกษา</option>
		             <option value="2">รายงานห้องสอบ</option>
		             <option value="3">รายงานกรรมการคุมสอบ</option>
             </select>
             <i class="fancy-arrow"></i>
          </div>

          <div class="row">
            <div class="col-md-12">
          <div class="form-group">
             <label for="inputsm">ประจำปีการศึกษา:</label>
             <input class="form-control input-sm" id="inputsm" type="text">
           </div>
         </div>
       </div>

          <div class="fancy-form fancy-form-select">
             <select class="form-control">
                 <option value="">---เลือกประเภทการสอบ ---</option>
                 <option value="1">การสอบกลางภาค</option>
                 <option value="2">การสอบปลายภาค</option>
             </select>
             <i class="fancy-arrow"></i>
          </div>


          <div class="col-md-12" >
          <strong>วันที่</strong><br/>
             <input type="text" class="form-control datepicker"  data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
          </div>


          <div class="col-md-12" ><br/>
            <a class="btn btn-3d btn-reveal btn-blue">
              <i class="et-tools"></i>
              <span>แก้ไขรายงาน</span>
            </a>
          </div>

        </body>

    </div>
</div>
