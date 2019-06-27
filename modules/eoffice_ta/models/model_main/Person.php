<?php

namespace app\modules\eoffice_ta\models\model_main;

use Yii;

/**
 * This is the model class for table "eoffice_main.person".
 *
 * @property int $person_id
 * @property string $person_name
 * @property string $person_name_eng
 * @property string $person_surname
 * @property string $person_surname_eng
 * @property string $person_citizen_id
 * @property string $prefix_id
 * @property string $person_gender
 * @property string $person_religion
 * @property string $person_nation
 * @property string $person_birthdate
 * @property string $person_operate_status
 * @property string $person_duty
 * @property string $person_start_date
 * @property string $person_contract_date
 * @property string $person_expire_date
 * @property string $person_confirmed_date
 * @property string $person_pass_probation_date
 * @property string $person_retire_date
 * @property string $person_official_age
 * @property string $person_decommission_date
 * @property string $person_account_hold
 * @property string $person_current_work_place
 * @property string $person_person_type
 * @property string $person_position_type
 * @property double $person_salary
 * @property string $person_administer_position
 * @property string $person_salary_position
 * @property string $person_pension
 * @property string $person_pension_withdraw
 * @property string $person_talent
 * @property string $person_current_address
 * @property int $person_current_district
 * @property int $person_current_amphur
 * @property int $person_current_province
 * @property int $person_current_zipcode
 * @property string $person_mobile
 * @property string $person_email
 * @property string $person_home_address
 * @property int $person_home_district
 * @property int $person_home_amphur
 * @property int $person_home_province
 * @property int $person_home_zipcode
 * @property string $department_id
 * @property string $lecturer
 * @property string $person_fax
 * @property string $person_type
 * @property string $person_academic_positions_id
 * @property string $DEPARTMENTID
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_main.person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'prefix_id', 'person_current_district', 'person_current_amphur', 'person_current_province', 'person_current_zipcode', 'person_home_district', 'person_home_amphur', 'person_home_province', 'person_home_zipcode', 'department_id', 'person_academic_positions_id', 'DEPARTMENTID'], 'required'],
            [['person_id', 'person_current_district', 'person_current_amphur', 'person_current_province', 'person_current_zipcode', 'person_home_district', 'person_home_amphur', 'person_home_province', 'person_home_zipcode'], 'integer'],
            [['person_birthdate', 'person_start_date', 'person_contract_date', 'person_expire_date', 'person_confirmed_date', 'person_pass_probation_date', 'person_retire_date', 'person_decommission_date'], 'safe'],
            [['person_salary'], 'number'],
            [['person_name', 'person_name_eng', 'person_surname', 'person_surname_eng', 'person_citizen_id', 'prefix_id', 'person_gender', 'person_religion', 'person_nation', 'person_operate_status', 'person_duty', 'person_official_age', 'person_account_hold', 'person_current_work_place', 'person_person_type', 'person_position_type', 'person_administer_position', 'person_salary_position', 'person_pension', 'person_pension_withdraw', 'person_talent', 'department_id', 'lecturer', 'person_academic_positions_id'], 'string', 'max' => 50],
            [['person_current_address', 'person_email', 'person_home_address'], 'string', 'max' => 100],
            [['person_mobile'], 'string', 'max' => 20],
            [['person_fax'], 'string', 'max' => 13],
            [['person_type'], 'string', 'max' => 10],
            [['DEPARTMENTID'], 'string', 'max' => 80],
            [['person_id'], 'unique'],
            [['person_academic_positions_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcademicPositions::className(), 'targetAttribute' => ['person_academic_positions_id' => 'academic_positions_id']],
            [['person_home_amphur'], 'exist', 'skipOnError' => true, 'targetClass' => Amphur::className(), 'targetAttribute' => ['person_home_amphur' => 'AMPHUR_ID']],
            [['person_current_amphur'], 'exist', 'skipOnError' => true, 'targetClass' => Amphur::className(), 'targetAttribute' => ['person_current_amphur' => 'AMPHUR_ID']],
            [['DEPARTMENTID'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['DEPARTMENTID' => 'DEPARTMENTID']],
            [['person_home_district'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['person_home_district' => 'DISTRICT_ID']],
            [['person_current_district'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['person_current_district' => 'DISTRICT_ID']],
            [['prefix_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prefix::className(), 'targetAttribute' => ['prefix_id' => 'PREFIXID']],
            [['person_current_province'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['person_current_province' => 'PROVINCE_ID']],
            [['person_home_province'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['person_home_province' => 'PROVINCE_ID']],
            [['person_current_zipcode'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['person_current_zipcode' => 'ZIPCODE _ID']],
            [['person_home_zipcode'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['person_home_zipcode' => 'ZIPCODE _ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'person_name' => 'Person Name',
            'person_name_eng' => 'Person Name Eng',
            'person_surname' => 'Person Surname',
            'person_surname_eng' => 'Person Surname Eng',
            'person_citizen_id' => 'Person Citizen ID',
            'prefix_id' => 'Prefix ID',
            'person_gender' => 'Person Gender',
            'person_religion' => 'Person Religion',
            'person_nation' => 'Person Nation',
            'person_birthdate' => 'Person Birthdate',
            'person_operate_status' => 'Person Operate Status',
            'person_duty' => 'Person Duty',
            'person_start_date' => 'Person Start Date',
            'person_contract_date' => 'Person Contract Date',
            'person_expire_date' => 'Person Expire Date',
            'person_confirmed_date' => 'Person Confirmed Date',
            'person_pass_probation_date' => 'Person Pass Probation Date',
            'person_retire_date' => 'Person Retire Date',
            'person_official_age' => 'Person Official Age',
            'person_decommission_date' => 'Person Decommission Date',
            'person_account_hold' => 'Person Account Hold',
            'person_current_work_place' => 'Person Current Work Place',
            'person_person_type' => 'Person Person Type',
            'person_position_type' => 'Person Position Type',
            'person_salary' => 'Person Salary',
            'person_administer_position' => 'Person Administer Position',
            'person_salary_position' => 'Person Salary Position',
            'person_pension' => 'Person Pension',
            'person_pension_withdraw' => 'Person Pension Withdraw',
            'person_talent' => 'Person Talent',
            'person_current_address' => 'Person Current Address',
            'person_current_district' => 'Person Current District',
            'person_current_amphur' => 'Person Current Amphur',
            'person_current_province' => 'Person Current Province',
            'person_current_zipcode' => 'Person Current Zipcode',
            'person_mobile' => 'Person Mobile',
            'person_email' => 'Person Email',
            'person_home_address' => 'Person Home Address',
            'person_home_district' => 'Person Home District',
            'person_home_amphur' => 'Person Home Amphur',
            'person_home_province' => 'Person Home Province',
            'person_home_zipcode' => 'Person Home Zipcode',
            'department_id' => 'Department ID',
            'lecturer' => 'Lecturer',
            'person_fax' => 'Person Fax',
            'person_type' => 'Person Type',
            'person_academic_positions_id' => 'Person Academic Positions ID',
            'DEPARTMENTID' => 'Departmentid',
        ];
    }
}
