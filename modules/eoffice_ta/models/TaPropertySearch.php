<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaProperty;

/**
 * TaPropertySearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaProperty`.
 */
class TaPropertySearch extends TaProperty
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_property_id', 'crby', 'udby'], 'integer'],
            [['ta_property_name', 'level_degree', 'property_detail', 'active_status', 'crtime', 'udtime'], 'safe'],
            [['ta_property_value', 'property_gpa'], 'number'],
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
        $query = TaProperty::find();

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
            'ta_property_id' => $this->ta_property_id,
            'ta_property_value' => $this->ta_property_value,
            'property_gpa' => $this->property_gpa,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'ta_property_name', $this->ta_property_name])
            ->andFilterWhere(['like', 'level_degree', $this->level_degree])
            ->andFilterWhere(['like', 'property_detail', $this->property_detail])
            ->andFilterWhere(['like', 'active_status', $this->active_status]);

        return $dataProvider;
    }
}
