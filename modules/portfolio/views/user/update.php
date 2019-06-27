<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $role common\rbac\models\Role; */

$this->title = Yii::t('app', 'แก้ไขผู้ใช้ คุณ ') . ': ' . $user->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'แก้ไข'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->username, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'แก้ไข');
?>
<div class="user-update">
    
        <div class="row">
            <div class="col-lg-6">      
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">แก้ไขผู้ใช้</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <?= $this->render('_form', [
                        'user' => $user,
                        'role' => $role,
                        'person' => $person,
                      ]) ?>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                      เป็นการแก้ไขผู้ใช้ในระบบ
                    </div><!-- box-footer -->
                </div><!-- /.box -->     
            </div>
        </div>
    

</div>
