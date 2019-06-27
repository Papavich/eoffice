<?php

namespace app\modules\eoffice_ta\models\model_central;

use Yii;

/**
 * This is the model class for table "eoffice_central.view_pis_subject_section_teacher".
 *
 * @property string $COURSECODE
 * @property string $COURSENAMEENG
 * @property string $COURSENAME
 * @property string $LEVELID
 * @property string $SECTION
 * @property string $SEMESTER
 * @property string $ACADYEAR
 * @property string $DEPARTMENTID
 * @property string $COURSEUNIT
 * @property string $PREFIXID
 * @property string $OFFICERNAME
 * @property string $OFFICERSURNAME
 * @property string $OFFICERNAMEENG
 * @property string $OFFICERSURNAMEENG
 * @property string $REVISIONCODE
 */
class ViewPisSubjectSectionTeacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eoffice_central.view_pis_subject_section_teacher';
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
            [['COURSECODE'], 'string', 'max' => 10],
            [['COURSENAMEENG', 'COURSENAME', 'COURSEUNIT', 'PREFIXID', 'OFFICERNAME', 'OFFICERSURNAME', 'OFFICERNAMEENG', 'OFFICERSURNAMEENG', 'REVISIONCODE'], 'string', 'max' => 255],
            [['LEVELID', 'SECTION', 'SEMESTER', 'ACADYEAR', 'DEPARTMENTID'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'COURSECODE' => 'Coursecode',
            'COURSENAMEENG' => 'Coursenameeng',
            'COURSENAME' => 'Coursename',
            'LEVELID' => 'Levelid',
            'SECTION' => 'Section',
            'SEMESTER' => 'Semester',
            'ACADYEAR' => 'Acadyear',
            'DEPARTMENTID' => 'Departmentid',
            'COURSEUNIT' => 'Courseunit',
            'PREFIXID' => 'Prefixid',
            'OFFICERNAME' => 'Officername',
            'OFFICERSURNAME' => 'Officersurname',
            'OFFICERNAMEENG' => 'Officernameeng',
            'OFFICERSURNAMEENG' => 'Officersurnameeng',
            'REVISIONCODE' => 'Revisioncode',
        ];
    }
}
