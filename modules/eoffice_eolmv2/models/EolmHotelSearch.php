<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_eolmv2\models\EolmHotel;

/**
 * EolmHotelSearch represents the model behind the search form of `app\modules\eoffice_eolmv2\models\EolmHotel`.
 */
class EolmHotelSearch extends EolmHotel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eolm_hotel_id'], 'integer'],
            [['eolm_hotel_name', 'eolm_hotel_address'], 'safe'],
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
        $query = EolmHotel::find();

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
            'eolm_hotel_id' => $this->eolm_hotel_id,
        ]);

        $query->andFilterWhere(['like', 'eolm_hotel_name', $this->eolm_hotel_name])
            ->andFilterWhere(['like', 'eolm_hotel_address', $this->eolm_hotel_address]);

        return $dataProvider;
    }
}
