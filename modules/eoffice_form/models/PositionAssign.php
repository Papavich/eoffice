<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "position_assign".
 *
 * @property int $position_id
 * @property int $user_id
 * @property string $cr_date
 * @property string $cr_by
 * @property string $ud_date
 * @property string $ud_by
 *
 * @property Position $position
 */
class PositionAssign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'position_assign';
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
            [['position_id', 'user_id'], 'required'],
            [['position_id', 'user_id'], 'integer'],
            [['cr_date', 'ud_date'], 'safe'],
            [['cr_by', 'ud_by'], 'string', 'max' => 255],
            [['position_id', 'user_id'], 'unique', 'targetAttribute' => ['position_id', 'user_id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Position::className(), 'targetAttribute' => ['position_id' => 'position_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'position_id' => 'Position ID',
            'user_id' => 'User ID',
            'cr_date' => 'Cr Date',
            'cr_by' => 'Cr By',
            'ud_date' => 'Ud Date',
            'ud_by' => 'Ud By',
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
