<?php

namespace app\modules\requestform\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\requestform\models\ReqApprove;

/**
 * ReqApproveSearch represents the model behind the search form about `app\modules\requestform\models\ReqApprove`.
 */
class ReqApproveSearch extends ReqApprove
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['approve_running', 'approve_id', 'req_flow_flow_id', 'approve_visible', 'approve_queue'], 'integer'],
            [['approve_name', 'approve_status', 'approve_comment', 'approve_receivedate', 'approve_date'], 'safe'],
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
        $query = ReqApprove::find();

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
            'approve_running' => $this->approve_running,
            'approve_id' => Yii::$app->user->identity->id,
            'approve_receivedate' => $this->approve_receivedate,
            'approve_date' => $this->approve_date,
            'req_flow_flow_id' => $this->req_flow_flow_id,
            'approve_visible' => "1",
            'approve_queue' => $this->approve_queue,
        ]);

        $query->andFilterWhere(['like', 'approve_name', $this->approve_name])
            ->andFilterWhere(['like', 'approve_status', 'รอการพิจารณา'])
            ->andFilterWhere(['like', 'approve_comment', $this->approve_comment]);

        return $dataProvider;
    }

    public function getFlow()
    {
        return $this->hasOne(ReqFlow::className(), ['req_flow_flow_id' => 'flow_id']);
    }




}
