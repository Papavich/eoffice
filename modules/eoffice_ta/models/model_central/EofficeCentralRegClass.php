<?php

namespace app\modules\eoffice_ta\models\model_central;

use Yii;

/**
 * This is the model class for table "eoffice_central.reg_class".
 *
 * @property string $CLASSID
 * @property string $CAMPUSID
 * @property string $LEVELID
 * @property string $ACADYEAR
 * @property string $SEMESTER
 * @property string $COURSEID
 * @property string $SECTION
 * @property string $CLASSSTATUS
 * @property string $TOTALSEAT
 * @property string $ENROLLSEAT
 * @property string $CLASSNOTE
 * @property string $FEEDEFAULT
 * @property string $CLASSTYPE
 * @property string $MALERESERVE
 * @property string $MALEENROLL
 * @property string $DATEFROM
 * @property string $DATETO
 * @property string $CLASSGRADESTATUS
 * @property string $CLASSSET
 * @property string $CLASSIDMASTER
 * @property string $REVENUEFACULTYID
 * @property string $REVENUEDEPARTMENTID
 * @property string $BLOCKSEQUENCE
 * @property string $CLASSCOURSECODE
 * @property string $CLASSCOURSEREVCODE
 * @property string $MAINEVALUATEID
 * @property string $EVALUATEONLINE
 * @property string $EVADATEFROM
 * @property string $EVADATETO
 * @property string $FACULTYID
 * @property string $DEPARTMENTID
 */
class EofficeCentralRegClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.reg_class';
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
            [['CLASSID'], 'required'],
            [['CLASSID', 'CAMPUSID', 'LEVELID', 'ACADYEAR', 'SEMESTER', 'COURSEID', 'SECTION', 'CLASSSTATUS', 'TOTALSEAT', 'ENROLLSEAT', 'FEEDEFAULT', 'CLASSTYPE', 'MALERESERVE', 'MALEENROLL', 'DATEFROM', 'DATETO', 'CLASSGRADESTATUS', 'CLASSSET', 'CLASSIDMASTER', 'REVENUEFACULTYID', 'REVENUEDEPARTMENTID', 'BLOCKSEQUENCE', 'CLASSCOURSECODE', 'CLASSCOURSEREVCODE', 'MAINEVALUATEID', 'EVALUATEONLINE', 'EVADATEFROM', 'EVADATETO', 'FACULTYID', 'DEPARTMENTID'], 'string', 'max' => 60],
            [['CLASSNOTE'], 'string', 'max' => 100],
            [['CLASSID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CLASSID' => 'Classid',
            'CAMPUSID' => 'Campusid',
            'LEVELID' => 'Levelid',
            'ACADYEAR' => 'Acadyear',
            'SEMESTER' => 'Semester',
            'COURSEID' => 'Courseid',
            'SECTION' => 'Section',
            'CLASSSTATUS' => 'Classstatus',
            'TOTALSEAT' => 'Totalseat',
            'ENROLLSEAT' => 'Enrollseat',
            'CLASSNOTE' => 'Classnote',
            'FEEDEFAULT' => 'Feedefault',
            'CLASSTYPE' => 'Classtype',
            'MALERESERVE' => 'Malereserve',
            'MALEENROLL' => 'Maleenroll',
            'DATEFROM' => 'Datefrom',
            'DATETO' => 'Dateto',
            'CLASSGRADESTATUS' => 'Classgradestatus',
            'CLASSSET' => 'Classset',
            'CLASSIDMASTER' => 'Classidmaster',
            'REVENUEFACULTYID' => 'Revenuefacultyid',
            'REVENUEDEPARTMENTID' => 'Revenuedepartmentid',
            'BLOCKSEQUENCE' => 'Blocksequence',
            'CLASSCOURSECODE' => 'Classcoursecode',
            'CLASSCOURSEREVCODE' => 'Classcourserevcode',
            'MAINEVALUATEID' => 'Mainevaluateid',
            'EVALUATEONLINE' => 'Evaluateonline',
            'EVADATEFROM' => 'Evadatefrom',
            'EVADATETO' => 'Evadateto',
            'FACULTYID' => 'Facultyid',
            'DEPARTMENTID' => 'Departmentid',
        ];
    }
}
