<?php

namespace app\modules\eoffice_asset\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_asset\models\AssetBorrow;

/**
 * AssetBorrowSearch represents the model behind the search form of `app\modules\eoffice_asset\models\AssetBorrow`.
 */
class AssetBorrowSearch extends AssetBorrow
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['borrow_id'], 'integer'],
            [['borrow_user_fname', 'borrow_user_lname', 'borrow_user_tel', 'borrow_date', 'borrow_object'], 'safe'],
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
        $query = AssetBorrow::find();

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
            'borrow_id' => $this->borrow_id,
            'borrow_date' => $this->borrow_date,
        ]);

        $query->andFilterWhere(['like', 'borrow_user_fname', $this->borrow_user_fname])
            ->andFilterWhere(['like', 'borrow_user_lname', $this->borrow_user_lname])
            ->andFilterWhere(['like', 'borrow_user_tel', $this->borrow_user_tel])
            ->andFilterWhere(['like', 'borrow_object', $this->borrow_object]);

        return $dataProvider;
    }
}