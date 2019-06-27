<?php

namespace app\modules\scholar_b\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\scholar_b\models\ScbEnrollScholarship;

/**
 * ScbEnrollScholarshipSearch represents the model behind the search form of `app\modules\scholar_b\models\ScbEnrollScholarship`.
 */
class ScbEnrollScholarshipSearch extends ScbEnrollScholarship
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['candidate_id_card', 'scholarship_id', 'crtime', 'udtime'], 'safe'],
            [['scholarship_year', 'crby', 'udby'], 'integer'],
            [['gpax_4to5', 'gpa_math4', 'gpa_math4to5', 'gpa_chem4', 'gpa_chem5', 'gpa_math5', 'gpa_physic4', 'gpa_physic5', 'gpa_sum_chem_physic_math_4to5'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ScbEnrollScholarship::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'scholarship_year' => $this->scholarship_year,
            'gpax_4to5' => $this->gpax_4to5,
            'gpa_math4' => $this->gpa_math4,
            'gpa_math4to5' => $this->gpa_math4to5,
            'gpa_chem4' => $this->gpa_chem4,
            'gpa_chem5' => $this->gpa_chem5,
            'gpa_math5' => $this->gpa_math5,
            'gpa_physic4' => $this->gpa_physic4,
            'gpa_physic5' => $this->gpa_physic5,
            'gpa_sum_chem_physic_math_4to5' => $this->gpa_sum_chem_physic_math_4to5,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'candidate_id_card', $this->candidate_id_card])
            ->andFilterWhere(['like', 'scholarship_id', $this->scholarship_id]);

        return $dataProvider;
    }
}
