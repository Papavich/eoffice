<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\AuthorLevel;

/**
 * AuthorLevelSearch represents the model behind the search form of `app\modules\portfolio\models\AuthorLevel`.
 */
class AuthorLevelSearch extends AuthorLevel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auth_level_id'], 'integer'],
            [['auth_level_name'], 'safe'],
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
        $query = AuthorLevel::find();

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
            'auth_level_id' => $this->auth_level_id,
        ]);

        $query->andFilterWhere(['like', 'auth_level_name', $this->auth_level_name]);

        return $dataProvider;
    }
}
