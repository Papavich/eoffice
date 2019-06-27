<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\AwardOrder;

/**
 * AwardOrderSearchSearch represents the model behind the search form of `app\modules\portfolio\models\AwardOrder`.
 */
class AwardOrderSearchSearch extends AwardOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['areward_order_id', 'date_areward', 'level_level_id', 'level_level_id1', 'project_member_pro_member_id'], 'integer'],
            [['areward_name', 'owner_owner_id'], 'safe'],
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
        $query = AwardOrder::find();

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
            'level_level_id1' => $this->level_level_id1,
            'project_member_pro_member_id' => $this->project_member_pro_member_id,
        ]);

        $query->andFilterWhere(['like', 'areward_name', $this->areward_name])
            ->andFilterWhere(['like', 'owner_owner_id', $this->owner_owner_id]);

        return $dataProvider;
    }
}
