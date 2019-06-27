<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\Major;

/**
 * MajorSearch represents the model behind the search form of `app\modules\personsystem\models\Major`.
 */
class MajorSearch extends Major
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['major_id', 'major_name', 'major_name_eng', 'major_code'], 'safe'],
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
        $query = Major::find();

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
        $query->andFilterWhere(['like', 'major_id', $this->major_id])
            ->andFilterWhere(['like', 'major_name', $this->major_name])
            ->andFilterWhere(['like', 'major_name_eng', $this->major_name_eng])
            ->andFilterWhere(['like', 'major_code', $this->major_code]);

        return $dataProvider;
    }
}
