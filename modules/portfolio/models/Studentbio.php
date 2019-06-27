<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "studentbio".
 *
 * @property integer $studentbio_id
 * @property string $studentid
 * @property string $teacher_id
 * @property string $student_card_id
 * @property string $student_email
 * @property string $student_img
 * @property string $student_nickname
 * @property string $student_height
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
 * @property integer $student_current_district_id
 * @property integer $student_current_amphur_id
 * @property integer $student_current_province_id
 * @property integer $student_current_zipcode_id
 * @property string $student_home_address
 * @property integer $student_home_district_id
 * @property integer $student_home_amphur_id
 * @property integer $student_home_province_id
 * @property integer $student_home_zipcode_id
 * @property string $father_birthday
 * @property string $father_highest_qualification
 * @property string $father_career
 * @property string $father_work_place
 * @property string $father_mobile
 * @property string $father_address
 * @property integer $father_district_id
 * @property integer $father_amphur_id
 * @property integer $father_province_id
 * @property integer $father_zipcode_id
 * @property string $father_religion
 * @property string $father_nationality
 * @property double $father_income_per_month
 * @property string $mother_birthday
 * @property string $mother_highest_qualification
 * @property string $mother_career
 * @property string $mother_work_place
 * @property string $mother_mobile
 * @property string $mother_address
 * @property integer $mother_district_id
 * @property integer $mother_amphur_id
 * @property integer $mother_province_id
 * @property integer $mother_zipcode_id
 * @property string $mother_religion
 * @property string $mother_nationality
 * @property double $mother_income_permonth
 * @property string $marital_status_parents
 * @property string $parent_career
 * @property string $parent_address
 * @property integer $parent_district_id
 * @property integer $parent_amphur_id
 * @property integer $parent_province_id
 * @property integer $parent_zipcode_id
 * @property string $parent_mobile
 * @property string $parent_religion
 * @property string $parent_nationality
 * @property string $contact_relation
 * @property string $contact_address
 * @property integer $contact_district_id
 * @property integer $contact_amphur_id
 * @property integer $contact_province_id
 * @property integer $contact_zipcode_id
 * @property string $contact_mobile
 * @property string $contact_religion
 * @property string $contact_nationality
 *
 * @property Amphur $contactAmphur
 * @property Amphur $parentAmphur
 * @property Amphur $motherAmphur
 * @property Amphur $fatherAmphur
 * @property Amphur $studentHomeAmphur
 * @property Amphur $studentCurrentAmphur
 * @property District $contactDistrict
 * @property District $parentDistrict
 * @property District $motherDistrict
 * @property District $fatherDistrict
 * @property District $studentHomeDistrict
 * @property District $studentCurrentDistrict
 * @property Province $contactProvince
 * @property Province $parentProvince
 * @property Province $motherProvince
 * @property Province $fatherProvince
 * @property Province $studentHomeProvince
 * @property Province $studentCurrentProvince
 * @property Zipcode $contactZipcode
 * @property Zipcode $parentZipcode
 * @property Zipcode $motherZipcode
 * @property Zipcode $fatherZipcode
 * @property Zipcode $studentHomeZipcode
 * @property Zipcode $studentCurrentZipcode
 * @property Studentreg[] $studentregs
 */
class Studentbio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'studentbio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['studentbio_id', 'student_current_district_id', 'student_current_amphur_id', 'student_current_province_id', 'student_current_zipcode_id', 'student_home_district_id', 'student_home_amphur_id', 'student_home_province_id', 'student_home_zipcode_id', 'father_district_id', 'father_amphur_id', 'father_province_id', 'father_zipcode_id', 'mother_district_id', 'mother_amphur_id', 'mother_province_id', 'mother_zipcode_id', 'parent_district_id', 'parent_amphur_id', 'parent_province_id', 'parent_zipcode_id', 'contact_district_id', 'contact_amphur_id', 'contact_province_id', 'contact_zipcode_id'], 'required'],
            [['studentbio_id', 'student_current_district_id', 'student_current_amphur_id', 'student_current_province_id', 'student_current_zipcode_id', 'student_home_district_id', 'student_home_amphur_id', 'student_home_province_id', 'student_home_zipcode_id', 'father_district_id', 'father_amphur_id', 'father_province_id', 'father_zipcode_id', 'mother_district_id', 'mother_amphur_id', 'mother_province_id', 'mother_zipcode_id', 'parent_district_id', 'parent_amphur_id', 'parent_province_id', 'parent_zipcode_id', 'contact_district_id', 'contact_amphur_id', 'contact_province_id', 'contact_zipcode_id'], 'integer'],
            [['student_working_salary', 'father_income_per_month', 'mother_income_permonth'], 'number'],
            [['father_birthday', 'mother_birthday'], 'safe'],
            [['studentid', 'teacher_id', 'student_card_id', 'student_mobile_phone', 'father_mobile', 'mother_mobile', 'parent_mobile', 'contact_mobile'], 'string', 'max' => 20],
            [['student_email', 'student_img', 'student_line_id', 'student_working_place', 'student_current_address', 'student_home_address', 'father_address', 'mother_highest_qualification', 'mother_address', 'parent_address', 'contact_address'], 'string', 'max' => 100],
            [['student_nickname', 'student_height', 'student_weight', 'student_blood_group', 'student_underlying_disease', 'student_marital_status', 'student_working_status', 'father_highest_qualification', 'father_career', 'father_work_place', 'father_religion', 'father_nationality', 'mother_career', 'mother_work_place', 'mother_religion', 'mother_nationality', 'marital_status_parents', 'parent_career', 'parent_religion', 'parent_nationality', 'contact_relation', 'contact_religion', 'contact_nationality'], 'string', 'max' => 50],
            [['student_facebook_url'], 'string', 'max' => 150],
            [['contact_amphur_id'], 'exist', 'skipOnError' => true, 'targetClass' => Amphur::className(), 'targetAttribute' => ['contact_amphur_id' => 'AMPHUR_ID']],
            [['parent_amphur_id'], 'exist', 'skipOnError' => true, 'targetClass' => Amphur::className(), 'targetAttribute' => ['parent_amphur_id' => 'AMPHUR_ID']],
            [['mother_amphur_id'], 'exist', 'skipOnError' => true, 'targetClass' => Amphur::className(), 'targetAttribute' => ['mother_amphur_id' => 'AMPHUR_ID']],
            [['father_amphur_id'], 'exist', 'skipOnError' => true, 'targetClass' => Amphur::className(), 'targetAttribute' => ['father_amphur_id' => 'AMPHUR_ID']],
            [['student_home_amphur_id'], 'exist', 'skipOnError' => true, 'targetClass' => Amphur::className(), 'targetAttribute' => ['student_home_amphur_id' => 'AMPHUR_ID']],
            [['student_current_amphur_id'], 'exist', 'skipOnError' => true, 'targetClass' => Amphur::className(), 'targetAttribute' => ['student_current_amphur_id' => 'AMPHUR_ID']],
            [['contact_district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['contact_district_id' => 'DISTRICT_ID']],
            [['parent_district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['parent_district_id' => 'DISTRICT_ID']],
            [['mother_district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['mother_district_id' => 'DISTRICT_ID']],
            [['father_district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['father_district_id' => 'DISTRICT_ID']],
            [['student_home_district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['student_home_district_id' => 'DISTRICT_ID']],
            [['student_current_district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['student_current_district_id' => 'DISTRICT_ID']],
            [['contact_province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['contact_province_id' => 'PROVINCE_ID']],
            [['parent_province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['parent_province_id' => 'PROVINCE_ID']],
            [['mother_province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['mother_province_id' => 'PROVINCE_ID']],
            [['father_province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['father_province_id' => 'PROVINCE_ID']],
            [['student_home_province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['student_home_province_id' => 'PROVINCE_ID']],
            [['student_current_province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['student_current_province_id' => 'PROVINCE_ID']],
            [['contact_zipcode_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['contact_zipcode_id' => 'ZIPCODE _ID']],
            [['parent_zipcode_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['parent_zipcode_id' => 'ZIPCODE _ID']],
            [['mother_zipcode_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['mother_zipcode_id' => 'ZIPCODE _ID']],
            [['father_zipcode_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['father_zipcode_id' => 'ZIPCODE _ID']],
            [['student_home_zipcode_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['student_home_zipcode_id' => 'ZIPCODE _ID']],
            [['student_current_zipcode_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['student_current_zipcode_id' => 'ZIPCODE _ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'studentbio_id' => 'Studentbio ID',
            'studentid' => 'Studentid',
            'teacher_id' => 'Teacher ID',
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactAmphur()
    {
        return $this->hasOne(Amphur::className(), ['AMPHUR_ID' => 'contact_amphur_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentAmphur()
    {
        return $this->hasOne(Amphur::className(), ['AMPHUR_ID' => 'parent_amphur_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMotherAmphur()
    {
        return $this->hasOne(Amphur::className(), ['AMPHUR_ID' => 'mother_amphur_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFatherAmphur()
    {
        return $this->hasOne(Amphur::className(), ['AMPHUR_ID' => 'father_amphur_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentHomeAmphur()
    {
        return $this->hasOne(Amphur::className(), ['AMPHUR_ID' => 'student_home_amphur_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentCurrentAmphur()
    {
        return $this->hasOne(Amphur::className(), ['AMPHUR_ID' => 'student_current_amphur_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactDistrict()
    {
        return $this->hasOne(District::className(), ['DISTRICT_ID' => 'contact_district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentDistrict()
    {
        return $this->hasOne(District::className(), ['DISTRICT_ID' => 'parent_district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMotherDistrict()
    {
        return $this->hasOne(District::className(), ['DISTRICT_ID' => 'mother_district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFatherDistrict()
    {
        return $this->hasOne(District::className(), ['DISTRICT_ID' => 'father_district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentHomeDistrict()
    {
        return $this->hasOne(District::className(), ['DISTRICT_ID' => 'student_home_district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentCurrentDistrict()
    {
        return $this->hasOne(District::className(), ['DISTRICT_ID' => 'student_current_district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactProvince()
    {
        return $this->hasOne(Province::className(), ['PROVINCE_ID' => 'contact_province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentProvince()
    {
        return $this->hasOne(Province::className(), ['PROVINCE_ID' => 'parent_province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMotherProvince()
    {
        return $this->hasOne(Province::className(), ['PROVINCE_ID' => 'mother_province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFatherProvince()
    {
        return $this->hasOne(Province::className(), ['PROVINCE_ID' => 'father_province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentHomeProvince()
    {
        return $this->hasOne(Province::className(), ['PROVINCE_ID' => 'student_home_province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentCurrentProvince()
    {
        return $this->hasOne(Province::className(), ['PROVINCE_ID' => 'student_current_province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactZipcode()
    {
        return $this->hasOne(Zipcode::className(), ['ZIPCODE _ID' => 'contact_zipcode_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentZipcode()
    {
        return $this->hasOne(Zipcode::className(), ['ZIPCODE _ID' => 'parent_zipcode_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMotherZipcode()
    {
        return $this->hasOne(Zipcode::className(), ['ZIPCODE _ID' => 'mother_zipcode_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFatherZipcode()
    {
        return $this->hasOne(Zipcode::className(), ['ZIPCODE _ID' => 'father_zipcode_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentHomeZipcode()
    {
        return $this->hasOne(Zipcode::className(), ['ZIPCODE _ID' => 'student_home_zipcode_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentCurrentZipcode()
    {
        return $this->hasOne(Zipcode::className(), ['ZIPCODE _ID' => 'student_current_zipcode_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentregs()
    {
        return $this->hasMany(Studentreg::className(), ['studentbio_id' => 'studentbio_id']);
    }
}
