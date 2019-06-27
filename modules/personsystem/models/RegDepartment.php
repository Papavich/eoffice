<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "reg_department".
 *
 * @property int $DEPARTMENTID
 * @property int $FACULTYID
 * @property string $DEPARTMENTNAME
 * @property string $DEPARTMENTNAMEENG
 *
 * @property Person[] $people
 * @property RegFaculty $fACULTY
 * @property RegStudentmaster[] $regStudentmasters
 */
class RegDepartment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg_department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DEPARTMENTID', 'FACULTYID'], 'required'],
            [['DEPARTMENTID', 'FACULTYID'], 'integer'],
            [['DEPARTMENTNAME', 'DEPARTMENTNAMEENG'], 'string', 'max' => 100],
            [['DEPARTMENTID', 'FACULTYID'], 'unique', 'targetAttribute' => ['DEPARTMENTID', 'FACULTYID']],
            [['FACULTYID'], 'exist', 'skipOnError' => true, 'targetClass' => RegFaculty::className(), 'targetAttribute' => ['FACULTYID' => 'FACULTYID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DEPARTMENTID' => 'Departmentid',
            'FACULTYID' => 'Facultyid',
            'DEPARTMENTNAME' => 'Departmentname',
            'DEPARTMENTNAMEENG' => 'Departmentnameeng',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['department_id' => 'DEPARTMENTID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFACULTY()
    {
        return $this->hasOne(RegFaculty::className(), ['FACULTYID' => 'FACULTYID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegStudentmasters()
    {
        return $this->hasMany(RegStudentmaster::className(), ['DEPARTMENTID' => 'DEPARTMENTID']);
    }
}
