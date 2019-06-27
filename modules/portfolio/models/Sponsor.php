<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "sponsor".
 *
 * @property int $sponsor_id
 * @property string $sponsor_name
 *
 * @property ProjectOrder[] $projectOrders
 */
class Sponsor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sponsor';
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
            [['sponsor_name'], 'required'],
            [['sponsor_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            // 'sponsor_id' => 'รหัสผู้สนับสนุน',
            'sponsor_name' => 'ชื่อผู้สนับสนุน',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectOrders()
    {
        return $this->hasMany(ProjectOrder::className(), ['sponsor_sponsor_id' => 'sponsor_id']);
    }
}
