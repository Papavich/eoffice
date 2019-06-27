<?php

namespace app\modules\eoffice_repair\models;

use Yii;

/**
 * This is the model class for table "repair_image".
 *
 * @property int $rep_image_id
 * @property string $rep_image_name
 *
 * @property RepairDescription[] $repairDescriptions
 */
class RepairImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repair_image';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_repair');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rep_image_name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rep_image_id' => 'Rep Image ID',
            'rep_image_name' => 'Rep Image Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairDescriptions()
    {
        return $this->hasMany(RepairDescription::className(), ['rep_image_id' => 'rep_image_id']);
    }
}
