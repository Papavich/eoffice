<?php

namespace app\modules\pms\models\model_main;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pms\models\model_main\EofficeMain;

/**
 * Serach represents the model behind the search form of `app\modules\pms\models\model_main\EofficeMain`.
 */
class Serach extends EofficeMain
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENTID', 'STUDENTCODE', 'STUDENTNAME', 'STUDENTSURNAME', 'STUDENTNAMEENG', 'STUDENTSURNAMEENG', 'LEVELNAME'], 'safe'],
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
        $query = EofficeMain::find();

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
        $query->andFilterWhere(['like', 'STUDENTID', $this->STUDENTID])
            ->andFilterWhere(['like', 'STUDENTCODE', $this->STUDENTCODE])
            ->andFilterWhere(['like', 'STUDENTNAME', $this->STUDENTNAME])
            ->andFilterWhere(['like', 'STUDENTSURNAME', $this->STUDENTSURNAME])
            ->andFilterWhere(['like', 'STUDENTNAMEENG', $this->STUDENTNAMEENG])
            ->andFilterWhere(['like', 'STUDENTSURNAMEENG', $this->STUDENTSURNAMEENG])
            ->andFilterWhere(['like', 'LEVELNAME', $this->LEVELNAME]);

        return $dataProvider;
    }
}
