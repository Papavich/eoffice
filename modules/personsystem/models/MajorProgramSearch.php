<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\MajorHasProgram;

/**
 * MajorProgramSearch represents the model behind the search form of `app\modules\personsystem\models\MajorHasProgram`.
 */
class MajorProgramSearch extends MajorHasProgram
{
    public $major_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['major_id', 'PROGRAMID','major_name'], 'safe'],
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

        $query = MajorHasProgram::find();
        $query->joinWith(['major']);
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
       // $query->andFilterWhere(['like', 'major_id', $this->major_id])
        $query->andFilterWhere(['like', 'PROGRAMID', $this->PROGRAMID])
        ->andFilterWhere(['like', 'major.major_name', $this->major_name]);

        return $dataProvider;
    }
}
