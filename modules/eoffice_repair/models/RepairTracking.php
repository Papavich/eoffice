<?php

namespace app\modules\eoffice_repair\models;

use Yii;

/**
 * This is the model class for table "repair_tracking".
 *
 * @property int $rep_track_id
 * @property int $rep_desc_id
 * @property int $rep_status_id
 * @property string $rep_tracking_date
 *
 * @property RepairStatus $repStatus
 * @property RepairDescription $repDesc
 */
class RepairTracking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repair_tracking';
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
            [['rep_desc_id', 'rep_status_id'], 'integer'],
            [['rep_tracking_date'], 'safe'],
            [['rep_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => RepairStatus::className(), 'targetAttribute' => ['rep_status_id' => 'rep_status_id']],
            [['rep_desc_id'], 'exist', 'skipOnError' => true, 'targetClass' => RepairDescription::className(), 'targetAttribute' => ['rep_desc_id' => 'rep_desc_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rep_track_id' => 'Rep Track ID',
            'rep_desc_id' => 'หมายเลขรายการแจ้งซ่อม',
            'rep_status_id' => 'สถานะ',
            'rep_tracking_date' => 'วัน/เดือน/ปี ที่ดำเนินการ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepStatus()
    {
        return $this->hasOne(RepairStatus::className(), ['rep_status_id' => 'rep_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepDesc()
    {
        return $this->hasOne(RepairDescription::className(), ['rep_desc_id' => 'rep_desc_id']);
    }
}
