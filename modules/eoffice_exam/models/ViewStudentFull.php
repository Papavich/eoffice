<?php

namespace app\modules\eoffice_exam\models;

use Yii;

/**
 * This is the model class for table "view_student_full".
 *
 * @property int $STUDENTID
 * @property string $STUDENTCODE
 * @property string $student_card_id
 * @property string $student_email
 * @property string $student_img
 * @property string $student_nickname
 * @property int $student_height
 * @property int $student_weight
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
 * @property string $student_home_address
 * @property int $student_home_district_id
 * @property int $student_home_amphur_id
 * @property int $student_home_province_id
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
 * @property string $parent_religion
 * @property string $parent_mobile
 * @property int $parent_zipcode_id
 * @property string $parent_nationality
 * @property string $contact_name
 * @property string $contact_relation
 * @property string $contact_mobile
 * @property string $PREFIXID
 * @property string $LEVELID
 * @property string $STUDENTNAME
 * @property string $STUDENTNAMEENG
 * @property string $STUDENTSURNAME
 * @property string $STUDENTSURNAMEENG
 * @property string $STUDENTYEAR
 * @property string $STUDENTEMAIL
 * @property string $STUDENTSTATUS
 * @property string $GPA
 * @property string $ADMITDATE
 * @property string $FINISHDATE
 * @property int $FACULTYID
 * @property int $DEPARTMENTID
 * @property string $PROGRAMID
 * @property string $NATIONID
 * @property string $SCHOOLID
 * @property string $RELIGIONID
 * @property string $ENTRYTYPE
 * @property string $BIRTHDATE
 * @property string $ENTRYDEGREE
 * @property string $STUDENTFATHERNAME
 * @property string $STUDENTMOTHERNAME
 * @property string $STUDENTSEX
 * @property string $ENTRYGPA
 * @property string $CITIZENID
 * @property string $PARENTRELATION
 * @property string $PARENTNAME
 * @property string $STUDENTMOBILE
 * @property string $HOMEADDRESS1
 * @property string $HOMEADDRESS2
 * @property string $HOMEDISTRICT
 * @property string $HOMEZIPCODE
 * @property string $major_name
 * @property string $major_name_eng
 * @property string $DEPARTMENTNAME
 * @property string $FACULTYNAMEENG
 * @property string $FACULTYNAME
 * @property string $DEPARTMENTNAMEENG
 * @property string $LEVELNAME
 * @property string $LEVELNAMEENG
 * @property string $PREFIXNAME
 * @property string $PROGRAMNAME
 * @property string $PARENTPHONENO
 * @property string $HOMEPROVINCEID
 * @property string $CURRENTADDRESS1
 * @property string $CURRENTADDRESS2
 * @property string $CURRENTDISTRICT
 * @property string $CURRENTPROVINCEID
 * @property string $CURRENTZIPCODE
 * @property string $CONTACTPERSON
 * @property string $CONTACTPHONENO
 * @property string $CONTACTRELATION
 * @property string $HOMEPHONENO
 * @property string $RELIGIONNAME
 * @property string $RELIGIONNAMEENG
 * @property string $NATIONNAME
 * @property string $OFFICERID
 * @property string $OFFICERNAME
 * @property string $OFFICERSURNAME
 * @property string $SCHOOLNAME
 * @property string $branch_name
 * @property int $branch_id
 * @property string $major_code
 * @property int $major_id
 * @property string $ADMITSEMESTER
 * @property string $ADMITACADYEAR
 * @property string $student_skill
 */
class ViewStudentFull extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_student_full';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENTID', 'PREFIXID', 'LEVELID', 'FACULTYID', 'DEPARTMENTID', 'PROGRAMID'], 'required'],
            [['STUDENTID', 'student_height', 'student_weight', 'student_current_district_id', 'student_current_amphur_id', 'student_current_province_id', 'student_current_zipcode_id', 'student_home_district_id', 'student_home_amphur_id', 'student_home_province_id', 'student_home_zipcode_id', 'father_district_id', 'father_amphur_id', 'father_province_id', 'father_zipcode_id', 'mother_district_id', 'mother_amphur_id', 'mother_province_id', 'mother_zipcode_id', 'parent_district_id', 'parent_amphur_id', 'parent_province_id', 'parent_zipcode_id', 'FACULTYID', 'DEPARTMENTID', 'branch_id', 'major_id'], 'integer'],
            [['student_working_salary', 'father_income_per_month', 'mother_income_permonth'], 'number'],
            [['father_birthday', 'mother_birthday'], 'safe'],
            [['STUDENTCODE', 'student_card_id', 'student_mobile_phone', 'father_mobile', 'mother_mobile', 'parent_mobile', 'contact_mobile'], 'string', 'max' => 20],
            [['student_email', 'student_img', 'student_line_id', 'student_working_place', 'student_current_address', 'student_home_address', 'father_address', 'mother_highest_qualification', 'mother_address', 'parent_address', 'contact_name', 'STUDENTNAME', 'STUDENTNAMEENG', 'STUDENTSURNAME', 'STUDENTSURNAMEENG', 'STUDENTYEAR', 'STUDENTEMAIL', 'STUDENTSTATUS', 'GPA', 'major_name_eng', 'DEPARTMENTNAME', 'DEPARTMENTNAMEENG', 'NATIONNAME', 'major_code'], 'string', 'max' => 100],
            [['student_nickname', 'student_blood_group', 'student_underlying_disease', 'student_marital_status', 'student_working_status', 'father_highest_qualification', 'father_career', 'father_work_place', 'father_religion', 'father_nationality', 'mother_career', 'mother_work_place', 'mother_religion', 'mother_nationality', 'marital_status_parents', 'parent_career', 'parent_religion', 'parent_nationality', 'contact_relation', 'PREFIXID', 'LEVELID', 'ADMITDATE', 'FINISHDATE', 'LEVELNAME', 'LEVELNAMEENG', 'PREFIXNAME'], 'string', 'max' => 50],
            [['student_facebook_url'], 'string', 'max' => 150],
            [['PROGRAMID', 'PROGRAMNAME', 'OFFICERNAME', 'OFFICERSURNAME', 'SCHOOLNAME'], 'string', 'max' => 255],
            [['NATIONID', 'SCHOOLID', 'RELIGIONID', 'ENTRYTYPE', 'BIRTHDATE', 'ENTRYDEGREE', 'STUDENTFATHERNAME', 'STUDENTMOTHERNAME', 'STUDENTSEX', 'ENTRYGPA', 'CITIZENID', 'PARENTRELATION', 'PARENTNAME', 'STUDENTMOBILE', 'HOMEADDRESS1', 'HOMEADDRESS2', 'HOMEDISTRICT', 'HOMEZIPCODE', 'major_name', 'FACULTYNAMEENG', 'FACULTYNAME', 'PARENTPHONENO', 'HOMEPROVINCEID', 'CURRENTADDRESS1', 'CURRENTADDRESS2', 'CURRENTDISTRICT', 'CURRENTPROVINCEID', 'CURRENTZIPCODE', 'CONTACTPERSON', 'CONTACTPHONENO', 'CONTACTRELATION', 'HOMEPHONENO', 'branch_name'], 'string', 'max' => 200],
            [['RELIGIONNAME', 'RELIGIONNAMEENG', 'OFFICERID', 'ADMITSEMESTER', 'ADMITACADYEAR'], 'string', 'max' => 45],
            [['student_skill'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STUDENTID' => 'Studentid',
            'STUDENTCODE' => 'Studentcode',
            'student_card_id' => 'Student Card ID',
            'student_email' => 'Student Email',
            'student_img' => 'Student Img',
            'student_nickname' => 'Student Nickname',
            'student_height' => 'Student Height',
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
            'student_home_address' => 'Student Home Address',
            'student_home_district_id' => 'Student Home District ID',
            'student_home_amphur_id' => 'Student Home Amphur ID',
            'student_home_province_id' => 'Student Home Province ID',
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
            'parent_religion' => 'Parent Religion',
            'parent_mobile' => 'Parent Mobile',
            'parent_zipcode_id' => 'Parent Zipcode ID',
            'parent_nationality' => 'Parent Nationality',
            'contact_name' => 'Contact Name',
            'contact_relation' => 'Contact Relation',
            'contact_mobile' => 'Contact Mobile',
            'PREFIXID' => 'Prefixid',
            'LEVELID' => 'Levelid',
            'STUDENTNAME' => 'Studentname',
            'STUDENTNAMEENG' => 'Studentnameeng',
            'STUDENTSURNAME' => 'Studentsurname',
            'STUDENTSURNAMEENG' => 'Studentsurnameeng',
            'STUDENTYEAR' => 'Studentyear',
            'STUDENTEMAIL' => 'Studentemail',
            'STUDENTSTATUS' => 'Studentstatus',
            'GPA' => 'Gpa',
            'ADMITDATE' => 'Admitdate',
            'FINISHDATE' => 'Finishdate',
            'FACULTYID' => 'Facultyid',
            'DEPARTMENTID' => 'Departmentid',
            'PROGRAMID' => 'Programid',
            'NATIONID' => 'Nationid',
            'SCHOOLID' => 'Schoolid',
            'RELIGIONID' => 'Religionid',
            'ENTRYTYPE' => 'Entrytype',
            'BIRTHDATE' => 'Birthdate',
            'ENTRYDEGREE' => 'Entrydegree',
            'STUDENTFATHERNAME' => 'Studentfathername',
            'STUDENTMOTHERNAME' => 'Studentmothername',
            'STUDENTSEX' => 'Studentsex',
            'ENTRYGPA' => 'Entrygpa',
            'CITIZENID' => 'Citizenid',
            'PARENTRELATION' => 'Parentrelation',
            'PARENTNAME' => 'Parentname',
            'STUDENTMOBILE' => 'Studentmobile',
            'HOMEADDRESS1' => 'Homeaddress1',
            'HOMEADDRESS2' => 'Homeaddress2',
            'HOMEDISTRICT' => 'Homedistrict',
            'HOMEZIPCODE' => 'Homezipcode',
            'major_name' => 'Major Name',
            'major_name_eng' => 'Major Name Eng',
            'DEPARTMENTNAME' => 'Departmentname',
            'FACULTYNAMEENG' => 'Facultynameeng',
            'FACULTYNAME' => 'Facultyname',
            'DEPARTMENTNAMEENG' => 'Departmentnameeng',
            'LEVELNAME' => 'Levelname',
            'LEVELNAMEENG' => 'Levelnameeng',
            'PREFIXNAME' => 'Prefixname',
            'PROGRAMNAME' => 'Programname',
            'PARENTPHONENO' => 'Parentphoneno',
            'HOMEPROVINCEID' => 'Homeprovinceid',
            'CURRENTADDRESS1' => 'Currentaddress1',
            'CURRENTADDRESS2' => 'Currentaddress2',
            'CURRENTDISTRICT' => 'Currentdistrict',
            'CURRENTPROVINCEID' => 'Currentprovinceid',
            'CURRENTZIPCODE' => 'Currentzipcode',
            'CONTACTPERSON' => 'Contactperson',
            'CONTACTPHONENO' => 'Contactphoneno',
            'CONTACTRELATION' => 'Contactrelation',
            'HOMEPHONENO' => 'Homephoneno',
            'RELIGIONNAME' => 'Religionname',
            'RELIGIONNAMEENG' => 'Religionnameeng',
            'NATIONNAME' => 'Nationname',
            'OFFICERID' => 'Officerid',
            'OFFICERNAME' => 'Officername',
            'OFFICERSURNAME' => 'Officersurname',
            'SCHOOLNAME' => 'Schoolname',
            'branch_name' => 'Branch Name',
            'branch_id' => 'Branch ID',
            'major_code' => 'Major Code',
            'major_id' => 'Major ID',
            'ADMITSEMESTER' => 'Admitsemester',
            'ADMITACADYEAR' => 'Admitacadyear',
            'student_skill' => 'Student Skill',
        ];
    }
}
