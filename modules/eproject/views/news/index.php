<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use yii\helpers\Url;
use yii\timeago\TimeAgo;
use yii\widgets\LinkPager;

$this->title =controllers::t( 'label', 'News' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
foreach ($data as $item) { ?>
    <a href="<?php echo Url::toRoute(['news/view', 'id' => $item->id]);?>">
        <div class="alert alert-bordered-dotted margin-bottom-3 padding-3"><!-- DEFAULT -->
            <strong> <?php echo $item->title;?> </strong>
            <span style="color: black">- <?=controllers::t( 'label', 'By' )?> <?php echo $item->crbyObj->name?> ( <i><?php echo TimeAgo::widget(['timestamp' => $item->crtime."GMT+7",]) ?></i> )</span>
        </div>
    </a>
<?php } ?>


<!-- pagination -->
<div class="text-center">
    <?php
    echo LinkPager::widget([
        'pagination' => $pages,
    ]);
    ?>
</div>




