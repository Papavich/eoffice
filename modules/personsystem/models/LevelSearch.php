<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\RegLevel;

/**
 * LevelSearch represents the model behind the search form of `app\modules\personsystem\models\RegLevel`.
 */
class LevelSearch extends RegLevel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LEVELID', 'LEVELNAME', 'LEVELNAMEENG', 'LEVELABB', 'LEVELABBENG', 'CURRENTACADYEAR', 'CURRENTSEMESTER', 'ENROLLACADYEAR', 'ENROLLSEMESTER', 'FIRSTYEAR'], 'safe'],
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
    public function search($params,$active)
    {
        $query = RegLevel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $arr=[];
        $arr[0]=$dataProvider;
        $arr[1]=1;
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $arr[1]=2;
            return $arr;
        }
        // grid filtering conditions
        $query->andFilterWhere(['like', 'LEVELID', $this->LEVELID])
            ->andFilterWhere(['like', 'LEVELNAME', $this->LEVELNAME])
            ->andFilterWhere(['like', 'LEVELNAMEENG', $this->LEVELNAMEENG])
            ->andFilterWhere(['like', 'LEVELABB', $this->LEVELABB])
            ->andFilterWhere(['like', 'LEVELABBENG', $this->LEVELABBENG])
            ->andFilterWhere(['like', 'CURRENTACADYEAR', $this->CURRENTACADYEAR])
            ->andFilterWhere(['like', 'CURRENTSEMESTER', $this->CURRENTSEMESTER])
            ->andFilterWhere(['like', 'ENROLLACADYEAR', $this->ENROLLACADYEAR])
            ->andFilterWhere(['like', 'ENROLLSEMESTER', $this->ENROLLSEMESTER])
            ->andFilterWhere(['like', 'FIRSTYEAR', $this->FIRSTYEAR]);

        return $arr ;

    }
}
