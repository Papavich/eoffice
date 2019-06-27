<?php

namespace app\modules\repairsystem\models;

use Yii;

/**
 * This is the model class for table "repair_status".
 *
 * @property integer $rep_status_id
 * @property string $rep_status_name
 *
 * @property RepDes[] $repDes
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rep_status_id', 'rep_status_name'], 'required'],
            [['rep_status_id'], 'integer'],
            [['rep_status_name'], 'string', 'max' => 50],
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
    public function getRepDes()
    {
        return $this->hasMany(RepDes::className(), ['rep_status_id' => 'rep_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairDescriptions()
    {
        return $this->hasMany(RepairDescription::className(), ['rep_status_id' => 'rep_status_id']);
    }
}
