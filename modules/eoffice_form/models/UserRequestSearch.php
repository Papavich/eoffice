<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_form\models\UserRequest;

/**
 * UserRequestSearch represents the model behind the search form of `app\modules\eoffice_form\models\UserRequest`.
 */
class UserRequestSearch extends UserRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'template_id', 'cr_term', 'cr_year'], 'integer'],
            [['cr_date', 'req_json', 'req_doc'], 'safe'],
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
        $query = UserRequest::find();

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
            'user_id' =>Yii::$app->user->identity->id,
            'template_id' => $this->template_id,
            'cr_date' => $this->cr_date,
            'cr_term' => $this->cr_term,
            'cr_year' => $this->cr_year,
        ]);

        $query->andFilterWhere(['like', 'req_json', $this->req_json])
            ->andFilterWhere(['like', 'req_doc', $this->req_doc]);

        return $dataProvider;
    }
}
