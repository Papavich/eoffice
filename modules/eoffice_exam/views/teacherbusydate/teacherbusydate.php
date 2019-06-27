<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use app\modules\eoffice_exam\models\EofficeExamBusydate;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
?>
<div id="content" class="dashboard padding-20">

  <div id="panel-1" class="panel panel-default">
    <div class="panel-heading">
      <span class="title elipsis">
        <strong class="size-20">ระบุวันที่ไม่ว่าง</strong> <!-- panel title -->

      </span>

    </div>


    <!-- panel content -->

  <div class="panel-body">

      <!-- COL 2 -->
      <div class="col-md-12 panel-default">

        <div class="tabs white nomargin-top">
          <ul class="nav nav-tabs tabs-primary">
            <li class="active">
              <a href="#overview" data-toggle="tab">ข้อมูลวันที่ไม่ว่าง</a>
            </li>
            <li>
              <a href="#edit" data-toggle="tab">แก้ไข</a>
            </li>
          </ul>

          <div class="tab-content">

            <!-- Overview -->
            <div id="overview" class="tab-pane active">


              <hr class="invisible half-margins" />

              <!-- COMMENT -->
              <ul class="comment list-unstyled">
                <li class="comment">

                  <!-- avatar -->
                  <?= Html::img('https://infocs.kku.ac.th/csperson/pic/person/Sunti.jpg');?>

                  <!-- comment body -->
                  <div class="comment-body">
                    <a href="#" class="comment-author">
                      <span>ผศ.สันติ ทินตะนัย</span>
                    </a>
                    <p>วันที่ :28/09/2017</p>
                    <p>เวลา : 8.00 - 12.00 น.</p>
                    <p>หมายเหตุ : ติดธุระสำคัญ</p>

                  </div><!-- /comment body -->

                  <!-- options -->
                  <ul class="list-inline size-13 margin-top-10">
                    <li class="pull-right">
                      <a href="#" class="text-danger">Delete</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="text-primary">Edit</a>
                    </li>
                  </ul>
                </li><!-- /options -->

            </ul>
            </div>

            <!-- Edit -->

            <div id="edit" class="tab-pane">


            </div>

          </div>

        </div>

      </div><!-- /COL 2 -->



      </section>
      <!-- /MIDDLE -->


    </div>




    <!-- JAVASCRIPT FILES -->
    <script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
    <script type="text/javascript" src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>

    <!-- PAGE LEVEL SCRIPT -->


<!-- STYLESWITCHER - REMOVE -->
<script async type="text/javascript" src="assets/plugins/styleswitcher/styleswitcher.js"></script>
</body>
