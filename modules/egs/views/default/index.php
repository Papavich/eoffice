<?php /* @var $params array */ ?>
<link href="<?= Yii::getAlias('@web/web_egs/css/react-table.css') ?>" rel="stylesheet"/>
<link href="<?= Yii::getAlias('@web/web_egs/css/tippy.css') ?>" rel="stylesheet"/>
<link href="<?= Yii::getAlias('@web/web_egs/css/react-redux-toastr.min.css') ?>" rel="stylesheet"/>
<link href="<?= Yii::getAlias("@web/web_egs/css/fullcalendar.min.css") ?>" rel="stylesheet"/>
<link href="<?= Yii::getAlias("@web/web_egs/css/daterangepicker.css") ?>" rel="stylesheet"/>
<link href="<?= Yii::getAlias("@web/web_egs/css/antd.min.css") ?>" rel="stylesheet"/>
<link href="<?= Yii::getAlias('@web/web_egs/css/dawae.css') ?>" rel="stylesheet"/>
<div id="app"></div>
<script src="<?= Yii::getAlias("@web/web_egs/js/moment-with-locales.js") ?>"></script>
<script src="<?= Yii::getAlias("@web/web_egs/js/fullcalendar.min.js") ?>"></script>
<script src="<?= Yii::getAlias("@web/web_egs/js/th.js") ?>"></script>
<script>
    moment.locale('<?= \app\modules\egs\controllers\Config::get_language() ?>')
    const params = {
    <?php if(isset($params)){
    foreach ($params as $index => $param) { ?>
    <?= $index ?>: <?= $param ?>,
    <?php }
    } ?>
    }
</script>
<script src="<?= Yii::getAlias("@web/web_egs/react/public/app.min.js") ?>"></script>