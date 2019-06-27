<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\AgencyAward;

/**
 * AgencyAwardSearch represents the model behind the search form of `app\modules\portfolio\models\AgencyAward`.
 */
class AgencyAwardSearch extends AgencyAward
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['areward_order_id'], 'integer'],
            [['image', 'data_detail', 'locus_areward', 'countries_areward', 'cities_areward'], 'safe'],
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
        $query = AgencyAward::find();

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
            'areward_order_id' => $this->areward_order_id,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'data_detail', $this->data_detail])
            ->andFilterWhere(['like', 'locus_areward', $this->locus_areward])
            ->andFilterWhere(['like', 'countries_areward', $this->countries_areward])
            ->andFilterWhere(['like', 'cities_areward', $this->cities_areward]);

        return $dataProvider;
    }
}
