<?php

namespace app\modules\eoffice_ta\models\model_central;

use Yii;

/**
 * This is the model class for table "eoffice_central.view_pis_enroll".
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
class ViewPisEnroll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.view_pis_enroll';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENTID', 'ACADYEAR', 'SEMESTER', 'COURSEID'], 'required'],
            [['STUDENTID'], 'string', 'max' => 9],
            [['ACADYEAR'], 'string', 'max' => 4],
            [['SEMESTER'], 'string', 'max' => 1],
            [['COURSEID'], 'string', 'max' => 10],
            [['SECTION', 'CLASSID', 'CREDITATTEMPT', 'CREDITSATISFY'], 'string', 'max' => 255],
            [['GRADE', 'GRADEMODE', 'GRADEENTRY1', 'GRADEENTRY2', 'COURSEIDREPLACE', 'EXAMSTATUS', 'EXAMROOMID', 'EXPORTSTATUS', 'LASTUPDATEDATETIME', 'LASTUPDATEUSERID', 'TRANSCRIPTSTATUS', 'ACTION', 'EXAMSEATID', 'REMARK', 'INPUTSTATUS'], 'string', 'max' => 45],
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
