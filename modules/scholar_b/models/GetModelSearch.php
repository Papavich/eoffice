<?php

namespace app\modules\scholar_b\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\scholar_b\models\ScbStudentHasTeacher;

/**
 * GetModelSearch represents the model behind the search form of `app\modules\scholar_b\models\ScbStudentHasTeacher`.
 */
class GetModelSearch extends ScbStudentHasTeacher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'teacher_id_card'], 'safe'],
            [['teacher_type_id'], 'integer'],
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
        $query = ScbStudentHasTeacher::find();

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
            'teacher_type_id' => $this->teacher_type_id,
        ]);

        $query->andFilterWhere(['like', 'student_id', $this->student_id])
            ->andFilterWhere(['like', 'teacher_id_card', $this->teacher_id_card]);

        return $dataProvider;
    }
}
