<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\ArewardOrder;

/**
 * ArewardOrderSearch represents the model behind the search form of `app\modules\portfolio\models\ArewardOrder`.
 */
class ArewardOrderSearch extends ArewardOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['areward_order_id', 'level_level_id', 'advisor_id', 'std_id', 'person_id', 'institution_ag_award_id', 'cities_id', 'member_member_id'], 'integer'],
            [['areward_name', 'date_areward', 'data_detail', 'image'], 'safe'],
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
        $query = ArewardOrder::find();

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
            'date_areward' => $this->date_areward,
            'level_level_id' => $this->level_level_id,
            'advisor_id' => $this->advisor_id,
            'std_id' => $this->std_id,
            'person_id' => $this->person_id,
            'institution_ag_award_id' => $this->institution_ag_award_id,
            'cities_id' => $this->cities_id,
            'member_member_id' => $this->member_member_id,
        ]);

        $query->andFilterWhere(['like', 'areward_name', $this->areward_name])
            ->andFilterWhere(['like', 'data_detail', $this->data_detail])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
