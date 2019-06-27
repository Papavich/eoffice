<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "major".
 *
 * @property int $major_id
 * @property string $major_name
 * @property string $major_name_eng
 * @property string $major_code
 *
 * @property MajorHasProgram[] $majorHasPrograms
 * @property Person[] $people
 */
class Major extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'major';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['major_name', 'major_name_eng', 'major_code'], 'required'],
            [['major_name'], 'string', 'max' => 200],
            [['major_name_eng', 'major_code'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'major_id' => 'Major ID',
            'major_name' => 'Major Name',
            'major_name_eng' => 'Major Name Eng',
            'major_code' => 'Major Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMajorHasPrograms()
    {
        return $this->hasMany(MajorHasProgram::className(), ['major_id' => 'major_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['major_id' => 'major_id']);
    }
}
