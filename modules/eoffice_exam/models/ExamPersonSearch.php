<?php

namespace app\modules\eoffice_exam\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_exam\models\ExamPerson;

/**
 * ExamPersonSearch represents the model behind the search form of `app\modules\eoffice_exam\models\ExamPerson`.
 */
class ExamPersonSearch extends ExamPerson
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'teacher_id'], 'integer'],
            [['type_id', 'prefix_id', 'person_name', 'person_surname', 'person_mail_register', 'person_mail', 'line_id', 'academic_positions_id', 'staff_position', 'department_id'], 'safe'],
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
        $query = ExamPerson::find();

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
            'person_id' => $this->person_id,
            'teacher_id' => $this->teacher_id,
        ]);

        $query->andFilterWhere(['like', 'type_id', $this->type_id])
            ->andFilterWhere(['like', 'prefix_id', $this->prefix_id])
            ->andFilterWhere(['like', 'person_name', $this->person_name])
            ->andFilterWhere(['like', 'person_surname', $this->person_surname])
            ->andFilterWhere(['like', 'person_mail_register', $this->person_mail_register])
            ->andFilterWhere(['like', 'person_mail', $this->person_mail])
            ->andFilterWhere(['like', 'line_id', $this->line_id])
            ->andFilterWhere(['like', 'academic_positions_id', $this->academic_positions_id])
            ->andFilterWhere(['like', 'staff_position', $this->staff_position])
            ->andFilterWhere(['like', 'department_id', $this->department_id]);

        return $dataProvider;
    }
}
