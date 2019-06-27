<?php

namespace app\modules\eoffice_ta\models\model_central;

use Yii;

/**
 * This is the model class for table "eoffice_central.view_pis_subject_section".
 *
 * @property string $SECTION
 * @property string $COURSECODE
 * @property string $COURSENAME
 * @property string $COURSENAMEENG
 * @property string $COURSEUNIT
 * @property string $REVISIONCODE
 * @property string $SEMESTER
 * @property string $ACADYEAR
 * @property string $LEVELID
 * @property string $DEPARTMENTID
 * @property string $COURSEID
 * @property string $CLASSID
 * @property string $FEEDEFAULT
 */
class ViewPisSubjectSection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eoffice_central.view_pis_subject_section';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CLASSID'], 'required'],
            [['SECTION', 'SEMESTER', 'ACADYEAR', 'LEVELID', 'DEPARTMENTID', 'COURSEID', 'CLASSID', 'FEEDEFAULT'], 'string', 'max' => 60],
            [['COURSECODE'], 'string', 'max' => 10],
            [['COURSENAME', 'COURSENAMEENG', 'COURSEUNIT', 'REVISIONCODE'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SECTION' => 'Section',
            'COURSECODE' => 'Coursecode',
            'COURSENAME' => 'Coursename',
            'COURSENAMEENG' => 'Coursenameeng',
            'COURSEUNIT' => 'Courseunit',
            'REVISIONCODE' => 'Revisioncode',
            'SEMESTER' => 'Semester',
            'ACADYEAR' => 'Acadyear',
            'LEVELID' => 'Levelid',
            'DEPARTMENTID' => 'Departmentid',
            'COURSEID' => 'Courseid',
            'CLASSID' => 'Classid',
            'FEEDEFAULT' => 'Feedefault',
        ];
    }
}
