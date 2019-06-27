<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaAssessmentOpen;

/**
 * TaAssessmentOpenSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaAssessmentOpen`.
 */
class TaAssessmentOpenSearch extends TaAssessmentOpen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_assessment_id', 'past', 'term', 'year', 'active', 'crtime', 'udtime'], 'safe'],
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
        $query = TaAssessmentOpen::find();

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
            ->andFilterWhere(['like', 'term', $this->term])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'active', $this->active]);

        return $dataProvider;
    }
}
