<?php

namespace app\modules\eproject\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eproject\models\Tool;

/**
 * ToolSearch represents the model behind the search form of `app\modules\eproject\models\Tool`.
 */
class ToolSearch extends Tool
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'crby', 'udby'], 'integer'],
            [['name', 'crtime', 'udtime'], 'safe'],
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
        $query = Tool::find();

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
            'id' => $this->id,
            'crby' => $this->crby,
            'udby' => $this->udby,
            'crtime' => $this->crtime,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
