<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_form\models\ApprovePosition;

/**
 * ApprovePositionSearch represents the model behind the search form of `app\modules\eoffice_form\models\ApprovePosition`.
 */
class ApprovePositionSearch extends ApprovePosition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_id', 'position_order', 'approve_group_id'], 'integer'],
            [['position_name'], 'safe'],
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
        $query = ApprovePosition::find();

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
        $session = Yii::$app->session;

        // grid filtering conditions
        $query->andFilterWhere([
            'position_id' => $this->position_id,
            'position_order' => $this->position_order,
            'approve_group_id' =>  $session['group_id'],
        ]);

        $query->andFilterWhere(['like', 'position_name', $this->position_name]);

        return $dataProvider;
    }
}
