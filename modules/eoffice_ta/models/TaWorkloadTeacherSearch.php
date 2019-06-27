<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaWorkloadTeacher;

/**
 * TaWorkloadTeacherSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaWorkloadTeacher`.
 */
class TaWorkloadTeacherSearch extends TaWorkloadTeacher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_wload_teacher_id', 'section', 'subject_id', 'term', 'year', 'ta_type_work_id', 'ta_status_id', 'time_start', 'time_end', 'crtime', 'udtime', 'time_start_lab', 'time_end_lab', 'day_lect', 'day_lab'], 'safe'],
            [['subject_version', 'crby', 'udby'], 'integer'],
            [['lec_inspect', 'lect_check_list_std', 'lec_other', 'lab_hr'], 'number'],
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
        $query = TaWorkloadTeacher::find();

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
            'subject_version' => $this->subject_version,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'lec_inspect' => $this->lec_inspect,
            'lect_check_list_std' => $this->lect_check_list_std,
            'lec_other' => $this->lec_other,
            'lab_hr' => $this->lab_hr,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
            'time_start_lab' => $this->time_start_lab,
            'time_end_lab' => $this->time_end_lab,
        ]);

        $query->andFilterWhere(['like', 'ta_wload_teacher_id', $this->ta_wload_teacher_id])
            ->andFilterWhere(['like', 'section', $this->section])
            ->andFilterWhere(['like', 'subject_id', $this->subject_id])
            ->andFilterWhere(['like', 'term', $this->term])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'ta_type_work_id', $this->ta_type_work_id])
            ->andFilterWhere(['like', 'ta_status_id', $this->ta_status_id])
            ->andFilterWhere(['like', 'day_lect', $this->day_lect])
            ->andFilterWhere(['like', 'day_lab', $this->day_lab]);

        return $dataProvider;
    }
}
