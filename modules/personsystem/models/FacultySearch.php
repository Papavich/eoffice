<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\RegFaculty;

/**
 * FacultySearch represents the model behind the search form of `app\modules\personsystem\models\RegFaculty`.
 */
class FacultySearch extends RegFaculty
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FACULTYID', 'FACULTYNAME', 'FACULTYNAMEENG', 'FACULTYABB', 'FACULTYABBENG', 'DEAN', 'DEANENG', 'FACULTYTYPE', 'FACULTYGROUP'], 'safe'],
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
        $query = RegFaculty::find();

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
        $query->andFilterWhere(['like', 'FACULTYID', $this->FACULTYID])
            ->andFilterWhere(['like', 'FACULTYNAME', $this->FACULTYNAME])
            ->andFilterWhere(['like', 'FACULTYNAMEENG', $this->FACULTYNAMEENG])
            ->andFilterWhere(['like', 'FACULTYABB', $this->FACULTYABB])
            ->andFilterWhere(['like', 'FACULTYABBENG', $this->FACULTYABBENG])
            ->andFilterWhere(['like', 'DEAN', $this->DEAN])
            ->andFilterWhere(['like', 'DEANENG', $this->DEANENG])
            ->andFilterWhere(['like', 'FACULTYTYPE', $this->FACULTYTYPE])
            ->andFilterWhere(['like', 'FACULTYGROUP', $this->FACULTYGROUP]);

        return $dataProvider;
    }
}
