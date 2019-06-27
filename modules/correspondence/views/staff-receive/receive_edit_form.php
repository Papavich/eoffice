<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use dosamigos\fileupload\FileUploadUI;
use app\modules\correspondence\models\CmsDocSecret;
use app\modules\correspondence\models\User;
use app\modules\correspondence\controllers;
use app\modules\correspondence\models\model_main\EofficeCentralViewPisBoardOfDirectors;

$this->title = Html::encode($this->title) . controllers::t('menu', 'Edit Receive Book');
$date = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
\Yii::setAlias('@webword', '@web/../modules/correspondence');
function findUserId()
{
    $userid = User::find()
        ->where(['LIKE', 'username', Yii::$app->user->identity->username])
        ->all();
    foreach ($userid as $item) {
        return $item['id'];
    }
}

function showDateTimeReadTime($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];

    date_default_timezone_set("Asia/Bangkok");
    date('Y-m-d H:i:s');
    if (substr($strDate, 0, 10) == date('Y-m-d')) {
        return "$strHour:$strMinute";
    } elseif (substr($strDate, 0, 10) < date('Y-m-d') && substr($strDate, 0, 4) == date('Y')) {
        return "$strDay" . " /" . " $strMonthThai $strHour:$strMinute";
    } else {
        return "$strDay" . " /" . " $strMonthThai" . " / " . $strYear;
    }
}

function add_nol($number, $add_nol)
{
    while (strlen($number) < $add_nol) {
        $number = "0" . $number;
    }
    return $number;
}

$this->registerCss("
.form-group{
 margin:3px;
}
");
$this->registerJsFile('@web/../modules/correspondence/style/js/input.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/../modules/correspondence/style/js/receive-edit.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/../modules/correspondence/style/js/contract-list.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/../modules/correspondence/style/js/mail.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('@web/../modules/correspondence/style/js/api.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

    <section id="middle" style="padding: 0px 1% 0px 1%">
        <div class="wizard">
            <header style="margin-left: 50px">
                <h4>
                    <strong>
                        <br>
                        <?= controllers::t('menu', 'Edit Receive Book') ?>
                    </strong>
                </h4>
                <br>
            </header>
            <div class="container">

                <div class="form-horizontal">
                    <?php $form = ActiveForm::begin(['method' => 'post'], ['options' => [ 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']]) ?>

                    <div class="col-sm-6 col1">
                        <div class="form-group">
                            <label class="control-label col-sm-3"><?= controllers::t('menu', 'Doc Roll Receive ID') ?>
                                :</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           value="<?= substr($model_roll->doc_roll_receive_id, -4) ?>"
                                           disabled>
                                </div>
                            </div>
                        </div>
                        <style>
                            @media only screen and (max-width: 767px) {
                                .receiveedit {
                                    width: 100%;
                                    padding: 6px 12px;
                                }

                                /*    .fileadd {
                                        background-color: #d43f3a;
                                    }*/
                            }

                            /* Medium Devices, Desktops */
                            @media only screen and (min-width: 768px) and (max-width: 1024px) {
                                .receiveedit {
                                    padding-left: 15px;
                                    width: 72%;
                                }

                                /* .fileadd {
                                     background-color: green;
                                 }
*/
                                .col1 {
                                    width: 70%;
                                }

                            }

                            @media only screen and  (min-width: 1024px) {
                                .receiveedit {
                                    padding-left: 15px;
                                    width: 72%;
                                }

                                /* .fileadd {
                                     background-color: #0a1380;
                                 }*/
                                .col1 {
                                    width: 500px;
                                }

                            }

                        </style>
                        <!-- date receive -->
                        <?php
                        echo $form->field($model_doc, 'receive_date', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ],
                            [
                                'inputOptions' => ['class' => 'form-control input-group-addon ',
                                    'style' => 'border:2px solid #d2d6de; border-radius:5px 5px 5px 5px;']
                            ])
                            ->textInput()->input('text', ['id' => 'datetimepicker2',
                                'required'])
                            ->label(controllers::t('menu', 'Receive Date'), ['class' => 'control-label col-sm-3']);
                        ?>

                        <!-- date book -->
                        <?php
                        echo $form->field($model_doc, 'doc_date', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ],
                            [
                                'inputOptions' => ['class' => 'form-control input-group-addon ',
                                    'style' => 'border:2px solid #d2d6de; border-radius:5px 5px 5px 5px;']
                            ])
                            ->textInput()->input('text', ['id' => 'datetimepicker3',
                                'required'])
                            ->label(controllers::t('menu', 'Doc Date'), ['class' => 'control-label col-sm-3']);
                        ?>
                        <!-- code book -->
                        <?php
                        echo $form->field($model_doc, 'doc_id_regist', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ])->textInput()->input('text', ['placeholder' => "ศธ.0514.2.1.3/332", 'id' => 'doc_id'])
                            ->label(controllers::t('menu', 'Doc Id Regist'), ['class' => 'control-label col-sm-3']);
                        ?>
                        <!-- secret -->
                        <?php
                        echo $form->field($model_doc, 'secret_id', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ])
                            ->dropDownList(
                                \yii\helpers\ArrayHelper::map(CmsDocSecret::find()->asArray()->all(), 'secret_id', 'secret_name')
                            )->label(controllers::t('menu', 'Secret ID'), ['class' => 'control-label col-sm-3']);
                        ?>
                        <!-- fast -->
                        <?php
                        echo $form->field($model_doc, 'speed_id', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ])
                            ->dropDownList(
                                \yii\helpers\ArrayHelper::map(\app\modules\correspondence\models\CmsDocSpeed::find()->asArray()->all(), 'speed_id', 'speed_name')
                            )->label(controllers::t('menu', 'Speed ID'), ['class' => 'control-label col-sm-3']);
                        ?>
                        <!-- topic -->
                        <?php
                        echo $form->field($model_doc, 'doc_subject', [
                            'template' => '{label}<div class="col-sm-9"> <div class="form-group">{input}{error}{hint}</div></div>'
                        ], [
                            'inputOptions' => ['class' => 'form-control']
                        ])->textarea(['placeholder' => "รายงานการประชุมเกี่ยวกับ..."])
                            ->label(controllers::t('menu', 'Doc Subject'), ['class' => 'control-label col-sm-3']);
                        ?>
                    </div>
                    <div class="col-sm-6 col1">
                        <!-- type -->
                        <?php
                        echo $form->field($model_doc, 'type_id', [
                            'template' => '{label}<div class="col-sm-8"><div class="form-group">{input}{error}</div></div>'
                        ])
                            ->dropDownList(
                                \yii\helpers\ArrayHelper::map(\app\modules\correspondence\models\CmsDocType::find()
                                    ->asArray()->all(), 'type_id', 'type_name')
                                , ['prompt' => '--- กรุณาเลือกประเภทหนังสือ ---'])
                            ->label(controllers::t('menu', 'Type ID'), ['class' => 'control-label col-sm-4']);
                        ?>
                        <!-- sub type -->
                        <?php
                        echo $form->field($model_doc, 'sub_type_id', [
                            'template' => '{label}<div class="col-sm-8"><div class="form-group">{input}{error}</div></div>'
                        ])
                            ->dropDownList(
                                \yii\helpers\ArrayHelper::map(\app\modules\correspondence\models\CmsDocSubType::find()
                                    ->asArray()->all(), 'sub_type_id', 'sub_type_name')
                                , ['id' => 'subtype-id', 'prompt' => '--- กรุณาเลือหมวดหมู่หนังสือ ---'])
                            ->label(controllers::t('menu', 'Sub Type ID'), ['class' => 'control-label col-sm-4']);
                        ?>
                        <!-- money -->
                        <div class="form-group" id="money" style="display: none">
                            <?php
                            echo $form->field($model_doc, 'money', [
                                'template' => '{label}<div class="col-sm-8"><div class="form-group">{input}{error}</div></div>'
                            ])
                                ->textInput(['type' => 'number'])
                                ->label(controllers::t('menu', 'Money'), ['class' => 'control-label col-sm-4']);
                            ?>
                        </div>
                        <!-- address -->
                        <?php
                        echo $form->field($model_doc, 'address_id', [
                            'template' => '{label}<div class="col-sm-8"><div class="form-group">{input}{error}</div></div>'
                        ])
                            ->label(controllers::t('menu', 'Address ID'), ['class' => 'control-label col-sm-4'])
                            ->dropDownList(
                                \yii\helpers\ArrayHelper::map(\app\modules\correspondence\models\CmsAddress::find()
                                    ->where(['sub_type_id' => $model_doc->subType->sub_type_id])
                                    ->asArray()->all(), 'address_id', 'address_name')
                                , ['prompt' => '--- กรุณาเลือกสถานที่เก็บต้นฉบับ ---']);
                        ?>
                        <!-- from -->
                        <div class="form-group" style="">
                            <label class="control-label col-sm-4"><?= controllers::t('menu', 'Doc From') ?></label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="คณะ/หน่วยงาน..." list="pname"
                                           id="keyword2" autocomplete="off"
                                           onkeyup="send(event)" value="<?= $model_doc->docDept->doc_dept_name ?>">
                                    <p class="help-block field-dept_id-error"
                                       style="margin-bottom: 0px; display: none;">
                                        <?= controllers::t('menu', 'From cannot be blank.') ?>
                                    </p>
                                </div>
                                <datalist id="pname"></datalist>

                            </div>
                        </div>
                        <!--Tel-->
                        <?php
                        echo $form->field($model_doc, 'doc_tel', [
                            'template' => '{label}<div class="col-sm-8"> <div class="form-group">{input}{error}{hint}</div></div>'
                        ], [
                            'inputOptions' => ['class' => 'form-control']])
                            ->textInput()->input('text', ['placeholder' => "กรอกเบอร์โทร", 'list' => 'doc_tel', 'onkeyup' => 'sendTel(event)',
                                'autocomplete' => 'off'])
                            ->label(controllers::t('menu', 'Doc Tel'), ['class' => 'control-label col-sm-4']);
                        ?>
                        <datalist id="doc_tel"></datalist>
                        <!-- doing -->
                        <?php
                        echo $form->field($model_roll, 'doc_roll_receive_doing', [
                            'template' => '{label}<div class="col-sm-8"> <div class="form-group">{input}{error}{hint}</div></div>'
                        ])
                            ->label(controllers::t('menu', 'Doc Roll Receive Doing'), ['class' => 'control-label col-sm-4']);
                        ?>
                        <!-- doc ref -->
                        <div class="form-group">
                            <label class="control-label col-sm-4"><?= controllers::t('menu', 'Related Documents') ?>
                                :</label>
                            <div>
                                <?php
                                $docRef = \app\modules\correspondence\models\CmsDocRef::find()->where(['doc_id' => $model_doc->doc_id])->all();
                                if ($docRef) {
                                    foreach ($docRef as $row) {
                                        $doc = \app\modules\correspondence\models\CmsDocument::findOne($row['doc_ref']);
                                        if ($doc->cmsDocRollReceives) {
                                            echo Html::a("เลขที่ " . $doc->doc_id_regist . " เรื่อง "
                                                . $doc->doc_subject,
                                                \yii\helpers\Url::to('detail_book?id=' . $doc->doc_id),
                                                ['target' => '_blank', 'style' => 'font-size: 16px']);
                                            ?>
                                            <a href='#' onclick='passId("<?= $row['doc_ref_id'] ?>")' class='btn btn-3d btn-xs btn-reveal btn-red
                                                         btnw confirmDeleteDocRef' style='margin-left: 10px;'>
                                                <i class='fa fa-trash'></i>
                                                <span><?= controllers::t('menu', 'Delete') ?></span>
                                            </a>
                                            <?php
                                        } elseif ($doc->cmsDocRollSends) {
                                            echo Html::a("เลขที่ " . $doc->doc_id_regist . " เรื่อง "
                                                . $doc->doc_subject,
                                                \yii\helpers\Url::to('../staff-send/detail_book?id=' . $doc->doc_id),
                                                ['target' => '_blank', 'style' => 'font-size: 16px']);
                                            ?>
                                            <a href='#' onclick='passId("<?= $row['doc_ref_id'] ?>")' class='btn btn-3d btn-xs btn-reveal btn-red
                                                         btnw confirmDeleteDocRef' style='margin-left: 10px;'>
                                                <i class='fa fa-trash'></i>
                                                <span><?= controllers::t('menu', 'Delete') ?></span>
                                            </a>
                                            <?php
                                        }
                                        echo "<br>";
                                    }
                                }

                                ?>
                            </div>
                            <br>
                            <div class="col-sm-8" style="margin-left: 150px">
                                <a href="#docRefModal" class="btn btn-primary" style="width: 100%" id="docRefLink">
                                    <?= controllers::t('menu', 'Click to attach documentation') ?>
                                </a>
                            </div>
                            <div id="docRefModalDetail" style="display: none">
                                <br><br><br>
                                <div id="panel-misc-portlet-r1" class="panel panel-default"
                                     style="border: 2px solid black; width: 100%; border-radius: 5px;
margin-left: 6%">
                                    <!-- panel content -->
                                    <div class="" style="display: block;padding: 15px; ">
                                        <label class="control-label col-sm-4"> <?= controllers::t('menu', 'Doc Subject') ?>
                                            :</label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                       placeholder="พิมพ์ชื่อเรื่องที่ต้องการอ้างอิงเพื่อค้นหา"
                                                       list="docRefList"
                                                       autocomplete="off" id="keyworddocRef"
                                                >
                                                <a class="btn btn-primary" id="searchDocRef"
                                                   onclick="senddocRef(event)">
                                                    <?= controllers::t('menu', 'Search') ?>
                                                </a>
                                            </div>
                                        </div>
                                        <table class="table table-bordered table-striped example">
                                            <thead>
                                            <tr>
                                                <th width="5%">เลือก</th>
                                                <th>เลขที่</th>
                                                <th>ชื่อเรื่อง</th>
                                                <th>วันที่รับ</th>
                                            </tr>
                                            </thead>
                                            <tbody id="docRefList">

                                            </tbody>
                                        </table>

                                    </div>
                                    <!-- /panel content -->

                                </div>
                            </div>
                        </div>
                        <!-- Files -->
                        <div class="form-group">
                            <label class="control-label col-sm-4"><?= controllers::t('menu', 'Existing file') ?>
                                :</label>
                            <div class="col-sm-8">
                                <?php
                                $query = \app\modules\correspondence\models\CmsFile::find()
                                    ->from(['cms_doc_file', 'cms_file', 'cms_document'])
                                    ->where(
                                        "cms_doc_file.doc_id = '" . $_GET["id"] . "'")
                                    ->andWhere("cms_doc_file.doc_id = cms_document.doc_id")
                                    ->andWhere("cms_doc_file.file_id = cms_file.file_id")
                                    ->all();
                                $i = 0;
                                foreach ($query as $items) {
                                    echo Html::a($items->file_name, Url::to(Yii::getAlias('@web') . '/web_cms/uploads/'
                                        . $items->file_path . '/' . $items->file_name), ['target' => '_blank', 'style' => 'font-size: 16px']);
                                    echo "<a href=\"#\" onclick=\"redirectDeleteRoll('" . $_GET['id'] . "',$items->file_id)\" 
                                class=\"btn btn-3d btn-xs btn-reveal btn-red btnw confirmFile\"style='margin-left: 10px;' >
                                            <i class=\"fa fa-trash\"></i>
                                            <span>" . controllers::t('menu', 'Delete') . "</span>
                                        </a>";
                                    echo "<br>";
                                    $_SESSION["filename"][$i]["name"] = $items->file_name;
                                    $i++;
                                }
                                $_SESSION['idDocReceive'] = $_GET['id'];
                                ?>
                            </div>
                        </div>
                        <br>
                    </div>
                    <!-- doc receiver -->
                    <div class="col-sm-12">
                        <label class="control-label"
                               style="padding-bottom: 20px;"><?= controllers::t('menu', 'Upload File') ?>:</label>

                        <?php
                        $_SESSION["fileOperation"] = "update";
                        $file1 = \app\modules\correspondence\models\CmsFile::find()
                            ->from(['cms_file', 'cms_doc_file'])
                            ->where("cms_doc_file.file_id = cms_file.file_id AND cms_doc_file.doc_id = '" . $_GET['id'] . "'")
                            ->one();
                        echo FileUploadUI::widget([
                            'model' => $model_file,
                            'attribute' => 'file',
                            'url' => ['file/update-file', 'docid' => $_GET['id']],
                            'gallery' => false,
                            'fieldOptions' => [
                                'accept' => '/*',
                            ],
                            'clientOptions' => [
                                'maxFileSize' => 2000000,
                                'maxFiles' => 4,
                                'autoUpload' => true
                            ],
                            // ...
                            'clientEvents' => [
                                'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                                
                            }',
                                'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);                                                        
                            }',

                            ],
                        ]);

                        ?>

                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label col-xs-2">
                                <?= controllers::t('menu', 'List of people sent') ?>:
                            </label>
                            <div class="col-md-6">
                                <?php
                                if (count($receiver) == 0) {
                                    echo controllers::t('menu', 'This document has not been submitted to any user');
                                } else {
                                    $count = 0;
                                    foreach ($receiver as $i => $rows) {
                                        if (count($receiver) >= 2) {
                                            echo "<a id='AllReceiver'>";
                                            echo $rows->user->prefix_th . $rows->user->fname . " " . $rows->user->lname . " ";
                                            echo " " . controllers::t('menu', 'and others');
                                            echo "</a>";
                                            break;
                                            //break;
                                        }
                                        if ($i == 1) {

                                        } else if (count($receiver) == 1) {
                                            echo $rows->user->prefix_th . $rows->user->fname . " " . $rows->user->lname;
                                        }
                                        $count++;
                                    }
                                }
                                ?>
                            </div>

                            <!-- checkbox -->
                            <br><br>
                            <div id="panel-ui-tan-l3" class="panel panel-default"
                                 style="display: none;border: 2px solid grey;">
                                <div class="panel-heading">
                                    <span class="elipsis"><!-- panel title -->
										<strong> <?= controllers::t('menu', 'List of people sent') ?></strong>
									</span>
                                    <!-- right options -->
                                    <ul class="options pull-right list-inline">
                                        <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title=""
                                               data-placement="bottom" data-original-title="Colapse"></a></li>
                                        <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip"
                                               title="" data-placement="bottom" data-original-title="Fullscreen"><i
                                                        class="fa fa-expand"></i></a></li>
                                        <li><a href="#" class="opt panel_close" data-confirm-title="Confirm"
                                               data-confirm-message="Are you sure you want to remove this panel?"
                                               data-toggle="tooltip" title="" data-placement="bottom"
                                               data-original-title="Close"><i class="fa fa-times"></i></a></li>
                                    </ul>
                                    <!-- /right options -->
                                </div>

                                <!-- panel content -->
                                <div class="panel-body">
                                    <div class="tabs nomargin-top">
                                        <!-- tabs -->
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab1_nobg" data-toggle="tab"
                                                   style="width: auto; height: auto">
                                                    <?= controllers::t('menu', 'read') ?>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#tab2_nobg" data-toggle="tab"
                                                   style="width: auto; height: auto">
                                                    <?= controllers::t('menu', 'unread') ?>
                                                </a>
                                            </li>
                                        </ul>

                                        <!-- tabs content -->
                                        <div class="tab-content transparent">
                                            <div id="tab1_nobg" class="tab-pane active">
                                                <?php
                                                $read = 0;
                                                foreach ($receiver as $rows) {
                                                    if ($rows['inbox_status'] == "read") {
                                                        echo "-<b>" . $rows->user->prefix_th . $rows->user->fname . " " .
                                                            $rows->user->lname . "</b>    "
                                                            . showDateTimeReadTime($rows['read_time']) . '<br>';
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
                                            </div>

                                            <div id="tab2_nobg" class="tab-pane">
                                                <?php
                                                $read = 0;
                                                foreach ($receiver as $rows) {
                                                    if ($rows['inbox_status'] == "unread") {
                                                        echo "-<b>" . $rows->user->prefix_th . $rows->user->fname . " " .
                                                            $rows->user->lname . '</b><br>';
                                                    }
                                                }
                                                if (count($receiver) == $read) {
                                                    echo '<tr>
                                                <td><b>' . controllers::t('menu', 'All users have read') . '</b></td>
                                            </tr>';
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>

                                </div>
                                <!-- /panel content -->

                            </div>
                            <?php
                            //check หนังสือนั้นถูกทำลายไปหรือยัง
                            $boo = "";
                            if ($model_doc->cmsDeleteRolls) {
                                foreach ($model_doc->cmsDeleteRolls as $item) {
                                    $boo = $item['status'];
                                }
                            } ?>
                            <br><br>
                            <div class="col-xs-4" style="left: 100px; margin-bottom: 25px;">
                                <?php
                                if ($boo != "ทำลายเสร็จสิ้น") {
                                    ?>

                                    <label>
                                        <input type="checkbox" id="checkNeedToSendMore" value="1">
                                        <i></i> ต้องการส่งให้ผู้ใช้อื่นๆ เพิ่ม
                                    </label>
                                    <div id="sendMore" style="display: none">
                                        <div id='form_receive_edit'>
                                            <div class="form-group"
                                                 class="checkbox-inline">
                                                <input type="checkbox" value="" name=""
                                                       id="allContract"><b>เลือกทั้งหมด</b>
                                                </label><br>
                                                <label style="float: left;clear: left; margin: auto; margin-right: 5px;"
                                                       class="checkbox-inline">
                                                    <input type="checkbox" value="" name="" id="ceo" class="checkedAll"><b>คณะผู้บริหาร</b>
                                                </label><br>
                                                <label style="float: left;margin: auto; margin-right: 2%;"
                                                       class="checkbox-inline">
                                                    <input type="checkbox" value="" name="" id="cs"
                                                           class="checkedAll"><b>คณาจารย์ประจำสาขาวิชาวิทยาการคอม﻿พิวเตอร์</b>
                                                </label><br>
                                                <label style="float: left; margin: auto; margin-right: 2%;"
                                                       class="checkbox-inline">
                                                    <input type="checkbox" value="" name="" id="ict"
                                                           class="checkedAll"><b>คณาจารย์ประจำสาขาวิชาเทคโนโลยีสารสนเทศ</b>
                                                </label><br>
                                                <label style="float: left;margin: auto ;margin-right: 2%;"
                                                       class="checkbox-inline">
                                                    <input type="checkbox" value="" name="" id="gis"
                                                           class="checkedAll"><b>คณาจารย์ประจำสาขาวิชาภูมิสารสนเทศศาสตร์</b>
                                                </label><br>
                                                <label style="float: left;margin: auto ;margin-right: 2%;"
                                                       class="checkbox-inline">
                                                    <input type="checkbox" value="" name="" id="staff"
                                                           class="checkedAll"><b>เจ้าหน้าที่ภายในภาควิชา</b>
                                                </label><br>
                                                <br><br>
                                                <div class="col-md-8 col-xs-8 col-sm-8"
                                                     style=" border: 2px solid #1c2b36; padding: 2%; border-radius: 5px;
                                                    width: 800px">
                                                    <!-- contract box -->
                                                    <div id="contarct-box">
                                                        <input type='checkbox' name='checkAllCEO'
                                                               id='checkAll2'><span
                                                                id="check3">เลือกทั้งหมด</span><br><br>
                                                        <div id="listOfCEO">
                                                            <?php
                                                            //TODO ดึงข้อมูลจริงมาจากระบบกลาง
                                                            /*                                                            $leader = \app\modules\correspondence\models\User::findOne(9);
                                                                                                                        echo '1<input type="checkbox" name="list_mail[]" value="' . $leader->id . '"   class="listceo" />
                                                                                                                    ' . $leader->prefix_th . $leader->fname . " " . $leader->lname .
                                                                                                                            ' <b>(' . $leader->person_position . ')</b>' . '<br>';*/
                                                            foreach ($notReceiver as $rows):
                                                                if ($rows->boardDirector) {
                                                                    if ($rows->boardDirector->position_name == "หัวหน้าภาควิชาวิทยาการคอมพิวเตอร์"
                                                                        && $rows->boardDirector->period_describe == "สมัยปัจจุบัน") {
                                                                        echo '<input type="checkbox" name="list_mail[]" value="' . $rows->person_id . '"   class="listceo" />
                                                        ' . $rows->PREFIXNAME . $rows->person_name . " " . $rows->person_surname .
                                                                            ' <b>(' . $rows->boardDirector->position_name . ')</b>' . '<br>';
                                                                        break;
                                                                    }
                                                                }
                                                            endforeach;
                                                            foreach ($notReceiver as $rows):
                                                                if ($rows->boardDirector) {
                                                                    if ($rows->boardDirector->position_name != "หัวหน้าภาควิชาวิทยาการคอมพิวเตอร์") {
                                                                        echo '<input type="checkbox" name="list_mail[]" value="' . $rows->person_id . '"   class="listceo" />
                                                        ' . $rows->PREFIXNAME . $rows->person_name . " " . $rows->person_surname .
                                                                            ' <b>(' . $rows->boardDirector->position_name . ')</b>' . '<br>';
                                                                    }
                                                                }

                                                                ?>
                                                            <?php endforeach; ?>

                                                        </div>
                                                        <div id="listOfCS">
                                                            <?php
                                                            foreach ($notReceiver as $rows):
                                                                if (!$rows->boardDirector && $rows->major) {
                                                                    if($rows->major->code == "CS")
                                                                        echo '<input type="checkbox" name="list_mail[]" value="' . $rows->person_id . '"   class="listcs" />
                                                                        ' . $rows->PREFIXNAME . $rows->person_name . " " . $rows->person_surname . '<br>';
                                                                }
                                                                ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <div id="listOfICT">
                                                            <?php
                                                            foreach ($notReceiver as $rows):
                                                                if (!$rows->boardDirector && $rows->major) {
                                                                    if ($rows->major->code == "IT")
                                                                        echo '<input type="checkbox" name="list_mail[]" value="' . $rows->person_id . '"   class="listict" />
                                                                        ' . $rows->PREFIXNAME . $rows->person_name . " " . $rows->person_surname . '<br>';
                                                                } else {
                                                                    if ($rows->boardDirector) {
                                                                        if ($rows->boardDirector->position_name == "หัวหน้าภาควิชาวิทยาการคอมพิวเตอร์" && $rows->boardDirector->period_describe != "สมัยปัจจุบัน"
                                                                            && $rows->major) {
                                                                            if ($rows->major->code == "IT")
                                                                                echo '<input type="checkbox" name="list_mail[]" value="' . $rows->person_id . '"   class="listict" />
                                                                        ' . $rows->PREFIXNAME . $rows->person_name . " " . $rows->person_surname . '<br>';
                                                                        }

                                                                    }
                                                                }
                                                                ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <div id="listOfGIS">
                                                            <?php
                                                            foreach ($notReceiver as $rows):
                                                                if (!$rows->boardDirector && $rows->major) {
                                                                    if($rows->major->code == "GIS")
                                                                        echo '<input type="checkbox" name="list_mail[]" value="' . $rows->person_id . '"   class="listgis" />
                                                                        ' . $rows->PREFIXNAME . $rows->person_name . " " . $rows->person_surname . '<br>';
                                                                }
                                                                ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <div id="listOfStaff">
                                                            <?php
                                                            foreach ($notReceiver as $rows):
                                                                if (!$rows->boardDirector && !$rows->major) {
                                                                    echo '<input type="checkbox" name="list_mail[]" value="' . $rows->person_id . '"   class="liststaff" />
                                                                        ' . $rows->PREFIXNAME . $rows->person_name . " " . $rows->person_surname .
                                                                        ' <b>(' . $rows->person_position_staff . ')</b>' . '<br>';
                                                                }
                                                                ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                    <label class="control-label col-xs-2"></label>
                    <div id="receiver" style="margin: 20px" class="col-xs-6"></div>
                    <br><br>
                    <div id="hidden-input">
                        <input type="hidden" id="updateId" value="<?= $_GET['id'] ?>">
                        <input type="hidden" id="oldDept" value="<?= $model_doc->docDept->doc_dept_name ?>">
                        <?= $form->field($model_doc, 'doc_dept_id')->hiddenInput(['id' => 'dept_id'])->label(false); ?>
                        <?= $form->field($model_doc, 'sent_date')->hiddenInput()->label(false); ?>

                        <?= $form->field($model_doc, 'user_id')->hiddenInput()->label(false); ?>

                        <?= $form->field($model_doc, 'check_id')->hiddenInput()->label(false); ?>

                        <?= $form->field($model_doc, 'doc_expire')->hiddenInput()->label(false); ?>

                        <?= $form->field($model_doc, 'doc_from')->hiddenInput()->label(false)->error(false); ?>

                        <?= $form->field($model_roll, 'doc_roll_receive_id')->hiddenInput()->label(false); ?>
                    </div>

                    <div class="col-md-12" style="padding-bottom:30px;clear: both">
                        <button type="submit" class="btn btn-success btn-lg next-step" id="next_tab2">
                            <?= controllers::t('menu', 'Save') ?>
                        </button>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
                <!-- **************************** End Form *********************************************** -->

                <div class="clearfix"></div>
            </div>
        </div>
    </section>

    <script>
        //pass parameter to delete document in ajax
        var pass_iddoc, pass_file, pass_ref;

        function redirectDeleteRoll(iddoc, idfile) {
            pass_iddoc = iddoc;
            pass_file = idfile;

        }

        function passId(idref) {
            pass_ref = idref;
        }

        var xmlHttp;

        function send(event) {
            xmlHttp = new XMLHttpRequest();
            var keyword = document.getElementById("keyword2").value;

            if (event.keyCode == 13) {  // ��ҡ� Enter
                // document.location = "productDetail2.php?pname=" + keyword;

            } else if (event.keyCode != 40) {  //  �������顴�١��ŧ
                var url = "search?keyword=" + keyword;
                xmlHttp.open("GET", url);
                xmlHttp.onreadystatechange = showListDept;
                xmlHttp.send();
            }
        }

        function showListDept() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                document.getElementById("pname").innerHTML = xmlHttp.responseText;
            }
        }

        function senddocRef(event) {
            xmlHttp = new XMLHttpRequest();
            var keyword = document.getElementById("keyworddocRef").value;
            console.log(keyword);
            if (event.keyCode == 13) {  // ��ҡ� Enter
                // document.location = "productDetail2.php?pname=" + keyword;

            } else if (event.keyCode != 40) {  //  �������顴�١��ŧ
                var url = "search-doc-ref?keyword=" + keyword;
                xmlHttp.open("GET", url);
                xmlHttp.onreadystatechange = showListRef;
                xmlHttp.send();
            }
        }

        function showListRef() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                document.getElementById("docRefList").innerHTML = xmlHttp.responseText;
            }
        }

        function sendUser(event) {
            xmlHttp = new XMLHttpRequest();
            var keyword = document.getElementById("keyword-user").value;

            if (event.keyCode == 13) {  // ��ҡ� Enter
                // document.location = "productDetail2.php?pname=" + keyword;

            } else if (event.keyCode != 40) {
                var url = "search-user?keyword=" + keyword;
                xmlHttp.open("GET", url);
                xmlHttp.onreadystatechange = showListUser;
                xmlHttp.send();
            }
        }

        function showListTel() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                document.getElementById("doc_tel").innerHTML = xmlHttp.responseText;
            }
        }

        function sendTel(event) {
            xmlHttp = new XMLHttpRequest();
            let keyword = document.getElementById("cmsdocument-doc_tel").value;

            if (event.keyCode == 13) {  // ��ҡ� Enter
                // document.location = "productDetail2.php?pname=" + keyword;

            } else if (event.keyCode != 40) {
                let url = "search-tel?keyword=" + keyword;
                xmlHttp.open("GET", url);
                xmlHttp.onreadystatechange = showListTel;
                xmlHttp.send();
            }
        }

        function showListUser() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                document.getElementById("username").innerHTML = xmlHttp.responseText;
            }
        }
    </script>
<?php

$this->registerJs(<<<JS
        $('#datetimepicker2').datetimepicker({
                  dateFormat: 'yy-mm-dd',
                  timeFormat: 'HH:mm:ss'
        });
        $('#datetimepicker3').datetimepicker({
                  dateFormat: 'yy-mm-dd',
                  timeFormat: 'HH:mm:ss'
        });
         $(".confirmFile").click(function(){
            swal({
                title: titleSwal,
                text: textSwal,
                icon: "warning",
                dangerMode: true,
                buttons: [buttonCancelSwal, buttonConfirmSwal],
            })
                .then(willDelete=> {
                if(willDelete) {
                    swal(successSwal, { icon: "success", button: false,});
                   return $.ajax({
                       url: '../file/delete-file-in-db',
                       type: 'get',
                       data: {
                           'iddoc': pass_iddoc,
                           'idfile': pass_file
                       },
                       success: function (data) {
                           window.setTimeout(function () {
                               window.location.reload();
                           }, 500);
                       }
                   });
                }
    
            }
        );
        });
         $(".confirmDeleteDocRef").click(function(){
            swal({
                title: titleSwal,
                text: textSwal,
                icon: "warning",
                dangerMode: true,
                buttons: [buttonCancelSwal, buttonConfirmSwal],
            })
                .then(willDelete => {
                if(willDelete) {
                  swal(successSwal, { icon: "success", button: false,});
                    return $.ajax({
                        url: 'delete-doc-ref',
                        type: 'post',
                        data: {
                            'idref': pass_ref,
                        },
                        success: function (data) {
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 500);
                        }
    
                        });
                    }
                }
            );
        });
         $("#AllReceiver").click(function() {
           $("#panel-ui-tan-l3").toggle();
         });
JS
);

?>