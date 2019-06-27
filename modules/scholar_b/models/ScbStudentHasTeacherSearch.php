<?php

namespace app\modules\scholar_b\models;

use app\modules\scholar_b\models\model_main\EofficeCentralViewStudentFull;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\scholar_b\models\ScbStudentHasTeacher;

/**
 * ScbStudentHasTeacherSearch represents the model behind the search form of `app\modules\scholar_b\models\ScbStudentHasTeacher`.
 */
class ScbStudentHasTeacherSearch extends ScbStudentHasTeacher
{
    public $PREFIXNAME;
    public $STUDENTNAME;
    public $STUDENTSURNAME;
    public $STUDENTSTATUS;
    public $scholarship_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'teacher_id_card','STUDENTNAME','STUDENTSURNAME','STUDENTSTATUS' ,'PREFIXNAME','scholarship_id'], 'safe'],
            [['teacher_type_id'], 'integer'],
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
        $query = ScbStudentHasTeacher::find()->orderBy('student_id ASC');
        $query->joinWith(['viewStudent']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'teacher_type_id' => $this->teacher_type_id,
            'STUDENTNAME' => $this->STUDENTNAME,
            'STUDENTSURNAME' => $this->STUDENTSURNAME,
            'scholarship_id' => $this->scholarship_id,
        ]);

        $query->andFilterWhere(['like', 'student_id', $this->student_id])
            ->andFilterWhere(['like', 'teacher_id_card', $this->teacher_id_card])
            ->andFilterWhere(['like', 'PREFIXNAME', $this->PREFIXNAME])
            ->andFilterWhere(['like', 'STUDENTNAME', $this->STUDENTNAME])
            ->andFilterWhere(['like', 'STUDENTSURNAME', $this->STUDENTSURNAME])
            ->andFilterWhere(['like', 'scholarship_id', $this->scholarship_id])
        ;

        return $dataProvider;
    }
}
