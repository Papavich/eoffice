<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_form\models\Section;

/**
 * SectionSearch represents the model behind the search form of `app\modules\eoffice_form\models\Section`.
 */
class SectionSearch extends Section
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['section_id', 'section_order', 'req_template_template_id'], 'integer'],
            [['section_name', 'section_type'], 'safe'],
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
        $query = Section::find();

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
            'section_id' => $this->section_id,
            'section_order' => $this->section_order,
            'req_template_template_id' => $this->req_template_template_id,
        ]);

        $session = Yii::$app->session;
        $query->andFilterWhere(['like', 'section_name', $this->section_name])
            ->andFilterWhere(['like', 'section_type', $this->section_type])
            ->andFilterWhere(['like', 'req_template_template_id',  $session['id']]);

        return $dataProvider;
    }
}
