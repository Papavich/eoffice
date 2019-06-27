<?php

namespace app\modules\scholar_b\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\scholar_b\models\ScbConditionHasStudent;

/**
 * ScbConditionHasStudentSearch represents the model behind the search form of `app\modules\scholar_b\models\ScbConditionHasStudent`.
 */
class ScbConditionHasStudentSearch extends ScbConditionHasStudent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['condi_id', 'scholarship_year', 'condition_pass'], 'integer'],
            [['scholarship_id', 'student_id'], 'safe'],
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
        $query = ScbConditionHasStudent::find();

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
            'condi_id' => $this->condi_id,
            'scholarship_year' => $this->scholarship_year,
            'condition_pass' => $this->condition_pass,
        ]);

        $query->andFilterWhere(['like', 'scholarship_id', $this->scholarship_id])
            ->andFilterWhere(['like', 'student_id', $this->student_id]);

        return $dataProvider;
    }
}
