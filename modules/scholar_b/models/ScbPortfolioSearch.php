<?php

namespace app\modules\scholar_b\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\scholar_b\models\ScbPortfolio;

/**
 * ScbPortfolioSearch represents the model behind the search form of `app\modules\scholar_b\models\ScbPortfolio`.
 */
class ScbPortfolioSearch extends ScbPortfolio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_portfolio', 'crby', 'udby', 'port_type_id', 'year', 'semester', 'project_code'], 'integer'],
            [['port_name', 'port_date', 'port_img', 'port_location', 'port_detail', 'port_file', 'crtime', 'udtime'], 'safe'],
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
        $query = ScbPortfolio::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->where(['crby'=> Yii::$app->user->identity->getId()]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_portfolio' => $this->id_portfolio,
            'port_date' => $this->port_date,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
            'port_type_id' => $this->port_type_id,
            'year' => $this->year,
            'semester' => $this->semester,
            'project_code' => $this->project_code,
        ]);

        $query->andFilterWhere(['like', 'port_name', $this->port_name])
            ->andFilterWhere(['like', 'port_img', $this->port_img])
            ->andFilterWhere(['like', 'port_location', $this->port_location])
            ->andFilterWhere(['like', 'port_detail', $this->port_detail])
            ->andFilterWhere(['like', 'port_file', $this->port_file]);

        return $dataProvider;
    }
}
