<?php

namespace app\modules\eoffice_repair\models;

use Yii;

/**
 * This is the model class for table "repair_description".
 *
 * @property int $rep_desc_id
 * @property string $rep_desc_fname
 * @property string $rep_desc_lname
 * @property string $rep_desc_email
 * @property string $rep_desc_tel
 * @property string $rep_desc_detail
 * @property string $rep_desc_cost
 * @property string $rep_desc_comment
 * @property string $rep_desc_request_date
 * @property int $rep_image_id
 * @property int $rep_status_id
 * @property string $rep_location
 * @property string $asset_detail_id
 * @property string $asset_detail_name
 * @property int $staff_id
 *
 * @property Staff $staff
 * @property RepairImage $repImage
 * @property RepairStatus $repStatus
 * @property RepairTracking[] $repairTrackings
 */
class RepairDescription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repair_description';
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
            [['rep_desc_request_date'], 'safe'],
            [['rep_image_id', 'rep_status_id', 'staff_id'], 'integer'],
            [['rep_status_id'], 'required'],
            [['rep_desc_fname', 'rep_desc_lname', 'rep_desc_email', 'asset_detail_name'], 'string', 'max' => 100],
            [['rep_desc_tel', 'asset_detail_id'], 'string', 'max' => 20],
            [['rep_desc_detail', 'rep_desc_comment'], 'string', 'max' => 200],
            [['rep_desc_cost'], 'string', 'max' => 10],
            [['rep_location'], 'string', 'max' => 255],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::className(), 'targetAttribute' => ['staff_id' => 'staff_id']],
            [['rep_image_id'], 'exist', 'skipOnError' => true, 'targetClass' => RepairImage::className(), 'targetAttribute' => ['rep_image_id' => 'rep_image_id']],
            [['rep_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => RepairStatus::className(), 'targetAttribute' => ['rep_status_id' => 'rep_status_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
          'rep_desc_id' => 'หมายเลขรายการแจ้งซ่อม',
         'rep_desc_fname' => 'ชื่อ',
         'rep_desc_lname' => 'สกุล',
         'rep_desc_email' => 'อีเมลล์',
         'rep_desc_tel' => 'หมายเลขโทรศัพท์',
         'rep_desc_detail' => 'รายละเอียด/ลักษณะอาการ',
         'rep_desc_cost' => 'ค่าใช้จ่าย',
         'rep_desc_comment' => 'Rep Desc Comment',
         'rep_desc_request_date' => 'วันที่แจ้งซ่อม',
         'rep_image_id' => 'รูปภาพ',
         'rep_status_id' => 'สถานะ',
         'rep_location' => 'สถานที่',
         'asset_detail_id' => 'หมายเลขครุภัณฑ์',
         'asset_detail_name' => 'ชื่อคุรุภัณฑ์',
          'staff_id' => 'เจ้าหน้าที่',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['staff_id' => 'staff_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepImage()
    {
        return $this->hasOne(RepairImage::className(), ['rep_image_id' => 'rep_image_id']);
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
    public function getRepairTrackings()
    {
        return $this->hasMany(RepairTracking::className(), ['rep_desc_id' => 'rep_desc_id']);
    }
    public function getAsset()
    {
        return $this->hasMany(EofficeAssetViewAsset::className(), ['rooms_id' => 'rep_location']);
    }
}
