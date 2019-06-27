<?php
foreach ( $model as $key => $value) {
    ?>
    <div id="panel-2" class="panel panel-default border-box-list">
        <div class="panel-heading ">
                <span class="title elipsis">
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <strong><?= $value['material']->material_name ?> (<?= $value['material']->material_id ?></strong>)
                    <!-- panel title -->
                    <small class="size-12 weight-300 text-mutted hidden-xs">จำนนวน <?= $value['value']['bill_detaill_amount'] ?></small>
                </span>
            <!-- right options -->
            <ul class="options pull-right list-inline">
                <li><a href="#" class="glyphicon glyphicon-wrench" data-toggle="modal" data-target="#modaledit"
                       onclick="setEditlist(<?= $value['count'] ?>)"></a></li>
                <li><a href="#" name="delete" class="glyphicon glyphicon-trash" onclick="setDeleteList(<?= $value['count'] ?>)"
                       data-toggle="modal" data-target="#modaldelete"></a></li>
            </ul>
            <!-- /right options -->
        </div>
    </div>
    <?php
}
?>
<input type='hidden' id='valueamount' value='<?= $amountlist ?>'>
<input type='hidden' id='priceoutput' value='<?=  $allprice ?>'>