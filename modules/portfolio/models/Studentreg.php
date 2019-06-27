<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "studentreg".
 *
 * @property integer $student_id
 * @property string $STUDENTID
 * @property string $STUDENTCODE
 * @property string $CITIZENID
 * @property string $PREFIXID
 * @property string $LEVELID
 * @property string $FACALTYID
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
 * @property integer $studentbio_id
 * @property integer $user_id
 *
 * @property Department $dEPARTMENT
 * @property Faculty $fACALTY
 * @property Level $lEVEL
 * @property Prefix $pREFIX
 * @property Studentbio $studentbio
 * @property User $user
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
            [['PREFIXID', 'LEVELID', 'FACALTYID', 'DEPARTMENTID', 'studentbio_id', 'user_id'], 'required'],
            [['BIRTHDATE', 'ADMITDATE', 'FINISHDATE'], 'safe'],
            [['GPA', 'ENTRYGPA'], 'number'],
            [['studentbio_id', 'user_id'], 'integer'],
            [['STUDENTID', 'STUDENTCODE', 'CITIZENID'], 'string', 'max' => 20],
            [['PREFIXID', 'LEVELID', 'FACALTYID', 'DEPARTMENTID', 'PROGRAMID', 'ADMITACADYEAR'], 'string', 'max' => 50],
            [['STUDENTNAME', 'STUDENTNAMEENG', 'STUDENTSURNAME', 'STUDENTSURNAMEENG', 'STUDENTYEAR', 'STUDENTSEX', 'STUDENTEMAIL', 'STUDENTSTATUS', 'STUDENTMOBILE', 'ADMITSEMESTER', 'RELIGIONID', 'NATIONID', 'SCHOOLID', 'ENTRYTYPE', 'ENTRYDEGREE', 'STUDENTFATHERNAME', 'STUDENTMOTHERNAME', 'PARENTNAME', 'PARENTRELATION', 'CONTACTPERSON'], 'string', 'max' => 100],
            [['DEPARTMENTID'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['DEPARTMENTID' => 'DEPARTMENTID']],
            [['FACALTYID'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['FACALTYID' => 'FACALTYID']],
            [['LEVELID'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['LEVELID' => 'LEVELID']],
            [['PREFIXID'], 'exist', 'skipOnError' => true, 'targetClass' => Prefix::className(), 'targetAttribute' => ['PREFIXID' => 'PREFIXID']],
            [['studentbio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Studentbio::className(), 'targetAttribute' => ['studentbio_id' => 'studentbio_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_id' => 'Student ID',
            'STUDENTID' => 'Studentid',
            'STUDENTCODE' => 'Studentcode',
            'CITIZENID' => 'Citizenid',
            'PREFIXID' => 'Prefixid',
            'LEVELID' => 'Levelid',
            'FACALTYID' => 'Facaltyid',
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
            'studentbio_id' => 'Studentbio ID',
            'user_id' => 'User ID',
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
    public function getFACALTY()
    {
        return $this->hasOne(Faculty::className(), ['FACALTYID' => 'FACALTYID']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentbio()
    {
        return $this->hasOne(Studentbio::className(), ['studentbio_id' => 'studentbio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
