<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_eolmv2\models\EolmRepay;

/**
 * EolmRepaySearch represents the model behind the search form of `app\modules\eoffice_eolmv2\models\EolmRepay`.
 */
class EolmRepaySearch extends EolmRepay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eolm_app_id'], 'integer'],
            [['eolm_repay_date'], 'safe'],
            [['eolm_repay'], 'number'],
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
        $query = EolmRepay::find();

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
            'eolm_app_id' => $this->eolm_app_id,
            'eolm_repay_date' => $this->eolm_repay_date,
            'eolm_repay' => $this->eolm_repay,
        ]);

        return $dataProvider;
    }
}
