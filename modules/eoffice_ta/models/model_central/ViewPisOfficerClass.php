<?php

namespace app\modules\eoffice_ta\models\model_central;

use Yii;

/**
 * This is the model class for table "eoffice_central.view_pis_officer_class".
 *
 * @property string $OFFICERNAME
 * @property string $OFFICERSURNAME
 * @property string $OFFICERNAMEENG
 * @property string $PREFIXID
 * @property string $DEPARTMENTID
 * @property string $FACULTYID
 * @property string $COURSENAME
 * @property string $COURSENAMEENG
 * @property string $COURSEUNIT
 * @property string $ACADYEAR
 * @property string $SEMESTER
 * @property string $COURSECODE
 * @property string $PREFIXABB
 * @property string $REVISIONCODE
 */
class ViewPisOfficerClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.view_pis_officer_class';
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
            [['OFFICERNAME', 'OFFICERSURNAME', 'OFFICERNAMEENG', 'PREFIXID', 'DEPARTMENTID', 'FACULTYID', 'COURSENAME', 'COURSENAMEENG', 'COURSEUNIT', 'REVISIONCODE'], 'string', 'max' => 255],
            [['ACADYEAR', 'SEMESTER'], 'string', 'max' => 60],
            [['COURSECODE'], 'string', 'max' => 10],
            [['PREFIXABB'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OFFICERNAME' => 'Officername',
            'OFFICERSURNAME' => 'Officersurname',
            'OFFICERNAMEENG' => 'Officernameeng',
            'PREFIXID' => 'Prefixid',
            'DEPARTMENTID' => 'Departmentid',
            'FACULTYID' => 'Facultyid',
            'COURSENAME' => 'Coursename',
            'COURSENAMEENG' => 'Coursenameeng',
            'COURSEUNIT' => 'Courseunit',
            'ACADYEAR' => 'Acadyear',
            'SEMESTER' => 'Semester',
            'COURSECODE' => 'Coursecode',
            'PREFIXABB' => 'Prefixabb',
            'REVISIONCODE' => 'Revisioncode',
        ];
    }
}
