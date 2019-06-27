<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "level".
 *
 * @property int $level_id
 * @property string $level_name
 *
 * @property ArewardOrder[] $arewardOrders
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
        return Yii::$app->get('db_pfo');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level_name'], 'required'],
            [['level_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'level_id' => 'รหัสอันดับรางวัล',
            'level_name' => 'ชื่ออันดับรางวัล',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArewardOrders()
    {
        return $this->hasMany(ArewardOrder::className(), ['level_level_id' => 'level_id']);
    }
}
