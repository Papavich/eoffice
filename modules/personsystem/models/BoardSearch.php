<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\BoardOfDirectors;

/**
 * BoardSearch represents the model behind the search form about `app\modules\personsystem\models\BoardOfDirectors`.
 */
class BoardSearch extends BoardOfDirectors
{
    public $person_name,$position_name,$period_describe;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['board_id','person_name','position_name','period_describe'], 'safe'],
            [['person_id', 'director_id', 'period_id'], 'integer'],

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
        $query = BoardOfDirectors::find();
        $query->joinWith(['person','director','period']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'board_id' => $this->board_id,
            'person.person_name'=> $this->person_name,
            'position_directors.position_name'=>$this->position_name,
            'period.period_describe'=> $this->period_describe,

        ]);
        $query->andFilterWhere(['like', 'board_id', $this->board_id])
            ->andFilterWhere(['like', 'person.person_name', $this->person_name])
            ->andFilterWhere(['like', 'position_directors.position_name', $this->position_name])
            ->andFilterWhere(['like', 'period.period_describe', $this->period_describe]);


        return $dataProvider;
    }
}
