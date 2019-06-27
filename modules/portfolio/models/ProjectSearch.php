<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\Project;

/**
 * ProjectSearch represents the model behind the search form of `app\modules\portfolio\models\Project`.
 */
class ProjectSearch extends Project
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'std_id', 'person_id', 'cities_id'], 'integer'],
            [['project_name_thai', 'project_name_eng', 'project_start', 'project_end', 'project_duration', 'project_budget', 'repayment', 'project_url', 'participation'], 'safe'],
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
        $query = Project::find();

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
            'project_id' => $this->project_id,
            'project_start' => $this->project_start,
            'project_end' => $this->project_end,
            'std_id' => $this->std_id,
            'person_id' => $this->person_id,
            'cities_id' => $this->cities_id,
        ]);

        $query->andFilterWhere(['like', 'project_name_thai', $this->project_name_thai])
            ->andFilterWhere(['like', 'project_name_eng', $this->project_name_eng])
            ->andFilterWhere(['like', 'project_duration', $this->project_duration])
            ->andFilterWhere(['like', 'project_budget', $this->project_budget])
            ->andFilterWhere(['like', 'repayment', $this->repayment])
            ->andFilterWhere(['like', 'project_url', $this->project_url])
            ->andFilterWhere(['like', 'participation', $this->participation]);

        return $dataProvider;
    }
}
