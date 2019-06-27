<?php

namespace app\modules\eoffice_ta\models\model_central;

use Yii;

/**
 * This is the model class for table "eoffice_central.view_pis_open_subject".
 *
 * @property string $semester_id
 * @property string $year_id
 * @property string $subject_id
 * @property string $DEPARTMENTID
 * @property string $COURSENAME
 * @property string $COURSENAMEENG
 * @property string $COURSEUNIT
 * @property string $REVISIONCODE
 */
class ViewPisOpenSubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.view_pis_open_subject';
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
            [['semester_id', 'year_id'], 'string', 'max' => 60],
            [['subject_id'], 'string', 'max' => 10],
            [['DEPARTMENTID', 'COURSENAME', 'COURSENAMEENG', 'COURSEUNIT', 'REVISIONCODE'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'semester_id' => 'Semester ID',
            'year_id' => 'Year ID',
            'subject_id' => 'Subject ID',
            'DEPARTMENTID' => 'Departmentid',
            'COURSENAME' => 'Coursename',
            'COURSENAMEENG' => 'Coursenameeng',
            'COURSEUNIT' => 'Courseunit',
            'REVISIONCODE' => 'Revisioncode',
        ];
    }
}
