<?php
use yii\helpers\Html;
?>



  <!-- page title -->
  <header id="page-header">
    <h1>ดูห้องสอบ</h1><br>
    <small class="size-12 weight-400 text-mutted hidden-xs">573020438-0 ศักดิ์ดา ประทุมชมภู</small>
  </header>
  <br>
  <!-- /page title -->

  <!-- table -->
  <div class="fancy-form fancy-form-select text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-offset-7 col-lg-4">
          <input type="text" name="search" placeholder="Search..">
        </div>
      </div>
    </div>

    <br>
<!--
    <div class="container">
        <div class="text-left">
          <h3><strong>ชื่อ	</strong>ศักดิ์ดา ประทุมชมภู<br>
            <strong>สถานภาพ	</strong>นักศึกษาปัจจุบัน สถานะปกติ<br>
            <strong>คณะ	</strong>คณะวิทยาศาสตร์<br>
            <strong>หลักสูตร	</strong>เทคโนโลยีสารสนเทศและการสื่อสาร<br>
            <strong>อ. ที่ปรึกษา	</strong>อ.ดร.จักรชัย โสอินทร์</h3> -->

            <div class="fancy-form fancy-form-select text-center">
              <div class="container">
                <div class="row">
                  <div class="col-lg-offset-2 col-lg-8">
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                      <thead>
                        <tr>
                          <th class="text-center">รหัสวิชา</th>
                          <th class="text-center">ชื่อวิชา</th>
                          <th class="text-center">วันที่สอบ</th>
                          <th class="text-center">เวลาสอบ</th>
                          <th class="text-center">ห้องสอบ</th>
                          <th class="text-center">ที่นั่งสอบ</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td>
                            322117
                          </td>
                          <td>
                            Computer Programming 1
                          </td>
                          <td>
                            27/3/2017
                          </td>
                          <td>
                            09.30-12.00 น.
                          </td>
                          <td>
                            8503
                          </td>
                          <td>
                            <a data-toggle="modal" data-target="#myModal">A7</a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            322161
                          </td>
                          <td>
                            Introduction To ICT
                          </td>
                          <td>
                            27/3/2017
                          </td>
                          <td>
                            13.00-16.00 น.
                          </td>
                          <td>
                            8503
                          </td>
                          <td>
                            <a data-toggle="modal" data-target="#myModal">A7</a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            322347
                          </td>
                          <td>
                            MIT
                          </td>
                          <td>
                            28/3/2017
                          </td>
                          <td>
                            13.00-16.00 น.
                          </td>
                          <td>
                            8505
                          </td>
                          <td>
                            <a data-toggle="modal" data-target="#myModal">A7</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </section>
            <!-- /MIDDLE -->

          </div>

          <!--modal-->
          <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">ที่นั่งสอบ</h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                  <?=Html::img(Yii::getAlias('@web').'/img/seat.PNG', ['class' => 'img-responsive'])?>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

              </div>
            </div>
          </div>
