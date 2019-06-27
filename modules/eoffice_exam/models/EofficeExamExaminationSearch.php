<?php

namespace app\modules\eoffice_exam\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_exam\models\EofficeExamExamination;

/**
 * EofficeExamExaminationSearch represents the model behind the search form of `app\modules\eoffice_exam\models\EofficeExamExamination`.
 */
class EofficeExamExaminationSearch extends EofficeExamExamination
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rooms_id', 'room_tag', 'subject_id', 'exam_date', 'exam_start_time', 'exam_end_time'], 'safe'],
            [['program_class'], 'integer'],
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
        $query = EofficeExamExamination::find();

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
            'program_class' => $this->program_class,
            'exam_date' => $this->exam_date,
        ]);

        $query->andFilterWhere(['like', 'rooms_id', $this->rooms_id])
            ->andFilterWhere(['like', 'room_tag', $this->room_tag])
            ->andFilterWhere(['like', 'subject_id', $this->subject_id])
            ->andFilterWhere(['like', 'exam_start_time', $this->exam_start_time])
            ->andFilterWhere(['like', 'exam_end_time', $this->exam_end_time]);

        return $dataProvider;
    }
}
