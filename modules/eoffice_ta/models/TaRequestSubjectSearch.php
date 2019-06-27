<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaRequestSubject;

/**
 * TaRequestSubjectSearch represents the model behind the search form about `app\modules\eoffice_ta\models\TaRequestSubject`.
 */
class TaRequestSubjectSearch extends TaRequestSubject
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'subject_id', 'term_id', 'year'], 'safe'],
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
        $query = TaRequestSubject::find();

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
        $query->andFilterWhere(['like', 'person_id', $this->person_id])
            ->andFilterWhere(['like', 'subject_id', $this->subject_id])
            ->andFilterWhere(['like', 'term_id', $this->term_id])
            ->andFilterWhere(['like', 'year', $this->year]);

        return $dataProvider;
    }
}
