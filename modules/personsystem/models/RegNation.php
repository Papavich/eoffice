<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "reg_nation".
 *
 * @property int $NATIONID
 * @property string $NATIONNAME
 */
class RegNation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg_nation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NATIONID'], 'required'],
            [['NATIONID'], 'integer'],
            [['NATIONNAME'], 'string', 'max' => 100],
            [['NATIONID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'NATIONID' => 'Nationid',
            'NATIONNAME' => 'Nationname',
        ];
    }
}
