<?php

namespace app\modules\eoffice_ta\models\model_main;

use Yii;
use app\modules\eoffice_ta\models\TaRegister;

/**
 * This is the model class for table "eoffice_main.person_view".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $user_type_type
 * @property string $person_id
 * @property string $department_id
 * @property string $major_id
 * @property string $student_fname_th
 * @property string $student_lname_th
 * @property string $student_fname_en
 * @property string $student_lname_en
 * @property string $person_fname_th
 * @property string $person_fname_eng
 * @property string $person_lname_th
 * @property string $person_lname_eng
 * @property string $prefix_th
 * @property string $prefix_en
 * @property string $NATIONID
 * @property string $RELIGIONID
 * @property string $SCHOOLID
 * @property string $ENTRYTYPE
 * @property string $ENTRYDEGREE
 * @property string $BIRTHDATE
 * @property string $STUDENTFATHERNAME
 * @property string $STUDENTMOTHERNAME
 * @property string $STUDENTSEX
 * @property string $ADMITACADYEAR
 * @property string $ADMITSEMESTER
 * @property string $PARENTNAME
 * @property double $ENTRYGPA
 * @property string $PARENTRELATION
 * @property string $CONTACTPERSON
 * @property string $STUDENTMOBILE
 * @property int $adviser_id
 * @property string $student_card_id
 * @property string $student_email
 * @property string $student_img
 * @property string $student_height
 * @property string $student_nickname
 * @property string $student_weight
 * @property string $student_blood_group
 * @property string $student_underlying_disease
 * @property string $student_marital_status
 * @property string $student_mobile_phone
 * @property string $student_facebook_url
 * @property string $student_line_id
 * @property string $student_working_status
 * @property string $student_working_place
 * @property double $student_working_salary
 * @property string $student_current_address
 * @property int $student_current_district_id
 * @property int $student_current_amphur_id
 * @property int $student_current_province_id
 * @property int $student_current_zipcode_id
 * @property int $student_home_province_id
 * @property string $student_home_address
 * @property int $student_home_amphur_id
 * @property int $student_home_district_id
 * @property int $student_home_zipcode_id
 * @property string $father_birthday
 * @property string $father_highest_qualification
 * @property string $father_career
 * @property string $father_work_place
 * @property string $father_mobile
 * @property string $father_address
 * @property int $father_district_id
 * @property int $father_amphur_id
 * @property int $father_province_id
 * @property int $father_zipcode_id
 * @property string $father_religion
 * @property string $father_nationality
 * @property double $father_income_per_month
 * @property string $mother_birthday
 * @property string $mother_highest_qualification
 * @property string $mother_career
 * @property string $mother_work_place
 * @property string $mother_mobile
 * @property string $mother_address
 * @property int $mother_district_id
 * @property int $mother_amphur_id
 * @property int $mother_province_id
 * @property int $mother_zipcode_id
 * @property string $mother_religion
 * @property string $mother_nationality
 * @property double $mother_income_permonth
 * @property string $marital_status_parents
 * @property string $parent_career
 * @property string $parent_address
 * @property int $parent_district_id
 * @property int $parent_amphur_id
 * @property int $parent_province_id
 * @property int $parent_zipcode_id
 * @property string $parent_mobile
 * @property string $parent_religion
 * @property string $parent_nationality
 * @property string $contact_relation
 * @property string $contact_address
 * @property int $contact_district_id
 * @property int $contact_amphur_id
 * @property int $contact_province_id
 * @property int $contact_zipcode_id
 * @property string $contact_mobile
 * @property string $contact_religion
 * @property string $contact_nationality
 * @property string $LEVELNAME
 * @property string $LEVELABB
 * @property string $LEVELNAMEENG
 * @property string $LEVELID
 * @property string $PREFIXID
 * @property string $lecturer
 *
 * @property Level $level
 * @property Type $type
 * @property TaAssess[] $taAssesses
 * @property TaInboxUser[] $taInboxUsers
 * @property TaLanguageAbility[] $taLanguageAbilities
 * @property TaRegister[] $taRegisters
 */
class PersonView extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_main.person_view';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'person_id', 'adviser_id', 'student_current_district_id', 'student_current_amphur_id', 'student_current_province_id', 'student_current_zipcode_id', 'student_home_province_id', 'student_home_amphur_id', 'student_home_district_id', 'student_home_zipcode_id', 'father_district_id', 'father_amphur_id', 'father_province_id', 'father_zipcode_id', 'mother_district_id', 'mother_amphur_id', 'mother_province_id', 'mother_zipcode_id', 'parent_district_id', 'parent_amphur_id', 'parent_province_id', 'parent_zipcode_id', 'contact_district_id', 'contact_amphur_id', 'contact_province_id', 'contact_zipcode_id'], 'integer'],
            [['username', 'email', 'user_type_type'], 'required'],
            [['BIRTHDATE', 'father_birthday', 'mother_birthday'], 'safe'],
            [['ENTRYGPA', 'student_working_salary', 'father_income_per_month', 'mother_income_permonth'], 'number'],
            [['username', 'email'], 'string', 'max' => 255],
            [['user_type_type', 'NATIONID', 'RELIGIONID', 'SCHOOLID', 'ENTRYTYPE', 'ENTRYDEGREE', 'STUDENTFATHERNAME', 'STUDENTMOTHERNAME', 'STUDENTSEX', 'ADMITACADYEAR', 'ADMITSEMESTER', 'STUDENTMOBILE', 'student_card_id', 'student_mobile_phone', 'father_mobile', 'mother_mobile', 'parent_mobile', 'contact_mobile'], 'string', 'max' => 20],
            [['department_id'], 'string', 'max' => 80],
            [['major_id', 'person_fname_th', 'person_fname_eng', 'person_lname_th', 'person_lname_eng', 'prefix_th', 'prefix_en', 'PARENTNAME', 'PARENTRELATION', 'CONTACTPERSON', 'student_height', 'student_nickname', 'student_weight', 'student_blood_group', 'student_underlying_disease', 'student_marital_status', 'student_working_status', 'father_highest_qualification', 'father_career', 'father_work_place', 'father_religion', 'father_nationality', 'mother_career', 'mother_work_place', 'mother_religion', 'mother_nationality', 'marital_status_parents', 'parent_career', 'parent_religion', 'parent_nationality', 'contact_relation', 'contact_religion', 'contact_nationality', 'LEVELNAME', 'LEVELABB', 'LEVELNAMEENG', 'LEVELID', 'PREFIXID', 'lecturer'], 'string', 'max' => 50],
            [['student_fname_th', 'student_lname_th', 'student_fname_en', 'student_lname_en', 'student_email', 'student_img', 'student_line_id', 'student_working_place', 'student_current_address', 'student_home_address', 'father_address', 'mother_highest_qualification', 'mother_address', 'parent_address', 'contact_address'], 'string', 'max' => 100],
            [['student_facebook_url'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'user_type_type' => 'User Type Type',
            'person_id' => 'Person ID',
            'department_id' => 'Department ID',
            'major_id' => 'Major ID',
            'student_fname_th' => 'Student Fname Th',
            'student_lname_th' => 'Student Lname Th',
            'student_fname_en' => 'Student Fname En',
            'student_lname_en' => 'Student Lname En',
            'person_fname_th' => 'Person Fname Th',
            'person_fname_eng' => 'Person Fname Eng',
            'person_lname_th' => 'Person Lname Th',
            'person_lname_eng' => 'Person Lname Eng',
            'prefix_th' => 'Prefix Th',
            'prefix_en' => 'Prefix En',
            'NATIONID' => 'Nationid',
            'RELIGIONID' => 'Religionid',
            'SCHOOLID' => 'Schoolid',
            'ENTRYTYPE' => 'Entrytype',
            'ENTRYDEGREE' => 'Entrydegree',
            'BIRTHDATE' => 'Birthdate',
            'STUDENTFATHERNAME' => 'Studentfathername',
            'STUDENTMOTHERNAME' => 'Studentmothername',
            'STUDENTSEX' => 'Studentsex',
            'ADMITACADYEAR' => 'Admitacadyear',
            'ADMITSEMESTER' => 'Admitsemester',
            'PARENTNAME' => 'Parentname',
            'ENTRYGPA' => 'Entrygpa',
            'PARENTRELATION' => 'Parentrelation',
            'CONTACTPERSON' => 'Contactperson',
            'STUDENTMOBILE' => 'Studentmobile',
            'adviser_id' => 'Adviser ID',
            'student_card_id' => 'Student Card ID',
            'student_email' => 'Student Email',
            'student_img' => 'Student Img',
            'student_height' => 'Student Height',
            'student_nickname' => 'Student Nickname',
            'student_weight' => 'Student Weight',
            'student_blood_group' => 'Student Blood Group',
            'student_underlying_disease' => 'Student Underlying Disease',
            'student_marital_status' => 'Student Marital Status',
            'student_mobile_phone' => 'Student Mobile Phone',
            'student_facebook_url' => 'Student Facebook Url',
            'student_line_id' => 'Student Line ID',
            'student_working_status' => 'Student Working Status',
            'student_working_place' => 'Student Working Place',
            'student_working_salary' => 'Student Working Salary',
            'student_current_address' => 'Student Current Address',
            'student_current_district_id' => 'Student Current District ID',
            'student_current_amphur_id' => 'Student Current Amphur ID',
            'student_current_province_id' => 'Student Current Province ID',
            'student_current_zipcode_id' => 'Student Current Zipcode ID',
            'student_home_province_id' => 'Student Home Province ID',
            'student_home_address' => 'Student Home Address',
            'student_home_amphur_id' => 'Student Home Amphur ID',
            'student_home_district_id' => 'Student Home District ID',
            'student_home_zipcode_id' => 'Student Home Zipcode ID',
            'father_birthday' => 'Father Birthday',
            'father_highest_qualification' => 'Father Highest Qualification',
            'father_career' => 'Father Career',
            'father_work_place' => 'Father Work Place',
            'father_mobile' => 'Father Mobile',
            'father_address' => 'Father Address',
            'father_district_id' => 'Father District ID',
            'father_amphur_id' => 'Father Amphur ID',
            'father_province_id' => 'Father Province ID',
            'father_zipcode_id' => 'Father Zipcode ID',
            'father_religion' => 'Father Religion',
            'father_nationality' => 'Father Nationality',
            'father_income_per_month' => 'Father Income Per Month',
            'mother_birthday' => 'Mother Birthday',
            'mother_highest_qualification' => 'Mother Highest Qualification',
            'mother_career' => 'Mother Career',
            'mother_work_place' => 'Mother Work Place',
            'mother_mobile' => 'Mother Mobile',
            'mother_address' => 'Mother Address',
            'mother_district_id' => 'Mother District ID',
            'mother_amphur_id' => 'Mother Amphur ID',
            'mother_province_id' => 'Mother Province ID',
            'mother_zipcode_id' => 'Mother Zipcode ID',
            'mother_religion' => 'Mother Religion',
            'mother_nationality' => 'Mother Nationality',
            'mother_income_permonth' => 'Mother Income Permonth',
            'marital_status_parents' => 'Marital Status Parents',
            'parent_career' => 'Parent Career',
            'parent_address' => 'Parent Address',
            'parent_district_id' => 'Parent District ID',
            'parent_amphur_id' => 'Parent Amphur ID',
            'parent_province_id' => 'Parent Province ID',
            'parent_zipcode_id' => 'Parent Zipcode ID',
            'parent_mobile' => 'Parent Mobile',
            'parent_religion' => 'Parent Religion',
            'parent_nationality' => 'Parent Nationality',
            'contact_relation' => 'Contact Relation',
            'contact_address' => 'Contact Address',
            'contact_district_id' => 'Contact District ID',
            'contact_amphur_id' => 'Contact Amphur ID',
            'contact_province_id' => 'Contact Province ID',
            'contact_zipcode_id' => 'Contact Zipcode ID',
            'contact_mobile' => 'Contact Mobile',
            'contact_religion' => 'Contact Religion',
            'contact_nationality' => 'Contact Nationality',
            'LEVELNAME' => 'Levelname',
            'LEVELABB' => 'Levelabb',
            'LEVELNAMEENG' => 'Levelnameeng',
            'LEVELID' => 'Levelid',
            'PREFIXID' => 'Prefixid',
            'lecturer' => 'Lecturer',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRegisters()
    {
        return $this->hasMany(TaRegister::className(), ['person_id' => 'person_id']);
    }
}
