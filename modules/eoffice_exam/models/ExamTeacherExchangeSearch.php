<?php

namespace app\modules\eoffice_exam\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_exam\models\ExamTeacherExchange;

/**
 * ExamTeacherExchangeSearch represents the model behind the search form of `app\modules\eoffice_exam\models\ExamTeacherExchange`.
 */
class ExamTeacherExchangeSearch extends ExamTeacherExchange
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exam_exchange_date', 'exam_exchange_start_time', 'exam_exchange_end_time', 'exam_exchange_note', 'exam_type_namethai', 'rooms_id', 'eaxm_exchange_tel'], 'safe'],
            [['person_id', 'subopen_year', 'subopen_semester'], 'integer'],
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
        $query = ExamTeacherExchange::find();

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
            'exam_exchange_date' => $this->exam_exchange_date,
            'person_id' => $this->person_id,
            'subopen_year' => $this->subopen_year,
            'subopen_semester' => $this->subopen_semester,
        ]);

        $query->andFilterWhere(['like', 'exam_exchange_start_time', $this->exam_exchange_start_time])
            ->andFilterWhere(['like', 'exam_exchange_end_time', $this->exam_exchange_end_time])
            ->andFilterWhere(['like', 'exam_exchange_note', $this->exam_exchange_note])
            ->andFilterWhere(['like', 'exam_type_namethai', $this->exam_type_namethai])
            ->andFilterWhere(['like', 'rooms_id', $this->rooms_id])
            ->andFilterWhere(['like', 'eaxm_exchange_tel', $this->eaxm_exchange_tel]);

        return $dataProvider;
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search2($params)
    {
        $query = ExamTeacherExchange::find();
        $query->andFilterWhere(['person_id' => Yii::$app->user->identity->person_id]);  //ตัวให้แสดงแต่ของผู้ใช้
        // add conditions that should always apply here

        $dataProvider2 = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider2;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'exam_exchange_date' => $this->exam_exchange_date,
            'person_id' => $this->person_id,
            'subopen_year' => $this->subopen_year,
            'subopen_semester' => $this->subopen_semester,
        ]);

        $query->andFilterWhere(['like', 'exam_exchange_start_time', $this->exam_exchange_start_time])
            ->andFilterWhere(['like', 'exam_exchange_end_time', $this->exam_exchange_end_time])
            ->andFilterWhere(['like', 'exam_exchange_note', $this->exam_exchange_note])
            ->andFilterWhere(['like', 'exam_type_namethai', $this->exam_type_namethai])
            ->andFilterWhere(['like', 'rooms_id', $this->rooms_id])
            ->andFilterWhere(['like', 'eaxm_exchange_tel', $this->eaxm_exchange_tel]);

        return $dataProvider2;
    }
}
