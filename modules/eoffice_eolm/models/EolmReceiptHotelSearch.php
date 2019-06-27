<?php

namespace app\modules\eoffice_eolm\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_eolm\models\EolmReceiptHotel;

/**
 * EolmReceiptHotelSearch represents the model behind the search form of `app\modules\eoffice_eolm\models\EolmReceiptHotel`.
 */
class EolmReceiptHotelSearch extends EolmReceiptHotel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eolm_app_id', 'eolm_hotel_id', 'crby', 'udby'], 'integer'],
            [[ 'eolm_rec_hotel_stay_date', 'eolm_rec_hotel_checkout_date', 'eolm_rec_hotel_amount_text', 'crtime', 'udtime'], 'safe'],
            [['eolm_rec_hotel_amount'], 'number'],
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
        $query = EolmReceiptHotel::find()->where(['eolm_app_id'=>$_GET['id']]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['udtime'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'eolm_app_id' => $this->eolm_app_id,
            'eolm_hotel_id' => $this->eolm_hotel_id,
            'eolm_rec_hotel_stay_date' => $this->eolm_rec_hotel_stay_date,
            'eolm_rec_hotel_checkout_date' => $this->eolm_rec_hotel_checkout_date,
            'eolm_rec_hotel_amount' => $this->eolm_rec_hotel_amount,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'eolm_rec_hotel_amount_text', $this->eolm_rec_hotel_amount_text]);

        return $dataProvider;
    }
}
