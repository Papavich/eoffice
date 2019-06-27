<?php

use yii\helpers\Html;

use app\modules\eoffice_asset\assets\AppAssetAsset;
AppAssetAsset::register($this);

?>
<div>
    <!-- page title -->
    <header id="page-header">
        <h1>ดาวน์โหลดแอปพลิเคชัน</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>
            <li class="active">ดาวน์โหลดแอปพลิเคชัน</a></li>
        </ol>
    </header>



    <div id="content" class="padding-20">
        <!--content-->
        <div class="asset-detail-view">

            <center> <a href="http://10.199.66.53/csc05/application/asset_management.apk"><?php echo Html::img('@web/web_asset/images/dowload.png',["width"=>"200px"]) ; ?>
           <h2>ดาวน์โหลดเพื่อติดตั้งแอปพลิเคชัน</h2></a>
           </center>

        </div>
        <!--end content-->
    </div>
</div>