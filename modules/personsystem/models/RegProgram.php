<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "reg_program".
 *
 * @property string $PROGRAMID
 * @property string $PROGRAMCODE
 * @property string $PROGRAMTYPE
 * @property string $PROGRAMYEAR
 * @property string $FACULTYID
 * @property string $DEPARTMENTID
 * @property string $LEVELID
 * @property string $PROGRAMNAME
 * @property string $PROGRAMNAMEENG
 * @property string $PROGRAMABB
 * @property string $PROGRAMABBENG
 * @property string $CREDITTOTAL
 * @property string $STUDYYEARMAX
 * @property string $PROGRAMNAMECERTIFY
 * @property string $SEMESTERPERYEAR
 * @property string $PROGRAMSTATUS
 *
 * @property MajorHasProgram $majorHasProgram
 * @property RegStudentmaster[] $regStudentmasters
 */
class RegProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg_program';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROGRAMID'], 'required'],
            [['PROGRAMID', 'PROGRAMCODE', 'PROGRAMTYPE', 'PROGRAMYEAR', 'FACULTYID', 'DEPARTMENTID', 'LEVELID', 'PROGRAMNAME', 'PROGRAMNAMEENG', 'PROGRAMABB', 'PROGRAMABBENG', 'CREDITTOTAL', 'STUDYYEARMAX', 'PROGRAMNAMECERTIFY', 'SEMESTERPERYEAR', 'PROGRAMSTATUS'], 'string', 'max' => 255],
            [['PROGRAMID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROGRAMID' => 'ID',
            'PROGRAMCODE' => 'Code',
            'PROGRAMTYPE' => 'Type',
            'PROGRAMYEAR' => 'Year',
            'FACULTYID' => 'FacultyID',
            'DEPARTMENTID' => 'DepartID',
            'LEVELID' => 'LevelID',
            'PROGRAMNAME' => 'Name',
            'PROGRAMNAMEENG' => 'NnameEng',
            'PROGRAMABB' => 'Programabb',
            'PROGRAMABBENG' => 'Programabbeng',
            'CREDITTOTAL' => 'CreditTotal',
            'STUDYYEARMAX' => 'StudyYearMax',
            'PROGRAMNAMECERTIFY' => 'ProgramNameCertify',
            'SEMESTERPERYEAR' => 'Semesterperyear',
            'PROGRAMSTATUS' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMajorHasProgram()
    {
        return $this->hasOne(MajorHasProgram::className(), ['PROGRAMID' => 'PROGRAMID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegStudentmasters()
    {
        return $this->hasMany(RegStudentmaster::className(), ['PROGRAMID' => 'PROGRAMID']);
    }
}
