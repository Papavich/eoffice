<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaRuleApproach;

/**
 * TaRuleApproachSearch represents the model behind the search form about `app\modules\eoffice_ta\models\TaRuleApproach`.
 */
class TaRuleApproachSearch extends TaRuleApproach
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_rule_approach_id', 'ta_type_rule_id', 'crby', 'udby'], 'integer'],
            [['ta_rule_approach_name', 'ta_rule_approach_detail', 'active_statuss', 'crtime', 'udtime'], 'safe'],
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
        $query = TaRuleApproach::find();

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
            'ta_rule_approach_id' => $this->ta_rule_approach_id,
            'ta_type_rule_id' => $this->ta_type_rule_id,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'ta_rule_approach_name', $this->ta_rule_approach_name])
            ->andFilterWhere(['like', 'ta_rule_approach_detail', $this->ta_rule_approach_detail])
            ->andFilterWhere(['like', 'active_statuss', $this->active_statuss]);

        return $dataProvider;
    }
}
