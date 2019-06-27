<?php
use yii\helpers\Html;

$this->registerJs(<<<JS
$(document).ready(function(){

  var current_page_URL = window.location.href; 
  $( ".menumail a" ).each(function() {
      
     if ($(this).attr("href") !== "#") { //get element tag a href
       var target_URL = $(this).prop("href");
       if (target_URL == current_page_URL) {
          $('.menumail-box li').parents('li').removeClass('active');
          $(this).parent('li').addClass('active');
          return false;
       }
     }
    });

});
JS
);
?>
<div class="col-md-3 menumail">
    <!--
    <div class="col-md-12">
        <?= Html::a("<button class='btn btn-primary btn-block margin-bottom hvr-grow-shadow'>เขียน</button>",
            ['staff/send'], ['style' => 'color: white', 'target' => '_blank'])
        ?>
    </div>
    -->
    <div class="box box-solid menumail-box">
        <div class="box-body no-padding">
            <ul class="nav  nav-stacked">
                <li>
                    <?= Html::a("<i class='glyphicon glyphicon-star'></i> จดหมายติดดาว",
                        ['user/favmail'], ['class' => 'hvr-float-shadow'])
                    ?>
                </li>
                <li>
                    <?= Html::a("<i class='fa fa-envelope-o'></i> จดหมายที่ส่งแล้ว",
                        ['user/senedmail'], ['class' => 'hvr-float-shadow'])
                    ?>
                </li>
                <li>
                    <?= Html::a("<i class='fa fa-file-text-o'></i> จดหมายร่าง",
                        ['user/drafmail'], ['class' => 'hvr-float-shadow'])
                    ?>
                </li>
                <li>
                    <?= Html::a("<i class='fa fa-filter'></i> จดหมายขยะ
                        <span class='label label-warning pull-right'>65</span>",
                        ['user/junkmail'], ['class' => 'hvr-float-shadow'])
                    ?>
                </li>
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
</div>
