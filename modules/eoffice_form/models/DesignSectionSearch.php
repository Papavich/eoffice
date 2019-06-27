<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_form\models\DesignSection;

/**
 * DesignSectionSearch represents the model behind the search form of `app\modules\eoffice_form\models\DesignSection`.
 */
class DesignSectionSearch extends DesignSection
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['design_section_id', 'design_section_order', 'template_id', 'section_type_id'], 'integer'],
            [['design_section_name'], 'safe'],
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
        $query = DesignSection::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'design_section_order' => [
                    'asc' => ['design_section_order' => SORT_ASC],
                    'desc' => ['design_section_order' => SORT_DESC],
                    'default' => SORT_ASC
                ],
            ],
            'defaultOrder' => [
                'design_section_order' => SORT_ASC
            ]
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
            'design_section_id' => $this->design_section_id,
            'design_section_order' => $this->design_section_order,
            'template_id' => $session['template_id'],
            'section_type_id' => $this->section_type_id,
        ]);

        $query->andFilterWhere(['like', 'design_section_name', $this->design_section_name]);

        return $dataProvider;
    }
}
