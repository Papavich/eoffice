<?php
use yii\widgets\LinkPager;
use miloschuman\highcharts\Highcharts;
use yii\grid\GridView;
use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\modules\portfolio\controllers;
use app\modules\portfolio\models\PublicationTypeSearch;

$this->title = 'รายงาน จำนวนบุคลากร';
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class=""></i> ค้นหาข้อมูล สถิติ
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="form-group">

                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-8 col-sm-8">
                            <?php $form = ActiveForm::begin([
                                'class' => 'horizontal',
                                'method' => 'get',
                            ]); ?>
                            <?php
                            $terms = PublicationTypeSearch::find()->orderBy(['pub_type_id' => SORT_DESC])->all();
                            foreach ($terms as $term) {
                            }
                            echo Select2::widget([
                                'name' => 'pub_type_name',
                                'value' => $term->pub_type_id,
                                'theme' => Select2::THEME_DEFAULT,
                                'data' => ArrayHelper::map(PublicationTypeSearch::find()->all(), 'pub_type_id', 'pub_type_name'),
                                'options' => [
                                    'placeholder' => 'Select type scholarship',
                                    'multiple' => false]
                            ]);
                            $term_name2 = \Yii::$app->request->get('pub_type_name');
                            ?>
                        </div>
                        <div class="col-md-1 col-sm-1">
                            <?= Html::submitButton('<i class="fa fa-search"></i>' . controllers::t('label', 'Search'), ['class' => 'btn btn-blue']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>

                    <center><?= Html::a('สถิติอาจารย์', ['report/report1'], ['class' => 'btn btn-success']) ?></center>
                </div>



            </div>
        </div>
    </div>
</div>

<!-- panel content -->
<div class="panel-body">
<!--    <div class="row">-->
<!--        <div class="col-lg-4">-->
<!--            --><?php //echo $this->render('_search', ['model' => $searchModel]); ?>
<!--        </div>-->
<!--    </div>-->
    <?php
    $ctype = [];

    echo '<table class="table table-striped table-hover table-bordered" id="sample_editable_1">';
    echo ' <thead> ';
    echo ' <tr> ';
    echo ' <th rowspan="3" ><center>ชื่อ นามสกุล</center></th> ';
    echo '      <th rowspan="3" ><center>สาขา</center></th>';
    for ($year = $current_year; $year >= $current_year - 1; $year--) {
        echo '   <th colspan="6" ><center>';
        echo $year;


        echo ' </center></th>';
    }
    /*echo '     <th rowspan="3" ><center>รวม</center></th>';*/

    echo '       </tr> ';
    echo '      <tr>';
    for ($year = $current_year; $year >= $current_year - 1; $year--) {
        echo '    <th colspan="3" ><center>National</center></th>';
        echo '    <th colspan="3" ><center>International</center></th>';
    }
    echo '     </tr>';
    echo '<tr> ';
    for ($year = $current_year; $year >= $current_year - 1; $year--) {
        echo '   <td ><center>Journal</center></td>';
        echo ' <td><center>Conference</center></td>';
        echo '    <td><center>Book</center></td>';
        echo '     <td><center>Journal</center></td>';
        echo '    <td><center>Conference</center></td>';
        echo '       <td><center>Book</center></td>';
    }

    echo '   </tr>';


    echo '  </thead>';
    echo '    <tbody>';
    echo '   <tr>';

        foreach ($publication_order_count as $person) {

            echo '<tr>';
            echo '<td>' . $person['name'] . '</td>';
            echo '<td>' . $person['dept'] . '</td>';

            foreach ($person['years'] as $year) {

                foreach ($year['disses'] as $diss) {

                    foreach ($diss['types'] as $type) {

                        echo '<td>' . $type['count'] . '</td>';


                    }
                }
            }
            echo '</tr>';
        }

    //
    //
    //                    echo '<td>' . $count . '</td>';
    //                }
    //            }
    //            echo '</tr>';
    //     }   }
    //    }
    echo '</tr>';


    echo ' </tbody> ';


    echo '  </table>';


    ?>

</div>
<!-- /panel content -->


</div>
</section>
<!-- /MIDDLE -->