<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\ProjectOrder;

/**
 * ProjectOrderSearch represents the model behind the search form of `app\modules\portfolio\models\ProjectOrder`.
 */
class ProjectOrderSearch extends ProjectOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_order_id', 'project_role_project_role_id', 'project_member_pro_member_id', 'project_project_id', 'sponsor_sponsor_id'], 'integer'],
            [['person_id'], 'safe'],
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
        $query = ProjectOrder::find();

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
            'project_order_id' => $this->project_order_id,
            'project_role_project_role_id' => $this->project_role_project_role_id,
            'project_member_pro_member_id' => $this->project_member_pro_member_id,
            'project_project_id' => $this->project_project_id,
            'sponsor_sponsor_id' => $this->sponsor_sponsor_id,
        ]);

        $query->andFilterWhere(['like', 'person_id', $this->person_id]);

        return $dataProvider;
    }
}
