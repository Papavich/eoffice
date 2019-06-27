<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/4/2018
 * Time: 3:01 PM
 */

namespace app\modules\personsystem\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\Student;

class StudentskillSearch extends ViewStudentFull
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENTID', 'student_height', 'student_weight', 'student_current_district_id', 'student_current_amphur_id', 'student_current_province_id', 'student_current_zipcode_id', 'student_home_district_id', 'student_home_amphur_id', 'student_home_province_id', 'student_home_zipcode_id', 'father_district_id', 'father_amphur_id', 'father_province_id', 'father_zipcode_id', 'mother_district_id', 'mother_amphur_id', 'mother_province_id', 'mother_zipcode_id', 'parent_district_id', 'parent_amphur_id', 'parent_province_id', 'parent_zipcode_id', 'FACULTYID', 'DEPARTMENTID', 'branch_id', 'major_id'], 'integer'],
            [['STUDENTCODE', 'student_card_id', 'student_email', 'student_img', 'student_nickname', 'student_blood_group', 'student_underlying_disease', 'student_marital_status', 'student_mobile_phone', 'student_facebook_url', 'student_line_id', 'student_working_status', 'student_working_place', 'student_current_address', 'student_home_address', 'father_birthday', 'father_highest_qualification', 'father_career', 'father_work_place', 'father_mobile', 'father_address', 'father_religion', 'father_nationality', 'mother_birthday', 'mother_highest_qualification', 'mother_career', 'mother_work_place', 'mother_mobile', 'mother_address', 'mother_religion', 'mother_nationality', 'marital_status_parents', 'parent_career', 'parent_address', 'parent_religion', 'parent_mobile', 'parent_nationality', 'contact_name', 'contact_relation', 'contact_mobile', 'PREFIXID', 'LEVELID', 'STUDENTNAME', 'STUDENTNAMEENG', 'STUDENTSURNAME', 'STUDENTSURNAMEENG', 'STUDENTYEAR', 'STUDENTEMAIL', 'STUDENTSTATUS', 'GPA', 'ADMITDATE', 'FINISHDATE', 'PROGRAMID', 'NATIONID', 'SCHOOLID', 'RELIGIONID', 'ENTRYTYPE', 'BIRTHDATE', 'ENTRYDEGREE', 'STUDENTFATHERNAME', 'STUDENTMOTHERNAME', 'STUDENTSEX', 'ENTRYGPA', 'CITIZENID', 'PARENTRELATION', 'PARENTNAME', 'STUDENTMOBILE', 'HOMEADDRESS1', 'HOMEADDRESS2', 'HOMEDISTRICT', 'HOMEZIPCODE', 'major_name', 'major_name_eng', 'DEPARTMENTNAME', 'FACULTYNAMEENG', 'FACULTYNAME', 'DEPARTMENTNAMEENG', 'LEVELNAME', 'LEVELNAMEENG', 'PREFIXNAME', 'PROGRAMNAME', 'PARENTPHONENO', 'HOMEPROVINCEID', 'CURRENTADDRESS1', 'CURRENTADDRESS2', 'CURRENTDISTRICT', 'CURRENTPROVINCEID', 'CURRENTZIPCODE', 'CONTACTPERSON', 'CONTACTPHONENO', 'CONTACTRELATION', 'HOMEPHONENO', 'RELIGIONNAME', 'RELIGIONNAMEENG', 'NATIONNAME', 'OFFICERID', 'OFFICERNAME', 'OFFICERSURNAME', 'SCHOOLNAME', 'branch_name', 'major_code', 'ADMITSEMESTER', 'ADMITACADYEAR', 'student_skill'], 'safe'],
            [['student_working_salary', 'father_income_per_month', 'mother_income_permonth'], 'number'],
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
    public function search($params,$id_skill)
    {
        $query = ViewStudentFull::find();
            $query->innerJoin('student_skill', 'student_skill.id_student = view_student_full.STUDENTID')
            ->where(['in', 'id_skill', $id_skill]);

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
            'STUDENTID' => $this->STUDENTID,
            'FACULTYID' => $this->FACULTYID,
            'DEPARTMENTID' => $this->DEPARTMENTID,
            'branch_id' => $this->branch_id,
            'major_id' => $this->major_id,
        ]);

        $query->andFilterWhere(['like', 'STUDENTCODE', $this->STUDENTCODE])
            ->andFilterWhere(['like', 'STUDENTCODE', $this->STUDENTCODE])
            ->andFilterWhere(['=', 'PREFIXNAME', $this->PREFIXNAME])
            ->andFilterWhere(['like', 'LEVELID', $this->LEVELID])
            ->andFilterWhere(['like', 'STUDENTNAME', $this->STUDENTNAME])
            ->andFilterWhere(['like', 'STUDENTSURNAME', $this->STUDENTSURNAME])
            ->andFilterWhere(['like', 'STUDENTYEAR', $this->STUDENTYEAR])
            ->andFilterWhere(['like', 'STUDENTSTATUS', $this->STUDENTSTATUS])
            ->andFilterWhere(['like', 'PROGRAMID', $this->PROGRAMID])
            ->andFilterWhere(['like', 'major_name', $this->major_name])
            ->andFilterWhere(['like', 'major_code', $this->major_code])
            ->andFilterWhere(['like', 'LEVELID', $this->LEVELNAME])
            ->andFilterWhere(['like', 'ADMITACADYEAR', $this->ADMITACADYEAR]);

        return $dataProvider;
    }

}