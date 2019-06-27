<?php

use app\modules\correspondence\controllers;

$this->registerCss("
table tbody tr td a {
  display: block;
  width: 100%;
  color: black;
}
tr.hover {
  cursor: pointer;
}
a:hover{
  color: black;
}
.scrollable-menu {
    height: auto;
    max-height: 150px;
    overflow-x: hidden;
}
.box{
    margin-bottom:50px;
}
");
$this->registerJsFile('@web/../modules/correspondence/style/js/mail-input.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/../modules/correspondence/style/js/mail.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<div class="box-header with-border">
    <div class="col-xs-4">
        <h3 style="color: black"><?php if (Yii::$app->controller->action->id == 'inbox') echo controllers::t('menu', 'Inbox');
            if ($this->title == 'จดหมายติดดาว') echo controllers::t('menu', 'Starred');
            if ($this->title == 'จดหมายขยะ') echo controllers::t('menu', 'Trash');
            if ($this->title == 'จดหมายที่ส่งแล้ว') echo controllers::t('menu', 'Sent Mail');
            if ($this->title == 'ป้ายกำกับ') echo controllers::t('menu', 'Labels') ?></h3>
    </div>
    <?php
    if (Yii::$app->controller->action->id != "labels"):
        ?>
        <div class="pull-right col-xs-4" id="new-search-area">
            <?php $form = \yii\widgets\ActiveForm::begin([
                'action' => [Yii::$app->controller->action->id],
                'method' => 'get',
                'options' => [
                    'style' => 'margin: 0;'
                ],
            ]); ?>
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Search for..."
                       value="<?php echo Yii::$app->request->get('keyword') ?>">
                <span class="input-group-btn">
                <?= \yii\helpers\Html::submitButton('<i class="fa fa-lg fa-search"></i>'
                    , ['class' => 'btn btn-default',]) ?>
            </span>
            </div><!-- /input-group -->
            <input type="hidden" name="id" value="<?= Yii::$app->controller->action->id ?>">
            <input type="hidden" name="search_by" value="searchBySubject">
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    <?php
    endif;
    ?>
    <!-- /.box-tools -->
</div>
<!-- /.box-header -->
<div class="box-body no-padding">
    <div class="mailbox-controls row" style="margin-left: 0; margin-right: 0; padding: 0">
        <!-- Check all button -->
        <form method='post' id='trash_mail' style="margin-bottom: 0">
            <div class="mail-options">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                        <i class="fa fa-square-o" style="width: 20px"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" id="readAll"><?=controllers::t('menu', 'read all' )?></a></li>
                        <li><a href="#" id="starAll"><?=controllers::t('menu', 'add to favorite' )?></a></li>
                        <li><a href="#" id="unstarAll"><?=controllers::t('menu', 'remove from favorite' )?></a></li>
                    </ul>
                </div>
                <div class="mail-header-tools btn-group" style="display: none">
                    <?=
                    (Yii::$app->controller->action->id == "labels" ?
                        '<button type="button" class="btn btn-default btn-sm remove-label">
                        <b>'.controllers::t('menu','Remove label').'</b>
                    </button>' : ''
                    )
                    ?>
                    <button type="submit" class="btn btn-default btn-sm button-trash"><i class="fa fa-trash-o"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-sm button-refresh"><i class="fa fa-refresh"></i>
                    </button>
                    <?php if(Yii::$app->controller->action->id != "sent-mail"): ?>
                    <div class="btn-group">
                        <button class="btn btn-default btn-sm button-label dropdown-toggle" type="button"
                                id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        title="<?=controllers::t('menu','Labels')?>">
                            <i class="glyphicon glyphicon-tag"></i>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu scrollable-menu" role="menu"
                            aria-labelledby="dropdownMenu1">
                            <span style="color: #1E252D; padding-left: 5px"><?= controllers::t('menu', 'Label as') ?>:</span><br>
                            <?php
                            if ($model_label) {
                                foreach ($model_label as $label) {
                                    echo '<li><a href="?sort=' . $searchData["sort"] . '&id=' . $label->inbox_label_id . '" 
                                            class="addInboxInLabel">
                            <span>' . $label->label_name . '</span>
                            </a></li>';
                                }
                            }
                            ?>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="#NewLabelModal" class="btn" data-toggle="modal" data-whatever="@mdo">
                                    <?= controllers::t('menu', 'Create new label') ?>
                                </a>
                            </li>
                            <li>
                                <?= \yii\helpers\Html::a(controllers::t('menu', 'Set up your label'),
                                    ['mail/labels'], ['class' => 'btn']); ?>
                            </li>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        <b> <?=controllers::t('menu', 'Order by' )?>:</b>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu scrollable-menu" role="menu">
                        <li><a href="?sort=-inbox_time&id=<?php echo $searchData["id"] ?>"><i
                                        class="fa fa-caret-right"></i>
                            <?=controllers::t('menu','New to Old')?>
                            </a></li>
                        <li><a href="?sort=inbox_time&id=<?= $searchData["id"] ?>"><i class="fa fa-caret-right"></i>
                                <?=controllers::t('menu','Old to New')?>
                            </a>
                        </li>
                        <li><a href="?sort=-speed&id=<?= $searchData["id"] ?>"><i class="fa fa-caret-right"></i>
                                <?=controllers::t('menu','Speed')?>
                            </a>
                        </li>
                        <li><a href="?sort=-secret&id=<?= $searchData["id"] ?>"><i class="fa fa-caret-right"></i>
                                <?=controllers::t('menu','Secret')?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li style="color: grey;"><b> <?=controllers::t('menu','Change view')?></b></li>
                        <li><a href="category""><i class="fa fa-caret-right"></i>
                            <?=controllers::t('menu','show by document file and category')?>
                            </a></li>
                        <li><a href="inbox"><i class="fa fa-caret-right"></i>
                                <?=controllers::t('menu','normal')?>
                            </a></li>
                    </ul>
                    <div style="float: left; margin-top: 2px">
                        <span style="margin-left: 10px" class="label label-warning" id="filterMail"></span></div>
                </div>

                <div class="pull-right">
                    <?php echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                        'firstPageLabel' => false,
                        'lastPageLabel' => false,
                        'prevPageLabel' => '<i class="glyphicon glyphicon-chevron-left" style="height: 5px"></i>',
                        'nextPageLabel' => '<i class="glyphicon glyphicon-chevron-right"></i>',
                        'maxButtonCount' => false,

                    ]);
                    ?>
                </div>
            </div>
            <div style="border: 0.5px solid #F2F0F0; margin-top: 5px"></div>
            <style>
                .footer {
                    position: fixed;
                    left: 0;
                    bottom: 0;
                    width: 82%;
                    font-size: 16px;
                    text-align: center;
                    margin-left: 17%;
                    background: white;
                    border-top: 4px solid #606060;
                    padding: 5px;
                    height: auto;
                }
            </style>
            <div class="footer" style="color: black">
                <span><b><?=controllers::t('menu', 'Speed')?> : </b></span>
                <img src="<?= Yii::getAlias('@web/..') ?>/modules/correspondence/style/images/high-voltage%20(4).png"
                     title="ลับปกติ" height="20"/> <?=controllers::t('menu', 'Normal speed')?>
                <img src="<?= Yii::getAlias('@web/..')  ?>/modules/correspondence/style/images/high-voltage%20(3).png"
                     title="ลับ" height="20"/> <?=controllers::t('menu', 'express')?>
                <img src="<?= Yii::getAlias('@web/..')  ?>/modules/correspondence/style/images/high-voltage%20(1).png"
                     title="ลับมาก" height="20"/> <?= controllers::t('menu', 'Very urgent')?>
                <img src="<?= Yii::getAlias('@web/..')  ?>/modules/correspondence/style/images/high-voltage%20(2).png"
                     title="ลับที่สุด" height="20"/> <?= controllers::t('menu', 'Most urgent')?>
                <span style="padding-left: 25px;"><b><?=controllers::t('menu', 'Secret')?> : </b></span>
                <img src="<?= Yii::getAlias('@web/..')  ?>/modules/correspondence/style/images/padlock%20(3).png"
                     title="เร็วปกติ" height="20"/> <?=controllers::t('menu', 'Normal secret')?>
                <img src="<?= Yii::getAlias('@web/..')  ?>/modules/correspondence/style/images/padlock%20(2).png"
                     title="ด่วน" height="20"/> <?=controllers::t('menu', 'secret')?>
                <img src="<?= Yii::getAlias('@web/..')  ?>/modules/correspondence/style/images/padlock%20(1).png"
                     title="ด่วนมาก" height="20"/> <?= controllers::t('menu', 'Very secret')?>
                <img src="<?= Yii::getAlias('@web/..')  ?>/modules/correspondence/style/images/padlock.png"
                     title="ด่วนที่สุด" height="20"/> <?= controllers::t('menu', 'Most secret')?>

            </div>
    </div>
<script>
var errorAddLabelHeader = "<?=controllers::t('menu','Something went wrong!')?>";
var errorAddLabelContent = "<?=controllers::t('menu','Labels have label already')?>";
var errorLabelNotUnique = "<?=controllers::t('menu','Label names must be unique.')?>";
</script>
