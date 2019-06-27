<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "position".
 *
 * @property string $position_id
 * @property string $position_name
 *
 * @property Person[] $people
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_id'], 'required'],
            [['position_id'], 'string', 'max' => 3],
            [['position_name'], 'string', 'max' => 100],
            [['position_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'position_id' => 'Position ID',
            'position_name' => 'Position Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['position_id' => 'position_id']);
    }
}
