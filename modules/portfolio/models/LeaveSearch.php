<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\Leave;

/**
 * LeaveSearch represents the model behind the search form about `backend\models\Leave`.
 */
class LeaveSearch extends Leave
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'leave_num'], 'integer'],
            [['person_id', 'leave_year', 'leave_type', 'leave_date_start', 'leave_date_end', 'leave_reason', 'leave_status'], 'safe'],
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
        //$query = Leave::find();
        $query = Leave::find()->joinWith(['person'])->orderBy(['id' => SORT_DESC]);
 
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
            'id' => $this->id,
            'leave_date_start' => $this->leave_date_start,
            'leave_date_end' => $this->leave_date_end,
            'leave_num' => $this->leave_num,
        ]);

        $query->andFilterWhere(['like', 'person_id', $this->person_id])
            ->andFilterWhere(['like', 'leave_year', $this->leave_year])
            ->andFilterWhere(['like', 'leave_type', $this->leave_type])
            ->andFilterWhere(['like', 'leave_reason', $this->leave_reason])
            ->andFilterWhere(['like', 'leave_status', $this->leave_status]);

        return $dataProvider;
    }
}
