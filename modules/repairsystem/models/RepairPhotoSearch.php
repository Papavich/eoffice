<?php

namespace app\modules\repairsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\repairsystem\models\RepairPhoto;

/**
 * RepairPhotoSearch represents the model behind the search form about `app\modules\repairsystem\models\RepairPhoto`.
 */
class RepairPhotoSearch extends RepairPhoto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rep_photo_id'], 'integer'],
            [['rep_photo_detail'], 'safe'],
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
        $query = RepairPhoto::find();

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
            'rep_photo_id' => $this->rep_photo_id,
        ]);

        $query->andFilterWhere(['like', 'rep_photo_detail', $this->rep_photo_detail]);

        return $dataProvider;
    }
}
