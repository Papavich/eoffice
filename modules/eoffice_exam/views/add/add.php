<?php
/* @var $this yii\web\View */
?>

  <div id="panel-1" class="panel panel-default">
      <div class="panel-heading">
        <span class="title elipsis">
          <strong class="size-20">นำข้อมูลเข้าสู่ระบบ</strong> <!-- panel title -->
        </span>


      </div>

      <!-- panel content -->
      <div class="panel-body">
        <div class="col-md-9">

          <label>
            ปีการศึกษา
          </label>
          <select class="form-control select2">
            <option value="">--- ระบุปีการศึกษา ---</option>
            <option value="1">2017</option>
            <option value="2">2016</option>
          </select>

          <hr/>

          <label>
            เทอม
          </label>
          <select class="form-control select2">
            <option value="">--- ระบุเทอม ---</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>

          <hr/>

          <br/>
          <div align="right">
            <a href="#" class="btn btn-3d btn-reveal btn-aqua">
              <i class="glyphicon glyphicon-refresh"></i>
              <span>ประมวลผล</span>
            </a>
          </div>

          <strong>แสดงข้อมูล</strong>
          <!-- Table -->

          <table class="table table-bordered nomargin">
            <thead>

              <tr>
                <th>รหัสวิชา</th>
                <th>ชื่อวิชา</th>
                <th>ชื่อวิชาภาษาอังกฤษ</th>
                <th>วันที่สอบ</th>
                <th>เวลาที่เริ่มสอบ</th>
                <th>เวลาสิ้นสุดการสอบ</th>
                <th>กลุ่ม</th>

              </tr>
            </thead>
            <tr>
              <td>322235</td>
              <td>การทดสอบซอฟต์แวร์</td>
              <td>SOFTWARE TESTING</td>
              <td>26/9/2017</td>
              <td>08:30</td>
              <td>11:30</td>
              <td>1</td>
            </tr>

            <tr>
              <td>322494</td>
              <td>โครงการคอมพิวเตอร์ 1</td>
              <td>COMPUTER PROJECT I</td>
              <td>27/9/2017</td>
              <td>13:00</td>
              <td>15:00</td>
              <td>1</td>
            </tr>

            <tr>
              <td>322372</td>
              <td>การวิเคราะห์และออกแบบระบบ</td>
              <td>SYSTEMS ANALYSIS AND DESIGN</td>
              <td>27/9/2017</td>
              <td>WBA</td>
              <td>-</td>
              <td>1</td>
            </tr>


          </table>
          <br>

          <div align="right">
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <li>
                  <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                  <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>

          <center>
            <a href="#" class="btn btn-3d btn-reveal btn-green">
            <i class="glyphicon glyphicon-save"></i>
              <span>เชื่อมต่อข้อมูล</span>
            </a>
          </center>


        </div>




      </div>





</section>
<!-- /MIDDLE -->
