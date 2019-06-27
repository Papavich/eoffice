<?php

namespace app\modules\eoffice_ta\models\model_central;

use Yii;

/**
 * This is the model class for table "eoffice_central.view_pis_enroll_ta".
 *
 * @property string $STUDENTID
 * @property string $SEMESTER
 * @property string $ACADYEAR
 * @property string $COURSECODE
 * @property string $REVISIONCODE
 * @property string $COURSEUNICODE
 * @property string $COURSENAME
 * @property string $COURSENAMEENG
 * @property string $COURSEABB
 * @property string $COURSEABBENG
 * @property string $SECTION
 * @property string $COURSEUNIT
 * @property string $DEPARTMENTID
 * @property string $LEVELID
 * @property string $FACULTYID
 * @property string $LEVELNAME
 * @property string $LEVELNAMEENG
 * @property string $LEVELABB
 * @property string $DEPARTMENTNAME
 * @property string $DEPARTMENTNAMEENG
 */
class ViewPisEnrollTa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eoffice_central.view_pis_enroll_ta';
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
            [['STUDENTID', 'SEMESTER', 'ACADYEAR'], 'required'],
            [['STUDENTID'], 'string', 'max' => 9],
            [['SEMESTER'], 'string', 'max' => 1],
            [['ACADYEAR'], 'string', 'max' => 4],
            [['COURSECODE'], 'string', 'max' => 10],
            [['REVISIONCODE', 'COURSEUNICODE', 'COURSENAME', 'COURSENAMEENG', 'COURSEABB', 'COURSEABBENG', 'SECTION', 'COURSEUNIT'], 'string', 'max' => 255],
            [['DEPARTMENTID', 'LEVELID', 'FACULTYID'], 'string', 'max' => 60],
            [['LEVELNAME', 'LEVELNAMEENG', 'LEVELABB'], 'string', 'max' => 50],
            [['DEPARTMENTNAME', 'DEPARTMENTNAMEENG'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'STUDENTID' => 'Studentid',
            'SEMESTER' => 'Semester',
            'ACADYEAR' => 'Acadyear',
            'COURSECODE' => 'Coursecode',
            'REVISIONCODE' => 'Revisioncode',
            'COURSEUNICODE' => 'Courseunicode',
            'COURSENAME' => 'Coursename',
            'COURSENAMEENG' => 'Coursenameeng',
            'COURSEABB' => 'Courseabb',
            'COURSEABBENG' => 'Courseabbeng',
            'SECTION' => 'Section',
            'COURSEUNIT' => 'Courseunit',
            'DEPARTMENTID' => 'Departmentid',
            'LEVELID' => 'Levelid',
            'FACULTYID' => 'Facultyid',
            'LEVELNAME' => 'Levelname',
            'LEVELNAMEENG' => 'Levelnameeng',
            'LEVELABB' => 'Levelabb',
            'DEPARTMENTNAME' => 'Departmentname',
            'DEPARTMENTNAMEENG' => 'Departmentnameeng',
        ];
    }
}
