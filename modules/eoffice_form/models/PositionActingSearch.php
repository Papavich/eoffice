<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_form\models\PositionActing;

/**
 * PositionActingSearch represents the model behind the search form of `app\modules\eoffice_form\models\PositionActing`.
 */
class PositionActingSearch extends PositionActing
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_id', 'user_id'], 'integer'],
            [['acting_startDate', 'acting_endDate'], 'safe'],
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
        $query = PositionActing::find();

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
            'position_id' => $this->position_id,
            'user_id' => $this->user_id,
            'acting_startDate' => $this->acting_startDate,
            'acting_endDate' => $this->acting_endDate,
        ]);

        return $dataProvider;
    }
}
