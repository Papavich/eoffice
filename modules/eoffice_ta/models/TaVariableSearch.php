<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaVariable;

/**
 * TaVariableSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaVariable`.
 */
class TaVariableSearch extends TaVariable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_variable_id', 'crby', 'udby'], 'integer'],
            [['ta_variable_name', 'ta_variable_detail', 'status', 'crtime', 'udtime'], 'safe'],
            [['ta_variable_value'], 'number'],
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
        $query = TaVariable::find()->orderBy('ta_variable_name ASC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ta_variable_id' => $this->ta_variable_id,
            'ta_variable_value' => $this->ta_variable_value,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'ta_variable_name', $this->ta_variable_name])
            ->andFilterWhere(['like', 'ta_variable_detail', $this->ta_variable_detail]);
            //->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
