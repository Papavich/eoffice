<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use yii\helpers\Html;
use yii\timeago\TimeAgo;

$this->title =controllers::t( 'label', 'News Status' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'News' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php  if (count($data) == 0) {
    echo "<p align='center'><?=controllers::t( 'label', 'No news waiting to be approved.' )?></p>";
} else { ?>
<div class="table-responsive nomargin">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th><?=controllers::t( 'label', 'Title' )?></th>
            <th><?=controllers::t( 'label', 'By' )?></th>
            <th><?=controllers::t( 'label', 'Time' )?></th>
            <th><?=controllers::t( 'label',  'Status' )?></th>
            <th>#</th>

        </tr>
        </thead>
        <tbody>
        <?php

            foreach ($data as $item) { ?>
                <tr>
                    <td><?php echo $item->title ?></td>
                    <td><?php echo $item->crbyObj->name ?></td>
                    <td><?php echo TimeAgo::widget(['timestamp' => $item->crtime."GMT+7", 'language' => 'th']) ?></td>
                    <td><?php echo $item->newsStatus->desc ?></td>
                    <td><?= Html::a('<i class="fa fa-check-square-o"></i>', ['status', 'id' => $item->id], ['style' => 'color:green;']) ?>

                        <?= Html::a('<i class="fa fa-edit"></i>', ['update', 'id' => $item->id]) ?>
                        <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $item->id], [
                            'style' => 'color:red;',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?></td>
                </tr>

            <?php } ?>

        </tbody>
    </table>
</div>
<?php } ?>