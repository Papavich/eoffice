<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_form\models\ApproveFieldList;

/**
 * ApproveFieldListSearch represents the model behind the search form of `app\modules\eoffice_form\models\ApproveFieldList`.
 */
class ApproveFieldListSearch extends ApproveFieldList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['approve_field_list_id', 'approve_field_list_order'], 'integer'],
            [['approve_field_list_name', 'approve_field_ref'], 'safe'],
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
        $query = ApproveFieldList::find();

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
            'approve_field_list_id' => $this->approve_field_list_id,
            'approve_field_list_order' => $this->approve_field_list_order,
        ]);

        $query->andFilterWhere(['like', 'approve_field_list_name', $this->approve_field_list_name])
            ->andFilterWhere(['like', 'approve_field_ref', $this->approve_field_ref]);

        return $dataProvider;
    }
}
