<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\Frequency;

/**
 * FrequencySearch represents the model behind the search form about `app\modules\portfolio\models\Frequency`.
 */
class FrequencySearch extends Frequency
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frequency_order_id'], 'integer'],
            [['frequency_name', 'frequency_id'], 'safe'],
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
        $query = Frequency::find();

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
            'frequency_order_id' => $this->frequency_order_id,
        ]);

        $query->andFilterWhere(['like', 'frequency_name', $this->frequency_name])
            ->andFilterWhere(['like', 'frequency_id', $this->frequency_id]);

        return $dataProvider;
    }
}
