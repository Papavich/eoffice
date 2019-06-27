<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\RegStudentmaster;

/**
 * StudentmasterSearch represents the model behind the search form of `app\modules\personsystem\models\RegStudentmaster`.
 */
class StudentmasterSearch extends RegStudentmaster
{
    public $PREFIXNAME;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENTID', 'STUDENTCODE', 'PREFIXID', 'LEVELID', 'STUDENTNAME', 'STUDENTNAMEENG', 'STUDENTSURNAME', 'STUDENTSURNAMEENG', 'STUDENTYEAR', 'STUDENTEMAIL', 'STUDENTSTATUS', 'ADMITDATE', 'FINISHDATE', 'FACALTYID', 'DEPARTMENTID', 'PROGRAMID','PREFIXNAME'], 'safe'],
            [['GPA'], 'number'],
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
        $query = RegStudentmaster::find();
        $query->leftJoin(RegPrefix::tableName(), RegStudentmaster::tableName() . '.PREFIXID = ' . RegPrefix::tableName() . '.PREFIXID')
            ->leftJoin(AvsregProgram::tableName(), RegStudentmaster::tableName() . '.PROGRAMID = ' . AvsregProgram::tableName() . '.PROGRAMID');

       // $query->joinWith(['pREFIX','pROGRAM']);
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
            'GPA' => $this->GPA,
            'ADMITDATE' => $this->ADMITDATE,
            'FINISHDATE' => $this->FINISHDATE,

        ]);


        if($this->STUDENTSTATUS=="นักศึกษาปกติ"){
            $this->STUDENTSTATUS="10";
        }else if($this->STUDENTSTATUS=="รักษาสภาพนักศึกษา"){
            $this->STUDENTSTATUS="11";
        }else if($this->STUDENTSTATUS=="ลาพักการเรียน"){
                $this->STUDENTSTATUS="12";
        }else if($this->STUDENTSTATUS=="สำเร็จการศึกษา"){
            $this->STUDENTSTATUS="40";
        }else if($this->STUDENTSTATUS=="พ้นสภาพเนื่องจากไม่ชำระค่าลงทะเบียนต่อ"){
            $this->STUDENTSTATUS="61";
        }
        else{
            $this->STUDENTSTATUS="";
        }


        $query->andFilterWhere(['like', 'STUDENTID', $this->STUDENTID])
            ->andFilterWhere(['like', 'STUDENTCODE', $this->STUDENTCODE])
            ->andFilterWhere(['like', 'PREFIXID', $this->PREFIXID])
            ->andFilterWhere(['like', 'LEVELID', $this->LEVELID])
            ->andFilterWhere(['like', 'STUDENTNAME', $this->STUDENTNAME])
            ->andFilterWhere(['like', 'STUDENTNAMEENG', $this->STUDENTNAMEENG])
            ->andFilterWhere(['like', 'STUDENTSURNAME', $this->STUDENTSURNAME])
            ->andFilterWhere(['like', 'STUDENTSURNAMEENG', $this->STUDENTSURNAMEENG])
            ->andFilterWhere(['like', 'STUDENTYEAR', $this->STUDENTYEAR])
            ->andFilterWhere(['like', 'STUDENTEMAIL', $this->STUDENTEMAIL])
            ->andFilterWhere(['like', 'STUDENTSTATUS', $this->STUDENTSTATUS])
            ->andFilterWhere(['like', 'FACALTYID', $this->FACALTYID])
            ->andFilterWhere(['like', 'DEPARTMENTID', $this->DEPARTMENTID])
            ->andFilterWhere(['like', 'PROGRAMID', $this->PROGRAMID])
            ->andFilterWhere(['like', 'PREFIXNAME', $this->PREFIXNAME]);

        return $dataProvider;
    }
}
