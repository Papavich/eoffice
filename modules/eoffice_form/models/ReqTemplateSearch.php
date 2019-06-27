<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_form\models\ReqTemplate;

/**
 * ReqTemplateSearch represents the model behind the search form of `app\modules\eoffice_form\models\ReqTemplate`.
 */
class ReqTemplateSearch extends ReqTemplate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_id'], 'integer'],
            [['template_name', 'cr_date', 'cr_by', 'template_available', 'template_file', 'template_level', 'template_operation', 'template_category', 'ud_by', 'ud_date', 'template_description'], 'safe'],
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
        $query = ReqTemplate::find();

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
            'template_id' => $this->template_id,
            'cr_date' => $this->cr_date,
            'ud_date' => $this->ud_date,
        ]);

        $query->andFilterWhere(['like', 'template_name', $this->template_name])
            ->andFilterWhere(['like', 'cr_by', $this->cr_by])
            ->andFilterWhere(['like', 'template_available', $this->template_available])
            ->andFilterWhere(['like', 'template_file', $this->template_file])
            ->andFilterWhere(['like', 'template_level', $this->template_level])
            ->andFilterWhere(['like', 'template_operation', $this->template_operation])
            ->andFilterWhere(['like', 'template_category', $this->template_category])
            ->andFilterWhere(['like', 'ud_by', $this->ud_by])
            ->andFilterWhere(['like', 'template_description', $this->template_description]);

        return $dataProvider;
    }
}
