<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "level".
 *
 * @property string $level_id
 * @property string $level_name
 *
 * @property Person[] $people
 * @property TaProperty[] $taProperties
 */
class Level extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'level';
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
            [['level_id'], 'required'],
            [['level_id'], 'string', 'max' => 10],
            [['level_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'level_id' => 'Level ID',
            'level_name' => 'Level Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['level_id' => 'level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaProperties()
    {
        return $this->hasMany(TaProperty::className(), ['level_degree' => 'level_id']);
    }
}
