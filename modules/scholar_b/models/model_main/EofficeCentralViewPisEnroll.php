<?php

namespace app\modules\scholar_b\models\model_main;

use Yii;

/**
 * This is the model class for table "Eoffice_central.view_pis_enroll".
 *
 * @property string $COURSECODE
 * @property string $COURSENAME
 * @property string $COURSENAMEENG
 * @property string $SECTION
 * @property string $ACADYEAR
 * @property string $STUDENTID
 * @property string $SEMESTER
 * @property string $COURSEID
 * @property string $CLASSID
 * @property string $CREDITATTEMPT
 * @property string $CREDITSATISFY
 * @property string $FACULTYID
 * @property string $DEPARTMENTID
 * @property string $GRADE
 * @property string $GRADEMODE
 * @property string $GRADEENTRY1
 * @property string $GRADEENTRY2
 * @property string $COURSEIDREPLACE
 * @property string $EXAMSTATUS
 * @property string $EXAMROOMID
 * @property string $EXPORTSTATUS
 * @property string $LASTUPDATEDATETIME
 * @property string $LASTUPDATEUSERID
 * @property string $TRANSCRIPTSTATUS
 * @property string $ACTION
 * @property string $EXAMSEATID
 * @property string $REMARK
 * @property string $INPUTSTATUS
 */
class EofficeCentralViewPisEnroll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Eoffice_central.view_pis_enroll';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COURSECODE', 'COURSENAME', 'COURSENAMEENG', 'SECTION', 'ACADYEAR', 'SEMESTER', 'CLASSID', 'CREDITATTEMPT', 'CREDITSATISFY'], 'string', 'max' => 255],
            [['STUDENTID', 'COURSEID', 'FACULTYID'], 'string', 'max' => 50],
            [['DEPARTMENTID'], 'string', 'max' => 80],
            [['GRADE', 'GRADEMODE', 'GRADEENTRY1', 'GRADEENTRY2', 'COURSEIDREPLACE', 'EXAMSTATUS', 'EXAMROOMID', 'EXPORTSTATUS', 'LASTUPDATEDATETIME', 'LASTUPDATEUSERID', 'TRANSCRIPTSTATUS', 'ACTION', 'EXAMSEATID', 'REMARK', 'INPUTSTATUS'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COURSECODE' => 'Coursecode',
            'COURSENAME' => 'Coursename',
            'COURSENAMEENG' => 'Coursenameeng',
            'SECTION' => 'Section',
            'ACADYEAR' => 'Acadyear',
            'STUDENTID' => 'Studentid',
            'SEMESTER' => 'Semester',
            'COURSEID' => 'Courseid',
            'CLASSID' => 'Classid',
            'CREDITATTEMPT' => 'Creditattempt',
            'CREDITSATISFY' => 'Creditsatisfy',
            'FACULTYID' => 'Facultyid',
            'DEPARTMENTID' => 'Departmentid',
            'GRADE' => 'Grade',
            'GRADEMODE' => 'Grademode',
            'GRADEENTRY1' => 'Gradeentry1',
            'GRADEENTRY2' => 'Gradeentry2',
            'COURSEIDREPLACE' => 'Courseidreplace',
            'EXAMSTATUS' => 'Examstatus',
            'EXAMROOMID' => 'Examroomid',
            'EXPORTSTATUS' => 'Exportstatus',
            'LASTUPDATEDATETIME' => 'Lastupdatedatetime',
            'LASTUPDATEUSERID' => 'Lastupdateuserid',
            'TRANSCRIPTSTATUS' => 'Transcriptstatus',
            'ACTION' => 'Action',
            'EXAMSEATID' => 'Examseatid',
            'REMARK' => 'Remark',
            'INPUTSTATUS' => 'Inputstatus',
        ];
    }
}
