<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "program".
 *
 * @property string $PROGRAMID
 * @property string $PROGRAMCODE
 * @property string $PROGRAMTYPE
 * @property string $FACALTYID
 * @property string $DEPARTMENTID
 * @property string $LEVELID
 * @property string $PROGRAMNAME
 * @property string $PROGRAMNAMEENG
 * @property string $PROGRAMABB
 * @property string $PROGRAMABBENG
 * @property string $CREDITTOTAL
 * @property string $PROGRAMNAMECERTIFY
 * @property string $PROGRAMSTATUS
 * @property string $STUDYYEARMAX
 */
class Program extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'program';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROGRAMID', 'PROGRAMCODE', 'FACALTYID', 'DEPARTMENTID', 'LEVELID', 'PROGRAMNAME', 'PROGRAMNAMEENG', 'PROGRAMABB', 'PROGRAMABBENG', 'CREDITTOTAL', 'PROGRAMNAMECERTIFY', 'PROGRAMSTATUS', 'STUDYYEARMAX'], 'string', 'max' => 50],
            [['PROGRAMTYPE'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROGRAMID' => 'Programid',
            'PROGRAMCODE' => 'Programcode',
            'PROGRAMTYPE' => 'Programtype',
            'FACALTYID' => 'Facaltyid',
            'DEPARTMENTID' => 'Departmentid',
            'LEVELID' => 'Levelid',
            'PROGRAMNAME' => 'Programname',
            'PROGRAMNAMEENG' => 'Programnameeng',
            'PROGRAMABB' => 'Programabb',
            'PROGRAMABBENG' => 'Programabbeng',
            'CREDITTOTAL' => 'Credittotal',
            'PROGRAMNAMECERTIFY' => 'Programnamecertify',
            'PROGRAMSTATUS' => 'Programstatus',
            'STUDYYEARMAX' => 'Studyyearmax',
        ];
    }
}
