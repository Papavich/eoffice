<?php

namespace app\modules\eoffice_eolm\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property integer $person_id
 * @property integer $type_id
 * @property integer $academic_positions_id
 * @property string $student_code
 * @property string $prefix
 * @property string $person_name
 * @property string $person_surname
 * @property string $person_mail_register
 * @property string $person_mail
 * @property string $person_img
 * @property string $current_address
 * @property string $current_amphur
 * @property string $current_province
 * @property string $current_country
 * @property integer $current_zipcode
 * @property integer $mobile_phone_register
 * @property integer $mobile_phone
 * @property integer $department_id
 *
 * @property EolmApprovalformHasPersonal[] $eolmApprovalformHasPersonals
 * @property EolmApprovalform[] $eolmApps
 * @property EolmOwner $eolmOwner
 * @property Department $department
 * @property Type $type
 * @property AcademicPositions $academicPositions
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
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
            [['person_id', 'type_id', 'department_id'], 'required'],
            [['person_id', 'type_id', 'academic_positions_id', 'current_zipcode', 'mobile_phone_register', 'mobile_phone', 'department_id'], 'integer'],
            [['student_code'], 'string', 'max' => 11],
            [['prefix'], 'string', 'max' => 6],
            [['person_name', 'person_surname'], 'string', 'max' => 50],
            [['person_mail_register', 'person_mail', 'person_img'], 'string', 'max' => 100],
            [['current_address'], 'string', 'max' => 200],
            [['current_amphur', 'current_province', 'current_country'], 'string', 'max' => 45],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'department_id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'type_id']],
            [['academic_positions_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcademicPositions::className(), 'targetAttribute' => ['academic_positions_id' => 'academic_positions_id']],
        ];
    }

    /**
     * @inheritdoc
     */
     public function attributeLabels()
    {
        return [
            'person_id' => 'ชื่อ',
            'type_id' => 'Type ID',
            'academic_positions_id' => 'Academic Positions ID',
            'student_code' => 'Student Code',
            'prefix' => 'Prefix',
            'person_name' => 'ชื่อ',
            'person_surname' => 'นามสกุล',
            'person_mail_register' => 'Person Mail Register',
            'person_mail' => 'Person Mail',
            'person_img' => 'Person Img',
            'current_address' => 'Current Address',
            'current_amphur' => 'Current Amphur',
            'current_province' => 'Current Province',
            'current_country' => 'Current Country',
            'current_zipcode' => 'Current Zipcode',
            'mobile_phone_register' => 'Mobile Phone Register',
            'mobile_phone' => 'Mobile Phone',
            'department_id' => 'Department ID',
        ];
    }
    public function getPersonName()
    {
        return $this->person_name.' '.$this->person_surname;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApprovalformHasPersonals()
    {
        return $this->hasMany(EolmApprovalformHasPersonal::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApps()
    {
        return $this->hasMany(EolmApprovalform::className(), ['eolm_app_id' => 'eolm_app_id'])->viaTable('eolm_approvalform_has_personal', ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmOwner()
    {
        return $this->hasOne(EolmOwner::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['department_id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['type_id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcademicPositions()
    {
        return $this->hasOne(AcademicPositions::className(), ['academic_positions_id' => 'academic_positions_id']);
    }  /*ใช้ อันนี้ */
    /*public static function getPersonByName($person_name)
    {
        $person = Person::find()->where(['person_name' => $person_name])->one();
        if (!$person) {
            $person = new Person();
            $person->person_name = $person_name;
            $person->save(false);
        }
        return $person;
    }*/
}
