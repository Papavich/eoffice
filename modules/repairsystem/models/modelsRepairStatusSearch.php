<?php

namespace app\modules\repairsystem;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\repairsystem\models\RepairStatus;

/**
 * modelsRepairStatusSearch represents the model behind the search form about `app\modules\repairsystem\models\RepairStatus`.
 */
class modelsRepairStatusSearch extends RepairStatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rep_status_id'], 'integer'],
            [['rep_status_name'], 'safe'],
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
        $query = RepairStatus::find();

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
            'rep_status_id' => $this->rep_status_id,
        ]);

        $query->andFilterWhere(['like', 'rep_status_name', $this->rep_status_name]);

        return $dataProvider;
    }
}
