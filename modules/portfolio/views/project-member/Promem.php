<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\ProjectMemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-member-Promem">
    <header id="page-header">
        <h1>สมาชิกโครงการวิจัย</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>

            <li class="active">สมาชิกโครงการวิจัย</li>
        </ol>
    </header>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= Html::a('ออกรายงานไฟล์ PDF', ['pdf'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('ออกรายงาน Excel', ['excel', 'model' => get_class($searchModel)], ['class' => 'btn btn-warning']) ?>
    <p>
    <center><?= Html::a('สร้างสมาชิกโครงการวิจัย', ['create'], ['class' => 'btn btn-success']) ?> </center>
    </p>
    <div class="panel-body">


        <table class="table table-striped table-bordered table-hover" id="datatable_sample">
            <thead>
            <tr>

                <th>รายชื่อ</th>
                <th>โครงการวิจัย</th>
                <th>บทบาทของสมาชิก</th>


            </tr>
            </thead>
            <?php /* @var $row app\modules\portfolio\models\ProjectMember*/
            foreach ($model3 as $row) { ?>
                <tbody>
                <tr class="odd gradeX">
                    <td>
                        <?php
                        //                            foreach ($project->projectMembers as $projectMember) {


                        echo $row->member_name.'&nbsp&nbsp&nbsp&nbsp&nbsp'.$row->member_lname;

                        //                            }
                        ?>
                    </td>
                    <td>
                        <?php
                        {


                            echo $row->projectProject->project_name_thai.'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'('.$row->projectProject->project_name_eng.')';



                            echo '<br>';
                        }
                        ?>

                    </td>
                    <td>
                        <?php
                       echo  $row->projectRoleProjectRole->project_role_name;

                            echo '<br>';

                        }
                        ?>

                    </td>

                </tr>


                </td >
                </tr >

                </tbody>


        </table>
        <?php  ?>
</div>
</div>