<?php

namespace app\modules\eoffice_exam\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_exam\models\EofficeExamInvigilate;

/**
 * EofficeExamInvigilate2Search represents the model behind the search form of `app\modules\eoffice_exam\models\EofficeExamInvigilate`.
 */
class EofficeExamInvigilate2Search extends EofficeExamInvigilate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id'], 'integer'],
            [['exam_date', 'examstart_time', 'exam_end_time', 'rooms_id'], 'safe'],
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
        $query = EofficeExamInvigilate::find();

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
            'exam_date' => $this->exam_date,
        ]);

        $query->andFilterWhere(['like', 'examstart_time', $this->examstart_time])
            ->andFilterWhere(['like', 'exam_end_time', $this->exam_end_time])
            ->andFilterWhere(['like', 'rooms_id', $this->rooms_id]);

        return $dataProvider;
    }
}
