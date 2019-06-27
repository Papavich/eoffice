<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "position".
 *
 * @property int $position_id
 * @property string $position_name
 *
 * @property PositionActing[] $positionActings
 * @property PositionAssign[] $positionAssigns
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
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_form');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_name'], 'string', 'max' => 255],
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
    public function getPositionActings()
    {
        return $this->hasMany(PositionActing::className(), ['position_id' => 'position_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPositionAssigns()
    {
        return $this->hasMany(PositionAssign::className(), ['position_id' => 'position_id']);
    }
}
