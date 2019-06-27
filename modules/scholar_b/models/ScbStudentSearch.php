<?php

namespace app\modules\scholar_b\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\scholar_b\models\ScbStudent;

/**
 * ScbStudentSearch represents the model behind the search form of `app\modules\scholar_b\models\ScbStudent`.
 */
class ScbStudentSearch extends ScbStudent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'scholarship_id', 'crtime', 'udtime'], 'safe'],
            [['scholarship_year', 'status_edu', 'status_advisor', 'out_of_scb_status', 'crby', 'udby'], 'integer'],
            [['out_of_scb_debt'], 'number'],
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
        $query = ScbStudent::find();

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
            'scholarship_year' => $this->scholarship_year,
            'status_edu' => $this->status_edu,
            'status_advisor' => $this->status_advisor,
            'out_of_scb_status' => $this->out_of_scb_status,
            'out_of_scb_debt' => $this->out_of_scb_debt,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'student_id', $this->student_id])
            ->andFilterWhere(['like', 'scholarship_id', $this->scholarship_id]);

        return $dataProvider;
    }
}
