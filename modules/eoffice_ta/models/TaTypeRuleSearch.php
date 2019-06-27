<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaTypeRule;

/**
 * TaTypeRuleSearch represents the model behind the search form about `app\modules\eoffice_ta\models\TaTypeRule`.
 */
class TaTypeRuleSearch extends TaTypeRule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_type_rule_id', 'crby', 'udby'], 'integer'],
            [['ta_type_rule_name', 'ta_type_detail', 'crtime', 'udtime'], 'safe'],
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
        $query = TaTypeRule::find();

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
            'ta_type_rule_id' => $this->ta_type_rule_id,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'ta_type_rule_name', $this->ta_type_rule_name])
            ->andFilterWhere(['like', 'ta_type_detail', $this->ta_type_detail]);

        return $dataProvider;
    }
}
