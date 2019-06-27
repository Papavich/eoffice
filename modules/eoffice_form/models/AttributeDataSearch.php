<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_form\models\AttributeData;

/**
 * AttributeDataSearch represents the model behind the search form of `app\modules\eoffice_form\models\AttributeData`.
 */
class AttributeDataSearch extends AttributeData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_data_id', 'attribute_order', 'design_section_id'], 'integer'],
            [['attribute_data', 'attribute_ref'], 'safe'],
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
        $query = AttributeData::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        } $session = Yii::$app->session;
        // grid filtering conditions
        $query->andFilterWhere([
            'attribute_data_id' => $this->attribute_data_id,
            'attribute_order' => $this->attribute_order,
            'design_section_id' =>  $session['design_section_id'],
        ]);

        $query->andFilterWhere(['like', 'attribute_data', $this->attribute_data])
            ->andFilterWhere(['like', 'attribute_ref', $session['attribute_ref']]);

        return $dataProvider;
    }
}
