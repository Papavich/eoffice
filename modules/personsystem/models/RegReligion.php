<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "reg_religion".
 *
 * @property int $RELIGIONID
 * @property string $RELIGIONNAME
 * @property string $RELIGIONNAMEENG
 *
 * @property RegStudentbio[] $regStudentbios
 */
class RegReligion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg_religion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RELIGIONID'], 'required'],
            [['RELIGIONID'], 'integer'],
            [['RELIGIONNAME', 'RELIGIONNAMEENG'], 'string', 'max' => 45],
            [['RELIGIONID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RELIGIONID' => 'Religionid',
            'RELIGIONNAME' => 'Religionname',
            'RELIGIONNAMEENG' => 'Religionnameeng',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegStudentbios()
    {
        return $this->hasMany(RegStudentbio::className(), ['RELIGIONID' => 'RELIGIONID']);
    }
}
