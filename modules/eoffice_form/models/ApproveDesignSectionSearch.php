<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_form\models\ApproveDesignSection;

/**
 * ApproveDesignSectionSearch represents the model behind the search form of `app\modules\eoffice_form\models\ApproveDesignSection`.
 */
class ApproveDesignSectionSearch extends ApproveDesignSection
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['approve_design_id', 'approve_design_order', 'approve_group_id', 'section_type_id'], 'integer'],
            [['approve_design_name'], 'safe'],
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
        $query = ApproveDesignSection::find();

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
            'approve_design_id' => $this->approve_design_id,
            'approve_design_order' => $this->approve_design_order,
            'approve_group_id' => $this->approve_group_id,
            'section_type_id' => $this->section_type_id,
        ]);

        $query->andFilterWhere(['like', 'approve_design_name', $this->approve_design_name]);

        return $dataProvider;
    }
}
