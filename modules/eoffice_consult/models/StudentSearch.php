<?php

namespace app\modules\eoffice_consult\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_consult\models\EofficeCentralViewStudentFull;


/**
 * ConsultPostSearch represents the model behind the search form of `app\modules\eoffice_consult\models\ConsultPost`.
 */
class StudentSearch extends EofficeCentralViewStudentFull
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENTID', '', 'status_id', 'topic_owner_id', 'respon_id'], 'integer'],
            [['STUDENTCODE', 'post_ark_date', 'post_ans'], 'safe'],
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
        $query = ConsultPost::find();

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
            'post_id' => $this->post_id,
            'post_ark_date' => $this->post_ark_date,
            'user_id' => $this->user_id,
            'status_id' => $this->status_id,
            'topic_owner_id' => $this->topic_owner_id,
            'respon_id' => $this->respon_id,
        ]);

        $query->andFilterWhere(['like', 'post_ark_detail', $this->post_ark_detail])
            ->andFilterWhere(['like', 'post_ans', $this->post_ans]);

        return $dataProvider;
    }
}
