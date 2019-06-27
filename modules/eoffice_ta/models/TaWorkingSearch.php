<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaWorking;

/**
 * TaWorkingSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaWorking`.
 */
class TaWorkingSearch extends TaWorking
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ta_work_plan_id', 'subject_version', 'crby', 'udby'], 'integer'],
            [['person_id', 'subject_id', 'section', 'term_id', 'year_id', 'ta_type_work_id', 'ta_work_title', 'ta_work_role', 'time_start', 'time_end', 'ta_working_note', 'working_date', 'ta_status_id', 'crtime', 'udtime', 'active_status', 'working_evidence'], 'safe'],
            [['hr_working'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = TaWorking::find();

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
            'ta_work_plan_id' => $this->ta_work_plan_id,
            'subject_version' => $this->subject_version,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'hr_working' => $this->hr_working,
            'working_date' => $this->working_date,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'person_id', $this->person_id])
            ->andFilterWhere(['like', 'subject_id', $this->subject_id])
            ->andFilterWhere(['like', 'section', $this->section])
            ->andFilterWhere(['like', 'term_id', $this->term_id])
            ->andFilterWhere(['like', 'year_id', $this->year_id])
            ->andFilterWhere(['like', 'ta_type_work_id', $this->ta_type_work_id])
            ->andFilterWhere(['like', 'ta_work_title', $this->ta_work_title])
            ->andFilterWhere(['like', 'ta_work_role', $this->ta_work_role])
            ->andFilterWhere(['like', 'ta_working_note', $this->ta_working_note])
            ->andFilterWhere(['like', 'ta_status_id', $this->ta_status_id])
            ->andFilterWhere(['like', 'active_status', $this->active_status])
            ->andFilterWhere(['like', 'working_evidence', $this->working_evidence]);

        return $dataProvider;
    }
}
