<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\Participation;

/**
 * ParticipationSearch represents the model behind the search form of `app\modules\portfolio\models\Participation`.
 */
class ParticipationSearch extends Participation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['participation_project_code'], 'integer'],
            [['participation_project_name', 'participation_value'], 'safe'],
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
        $query = Participation::find();

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
            'participation_project_code' => $this->participation_project_code,
        ]);

        $query->andFilterWhere(['like', 'participation_project_name', $this->participation_project_name])
            ->andFilterWhere(['like', 'participation_value', $this->participation_value]);

        return $dataProvider;
    }
}
