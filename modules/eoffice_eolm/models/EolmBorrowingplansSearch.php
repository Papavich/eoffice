<?php

namespace app\modules\eoffice_eolm\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_eolm\models\EolmBorrowingplans;

/**
 * EolmBorrowingplansSearch represents the model behind the search form about `app\modules\eoffice_eolm\models\EolmBorrowingplans`.
 */
class EolmBorrowingplansSearch extends EolmBorrowingplans
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eolm_app_id'], 'integer'],
            [['eolm_bor_periods', 'eolm_bor_date_spent'], 'safe'],
        ];
    }
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolm');
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
        $query = EolmBorrowingplans::find();

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
            'eolm_bor_date_spent' => $this->eolm_bor_date_spent,
        ]);

        $query->andFilterWhere(['like', 'eolm_bor_periods', $this->eolm_bor_periods]);

        return $dataProvider;
    }
}
