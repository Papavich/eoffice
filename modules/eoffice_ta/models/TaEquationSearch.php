<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaEquation;

/**
 * TaEquationSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaEquation`.
 */
class TaEquationSearch extends TaEquation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_equation_id', 'ans', 'ta_type_rule_id', 'crby', 'udby'], 'integer'],
            [['ta_equation_name', 'ta_equation_detail', 'active_status', 'crtime', 'udtime'], 'safe'],
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
        $query = TaEquation::find();

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
            'ta_equation_id' => $this->ta_equation_id,
            'ans' => $this->ans,
            'ta_type_rule_id' => $this->ta_type_rule_id,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'ta_equation_name', $this->ta_equation_name])
            ->andFilterWhere(['like', 'ta_equation_detail', $this->ta_equation_detail])
            ->andFilterWhere(['like', 'active_status', $this->active_status]);

        return $dataProvider;
    }
}
