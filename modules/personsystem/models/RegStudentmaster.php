<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "reg_studentmaster".
 *
 * @property int $STUDENTID
 * @property string $STUDENTCODE
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
 * @property string $OFFICERID
 * @property string $ADMITSEMESTER
 * @property string $ADMITACADYEAR
 *
 * @property RegStudentbio $regStudentbio
 * @property RegProgram $pROGRAM
 * @property RegDepartment $dEPARTMENT
 * @property RegFaculty $fACULTY
 * @property RegLevel $lEVEL
 * @property RegPrefix $pREFIX
 * @property Student $student
 */
class RegStudentmaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg_studentmaster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENTID', 'PREFIXID', 'LEVELID', 'FACULTYID', 'DEPARTMENTID', 'PROGRAMID'], 'required'],
            [['STUDENTID', 'FACULTYID', 'DEPARTMENTID'], 'integer'],
            [['STUDENTCODE'], 'string', 'max' => 20],
            [['PREFIXID', 'LEVELID', 'ADMITDATE', 'FINISHDATE'], 'string', 'max' => 50],
            [['STUDENTNAME', 'STUDENTNAMEENG', 'STUDENTSURNAME', 'STUDENTSURNAMEENG', 'STUDENTYEAR', 'STUDENTEMAIL', 'STUDENTSTATUS', 'GPA'], 'string', 'max' => 100],
            [['PROGRAMID'], 'string', 'max' => 255],
            [['OFFICERID', 'ADMITSEMESTER', 'ADMITACADYEAR'], 'string', 'max' => 45],
            [['STUDENTID'], 'unique'],
            [['PROGRAMID'], 'exist', 'skipOnError' => true, 'targetClass' => RegProgram::className(), 'targetAttribute' => ['PROGRAMID' => 'PROGRAMID']],
            [['DEPARTMENTID'], 'exist', 'skipOnError' => true, 'targetClass' => RegDepartment::className(), 'targetAttribute' => ['DEPARTMENTID' => 'DEPARTMENTID']],
            [['FACULTYID'], 'exist', 'skipOnError' => true, 'targetClass' => RegFaculty::className(), 'targetAttribute' => ['FACULTYID' => 'FACULTYID']],
            [['LEVELID'], 'exist', 'skipOnError' => true, 'targetClass' => RegLevel::className(), 'targetAttribute' => ['LEVELID' => 'LEVELID']],
            [['PREFIXID'], 'exist', 'skipOnError' => true, 'targetClass' => RegPrefix::className(), 'targetAttribute' => ['PREFIXID' => 'PREFIXID']],
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
            'OFFICERID' => 'Officerid',
            'ADMITSEMESTER' => 'Admitsemester',
            'ADMITACADYEAR' => 'Admitacadyear',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegStudentbio()
    {
        return $this->hasOne(RegStudentbio::className(), ['STUDENTID' => 'STUDENTID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPROGRAM()
    {
        return $this->hasOne(RegProgram::className(), ['PROGRAMID' => 'PROGRAMID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDEPARTMENT()
    {
        return $this->hasOne(RegDepartment::className(), ['DEPARTMENTID' => 'DEPARTMENTID']);
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
    public function getLEVEL()
    {
        return $this->hasOne(RegLevel::className(), ['LEVELID' => 'LEVELID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPREFIX()
    {
        return $this->hasOne(RegPrefix::className(), ['PREFIXID' => 'PREFIXID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['STUDENTID' => 'STUDENTID']);
    }
}
