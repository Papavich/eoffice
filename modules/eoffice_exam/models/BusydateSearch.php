<?php

namespace app\modules\eoffice_exam\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_exam\models\Busydate;

/**
 * BusydateSearch represents the model behind the search form of `app\modules\eoffice_exam\models\Busydate`.
 */
class BusydateSearch extends Busydate
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['exam_busydate_date', 'exam_busydate_time', 'exam_busydate_note', 'exam_busy_file'], 'safe'],
            [['person_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Busydate::find();
        $query->andFilterWhere(['person_id' => Yii::$app->user->identity->person_id]);  //ตัวให้แสดงแต่ของผู้ใช้
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
            'exam_busydate_date' => $this->exam_busydate_date,
            'person_id' => $this->person_id,
        ]);

        $query->andFilterWhere(['like', 'exam_busydate_time', $this->exam_busydate_time])
            ->andFilterWhere(['like', 'exam_busydate_note', $this->exam_busydate_note])
            ->andFilterWhere(['like', 'exam_busy_file', $this->exam_busy_file]);

        return $dataProvider;
    }
}
