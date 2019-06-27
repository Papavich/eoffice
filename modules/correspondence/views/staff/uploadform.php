<?php

use yii\helpers\Url;
use dosamigos\fileupload\FileUploadUI;

?>
<section id="middle" style="color: black">
    <div id="content" class="padding-30">
        <div id="panel-2" class="panel panel-default">
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>ลงทะเบียนหนังสือรับ</strong> <!-- panel title -->
                </span>
            </div>
            <div class="panel-body">
                ขนาดไฟล์ไม่เกิน 2 MB
                <?= FileUploadUI::widget([
                    'model' => $model,
                    'attribute' => 'file',
                    'url' => ['staff/image'],
                    'gallery' => false,
                    'fieldOptions' => [
                        'accept' => 'image/*'
                    ],
                    'clientOptions' => [
                        'maxFileSize' => 2000000
                    ],
                    // ...
                    'clientEvents' => [
                        'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                                
                            }',
                        'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);                                                        
                            }',

                    ],
                ]); ?>

            </div>
        </div>
    </div>
</section>
<?php
$this->registerJs(<<<JS
$(document).ready(function(){
    $(".fileinput-button").click(function() {
     console.log(" ");
     
        if($(".delete").length > 1) {
             
            console.log($(".delete").length);
            $(".delete").click(function() {
                if (confirm("ต้องการลบใช่หรือไม่ ?")){
                   return true;
                }else{
                 //console.log("ssss");
                 window.stop();
                 return false;                 
                }
            });
        }
    
    });
});
JS
);
?>