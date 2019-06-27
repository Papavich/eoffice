<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 5/3/2561
 * Time: 2:54
 */
?>
<style>
    /* Chat containers */
    .container {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
    }

    /* Darker chat container */
    .darker {
        border-color: #ccc;
        background-color: #ddd;
    }

    /* Clear floats */
    .container::after {
        content: "";
        clear: both;
        display: table;
    }

    /* Style images */
    .container img {
        float: left;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
    }

    /* Style the right image */
    .container img.right {
        float: right;
        margin-left: 20px;
        margin-right: 0;
    }

    /* Style time text */
    .time-right {
        float: right;
        color: #aaa;
    }

    /* Style time text */
    .time-left {
        float: left;
        color: #999;
    }
</style>
<div id="content" class="padding-20">
    <div class="panel-body">
        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <h3>ความเห็นอาจารย์</h3>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label><b>ชื่อโครงงาน : โปรแกรมการหาตำแหน่งม่านตา ปีการศึกษา 2560</b></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <br>
                <div class="container" style="width:1000px;margin: auto;">
                    <img src="<?= Yii::getAlias('@web') ?>/web_scb/images/comment-ava.png" alt="Avatar">
                    <p>โปรเจคสามารถนำไปต่อยอดและประยุกต์กับเทคโนโลยีการแพทย์ได้ดี</p>
                    <span class="time-right">ผศ.สันติ  ทินตะนัย <br>(อาจารย์ที่ปรึกษาทุน)<br>12/1/2561</span>
                </div>
                <br>
                <div class="container darker" style="width:1000px;margin: auto;">
                    <img src="<?= Yii::getAlias('@web') ?>/web_scb/images/comment-ava.png" alt="Avatar" class="right">
                    <p>แนะนำพัฒนาต่อไปโดยเน้นอัลกอลิทึมเป็นหลัก</p>
                    <span class="time-left">อ.ดร.สายยัญ สายยศ<br>(อาจารย์ที่ปรึกษาโปรเจค)<br>16/1/2561</span>
                </div>
                <br>
                <div class="container" style="width:1000px;margin: auto;">
                    <img src="<?= Yii::getAlias('@web') ?>/web_scb/images/comment-ava.png" alt="Avatar">
                    <p>แนะนำติดต่อท่านอาจารย์คณะแพทยศาสตร์เพื่อเชิญมาเป็นอาจารย์ที่ปรึกษาร่วมในการพัฒนาโปรเจค</p>
                    <span class="time-right">อ.ดร.นันท์นภัส ม่วงมิ่งสุข<br>(อาจารย์กรรมการทุน)<br>17/1/2561</span>
                </div>

            </div>
        </div>

    </div>
</div>

