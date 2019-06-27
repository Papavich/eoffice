<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_form\models\PositionAssign;

/**
 * PositionAssignSearch represents the model behind the search form of `app\modules\eoffice_form\models\PositionAssign`.
 */
class PositionAssignSearch extends PositionAssign
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_id', 'user_id'], 'integer'],
            [['cr_date', 'cr_by', 'ud_date', 'ud_by'], 'safe'],
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
        $query = PositionAssign::find();

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
            'cr_date' => $this->cr_date,
            'ud_date' => $this->ud_date,
        ]);

        $query->andFilterWhere(['like', 'cr_by', $this->cr_by])
            ->andFilterWhere(['like', 'ud_by', $this->ud_by]);

        return $dataProvider;
    }
}
