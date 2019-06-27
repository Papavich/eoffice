<?php

namespace app\modules\eoffice_ta\models\model_central;

use Yii;

/**
 * This is the model class for table "eoffice_central.reg_classinstructor".
 *
 * @property string $CLASSID
 * @property string $OFFICERID
 * @property string $LOADPERCENT
 * @property string $SEQUENCE
 * @property string $SEMESTERINDEX
 * @property string $DATEFROM
 * @property string $DATETO
 * @property string $LOAD1
 * @property string $LOAD2
 * @property string $LOAD3
 * @property string $RESPONSEAUTHORITY
 * @property string $EVALUATEID
 * @property string $EVALUATESTATUS
 * @property string $EVADATEFROM
 * @property string $EVADATETO
 */
class EofficeCentralRegClassinstructor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.reg_classinstructor';
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
            [['CLASSID'], 'string', 'max' => 50],
            [['OFFICERID', 'LOADPERCENT', 'SEQUENCE', 'SEMESTERINDEX', 'DATEFROM', 'DATETO', 'LOAD1', 'LOAD2', 'LOAD3', 'RESPONSEAUTHORITY', 'EVALUATEID', 'EVALUATESTATUS', 'EVADATEFROM', 'EVADATETO'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CLASSID' => 'Classid',
            'OFFICERID' => 'Officerid',
            'LOADPERCENT' => 'Loadpercent',
            'SEQUENCE' => 'Sequence',
            'SEMESTERINDEX' => 'Semesterindex',
            'DATEFROM' => 'Datefrom',
            'DATETO' => 'Dateto',
            'LOAD1' => 'Load1',
            'LOAD2' => 'Load2',
            'LOAD3' => 'Load3',
            'RESPONSEAUTHORITY' => 'Responseauthority',
            'EVALUATEID' => 'Evaluateid',
            'EVALUATESTATUS' => 'Evaluatestatus',
            'EVADATEFROM' => 'Evadatefrom',
            'EVADATETO' => 'Evadateto',
        ];
    }
}
