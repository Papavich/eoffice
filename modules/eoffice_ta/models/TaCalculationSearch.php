<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaCalculation;

/**
 * TaCalculationSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaCalculation`.
 */
class TaCalculationSearch extends TaCalculation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_calculate_id', 'ta_rule_id', 'order'], 'integer'],
            [['symbol', 'status_symbol'], 'safe'],
            [['symbol_value'], 'number'],
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
        $query = TaCalculation::find();

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
            'ta_calculate_id' => $this->ta_calculate_id,
            'symbol_value' => $this->symbol_value,
            'ta_rule_id' => $this->ta_rule_id,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'symbol', $this->symbol])
            ->andFilterWhere(['like', 'status_symbol', $this->status_symbol]);

        return $dataProvider;
    }
}
