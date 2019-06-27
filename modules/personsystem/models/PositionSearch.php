<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\PositionDirectors;

/**
 * PositionSearch represents the model behind the search form of `app\modules\personsystem\models\PositionDirectors`.
 */
class PositionSearch extends PositionDirectors
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['director_id'], 'integer'],
            [['position_name', 'position_name_eng'], 'safe'],
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
        $query = PositionDirectors::find();

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
            'director_id' => $this->director_id,
            'position_name' => $this->position_name,
        ]);

        $query->andFilterWhere(['LIKE', 'position_name', $this->position_name])
            ->andFilterWhere(['like', 'position_name_eng', $this->position_name_eng]);

        return $dataProvider;
    }
}
