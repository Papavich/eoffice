<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaComparisonGrade;

/**
 * TaComparisonGradeSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaComparisonGrade`.
 */
class TaComparisonGradeSearch extends TaComparisonGrade
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ta_comparison_grade_id', 'subject_version', 'crby', 'udby'], 'integer'],
            [['person_id', 'subject_id', 'term', 'year', 'ta_status_id', 'grade_name', 'doc_ref', 'crtime', 'udtime', 'subject_id_compar', 'subject_name_compar', 'compar_detail'], 'safe'],
            [['grade_value'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = TaComparisonGrade::find();

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
            'ta_comparison_grade_id' => $this->ta_comparison_grade_id,
            'subject_version' => $this->subject_version,
            'grade_value' => $this->grade_value,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'person_id', $this->person_id])
            ->andFilterWhere(['like', 'subject_id', $this->subject_id])
            ->andFilterWhere(['like', 'term', $this->term])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'ta_status_id', $this->ta_status_id])
            ->andFilterWhere(['like', 'grade_name', $this->grade_name])
            ->andFilterWhere(['like', 'doc_ref', $this->doc_ref])
            ->andFilterWhere(['like', 'subject_id_compar', $this->subject_id_compar])
            ->andFilterWhere(['like', 'subject_name_compar', $this->subject_name_compar])
            ->andFilterWhere(['like', 'compar_detail', $this->compar_detail]);

        return $dataProvider;
    }
}
