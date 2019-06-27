<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_form\models\BoxAttribute;

/**
 * BoxAttributeSearch represents the model behind the search form of `app\modules\eoffice_form\models\BoxAttribute`.
 */
class BoxAttributeSearch extends BoxAttribute
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['box_ref', 'box_name', 'box_type', 'box_function'], 'safe'],
            [['box_order', 'section_section_id'], 'integer'],
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
        $query = BoxAttribute::find();

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
            'box_order' => $this->box_order,
            'section_section_id' => $this->section_section_id,
        ]);
        $session = Yii::$app->session;
        $query->andFilterWhere(['like', 'box_ref', $this->box_ref])
            ->andFilterWhere(['like', 'box_name', $this->box_name])
            ->andFilterWhere(['like', 'box_type', $this->box_type])
            ->andFilterWhere(['like', 'box_function', $this->box_function])
        ->andFilterWhere(['like', 'section_section_id',  $session['section_id']]);

        return $dataProvider;
    }
}
