<?php

namespace app\modules\repairsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\repairsystem\models\RepDes;

/**
 * RepDesSearch represents the model behind the search form about `app\modules\repairsystem\models\RepDes`.
 */
class RepDesSearch extends RepDes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rep_des_id', 'asset_type_dept_id', 'building_id', 'room_id', 'rep_status_id', 'rep_photo_id'], 'integer'],
            [['fname', 'lname', 'email', 'tel', 'rep_date', 'asset_code', 'rep_des_detail'], 'safe'],
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
        $query = RepDes::find();

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
            'rep_des_id' => $this->rep_des_id,
            'rep_date' => $this->rep_date,
            'asset_type_dept_id' => $this->asset_type_dept_id,
            'building_id' => $this->building_id,
            'room_id' => $this->room_id,
            'rep_status_id' => $this->rep_status_id,
            'rep_photo_id' => $this->rep_photo_id,
        ]);

        $query->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'asset_code', $this->asset_code])
            ->andFilterWhere(['like', 'rep_des_detail', $this->rep_des_detail]);

        return $dataProvider;
    }
}
