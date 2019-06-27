<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;

/**
 * This is the model class for table "eoffice_main.reg_course".
 *
 * @property integer $COURSEID
 * @property string $COURSECODE
 * @property string $REVISIONCODE
 * @property string $COURSEUNICODE
 * @property string $COURSENAME
 * @property string $COURSENAMEENG
 * @property string $COURSEABB
 * @property string $COURSEABBENG
 * @property string $CREDITMIN
 * @property string $CREDITMAX
 * @property string $CREDITTOTAL
 * @property string $PERIODTOTAL
 * @property string $CREDIT1
 * @property string $CREDIT2
 * @property string $CREDIT3
 * @property string $PERIOD1
 * @property string $PERIOD2
 * @property string $PERIOD3
 * @property string $STUDYCODE1
 * @property string $STUDYCODE2
 * @property string $STUDYCODE3
 * @property string $FEECHARGE
 * @property string $FEESEMESTER1
 * @property string $FEESEMESTER2
 * @property string $FEESEMESTER3
 * @property string $COURSETYPE
 * @property string $COURSESTATUS
 * @property string $DEFAULTCLASSSTATUS
 * @property string $GRADEMODE
 * @property string $FACULTYID
 * @property string $DEPARTMENTID
 * @property string $DESCRIPTION1
 * @property string $DESCRIPTION2
 * @property string $DESCRIPTIONENG1
 * @property string $DESCRIPTIONENG2
 * @property string $CREATEDATETIME
 * @property string $CREATEUSERID
 * @property string $LASTUPDATEDATETIME
 * @property string $LASTUPDATEUSERID
 * @property string $COURSEUNIT
 * @property string $COURSEGROUP
 * @property string $OPENDATE
 * @property string $CLOSEDATE
 * @property string $FEESEMESTER4
 * @property string $PREREQUISITENOTE
 * @property string $DESCRIPTION3
 * @property string $DESCRIPTIONENG3
 * @property string $OWNERLEVELID
 * @property string $EVALUATEID
 * @property string $CLASSEVALUATEID
 */
class regCourse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_main.reg_course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COURSEID'], 'required'],
            [['COURSEID'], 'integer'],
            [['COURSECODE', 'REVISIONCODE', 'COURSEUNICODE', 'COURSENAME', 'COURSENAMEENG', 'COURSEABB', 'COURSEABBENG', 'CREDITMIN', 'CREDITMAX', 'CREDITTOTAL', 'PERIODTOTAL', 'CREDIT1', 'CREDIT2', 'CREDIT3', 'PERIOD1', 'PERIOD2', 'PERIOD3', 'STUDYCODE1', 'STUDYCODE2', 'STUDYCODE3', 'FEECHARGE', 'FEESEMESTER1', 'FEESEMESTER2', 'FEESEMESTER3', 'COURSETYPE', 'COURSESTATUS', 'DEFAULTCLASSSTATUS', 'GRADEMODE', 'FACULTYID', 'DEPARTMENTID', 'DESCRIPTION1', 'DESCRIPTION2', 'DESCRIPTIONENG1', 'DESCRIPTIONENG2', 'CREATEDATETIME', 'CREATEUSERID', 'LASTUPDATEDATETIME', 'LASTUPDATEUSERID', 'COURSEUNIT', 'COURSEGROUP', 'OPENDATE', 'CLOSEDATE', 'FEESEMESTER4', 'PREREQUISITENOTE', 'DESCRIPTION3', 'DESCRIPTIONENG3', 'OWNERLEVELID', 'EVALUATEID', 'CLASSEVALUATEID'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COURSEID' => 'Courseid',
            'COURSECODE' => 'Coursecode',
            'REVISIONCODE' => 'Revisioncode',
            'COURSEUNICODE' => 'Courseunicode',
            'COURSENAME' => 'Coursename',
            'COURSENAMEENG' => 'Coursenameeng',
            'COURSEABB' => 'Courseabb',
            'COURSEABBENG' => 'Courseabbeng',
            'CREDITMIN' => 'Creditmin',
            'CREDITMAX' => 'Creditmax',
            'CREDITTOTAL' => 'Credittotal',
            'PERIODTOTAL' => 'Periodtotal',
            'CREDIT1' => 'Credit1',
            'CREDIT2' => 'Credit2',
            'CREDIT3' => 'Credit3',
            'PERIOD1' => 'Period1',
            'PERIOD2' => 'Period2',
            'PERIOD3' => 'Period3',
            'STUDYCODE1' => 'Studycode1',
            'STUDYCODE2' => 'Studycode2',
            'STUDYCODE3' => 'Studycode3',
            'FEECHARGE' => 'Feecharge',
            'FEESEMESTER1' => 'Feesemester1',
            'FEESEMESTER2' => 'Feesemester2',
            'FEESEMESTER3' => 'Feesemester3',
            'COURSETYPE' => 'Coursetype',
            'COURSESTATUS' => 'Coursestatus',
            'DEFAULTCLASSSTATUS' => 'Defaultclassstatus',
            'GRADEMODE' => 'Grademode',
            'FACULTYID' => 'Facultyid',
            'DEPARTMENTID' => 'Departmentid',
            'DESCRIPTION1' => 'Description1',
            'DESCRIPTION2' => 'Description2',
            'DESCRIPTIONENG1' => 'Descriptioneng1',
            'DESCRIPTIONENG2' => 'Descriptioneng2',
            'CREATEDATETIME' => 'Createdatetime',
            'CREATEUSERID' => 'Createuserid',
            'LASTUPDATEDATETIME' => 'Lastupdatedatetime',
            'LASTUPDATEUSERID' => 'Lastupdateuserid',
            'COURSEUNIT' => 'Courseunit',
            'COURSEGROUP' => 'Coursegroup',
            'OPENDATE' => 'Opendate',
            'CLOSEDATE' => 'Closedate',
            'FEESEMESTER4' => 'Feesemester4',
            'PREREQUISITENOTE' => 'Prerequisitenote',
            'DESCRIPTION3' => 'Description3',
            'DESCRIPTIONENG3' => 'Descriptioneng3',
            'OWNERLEVELID' => 'Ownerlevelid',
            'EVALUATEID' => 'Evaluateid',
            'CLASSEVALUATEID' => 'Classevaluateid',
        ];
    }
}
