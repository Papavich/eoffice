<?php

namespace app\modules\eoffice_consult\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_consult\models\Question;

/**
 * QuestionSearch represents the model behind the search form of `app\modules\eoffice_consult\models\Question`.
 */
class QuestionSearch extends Question
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'question_one', 'question_two', 'question_three', 'question_four', 'question_five'], 'integer'],
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
        $query = Question::find();

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
            'question_id' => $this->question_id,
            'question_one' => $this->question_one,
            'question_two' => $this->question_two,
            'question_three' => $this->question_three,
            'question_four' => $this->question_four,
            'question_five' => $this->question_five,
        ]);

        return $dataProvider;
    }
}
