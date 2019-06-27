<?php

use app\modules\eoffice_materialsys\assets\AssetTheme;
use app\modules\eoffice_materialsys\assets\AssetModule;
use yii\helpers\Html;
use app\modules\personsystem\models\User;
use app\modules\eoffice_materialsys\models\MatsysOrderHasMaterial;
use app\modules\eoffice_materialsys\models\MatsysOrder;

AssetTheme::register($this);
AssetModule::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ระบบจัดการวัสดุ</title>
    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"/>
    <?= Html::csrfMetaTags() ?>
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="wrapper" class="clearfix">
    <!-- ASIDE -->
    <aside id="aside">
        <!--
            Always open:
            <li class="active alays-open">

            LABELS:
                <span class="label label-danger pull-right">1</span>
                <span class="label label-default pull-right">1</span>
                <span class="label label-warning pull-right">1</span>
                <span class="label label-success pull-right">1</span>
                <span class="label label-info pull-right">1</span>
        -->
        <nav id="sideNav"><!-- MAIN MENU -->
            <ul class="nav nav-list">
                <?php $fakedModel = (object)['title'=> 'A Product', 'image' => 'http://placehold.it/350x150']; ?>
                <?= \app\components\Mywidget::widget(['model' => $fakedModel]); ?>
            </ul>
        </nav>

        <span id="asidebg"><!-- aside fixed background --></span>
    </aside>
    <!-- /ASIDE -->

    <!-- HEADER -->
    <header id="header">

        <!-- Mobile Button -->
        <button id="mobileMenuBtn"></button>

        <!-- Logo -->
        <span class="logo pull-left">
					<img src="<?= Yii::getAlias('@web') ?>/images/logo_light.png" alt="admin panel" height="35"/>
				</span>
        <!-- End Logo -->


        <nav>
            <!-- OPTIONS LIST -->
            <ul class="nav pull-right">
                <li class="dropdown pull-left">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <img class="user-avatar" alt="" src="<?= Yii::getAlias('@web') ?>/images/noavatar.jpg"
                             height="34"/>
                        <span class="user-name">
									<span class="hidden-xs">
										 <?php
                                         if (!Yii::$app->user->isGuest) {
                                             if (Yii::$app->user->identity->username == 'admin') {
                                                 print('Account(' . Yii::$app->user->identity->username . ')');
                                             } else {
                                                 print('Account(' . \app\modules\eoffice_materialsys\models\User::getFullname(Yii::$app->user->identity->getId()) . ')');
                                             }
                                         } else {
                                             print "ยังไม่ได้เข้าสู่ระบบ";
                                         }
                                         ?>
									</span>
								</span>
                    </a>
                    <ul class="dropdown-menu hold-on-click">
                        <?php
                        if (!Yii::$app->user->isGuest) {
                            if (Yii::$app->user->identity->username == 'admin') {
                                ?>
                                <li>
                                    <a href="<?= Yii::getAlias('@web') ?>/admin/user"> Admin</a>
                                </li>
                                <?php
                            } else {
                            }
                            ?>
                            <li>
                                <?php $modelUser = User::findOne(Yii::$app->user->identity->id);
                                if ($modelUser->type == 1) {
                                    $modelUser->type = "teacher";
                                } else if ($modelUser->type == 2) {
                                    $modelUser->type = "staff";
                                } else if ($modelUser->type == 0) {
                                    $modelUser->type = "student";
                                } else {
                                    $modelUser->type = "guest";
                                }
                                ?>
                                <a href="<?= Yii::getAlias('@web') ?>/personsystem/profile/<?= $modelUser->type ?>">Profile</a>
                            </li>
                            <li class="divider"></li>
                            <form action="<?= Yii::getAlias('@web') ?>/site/logout" method="post">
                                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                                <button type="submit" class="btn btn-link logout">Log Out</button>
                            </form>
                        <?php } else {
                            ?>
                            <li>
                                <a href="<?= Yii::getAlias('@web') ?>/user/security/login">Log in</a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="pull-right" style="padding-top: 4px">
            <?= \yii\helpers\Html::a('<img src="' . Yii::$app->homeUrl . 'images/th.png" height="14"/>', ['language/change?lang=th']) ?>
            <br>
            <?= \yii\helpers\Html::a('<img src="' . Yii::$app->homeUrl . 'images/en.png" height="14"/>', ['language/change?lang=en']) ?>
        </div>
        <?php
        if (!Yii::$app->user->isGuest) { ?>
            <nav id="layout-cart">
                <!-- OPTIONS LIST -->
                <ul class="nav pull-right">
                    <li class="dropdown pull-left">
                        <a href="#" id="myCart" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true" style="padding: 0 10px 0 5px !important;">
                            <i class="fa fa-3x fa-shopping-cart" aria-hidden="true"></i>
                            <?php
                            $id = Yii::$app->user->identity->getId();
                            if (MatsysOrder::searchConfirmbill($id) != 'false') {
                                $bill = MatsysOrder::searchConfirmbill($id);
                                $bill_id = $bill->order_id;
                                ?>
                                <script type="text/javascript">
                                    var status_cart = true;
                                </script>
                                <span class="badge my-badge"><?= MatsysOrderHasMaterial::allAmountInOrder($bill_id) ?></span>
                            <?php } else {
                                ?>
                                <script type="text/javascript">
                                    var status_cart = false;
                                </script>
                                <span class="badge my-badge">0</span>
                                <?php
                            } ?>
                        </a>
                        <?php
                        if (MatsysOrder::searchConfirmbill($id) != 'false') {
                            ?>
                            <ul class="dropdown-menu hold-on-click" style="width: 320px !important">
                                <table class="table table-hover"
                                       style="color: #1e1e1e;width:300px;margin: 0 10px !important">
                                    <tr>
                                        <th>รายชื่อวัสดุ</th>
                                        <th>จำนวน</th>
                                    </tr>
                                    <tbody id="layout-cart-tbody">
                                    <?php
                                    if (MatsysOrder::searchConfirmbill($id) != 'false') {
                                        $bill = MatsysOrder::searchConfirmbill($id);
                                        $bill_id = $bill->order_id;
                                        $items = MatsysOrderHasMaterial::getMainmaterial($bill_id);
                                        foreach ($items as $key => $value) {
                                            ?>
                                            <tr>
                                                <td><?= $value->materialdetail->material_name ?></td>
                                                <td><?= $value->material_amount ?> <?= $value->materialdetail->material_unit_name ?></td>
                                            </tr>
                                        <?php }
                                    } else {
                                        ?>
                                        <?php
                                    } ?>
                                    </tbody>
                                </table>
                                <li class="pull-right margin-right-6">
                                    <button onclick="location.href='../widen'" class="btn btn-info btn-sm">
                                        ไปหน้าเบิกวัสดุ
                                    </button>
                                </li>
                            </ul>
                        <?php }else { ?>
                        <ul class="dropdown-menu hold-on-click" style="width: 150px !important">
                            <li class="margin-right-6 margin-left-6" >
                                <button data-toggle="modal" data-target="layout-ModalCreate" class="btn btn-success btn-sm" style="width: 100%">
                                    สร้างใบเบิกวัสดุ
                                </button>

                                <!-- Modal Create Order -->
                                <div class="modal fade" id="layout-ModalCreate" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">สร้างใบเบิกวัสดุ</h4>
                                            </div>
                                            <div class="modal-body modal-center">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>รายละเอียดการนำไปใช้(*)</label>
                                                        <select id="detail" style="width: 100%">
                                                            <option value="D001">วิชาเรียน</option>
                                                            <option value="D002">โครงการ</option>
                                                            <option value="D003">กิจกรรม</option>
                                                            <option value="D004" selected>อื่น ๆ</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div style="display: none" id="boxdetail1" name="D001">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label>รหัสวิชา</label>
                                                                    <input name="order_detail_name_id" type="text" class="form-control">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <label>ชื่อวิชา</label>
                                                                    <input name="order_detail_name" type="text" class="form-control">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label>รายละเอียด</label>
                                                                    <textarea name="order_detail" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="display: none" id="boxdetail2" name="D002">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label>รหัสโครงการ</label>
                                                                    <input name="order_detail_name_id" type="text" class="form-control">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <label>ชื่อโครงการ</label>
                                                                    <input name="order_detail_name" type="text" class="form-control">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label>รายละเอียด</label>
                                                                    <textarea name="order_detail" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="display: none" id="boxdetail3" name="D003">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label>ชื่อกิจกรรม</label>
                                                                    <input name="order_detail_name" type="text" class="form-control">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label>รายละเอียด</label>
                                                                    <textarea name="order_detail" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="display: block" id="boxdetail4" name="D004">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label>รายละเอียด</label>
                                                                    <textarea name="order_detail" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 margin-top-20">
                                                        <div class="pull-right">
                                                            <button id="createOrdermaster" class="btn btn-success btn-sm">ยืนยัน</button>
                                                            <button class="btn btn-default btn-sm" data-dismiss="modal">ยกเลิก</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <?php } ?>
                    </li>
                </ul>
            </nav>
        <?php } ?>
    </header>
    <!-- /HEADER -->

    <!-- MIDDLE -->
    <section id="middle">
        <div class="padding-20">
            <?= $content ?>
        </div>
    </section>
    <!-- /MIDDLE -->

</div>
<!-- JAVASCRIPT FILES -->

<script type="text/javascript">var home_path = '<?= Yii::$app->homeUrl ?>'</script>
<script type="text/javascript">var image_path = '<?= Yii::$app->homeUrl ?>../modules/eoffice_materialsys';</script>
<script type="text/javascript">var plugin_path = '<?= Yii::$app->homeUrl ?>/plugins/';</script>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
