<?php
/**
 * Created by PhpStorm.
 * User: VaraPhon
 * Date: 5/5/2018
 * Time: 12:42 AM
 */
use app\modules\correspondence\controllers;
?>
<div class="modal fade" id="ReceiverModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="panel-ui-tan-l1" class="panel panel-default">

                <div class="panel-heading">
									<span class="elipsis"><!-- panel title -->
                                        <b><?=controllers::t('menu','List of recipients')?></b> <!-- panel title -->
									</span>
                    <!-- tabs nav -->
                    <ul class="nav nav-tabs pull-right tabsetting">
                        <li class="active">
                            <a href="#ttab1_nobg" data-toggle="tab" aria-expanded="true">
                                <?= controllers::t('menu', 'read') ?>
                            </a>
                        </li>
                        <li class="">
                            <a href="#ttab2_nobg" data-toggle="tab"
                               aria-expanded="false"><?= controllers::t('menu', 'unread') ?></a>
                        </li>

                    </ul>
                    <!-- /tabs nav -->
                </div>
            </div>
            <div class="">
                <!-- panel content -->
                <div class="modal-body panel-body padding-20" style="margin: 0px">
                    <!-- tabs content -->
                    <div class="tab-content transparent">
                        <div id="ttab1_nobg" class="tab-pane active"><!-- TAB 1 CONTENT -->
                            <table class="table table-hover nomargin">
                                <tbody>
                                <?php
                                $read = 0;
                                foreach ($receiver as $rows) {
                                    if ($rows['inbox_status'] == "read") {
                                        echo '
                                            <tr>
                                                <td>' .
                                            "<b>" .
                                                $rows->user->prefix_th . $rows->user->fname . " " . $rows->user->lname.
                                            "</b> "
                                            . controllers::DateThaiForMail($rows['read_time'])
                                            . '</td>
                                            </tr>';
                                    } else {
                                        $read++;
                                    }
                                }
                                if (count($receiver) == $read) {
                                    echo '<tr>
                                                <td><b>' . controllers::t('menu', 'No user has read') . '</b></td>
                                            </tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div><!-- /TAB 1 CONTENT -->
                        <div id="ttab2_nobg" class="tab-pane"><!-- TAB 2 CONTENT -->
                            <table class="table table-hover nomargin">
                                <tbody>
                                <?php
                                $read = 0;
                                foreach ($receiver as $rows) {
                                    if ($rows['inbox_status'] == "unread") {
                                        echo '
                                            <tr>
                                                <td>' .
                                            "<b>" .
                                                $rows->user->prefix_th . $rows->user->fname . " " . $rows->user->lname
                                            . '</b>
                                                </td>
                                            </tr>';
                                    }
                                }
                                if (count($receiver) == $read) {
                                    echo '<tr>
                                                <td><b>' . controllers::t('menu', 'All users have read') . '</b></td>
                                            </tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div><!-- /TAB 2 CONTENT -->
                    </div>
                    <!-- /tabs content -->

                </div>
                <!-- /panel content -->
            </div>
        </div>
    </div>
</div>
