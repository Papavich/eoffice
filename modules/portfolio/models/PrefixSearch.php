<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\Prefix;

/**
 * PrefixSearch represents the model behind the search form about `backend\models\Prefix`.
 */
class PrefixSearch extends Prefix
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prefix_id', 'prefix_name'], 'safe'],
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
        $query = Prefix::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'prefix_id', $this->prefix_id])
            ->andFilterWhere(['like', 'prefix_name', $this->prefix_name]);

        return $dataProvider;
    }
}
