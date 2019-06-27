<?php

namespace app\modules\repairsystem\models;

use Yii;

/**
 * This is the model class for table "rep_des".
 *
 * @property integer $rep_des_id
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property string $tel
 * @property string $rep_date
 * @property string $asset_code
 * @property integer $asset_type_dept_id
 * @property integer $building_id
 * @property integer $room_id
 * @property string $rep_des_detail
 * @property integer $rep_status_id
 * @property integer $rep_photo_id
 *
 * @property AssetTypeDepartment $assetTypeDept
 * @property Building $building
 * @property RepairPhoto $repPhoto
 * @property Room $room
 * @property RepairStatus $repStatus
 */
class RepDes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rep_des';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fname', 'lname', 'email', 'tel', 'rep_date', 'asset_code', 'asset_type_dept_id', 'building_id', 'room_id', 'rep_des_detail', 'rep_status_id', 'rep_photo_id'], 'required'],
            [['rep_date'], 'safe'],
            [['asset_type_dept_id', 'building_id', 'room_id', 'rep_status_id', 'rep_photo_id'], 'integer'],
            [['fname', 'lname', 'email'], 'string', 'max' => 50],
            [['tel'], 'string', 'max' => 11],
            [['asset_code'], 'string', 'max' => 25],
            [['rep_des_detail'], 'string', 'max' => 200],
            [['asset_type_dept_id'], 'exist', 'skipOnError' => true, 'targetClass' => AssetTypeDepartment::className(), 'targetAttribute' => ['asset_type_dept_id' => 'asset_type_dept_id']],
        [['building_id'], 'exist', 'skipOnError' => true, 'targetClass' => Building::className(), 'targetAttribute' => ['building_id' => 'building_id']],
           [['rep_photo_id'], 'exist', 'skipOnError' => true, 'targetClass' => RepairPhoto::className(), 'targetAttribute' => ['rep_photo_id' => 'rep_photo_id']],
         [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['room_id' => 'room_id']],
          [['rep_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => RepairStatus::className(), 'targetAttribute' => ['rep_status_id' => 'rep_status_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rep_des_id' => 'แก้ไขสถานะของรายการแจ้งซ่อมที่:',
            'fname' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'email' => 'อีมลล์',
            'tel' => 'เบอร์โทรศัพท์',
            'rep_date' => 'วัน/เดือน/ปี ที่แจ้งซ่อม',
            'asset_code' => 'หมายเลขครุภัณฑ์*',
            'asset_type_dept_id' => 'ชื่อครุภัณฑ์*',
            'building_id' => 'อาคาร*',
            'room_id' => 'ห้อง*',
            'rep_des_detail' => 'รายละเอียด/ลักษณะอาการ*',
            'rep_status_id' => 'สถานะการดำเนินการ',
            'rep_photo_id' => 'Rep Photo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetTypeDept()
    {
        return $this->hasOne(AssetTypeDepartment::className(), ['asset_type_dept_id' => 'asset_type_dept_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuilding()
    {
        return $this->hasOne(Building::className(), ['building_id' => 'building_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepPhoto()
    {
        return $this->hasOne(RepairPhoto::className(), ['rep_photo_id' => 'rep_photo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['room_id' => 'room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepStatus()
    {
        return $this->hasOne(RepairStatus::className(), ['rep_status_id' => 'rep_status_id']);
    }
}
