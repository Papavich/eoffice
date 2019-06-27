<?php

namespace app\modules\requestform\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\requestform\models\ReqForm;

/**
 * ReqFlowSearch represents the model behind the search form about `app\modules\requestform\models\ReqForm`.
 */
class ReqFlowSearch extends ReqForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['form_id', 'user_id', 'cryear', 'crterm', 'req_template_template_id'], 'integer'],
            [['form_value', 'form_layout', 'req_formcol', 'crdate'], 'safe'],
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
        $query = ReqForm::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'form_id' => [
                    'asc' => ['form_id' => SORT_ASC],
                    'desc' => ['form_id' => SORT_DESC],
                    'default' => SORT_DESC
                ],
            ],
            'defaultOrder' => [
                'form_id' => SORT_DESC
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'form_id' => $this->form_id,
            'user_id' => Yii::$app->user->identity->id,
            'crdate' => $this->crdate,
            'cryear' => $this->cryear,
            'crterm' => $this->crterm,
            'req_template_template_id' => $this->req_template_template_id,
        ]);

        $query->andFilterWhere(['like', 'form_value', $this->form_value])
            ->andFilterWhere(['like', 'form_layout', $this->form_layout])
            ->andFilterWhere(['like', 'req_formcol', $this->req_formcol]);

        return $dataProvider;
    }
}
