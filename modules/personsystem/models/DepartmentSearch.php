<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\RegDepartment;

/**
 * DepartmentSearch represents the model behind the search form of `app\modules\personsystem\models\RegDepartment`.
 */
class DepartmentSearch extends RegDepartment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DEPARTMENTID', 'FACULTYID', 'DEPARTMENTNAME', 'DEPARTMENTNAMEENG'], 'safe'],
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
        $query = RegDepartment::find();

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
        $query->andFilterWhere(['like', 'DEPARTMENTID', $this->DEPARTMENTID])
            ->andFilterWhere(['like', 'FACULTYID', $this->FACULTYID])
            ->andFilterWhere(['like', 'DEPARTMENTNAME', $this->DEPARTMENTNAME])
            ->andFilterWhere(['like', 'DEPARTMENTNAMEENG', $this->DEPARTMENTNAMEENG]);

        return $dataProvider;
    }
}
