<?php

namespace app\modules\consulting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\consulting\models\ConsultPoint;

/**
 * ConsultPointSearch represents the model behind the search form of `app\modules\consulting\models\ConsultPoint`.
 */
class ConsultPointSearch extends ConsultPoint
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['consult_point_id'], 'integer'],
            [['consult_point_name'], 'safe'],
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
        $query = ConsultPoint::find();

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
            'consult_point_id' => $this->consult_point_id,
        ]);

        $query->andFilterWhere(['like', 'consult_point_name', $this->consult_point_name]);

        return $dataProvider;
    }
}
