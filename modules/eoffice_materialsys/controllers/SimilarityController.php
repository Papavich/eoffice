<?php

namespace app\modules\eoffice_materialsys\controllers;
use app\modules\eoffice_materialsys\components\thsplitlib\segment;
use app\modules\eoffice_materialsys\models\MatsysMaterial;

class SimilarityController extends \yii\web\Controller
{
    // Use function php
    public function actionIndex()
    {
        $string_base = \Yii::$app->request->get("str");

        $material = $this->similarity($string_base);
        arsort($material);
        foreach ( $material as $key => $model){
            echo $key."=>".$model."<br>";
        }
    }

    public function searchmaterial($string_base){
        return $material = $this->similarity($string_base);
    }

    // PHP function
    public function similarity($string_base){
        $result_similarity = [];
        $sql = "";
        $String_split = $this->split($string_base);
        $numItems = count($String_split);
        foreach ($String_split as $keyloop => $value){
            if($keyloop === $numItems-1){
                $sql = $sql."material_name LIKE '%"."$value"."%'";
            }else{
                $sql = $sql."material_name LIKE '%"."$value"."%' OR ";
            }
        }
        $material = \Yii::$app->get('db_mat')->createCommand('SELECT * FROM matsys_material WHERE '.$sql)->queryAll();

        foreach ( $material as $key => $model){
            similar_text($string_base, $model['material_name'], $sim);
            $result_similarity = array_merge($result_similarity,array($model["material_name"] => $sim ));
        }

        arsort($material);
        return $result_similarity;
    }

    // My Split
    public function split($string_base){
        $segment = new Segment();
        $result = $segment->get_segment_array($string_base);
        return $result;
    }
}
