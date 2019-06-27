<?php

namespace app\modules\consulting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\consulting\models\ViewPisUser;

/**
 * ViewPisUserSearch represents the model behind the search form of `app\modules\consulting\models\ViewPisUser`.
 */
class ViewPisUserSearch extends ViewPisUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['consult_user_id', 'consult_user_tel'], 'integer'],
            [['consult_user_fname', 'consult_user_lname', 'consult_user_email', 'consult__user_password'], 'safe'],
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
        $query = ViewPisUser::find();

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
            'consult_user_id' => $this->consult_user_id,
            'consult_user_tel' => $this->consult_user_tel,
        ]);

        $query->andFilterWhere(['like', 'consult_user_fname', $this->consult_user_fname])
            ->andFilterWhere(['like', 'consult_user_lname', $this->consult_user_lname])
            ->andFilterWhere(['like', 'consult_user_email', $this->consult_user_email])
            ->andFilterWhere(['like', 'consult__user_password', $this->consult__user_password]);

        return $dataProvider;
    }
}
