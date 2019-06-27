<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\ViewStudentFull;

/**
 * StudentListSearch represents the model behind the search form of `app\modules\personsystem\models\ViewStudentFull`.
 */
class StudentListSearch extends ViewStudentFull
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENTID', 'STUDENTCODE', 'student_card_id', 'student_email', 'student_img', 'student_nickname', 'student_height', 'student_weight', 'student_blood_group', 'student_underlying_disease', 'student_marital_status', 'student_mobile_phone', 'student_facebook_url', 'student_line_id', 'student_working_status', 'student_working_place', 'student_current_address', 'student_home_address', 'father_birthday', 'father_highest_qualification', 'father_career', 'father_work_place', 'father_mobile', 'father_address', 'father_religion', 'father_nationality', 'mother_birthday', 'mother_highest_qualification', 'mother_career', 'mother_work_place', 'mother_mobile', 'mother_address', 'mother_religion', 'mother_nationality', 'marital_status_parents', 'parent_career', 'parent_address', 'parent_religion', 'parent_mobile', 'parent_nationality', 'contact_name', 'contact_relation', 'contact_mobile', 'PREFIXID', 'LEVELID', 'STUDENTNAME', 'STUDENTNAMEENG', 'STUDENTSURNAME', 'STUDENTSURNAMEENG', 'STUDENTYEAR', 'STUDENTEMAIL', 'STUDENTSTATUS', 'ADMITDATE', 'FINISHDATE', 'FACULTYID', 'DEPARTMENTID', 'PROGRAMID', 'NATIONID', 'SCHOOLID', 'RELIGIONID', 'ENTRYTYPE', 'BIRTHDATE', 'ENTRYDEGREE', 'STUDENTFATHERNAME', 'STUDENTMOTHERNAME', 'STUDENTSEX', 'ADMITACADYEAR', 'ADMITSEMESTER', 'CITIZENID', 'PARENTRELATION', 'PARENTNAME', 'STUDENTMOBILE', 'HOMEADDRESS1', 'HOMEADDRESS2', 'HOMEDISTRICT', 'HOMEZIPCODE', 'major_name', 'major_name_eng', 'major_code', 'DEPARTMENTNAME', 'FACULTYNAMEENG', 'FACULTYNAME', 'DEPARTMENTNAMEENG', 'LEVELNAME', 'LEVELNAMEENG', 'PREFIXNAME', 'PROGRAMNAME', 'PARENTPHONENO', 'HOMEPROVINCEID', 'CURRENTADDRESS1', 'CURRENTADDRESS2', 'CURRENTDISTRICT', 'CURRENTPROVINCEID', 'CURRENTZIPCODE', 'CONTACTPERSON', 'CONTACTPHONENO', 'CONTACTRELATION', 'HOMEPHONENO','branch_name'], 'safe'],
            [['student_working_salary', 'father_income_per_month', 'mother_income_permonth', 'GPA', 'ENTRYGPA'], 'number'],
            [['student_current_district_id', 'student_current_amphur_id', 'student_current_province_id', 'student_current_zipcode_id', 'student_home_district_id', 'student_home_amphur_id', 'student_home_province_id', 'student_home_zipcode_id', 'father_district_id', 'father_amphur_id', 'father_province_id', 'father_zipcode_id', 'mother_district_id', 'mother_amphur_id', 'mother_province_id', 'mother_zipcode_id', 'parent_district_id', 'parent_amphur_id', 'parent_province_id', 'parent_zipcode_id'], 'integer'],
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
        $query = ViewStudentFull::find()->orderBy(['STUDENTID' => SORT_DESC]);

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
            'GPA' => $this->GPA,
            'ADMITDATE' => $this->ADMITDATE,
            'FINISHDATE' => $this->FINISHDATE,
            'BIRTHDATE' => $this->BIRTHDATE,
            'ENTRYGPA' => $this->ENTRYGPA,
        ]);


        $query->andFilterWhere(['like', 'STUDENTID', $this->STUDENTID])
            ->andFilterWhere(['like', 'STUDENTCODE', $this->STUDENTCODE])
            ->andFilterWhere(['=', 'PREFIXNAME', $this->PREFIXNAME])
            ->andFilterWhere(['like', 'LEVELID', $this->LEVELID])
            ->andFilterWhere(['like', 'STUDENTNAME', $this->STUDENTNAME])
            ->andFilterWhere(['like', 'STUDENTNAMEENG', $this->STUDENTNAMEENG])
            ->andFilterWhere(['like', 'STUDENTSURNAME', $this->STUDENTSURNAME])
            ->andFilterWhere(['like', 'STUDENTSURNAMEENG', $this->STUDENTSURNAMEENG])
            ->andFilterWhere(['like', 'STUDENTYEAR', $this->STUDENTYEAR])
            ->andFilterWhere(['like', 'STUDENTSTATUS', $this->STUDENTSTATUS])
            ->andFilterWhere(['like', 'FACULTYID', $this->FACULTYID])
            ->andFilterWhere(['like', 'DEPARTMENTID', $this->DEPARTMENTID])
            ->andFilterWhere(['like', 'PROGRAMID', $this->PROGRAMID])
            ->andFilterWhere(['like', 'major_name', $this->major_name])
            ->andFilterWhere(['like', 'major_name_eng', $this->major_name_eng])
            ->andFilterWhere(['like', 'major_code', $this->major_code])
            ->andFilterWhere(['like', 'LEVELID', $this->LEVELNAME])
            ->andFilterWhere(['like', 'ADMITACADYEAR', $this->ADMITACADYEAR])
      ;

        return $dataProvider;
    }
}
