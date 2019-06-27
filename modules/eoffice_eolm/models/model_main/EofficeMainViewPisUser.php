<?php

namespace app\modules\eoffice_eolm\models\model_main;

use Yii;

/**
 * This is the model class for table "eoffice_central.view_pis_user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $user_type_id
 * @property int $department_id
 * @property string $student_fname_th
 * @property string $student_lname_th
 * @property string $student_fname_en
 * @property string $student_lname_en
 * @property string $person_fname_en
 * @property string $person_lname_th
 * @property string $person_lname_en
 * @property string $prefix_en
 * @property string $user_id
 * @property string $academic_positions_id
 * @property string $academic_positions_abb_thai
 * @property string $academic_positions_eng
 * @property string $academic_positions
 * @property string $academic_positions_abb
 * @property string $PREFIXNAME
 * @property int $major_id
 * @property string $major_name
 * @property string $major_name_eng
 * @property string $major_code
 * @property string $person_fname_th
 * @property string $person_mobile
 * @property string $person_current_address
 * @property string $AMPHUR_NAME
 * @property string $PROVINCE_NAME
 * @property string $ZIPCODE
 * @property string $DISTRICT_NAME
 */
class EofficeMainViewPisUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.view_pis_user';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolm');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'department_id', 'major_id'], 'integer'],
            [['username', 'email'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            [['user_type_id', 'user_id', 'person_mobile'], 'string', 'max' => 20],
            [['student_fname_th', 'student_lname_th', 'student_fname_en', 'student_lname_en', 'major_name_eng', 'major_code', 'person_current_address'], 'string', 'max' => 100],
            [['person_fname_en', 'person_lname_th', 'person_lname_en', 'prefix_en', 'academic_positions_id', 'academic_positions_abb_thai', 'academic_positions_eng', 'academic_positions', 'academic_positions_abb', 'PREFIXNAME', 'person_fname_th'], 'string', 'max' => 50],
            [['major_name'], 'string', 'max' => 200],
            [['AMPHUR_NAME', 'PROVINCE_NAME', 'DISTRICT_NAME'], 'string', 'max' => 150],
            [['ZIPCODE'], 'string', 'max' => 5],
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
            'user_type_id' => 'User Type ID',
            'department_id' => 'Department ID',
            'student_fname_th' => 'Student Fname Th',
            'student_lname_th' => 'Student Lname Th',
            'student_fname_en' => 'Student Fname En',
            'student_lname_en' => 'Student Lname En',
            'person_fname_en' => 'Person Fname En',
            'person_lname_th' => 'Person Lname Th',
            'person_lname_en' => 'Person Lname En',
            'prefix_en' => 'Prefix En',
            'user_id' => 'User ID',
            'academic_positions_id' => 'Academic Positions ID',
            'academic_positions_abb_thai' => 'Academic Positions Abb Thai',
            'academic_positions_eng' => 'Academic Positions Eng',
            'academic_positions' => 'Academic Positions',
            'academic_positions_abb' => 'Academic Positions Abb',
            'PREFIXNAME' => 'Prefixname',
            'major_id' => 'Major ID',
            'major_name' => 'Major Name',
            'major_name_eng' => 'Major Name Eng',
            'major_code' => 'Major Code',
            'person_fname_th' => 'Person Fname Th',
            'person_mobile' => 'Person Mobile',
            'person_current_address' => 'Person Current Address',
            'AMPHUR_NAME' => 'Amphur  Name',
            'PROVINCE_NAME' => 'Province  Name',
            'ZIPCODE' => 'Zipcode',
            'DISTRICT_NAME' => 'District  Name',
        ];
    }
}
