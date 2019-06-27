<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_activity_type".
 *
 * @property int $act_type_id
 * @property string $act_type_name
 *
 * @property ScbActivityMain[] $scbActivityMains
 */
class ScbActivityType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_activity_type';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['act_type_id'], 'required'],
            [['act_type_id'], 'integer'],
            [['act_type_name'], 'string', 'max' => 10],
            [['act_type_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'act_type_id' => 'ประเภทกิจกรรม',
            'act_type_name' => 'ประเภทกิจกรรม',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbActivityMains()
    {
        return $this->hasMany(ScbActivityMain::className(), ['act_type_id' => 'act_type_id']);
    }
}
