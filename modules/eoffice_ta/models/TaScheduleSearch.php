<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaSchedule;

/**
 * TaScheduleSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaSchedule`.
 */
class TaScheduleSearch extends TaSchedule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_schedule_id', 'crby', 'udby'], 'integer'],
            [['ta_schedule_url', 'ta_schedule_title', 'time_start', 'time_end', 'ta_schedule_detail', 'ta_schedule_type', 'term', 'year', 'active_status', 'crtime', 'udtime'], 'safe'],
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
        $query = TaSchedule::find();

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
            'ta_schedule_id' => $this->ta_schedule_id,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'ta_schedule_url', $this->ta_schedule_url])
            ->andFilterWhere(['like', 'ta_schedule_title', $this->ta_schedule_title])
            ->andFilterWhere(['like', 'ta_schedule_detail', $this->ta_schedule_detail])
            ->andFilterWhere(['like', 'ta_schedule_type', $this->ta_schedule_type])
            ->andFilterWhere(['like', 'term', $this->term])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'active_status', $this->active_status]);

        return $dataProvider;
    }
}
