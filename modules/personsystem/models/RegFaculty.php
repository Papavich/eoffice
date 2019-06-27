<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "reg_faculty".
 *
 * @property string $FACULTYID
 * @property string $FACULTYNAME
 * @property string $FACULTYNAMEENG
 * @property string $FACULTYABB
 * @property string $FACULTYABBENG
 * @property string $DEAN
 * @property string $DEANENG
 * @property string $FACULTYTYPE
 * @property string $FACULTYGROUP
 *
 * @property Person[] $people
 * @property RegDepartment[] $regDepartments
 * @property RegEnroll[] $regEnrolls
 * @property RegStudentmaster[] $regStudentmasters
 */
class RegFaculty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg_faculty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FACULTYID'], 'required'],
            [['FACULTYID', 'FACULTYTYPE', 'FACULTYGROUP'], 'string', 'max' => 50],
            [['FACULTYNAME', 'FACULTYNAMEENG'], 'string', 'max' => 200],
            [['FACULTYABB', 'FACULTYABBENG'], 'string', 'max' => 250],
            [['DEAN', 'DEANENG'], 'string', 'max' => 150],
            [['FACULTYID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'FACULTYID' => 'Facultyid',
            'FACULTYNAME' => 'Facultyname',
            'FACULTYNAMEENG' => 'Facultynameeng',
            'FACULTYABB' => 'Facultyabb',
            'FACULTYABBENG' => 'Facultyabbeng',
            'DEAN' => 'Dean',
            'DEANENG' => 'Deaneng',
            'FACULTYTYPE' => 'Facultytype',
            'FACULTYGROUP' => 'Facultygroup',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['faculty_id' => 'FACULTYID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegDepartments()
    {
        return $this->hasMany(RegDepartment::className(), ['FACULTYID' => 'FACULTYID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegEnrolls()
    {
        return $this->hasMany(RegEnroll::className(), ['FACULTYID' => 'FACULTYID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegStudentmasters()
    {
        return $this->hasMany(RegStudentmaster::className(), ['FACULTYID' => 'FACULTYID']);
    }
}
