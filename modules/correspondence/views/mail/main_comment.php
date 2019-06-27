<?php

use app\modules\correspondence\controllers;
use \yii\helpers\Html;
$_SESSION['limit'] = 3;
?>
<div class="row padding-50" id="comments-container" style="text-align: center">
    <br><br>
    <h1 class="page-header comment">Comments</h1>
    <section class="comment-list"  style="margin-bottom: 20px">
        <!-- Comment -->
        <script>
            var countLimit = <?=count($inbox_reply)?>;
        </script>
        <?php foreach ($inbox_reply as $comments) {

            if ($comments['message_reply']) {
                ?>
                <?= $this->render('comments', ['comments' => $comments]) ?>
            <?php } elseif ($comments['message_approve']) { ?>
                <?= $this->render('comment_approve', ['comments' => $comments]) ?>

                <?php
            }
        }
        ?>
<!--        <div class="pull-right"><a href="#" class="pull-right">Read more</a></div>-->
        <span id="textCancel" style="display: none">
            <?= ($inbox_reply ? controllers::t('menu','** Can be canceled within 1 minute (except for approval)')
                : '');
            ?>
        </span>
    </section>
    <div style="border: 2px solid grey; margin: 0 0 10px 10px"></div>
    <?php
    // display pagination
    echo \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
    ]);
    ?>
</div>
</div>
<!-- /.mailbox-read-message -->
</div>
<!-- /.box-body -->
<?= $this->render('form_comment', ['model_document' => $model_document,'inbox'=>true]) ?>
<script>
    var xmlHttp;
    var message, inbox;

    function send(event) {
        xmlHttp = new XMLHttpRequest();
        var keyword = document.getElementById("keyword-forward").value;

        if (event.keyCode == 13) {  // ��ҡ� Enter
            // document.location = "productDetail2.php?pname=" + keyword;

        } else if (event.keyCode != 40) {
            var url = "search-user?keyword=" + keyword;
            xmlHttp.open("GET", url);
            xmlHttp.onreadystatechange = showListName;
            xmlHttp.send();
        }
    }

    function showListName() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            document.getElementById("forward-name").innerHTML = xmlHttp.responseText;
        }
    }

    function redirectId(mes, ib) {
        message = mes.toString();
        inbox = ib.toString();

    }
</script>
