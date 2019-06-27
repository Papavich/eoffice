<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\RegProgram;

/**
 * ProgramSearch represents the model behind the search form of `app\modules\personsystem\models\RegProgram`.
 */
class ProgramSearch extends RegProgram
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROGRAMID', 'PROGRAMCODE', 'PROGRAMTYPE', 'PROGRAMYEAR', 'FACULTYID', 'DEPARTMENTID', 'LEVELID', 'PROGRAMNAME', 'PROGRAMNAMEENG', 'PROGRAMABB', 'PROGRAMABBENG', 'CREDITTOTAL', 'STUDYYEARMAX', 'PROGRAMNAMECERTIFY', 'SEMESTERPERYEAR', 'PROGRAMSTATUS'], 'safe'],
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
        $query = RegProgram::find();

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
        $query->andFilterWhere(['like', 'PROGRAMID', $this->PROGRAMID])
            ->andFilterWhere(['like', 'PROGRAMCODE', $this->PROGRAMCODE])
            ->andFilterWhere(['like', 'PROGRAMTYPE', $this->PROGRAMTYPE])
            ->andFilterWhere(['like', 'PROGRAMYEAR', $this->PROGRAMYEAR])
            ->andFilterWhere(['like', 'FACULTYID', $this->FACULTYID])
            ->andFilterWhere(['like', 'DEPARTMENTID', $this->DEPARTMENTID])
            ->andFilterWhere(['like', 'LEVELID', $this->LEVELID])
            ->andFilterWhere(['like', 'PROGRAMNAME', $this->PROGRAMNAME])
            ->andFilterWhere(['like', 'PROGRAMNAMEENG', $this->PROGRAMNAMEENG])
            ->andFilterWhere(['like', 'PROGRAMABB', $this->PROGRAMABB])
            ->andFilterWhere(['like', 'PROGRAMABBENG', $this->PROGRAMABBENG])
            ->andFilterWhere(['like', 'CREDITTOTAL', $this->CREDITTOTAL])
            ->andFilterWhere(['like', 'STUDYYEARMAX', $this->STUDYYEARMAX])
            ->andFilterWhere(['like', 'PROGRAMNAMECERTIFY', $this->PROGRAMNAMECERTIFY])
            ->andFilterWhere(['like', 'SEMESTERPERYEAR', $this->SEMESTERPERYEAR])
            ->andFilterWhere(['like', 'PROGRAMSTATUS', $this->PROGRAMSTATUS]);

        return $dataProvider;
    }
}
