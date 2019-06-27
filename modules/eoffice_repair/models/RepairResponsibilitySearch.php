<?php

namespace app\modules\eoffice_repair\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_repair\models\RepairResponsibility;

/**
 * RepairResponsibilitySearch represents the model behind the search form of `app\modules\eoffice_repair\models\RepairResponsibility`.
 */
class RepairResponsibilitySearch extends RepairResponsibility
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rep_resp_id', 'staff_id'], 'integer'],
            [['rep_location'], 'safe'],
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
        $query = RepairResponsibility::find();

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
            'rep_resp_id' => $this->rep_resp_id,
            'staff_id' => $this->staff_id,
        ]);

        $query->andFilterWhere(['like', 'rep_location', $this->rep_location]);

        return $dataProvider;
    }
}
