<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_form\models\DesignAttribute;

/**
 * DesignAttributeSearch represents the model behind the search form of `app\modules\eoffice_form\models\DesignAttribute`.
 */
class DesignAttributeSearch extends DesignAttribute
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_ref', 'attribute_name'], 'safe'],
            [['attribute_order', 'design_section_id', 'attribute_function_id', 'attribute_type_id'], 'integer'],
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
        $query = DesignAttribute::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'attribute_order' => [
                    'asc' => ['attribute_order' => SORT_ASC],
                    'desc' => ['attribute_order' => SORT_DESC],
                    'default' => SORT_ASC
                ],
            ],
            'defaultOrder' => [
                'attribute_order' => SORT_ASC
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
            'attribute_order' => $this->attribute_order,
            'design_section_id' => $session['design_section_id'],
            'attribute_function_id' => $this->attribute_function_id,
            'attribute_type_id' => $this->attribute_type_id,
        ]);

        $query->andFilterWhere(['like', 'attribute_ref', $this->attribute_ref])
            ->andFilterWhere(['like', 'attribute_name', $this->attribute_name]);

        return $dataProvider;
    }
}
