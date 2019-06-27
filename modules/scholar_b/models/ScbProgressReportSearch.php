<?php

namespace app\modules\scholar_b\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\scholar_b\models\ScbProgressReport;

/**
 * ScbProgressReportSearch represents the model behind the search form of `app\modules\scholar_b\models\ScbProgressReport`.
 */
class ScbProgressReportSearch extends ScbProgressReport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['progress_seq', 'project_year', 'project_semester', 'project_code', 'year', 'semester', 'crby', 'udby'], 'integer'],
            [['student_id', 'proj_summary', 'proj_activity', 'proj_factual', 'proj_plan_next_year', 'plan_year1', 'plan_year2', 'plan_year3', 'plan_year4', 'proj_problem', 'crtime', 'udtime'], 'safe'],
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
        $query = ScbProgressReport::find();

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
            'progress_seq' => $this->progress_seq,
            'project_year' => $this->project_year,
            'project_semester' => $this->project_semester,
            'project_code' => $this->project_code,
            'year' => $this->year,
            'semester' => $this->semester,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'student_id', $this->student_id])
            ->andFilterWhere(['like', 'proj_summary', $this->proj_summary])
            ->andFilterWhere(['like', 'proj_activity', $this->proj_activity])
            ->andFilterWhere(['like', 'proj_factual', $this->proj_factual])
            ->andFilterWhere(['like', 'proj_plan_next_year', $this->proj_plan_next_year])
            ->andFilterWhere(['like', 'plan_year1', $this->plan_year1])
            ->andFilterWhere(['like', 'plan_year2', $this->plan_year2])
            ->andFilterWhere(['like', 'plan_year3', $this->plan_year3])
            ->andFilterWhere(['like', 'plan_year4', $this->plan_year4])
            ->andFilterWhere(['like', 'proj_problem', $this->proj_problem]);

        return $dataProvider;
    }
}
