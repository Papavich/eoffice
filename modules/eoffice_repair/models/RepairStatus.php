<?php

namespace app\modules\eoffice_repair\models;

use Yii;

/**
 * This is the model class for table "repair_status".
 *
 * @property int $rep_status_id
 * @property string $rep_status_name
 *
 * @property RepairDescription[] $repairDescriptions
 */
class RepairStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repair_status';
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
            [['rep_status_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rep_status_id' => 'Rep Status ID',
            'rep_status_name' => 'Rep Status Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairDescriptions()
    {
        return $this->hasMany(RepairDescription::className(), ['rep_status_id' => 'rep_status_id']);
    }
}
