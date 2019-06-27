<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaAssessment;

/**
 * TaAssessmentSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaAssessment`.
 */
class TaAssessmentSearch extends TaAssessment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_assessment_id', 'past', 'ta_assessment_name', 'ta_assessment_detail', 'type_user', 'ta_assessment_note', 'crtime', 'udtime'], 'safe'],
            [['crby', 'udby'], 'integer'],
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
        $query = TaAssessment::find();

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
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'ta_assessment_id', $this->ta_assessment_id])
            ->andFilterWhere(['like', 'past', $this->past])
            ->andFilterWhere(['like', 'ta_assessment_name', $this->ta_assessment_name])
            ->andFilterWhere(['like', 'ta_assessment_detail', $this->ta_assessment_detail])
            ->andFilterWhere(['like', 'type_user', $this->type_user])
            ->andFilterWhere(['like', 'ta_assessment_note', $this->ta_assessment_note]);

        return $dataProvider;
    }
}
