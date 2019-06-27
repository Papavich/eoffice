<?php

namespace app\modules\eoffice_ta\models\model_main;

use Yii;

/**
 * This is the model class for table "studentreg".
 *
 * @property string $STUDENTID
 * @property string $STUDENTCODE
 * @property string $CITIZENID
 * @property string $PREFIXID
 * @property string $LEVELID
 * @property string $FACULTYID
 * @property string $DEPARTMENTID
 * @property string $PROGRAMID
 * @property string $STUDENTNAME
 * @property string $STUDENTNAMEENG
 * @property string $STUDENTSURNAME
 * @property string $STUDENTSURNAMEENG
 * @property string $STUDENTYEAR
 * @property string $STUDENTSEX
 * @property string $STUDENTEMAIL
 * @property string $STUDENTSTATUS
 * @property string $STUDENTMOBILE
 * @property string $BIRTHDATE
 * @property double $GPA
 * @property string $ADMITACADYEAR
 * @property string $ADMITSEMESTER
 * @property string $ADMITDATE
 * @property string $FINISHDATE
 * @property string $RELIGIONID
 * @property string $NATIONID
 * @property string $SCHOOLID
 * @property string $ENTRYTYPE
 * @property string $ENTRYDEGREE
 * @property double $ENTRYGPA
 * @property string $STUDENTFATHERNAME
 * @property string $STUDENTMOTHERNAME
 * @property string $PARENTNAME
 * @property string $PARENTRELATION
 * @property string $CONTACTPERSON
 *
 * @property Department $dEPARTMENT
 * @property Faculty $fACULTY
 * @property Level $lEVEL
 * @property Prefix $pREFIX
 */
class Studentreg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'studentreg';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENTID', 'PREFIXID', 'LEVELID', 'FACULTYID', 'DEPARTMENTID'], 'required'],
            [['BIRTHDATE', 'ADMITDATE', 'FINISHDATE'], 'safe'],
            [['GPA', 'ENTRYGPA'], 'number'],
            [['STUDENTID', 'STUDENTCODE', 'CITIZENID'], 'string', 'max' => 20],
            [['PREFIXID', 'LEVELID', 'FACULTYID', 'DEPARTMENTID', 'PROGRAMID', 'ADMITACADYEAR'], 'string', 'max' => 50],
            [['STUDENTNAME', 'STUDENTNAMEENG', 'STUDENTSURNAME', 'STUDENTSURNAMEENG', 'STUDENTYEAR', 'STUDENTSEX', 'STUDENTEMAIL', 'STUDENTSTATUS', 'STUDENTMOBILE', 'ADMITSEMESTER', 'RELIGIONID', 'NATIONID', 'SCHOOLID', 'ENTRYTYPE', 'ENTRYDEGREE', 'STUDENTFATHERNAME', 'STUDENTMOTHERNAME', 'PARENTNAME', 'PARENTRELATION', 'CONTACTPERSON'], 'string', 'max' => 100],
            [['DEPARTMENTID'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['DEPARTMENTID' => 'DEPARTMENTID']],
            [['FACULTYID'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['FACULTYID' => 'FACALTYID']],
            [['LEVELID'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['LEVELID' => 'LEVELID']],
            [['PREFIXID'], 'exist', 'skipOnError' => true, 'targetClass' => Prefix::className(), 'targetAttribute' => ['PREFIXID' => 'PREFIXID']],
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
            'CITIZENID' => 'Citizenid',
            'PREFIXID' => 'Prefixid',
            'LEVELID' => 'Levelid',
            'FACULTYID' => 'Facultyid',
            'DEPARTMENTID' => 'Departmentid',
            'PROGRAMID' => 'Programid',
            'STUDENTNAME' => 'Studentname',
            'STUDENTNAMEENG' => 'Studentnameeng',
            'STUDENTSURNAME' => 'Studentsurname',
            'STUDENTSURNAMEENG' => 'Studentsurnameeng',
            'STUDENTYEAR' => 'Studentyear',
            'STUDENTSEX' => 'Studentsex',
            'STUDENTEMAIL' => 'Studentemail',
            'STUDENTSTATUS' => 'Studentstatus',
            'STUDENTMOBILE' => 'Studentmobile',
            'BIRTHDATE' => 'Birthdate',
            'GPA' => 'Gpa',
            'ADMITACADYEAR' => 'Admitacadyear',
            'ADMITSEMESTER' => 'Admitsemester',
            'ADMITDATE' => 'Admitdate',
            'FINISHDATE' => 'Finishdate',
            'RELIGIONID' => 'Religionid',
            'NATIONID' => 'Nationid',
            'SCHOOLID' => 'Schoolid',
            'ENTRYTYPE' => 'Entrytype',
            'ENTRYDEGREE' => 'Entrydegree',
            'ENTRYGPA' => 'Entrygpa',
            'STUDENTFATHERNAME' => 'Studentfathername',
            'STUDENTMOTHERNAME' => 'Studentmothername',
            'PARENTNAME' => 'Parentname',
            'PARENTRELATION' => 'Parentrelation',
            'CONTACTPERSON' => 'Contactperson',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDEPARTMENT()
    {
        return $this->hasOne(Department::className(), ['DEPARTMENTID' => 'DEPARTMENTID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFACULTY()
    {
        return $this->hasOne(Faculty::className(), ['FACALTYID' => 'FACULTYID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLEVEL()
    {
        return $this->hasOne(Level::className(), ['LEVELID' => 'LEVELID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPREFIX()
    {
        return $this->hasOne(Prefix::className(), ['PREFIXID' => 'PREFIXID']);
    }
}
