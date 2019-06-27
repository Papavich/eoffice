<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 1/5/2561
 * Time: 18:21
 */

use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaDocuments */


?>

<?php
$title = controllers::t('label','Document TA');
$back = controllers::t( 'label', 'Back' );
$create = controllers::t( 'label', 'Create' );
$download = controllers::t( 'label', 'Download' );
$search = controllers::t( 'label', 'Search' );
$this->title = $title;
//$this->title = $title_main;
//$this->params['breadcrumbs'][] = ['label' => $title_main, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- page title -->

<div class="ta-documents-index">
    <!--content doc -->

    <!-- panel content -->
    <div class="panel-body">
        <?php Pjax::begin(); ?>
        <div class="table-responsive">
            <table class="table table-hover table-vertical-middle nomargin">
                <thead>
                <tr>
                    <th class="text-center" width="2%"></th>
                    <th class="text-center" width="5%">เอกสาร</th>
                    <th class="text-center" width="5%">ไฟล์</th>
                    <th class="text-center" width="20%">รายละเอียด</th>
                    <th class="text-center" width="10%">วันเวลาสร้าง</th>
                    <th class="text-center" width="9%">Action</th>
                </tr>
                </thead>
                <?php
                foreach ($model as $row){
                    ?>
                    <tbody>
                    <tr>
                        <td class="text-center">
                            <img src="<?= Yii::getAlias('@web') ?>/web_ta/images/img/file-text-icon.png" width='30em' alt="company logo">
                        </td>
                        <td class="text-center"><span class="margin-bottom-10">
                            <?=$row->ta_documents_name?></span></td>
                        <td class="text-center"><a>ไฟล์ :<?=$row->ta_documents_path?></a></td>
                        <td class="text-left"><?= $row->ta_doc_detail?></td>
                        <td class="text-center">
                            <a class="size-13">
                                <i class="glyphicon glyphicon-time"></i>
                                สร้างเมื่อ&nbsp;&nbsp;<?= Yii::$app->formatter->format($row->crtime, 'relativeTime') ?>
                            </a><br>
                            <a class="size-13">
                                <i class="glyphicon glyphicon-time"></i>
                                แก้ไขเมื่อ&nbsp;&nbsp;<?= Yii::$app->formatter->format($row->udtime, 'relativeTime') ?>
                            </a>
                        </td>
                        <td class="text-center">
                            <?= Html::a(Html::tag('i', '',
                                ['class' => 'glyphicon glyphicon-eye-open size-14']), ['ta-documents/view','id'=>$row->ta_documents_id],
                                ['class' => 'btn btn-sm btn-blue'])  ?>
                            <?= Html::a(Html::tag('i', '',
                                ['class' => 'fa fa-cloud-download size-14']),'@web/web_ta/files/'.$row->ta_documents_path, //['ta-documents/download','id'=>$row->ta_documents_id],
                                ['class' => 'btn btn-sm btn-green'])  ?>
                        </td>
                    </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
    <div id="custom-pagination" class="pull-right">
        <?php
        echo LinkPager::widget([
            'pagination' => $pages,
        ])
        ?>
    </div></div>
<?php Pjax::end(); ?>
