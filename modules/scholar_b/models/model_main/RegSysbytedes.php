<?php

namespace app\modules\scholar_b\models\model_main;

use Yii;

/**
 * This is the model class for table "reg_sysbytedes".
 *
 * @property string $TABLENAME
 * @property string $COLUMNNAME
 * @property string $BYTECODE
 * @property string $BYTEDES
 * @property string $BYTEDESENG
 */
class RegSysbytedes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg_sysbytedes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TABLENAME', 'COLUMNNAME', 'BYTECODE'], 'required'],
            [['TABLENAME', 'COLUMNNAME', 'BYTECODE', 'BYTEDES', 'BYTEDESENG'], 'string', 'max' => 100],
            [['TABLENAME', 'COLUMNNAME', 'BYTECODE'], 'unique', 'targetAttribute' => ['TABLENAME', 'COLUMNNAME', 'BYTECODE']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TABLENAME' => 'Tablename',
            'COLUMNNAME' => 'Columnname',
            'BYTECODE' => 'Bytecode',
            'BYTEDES' => 'Bytedes',
            'BYTEDESENG' => 'Bytedeseng',
        ];
    }
}
