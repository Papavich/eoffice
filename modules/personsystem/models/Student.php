<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $STUDENTID
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
 * @property int $parent_zipcode_id
 * @property string $parent_mobile
 * @property string $parent_religion
 * @property string $parent_nationality
 * @property string $contact_name
 * @property string $contact_relation
 * @property string $contact_mobile
 * @property string $student_skill
 *
 * @property RegStudentmaster $sTUDENT
 * @property StudentSkill[] $studentSkills
 * @property Skill[] $skills
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENTID'], 'required'],
            [['STUDENTID', 'student_height', 'student_weight', 'student_current_district_id', 'student_current_amphur_id', 'student_current_province_id', 'student_current_zipcode_id', 'student_home_district_id', 'student_home_amphur_id', 'student_home_province_id', 'student_home_zipcode_id', 'father_district_id', 'father_amphur_id', 'father_province_id', 'father_zipcode_id', 'mother_district_id', 'mother_amphur_id', 'mother_province_id', 'mother_zipcode_id', 'parent_district_id', 'parent_amphur_id', 'parent_province_id', 'parent_zipcode_id'], 'integer'],
            [['student_working_salary', 'father_income_per_month', 'mother_income_permonth'], 'number'],
            [['father_birthday', 'mother_birthday'], 'safe'],
            [['student_card_id', 'student_mobile_phone', 'father_mobile', 'mother_mobile', 'parent_mobile', 'contact_mobile'], 'string', 'max' => 20],
            [['student_email', 'student_img', 'student_line_id', 'student_working_place', 'student_current_address', 'student_home_address', 'father_address', 'mother_highest_qualification', 'mother_address', 'parent_address', 'contact_name'], 'string', 'max' => 100],
            [['student_nickname', 'student_blood_group', 'student_underlying_disease', 'student_marital_status', 'student_working_status', 'father_highest_qualification', 'father_career', 'father_work_place', 'father_religion', 'father_nationality', 'mother_career', 'mother_work_place', 'mother_religion', 'mother_nationality', 'marital_status_parents', 'parent_career', 'parent_religion', 'parent_nationality', 'contact_relation'], 'string', 'max' => 50],
            [['student_facebook_url'], 'string', 'max' => 150],
            [['student_skill'], 'string', 'max' => 300],
            [['STUDENTID'], 'unique'],
            [['STUDENTID'], 'exist', 'skipOnError' => true, 'targetClass' => RegStudentmaster::className(), 'targetAttribute' => ['STUDENTID' => 'STUDENTID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STUDENTID' => 'Studentid',
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
            'contact_name' => 'Contact Name',
            'contact_relation' => 'Contact Relation',
            'contact_mobile' => 'Contact Mobile',
            'student_skill' => 'Student Skill',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSTUDENT()
    {
        return $this->hasOne(RegStudentmaster::className(), ['STUDENTID' => 'STUDENTID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentSkills()
    {
        return $this->hasMany(StudentSkill::className(), ['id_student' => 'STUDENTID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::className(), ['id_skill' => 'id_skill'])->viaTable('student_skill', ['id_student' => 'STUDENTID']);
    }

    public static function findSkillId($skill_id,$student_id)
    {
        if (StudentSkill::find()->where( ['id_student' => $student_id,'id_skill'=>$skill_id] )->one()) {
            return StudentSkill::find()->where( ['id_student' => $student_id,'id_skill'=>$skill_id] )->one()->id_skill;
        } else {
            return false;
        }
    }
}
