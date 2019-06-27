<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_form\models\ReqApproval;

/**
 * ReqApprovalSearch represents the model behind the search form of `app\modules\eoffice_form\models\ReqApproval`.
 */
class ReqApprovalSearch extends ReqApproval
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'template_id', 'cr_term', 'cr_year', 'approve_group_queue', 'approve_id', 'approve_queue'], 'integer'],
            [['cr_date', 'approve_name', 'approve_status', 'approve_comment', 'approve_visible', 'approve_enddate', 'approve_json'], 'safe'],
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
        $query = ReqApproval::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'cr_date' => [
                    'asc' => ['cr_date' => SORT_ASC],
                    'desc' => ['cr_date' => SORT_DESC],
                    'default' => SORT_ASC
                ],
            ],
            'defaultOrder' => [
                'cr_date' => SORT_ASC
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
            'user_id' => $this->user_id,
            'template_id' => $this->template_id,
            'cr_date' => $this->cr_date,
            'cr_term' => $this->cr_term,
            'cr_year' => $this->cr_year,
            'approve_group_queue' => $this->approve_group_queue,
            'approve_id' => Yii::$app->user->identity->username,
            'approve_queue' => $this->approve_queue,
            'approve_enddate' => $this->approve_enddate,
            'approve_visible' => 'Visible',
            'approve_status' => 'กำลังดำเนินการ',
        ]);

        $query->andFilterWhere(['like', 'approve_name', $this->approve_name])
            //->andFilterWhere(['like', 'approve_status', $this->approve_status])
            ->andFilterWhere(['like', 'approve_comment', $this->approve_comment])
            //->andFilterWhere(['like', 'approve_visible', 'Visible'])
            ->andFilterWhere(['like', 'approve_json', $this->approve_json]);

        return $dataProvider;
    }
}
