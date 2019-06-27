<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "reg_enrollsummary".
 *
 * @property string $STUDENTID
 * @property string $ACADYEAR
 * @property string $SEMESTER
 * @property string $COURSEID
 * @property string $SECTION
 * @property string $CLASSID
 * @property string $CREDITATTEMPT
 * @property string $CREDITSATISFY
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
class RegEnrollsummary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg_enrollsummary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENTID'], 'string', 'max' => 9],
            [['ACADYEAR'], 'string', 'max' => 4],
            [['SEMESTER'], 'string', 'max' => 1],
            [['COURSEID'], 'string', 'max' => 10],
            [['SECTION', 'CLASSID', 'CREDITATTEMPT', 'CREDITSATISFY'], 'string', 'max' => 255],
            [['GRADE', 'GRADEMODE', 'GRADEENTRY1', 'GRADEENTRY2', 'COURSEIDREPLACE', 'EXAMSTATUS', 'EXAMROOMID', 'EXPORTSTATUS', 'LASTUPDATEDATETIME', 'LASTUPDATEUSERID', 'TRANSCRIPTSTATUS', 'ACTION', 'EXAMSEATID', 'REMARK', 'INPUTSTATUS'], 'string', 'max' => 45],
            [['STUDENTID', 'ACADYEAR', 'COURSEID', 'SEMESTER'], 'unique', 'targetAttribute' => ['STUDENTID', 'ACADYEAR', 'COURSEID', 'SEMESTER']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STUDENTID' => 'Studentid',
            'ACADYEAR' => 'Acadyear',
            'SEMESTER' => 'Semester',
            'COURSEID' => 'Courseid',
            'SECTION' => 'Section',
            'CLASSID' => 'Classid',
            'CREDITATTEMPT' => 'Creditattempt',
            'CREDITSATISFY' => 'Creditsatisfy',
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
