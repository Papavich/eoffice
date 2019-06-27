<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\Advisors;

/**
 * AdvisorsSearch represents the model behind the search form of `app\modules\portfolio\models\Advisors`.
 */
class AdvisorsSearch extends Advisors
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['advisors_id', 'person_id', 'department_id', 'prefix_id', 'acadmic_positions_id', 'expertise_id', 'areward_order_areward_order_id', 'project_member_pro_member_id', 'publication_order_pub_order_id'], 'integer'],
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
        $query = Advisors::find();

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
            'advisors_id' => $this->advisors_id,
            'person_id' => $this->person_id,
            'department_id' => $this->department_id,
            'prefix_id' => $this->prefix_id,
            'acadmic_positions_id' => $this->acadmic_positions_id,
            'expertise_id' => $this->expertise_id,
            'areward_order_areward_order_id' => $this->areward_order_areward_order_id,
            'project_member_pro_member_id' => $this->project_member_pro_member_id,
            'publication_order_pub_order_id' => $this->publication_order_pub_order_id,
        ]);

        return $dataProvider;
    }
}
