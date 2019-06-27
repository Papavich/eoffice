<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_form\models\ApproveDesignField;

/**
 * ApproveDesignFieldSearch represents the model behind the search form of `app\modules\eoffice_form\models\ApproveDesignField`.
 */
class ApproveDesignFieldSearch extends ApproveDesignField
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['approve_field_ref', 'approve_field_name'], 'safe'],
            [['approve_field_order', 'approve_design_id', 'attribute_type_id'], 'integer'],
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
        $query = ApproveDesignField::find();

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
            'approve_field_order' => $this->approve_field_order,
            'approve_design_id' => $this->approve_design_id,
            'attribute_type_id' => $this->attribute_type_id,
        ]);

        $query->andFilterWhere(['like', 'approve_field_ref', $this->approve_field_ref])
            ->andFilterWhere(['like', 'approve_field_name', $this->approve_field_name]);

        return $dataProvider;
    }
}
