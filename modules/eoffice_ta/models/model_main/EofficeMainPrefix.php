<?php

namespace app\modules\eoffice_ta\models\model_main;

use Yii;

/**
 * This is the model class for table "eoffice_main.prefix".
 *
 * @property string $PREFIXID
 * @property string $PREFIXNAME
 * @property string $PREFIXNAMEENG
 * @property string $PREFIXABB
 * @property string $PREFIXABBENG
 * @property string $DEFAULTSEX
 */
class EofficeMainPrefix extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_main.prefix';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PREFIXID'], 'required'],
            [['PREFIXID', 'PREFIXNAME', 'PREFIXNAMEENG', 'PREFIXABB', 'PREFIXABBENG'], 'string', 'max' => 50],
            [['DEFAULTSEX'], 'string', 'max' => 10],
            [['PREFIXID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PREFIXID' => 'Prefixid',
            'PREFIXNAME' => 'Prefixname',
            'PREFIXNAMEENG' => 'Prefixnameeng',
            'PREFIXABB' => 'Prefixabb',
            'PREFIXABBENG' => 'Prefixabbeng',
            'DEFAULTSEX' => 'Defaultsex',
        ];
    }
}
