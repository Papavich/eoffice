<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "position_acting".
 *
 * @property int $position_id
 * @property int $user_id
 * @property string $acting_startDate
 * @property string $acting_endDate
 *
 * @property Position $position
 */
class PositionActing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'position_acting';
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
            [['position_id', 'user_id', 'acting_startDate', 'acting_endDate'], 'required'],
            [['position_id', 'user_id'], 'integer'],
            [['acting_startDate', 'acting_endDate'], 'safe'],
            [['position_id', 'user_id', 'acting_startDate', 'acting_endDate'], 'unique', 'targetAttribute' => ['position_id', 'user_id', 'acting_startDate', 'acting_endDate']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Position::className(), 'targetAttribute' => ['position_id' => 'position_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'position_id' => 'ตำแหน่ง',
            'user_id' => 'บุคคลากร',
            'acting_startDate' => 'ตั้งแต่วันที่',
            'acting_endDate' => 'ถึงวันที่',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Position::className(), ['position_id' => 'position_id']);
    }

    public function getUsername()
    {
        return $this->hasOne(ViewPisPerson::className(), ['person_card_id' => 'user_id']);
    }
}
