<?php

namespace app\modules\eoffice_exam\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_exam\models\ExamRoomDetail;

/**
 * ExamRoomDetailSearch represents the model behind the search form of `app\modules\eoffice_exam\models\ExamRoomDetail`.
 */
class ExamRoomDetailSearch extends ExamRoomDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rooms_detail_date', 'rooms_detail_time', 'rooms_id', 'exam_room_tag', 'exam_room_status', 'rooms_pic'], 'safe'],
            [['exam_rooms_seat', 'exam_rooms_seat_temp'], 'integer'],
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
        $query = ExamRoomDetail::find();

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
        $session = Yii::$app->session;
        // grid filtering conditions
        $query->andFilterWhere([
//            'rooms_detail_date' =>$session['date'],
            'exam_rooms_seat' => $this->exam_rooms_seat,
            'exam_rooms_seat_temp' => $this->exam_rooms_seat_temp,
            'exam_room_tag' => $this->exam_room_tag,
        ]);

if ([$session['room']!='empty' && $session['date']==NULL])
{
    $query->andFilterWhere(['like', 'rooms_detail_time',$this->rooms_detail_time])
        ->andFilterWhere(['like', 'rooms_id', $session['room']])
        ->andFilterWhere(['like', 'rooms_detail_date', $this->rooms_detail_date])
        ->andFilterWhere(['like', 'exam_room_tag', $this->exam_room_tag])
        ->andFilterWhere(['like', 'exam_room_status', $this->exam_room_status])
        ->andFilterWhere(['like', 'rooms_pic', $this->rooms_pic]);

    return $dataProvider;

}elseif([$session['room']=='empty' && $session['date']!=NULL])
{
    $query->andFilterWhere(['like', 'rooms_detail_time',$this->rooms_detail_time])
        ->andFilterWhere(['like', 'rooms_id', $this->rooms_id])
        ->andFilterWhere(['like', 'rooms_detail_date', $session['date']])
        ->andFilterWhere(['like', 'exam_room_tag', $this->exam_room_tag])
        ->andFilterWhere(['like', 'exam_room_status', $this->exam_room_status])
        ->andFilterWhere(['like', 'rooms_pic', $this->rooms_pic]);

    return $dataProvider;

}

    }
}
