<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 25/11/2560
 * Time: 16:04
 */

use app\modules\eoffice_ta\models\TaWorkLoad;
use app\modules\eoffice_ta\models\TaRegister;
use app\models\Person;
use app\modules\eoffice_ta\controllers;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php
$label_subj = controllers::t( 'label', 'Subject');
$label_teacher = controllers::t( 'label', 'Teacher Subject');
$label_credit = controllers::t( 'label', 'Credit');
$label_Wplan = controllers::t( 'label', 'Work Plan');
$label_action = controllers::t( 'label', 'Action');
$title = controllers::t( 'label', 'Manage WorkLoad');
$back = controllers::t( 'label', 'Back');
$this->title = $title;
$user = new Person();
$user->user_id = Yii::$app->user->id;
$per = Person::findOne(['user_id'=>$user]);
$reg = TaRegister::find()->all();
?>
<!-- page title -->
<header id="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="options pull-right list-inline">
        <li><strong><?=$per->prefix->PREFIXNAME?>&nbsp;<?=$per->person_name?>&nbsp;<?=$per->person_surname?></strong>
        </li>
        <li> <?= Html::a(Html::tag('i', '',
                    ['class' => 'glyphicon glyphicon-share-alt']) . $back, ['site/index'],
                ['class' => 'btn btn-reveal btn-primary'])  ?>
        </li>
    </ol>
</header>
<!-- /page title -->
<div id="content" class="padding-10">
<div class="table-responsive">
    <table class="table table-bordered table-vertical-middle nomargin">
        <thead>
        <tr class="btn-aqua" align="center">
            <th width="15%"><center><?=$label_subj?></center></th>
            <th  width="15%"><center><?=$label_teacher?></center></th>
            <th  width="5%"><center><?=$label_credit?></center></th>
            <th  width="10%"><center><?=$label_Wplan?></center></th>
            <th  width="15%"><center><?=$label_action?></center></th>
        </tr>
        </thead>

            <tbody>
            <tr>
                <!-- *********************** วิชา ****************** -->
                <td></td>
                <!-- *********************** อาจารย์ ****************** -->
                <td></td>
                <!-- *********************** หน่วยกิต ****************** -->
                <td align="center"></td>
                <!-- *********************** Secที่สอน ****************** -->

                <td align="center">

                </td>

                <!-- *********************************** จัดการ ******************************* -->
                <td align="center">

                 <!-- *********************************** แก้ไข ******************************* -->

                 <!-- ********************************** ลบ **************************** -->

                    <!-- ********************************** กรณียังไม่แจ้งภาระงาน **************************** -->
                </td>
            </tr>
            </tbody>
    </table>
</div>
</div>