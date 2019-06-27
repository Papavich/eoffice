<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 27/11/2560
 * Time: 12:48
 */


use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;
?>
<?php
$title = controllers::t('label','Setting Calculate');
$create = controllers::t( 'label', 'Create' );
$back = controllers::t( 'label', 'Back' );
$cal_active = controllers::t( 'label', 'Calculate Active' );
$this->title = $title;
$this->params['breadcrumbs'][] = $title;
?>

<div id="content" class="padding-10">
    <!-- ********************************************* เกณฑ์สัดส่วนผู้ช่วยสอน ******************************** -->
    <div class="panel-body">
      <div class="row">
        <!-- COL 1 -->


        <!-- COL 1 -->
        <div class="col-md-3 col-lg-3">
            <div class="panel-body noradius padding-10">
                <div align="center">
                    <a  href=" <?= Url::to(['ta-type-rule/index']) ?>" >
                        <?=Html::img(Yii::getAlias('@web').'/web_ta/images/calculate.png',
                            ['class' => 'img-responsive ', 'width' => 85, 'height' => 85])?>
                        <strong class="control-label size-20" ><br>
                            <i class="fa fa-wrench"></i> ตั้งค่าประเภทสูตร</strong>
                    </a>
                </div>
            </div>
        </div><!-- /COL 1 -->

        <!-- COL 3 -->
        <div class="col-md-3 col-lg-3">
            <div class="panel-body noradius padding-10">
                <div align="center">
                    <a  href=" <?= Url::to(['ta-variable/index']) ?>" >
                        <?=Html::img(Yii::getAlias('@web').'/web_ta/images/equation1.png',
                            ['class' => 'img-responsive ', 'width' => 90, 'height' => 90])?>
                        <strong class="control-label size-20" ><br>
                            <i class="fa fa-wrench"></i> ตั้งค่าตัวแปร</strong>
                    </a>
                </div>
            </div>
        </div><!-- /COL 3 -->
          <!-- COL 5 -->
          <div class="col-md-3 col-lg-3">
              <div class="panel-body noradius padding-10">
                  <div align="center">

                      <a  href=" <?= Url::to(['ta-equation/index']) ?>" >
                          <?=Html::img(Yii::getAlias('@web').'/web_ta/images/variable.png',
                              ['class' => 'img-responsive ', 'width' => 90, 'height' => 80])?>
                          <strong class="control-label size-20" ><br>
                              <i class="fa fa-wrench"></i>ตั้งค่าสูตรคำนวณ</strong>
                      </a>

                  </div>
              </div>
          </div><!-- /COL 5 -->
      </div>






    </div>
</div>


