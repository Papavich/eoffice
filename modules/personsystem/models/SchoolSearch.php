<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\RegSchool;

/**
 * SchoolSearch represents the model behind the search form of `app\modules\personsystem\models\RegSchool`.
 */
class SchoolSearch extends RegSchool
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SCHOOLID'], 'integer'],
            [['SCHOOLNAME', 'SCHOOLNAMEENG', 'SCHOOLHEAD', 'SCHOOLADDRESS1', 'SCHOOLADDRESS2', 'SCHOOLDISTRICT', 'SCHOOLZIPCODE', 'SCHOOLPHONENO', 'SCHOOLPROVINCEID', 'SCHOOLCODE', 'FLAG1', 'NATIONID', 'SCHOOLCODE2', 'VALID', 'GROUPID'], 'safe'],
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
        $query = RegSchool::find();

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
            'SCHOOLID' => $this->SCHOOLID,
        ]);

        $query->andFilterWhere(['like', 'SCHOOLNAME', $this->SCHOOLNAME])
            ->andFilterWhere(['like', 'SCHOOLNAMEENG', $this->SCHOOLNAMEENG])
            ->andFilterWhere(['like', 'SCHOOLHEAD', $this->SCHOOLHEAD])
            ->andFilterWhere(['like', 'SCHOOLADDRESS1', $this->SCHOOLADDRESS1])
            ->andFilterWhere(['like', 'SCHOOLADDRESS2', $this->SCHOOLADDRESS2])
            ->andFilterWhere(['like', 'SCHOOLDISTRICT', $this->SCHOOLDISTRICT])
            ->andFilterWhere(['like', 'SCHOOLZIPCODE', $this->SCHOOLZIPCODE])
            ->andFilterWhere(['like', 'SCHOOLPHONENO', $this->SCHOOLPHONENO])
            ->andFilterWhere(['like', 'SCHOOLPROVINCEID', $this->SCHOOLPROVINCEID])
            ->andFilterWhere(['like', 'SCHOOLCODE', $this->SCHOOLCODE])
            ->andFilterWhere(['like', 'FLAG1', $this->FLAG1])
            ->andFilterWhere(['like', 'NATIONID', $this->NATIONID])
            ->andFilterWhere(['like', 'SCHOOLCODE2', $this->SCHOOLCODE2])
            ->andFilterWhere(['like', 'VALID', $this->VALID])
            ->andFilterWhere(['like', 'GROUPID', $this->GROUPID]);

        return $dataProvider;
    }
}
