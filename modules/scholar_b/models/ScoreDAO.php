<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 22/2/2561
 * Time: 21:46
 */


namespace app\modules\scholar_b\models;

use Yii;
use yii\base\Model;
use yii\widgets\ActiveForm;
use yii\web\Response;


class ScoreDAO
{
    public function scoreCandidate($sci, $math, $com, $id)
    {
        $model_score = new ScbScore();
        $model_sc_id = ScbEnrollScholarship::find()
            ->from(['scb_enroll_scholarship', 'scb_scholarship_type_has_year'])
            ->where('scb_enroll_scholarship.scholarship_id=scb_scholarship_type_has_year
          .scholarship_id')
            ->andWhere('scb_enroll_scholarship.scholarship_year=scb_scholarship_type_has_year.scholarship_year')
            ->andWhere('candidate_id_card= "'.$id.'"')
            ->one();

        $model_score->score = $sci;
        $model_score->scb_subject_subject_id = 1;
        $model_score->candidate_id_card = $id;
        $model_score->scholarship_id = $model_sc_id->scholarship_id;
        $model_score->scholarship_year = $model_sc_id->scholarship_year;

        $model_score->save(false);
        $model_score = new ScbScore();
        $model_score->score = $math;
        $model_score->scb_subject_subject_id = 2;
        $model_score->candidate_id_card = $id;
        $model_score->scholarship_id = "P013";
        $model_score->scholarship_year = 2561;

        $model_score->save(false);

        $model_score = new ScbScore();
        $model_score->score = $com;
        $model_score->scb_subject_subject_id = 3;
        $model_score->candidate_id_card = $id;
        $model_score->scholarship_id = "P013";
        $model_score->scholarship_year = 2561;

        $model_score->save(false);


    }

    public function updateScoreCandidate(){

    }
}