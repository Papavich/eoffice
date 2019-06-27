<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "view_position_join_assign".
 *
 * @property int $position_id
 * @property string $position_name
 * @property int $user_id
 */
class ViewPositionJoinAssign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_position_join_assign';
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
            'user_id' => 'User ID',
        ];
    }
}
