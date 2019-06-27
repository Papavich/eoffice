<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "reg_prefix".
 *
 * @property string $PREFIXID
 * @property string $PREFIXNAME
 * @property string $PREFIXNAMEENG
 * @property string $PREFIXABB
 * @property string $PREFIXABBENG
 * @property string $DEFAULTSEX
 *
 * @property Person[] $people
 * @property RegStudentmaster[] $regStudentmasters
 */
class RegPrefix extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg_prefix';
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
            'PREFIXNAME' => Yii::t('app','คำนำหน้าชื่อ'),
            'PREFIXNAMEENG' => 'Prefixnameeng',
            'PREFIXABB' => 'Prefixabb',
            'PREFIXABBENG' => 'Prefixabbeng',
            'DEFAULTSEX' => 'Defaultsex',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['prefix_id' => 'PREFIXID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegStudentmasters()
    {
        return $this->hasMany(RegStudentmaster::className(), ['PREFIXID' => 'PREFIXID']);
    }
}
