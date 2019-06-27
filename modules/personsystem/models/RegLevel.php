<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "reg_level".
 *
 * @property string $LEVELID
 * @property string $LEVELNAME
 * @property string $LEVELNAMEENG
 * @property string $LEVELABB
 * @property string $LEVELABBENG
 * @property string $CURRENTACADYEAR
 * @property string $CURRENTSEMESTER
 * @property string $ENROLLACADYEAR
 * @property string $ENROLLSEMESTER
 * @property string $FIRSTYEAR
 *
 * @property BranchHasLevel $branchHasLevel
 * @property RegStudentmaster[] $regStudentmasters
 */
class RegLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LEVELID'], 'required'],
            [['LEVELID', 'LEVELNAME', 'LEVELNAMEENG', 'LEVELABB', 'LEVELABBENG', 'CURRENTACADYEAR', 'CURRENTSEMESTER', 'ENROLLACADYEAR', 'ENROLLSEMESTER', 'FIRSTYEAR'], 'string', 'max' => 50],
            [['LEVELID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LEVELID' => 'ID',
            'LEVELNAME' => 'Name',
            'LEVELNAMEENG' => 'Name Eng',
            'LEVELABB' => 'Level Abb',
            'LEVELABBENG' => 'Level Abb Eng',
            'CURRENTACADYEAR' => 'Current Year',
            'CURRENTSEMESTER' => 'Current Semester',
            'ENROLLACADYEAR' => 'Enroll Year',
            'ENROLLSEMESTER' => 'Enroll Semester',
            'FIRSTYEAR' => 'First Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranchHasLevel()
    {
        return $this->hasOne(BranchHasLevel::className(), ['LEVELID' => 'LEVELID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegStudentmasters()
    {
        return $this->hasMany(RegStudentmaster::className(), ['LEVELID' => 'LEVELID']);
    }
}
