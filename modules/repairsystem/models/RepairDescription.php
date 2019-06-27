<?php

namespace app\modules\repairsystem\models;

use Yii;

/**
 * This is the model class for table "repair_description".
 *
 * @property integer $rep_desc_id
 * @property string $rep_desc_detail
 * @property string $rep_desc_cost
 * @property string $rep_desc_room_other
 * @property string $rep_desc_aaset_no
 * @property string $rep_desc_asset_other
 * @property string $rep_desc_comment
 * @property string $rep_desc_request_date
 * @property integer $rep_status_id
 * @property string $user_create_time
 * @property string $user_update_time
 * @property integer $room_id
 * @property integer $user_id
 * @property integer $asset_id
 * @property integer $asset_type_dept_id
 *
 * @property Asset $assetdetail
 * @property AssetTypeDepartment $assetTypeDept
 * @property Room $room
 * @property RepairStatus $repStatus
 * @property User2 $user
 * @property RepairPhoto[] $repairPhotos
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rep_desc_id', 'rep_desc_detail', 'rep_desc_cost', 'rep_desc_room_other', 'rep_desc_aaset_no', 'rep_desc_asset_other', 'rep_desc_comment', 'rep_desc_request_date', 'rep_status_id', 'user_create_time', 'user_update_time', 'room_id', 'user_id', 'asset_id', 'asset_type_dept_id'], 'required'],
            [['rep_desc_id', 'rep_status_id', 'room_id', 'user_id', 'asset_id', 'asset_type_dept_id'], 'integer'],
            [['rep_desc_request_date', 'user_create_time', 'user_update_time'], 'safe'],
            [['rep_desc_detail', 'rep_desc_room_other', 'rep_desc_asset_other', 'rep_desc_comment'], 'string', 'max' => 200],
            [['rep_desc_cost', 'rep_desc_aaset_no'], 'string', 'max' => 10],
            [['asset_id'], 'exist', 'skipOnError' => true, 'targetClass' => Asset::className(), 'targetAttribute' => ['asset_id' => 'asset_id']],
            [['asset_type_dept_id'], 'exist', 'skipOnError' => true, 'targetClass' => AssetTypeDepartment::className(), 'targetAttribute' => ['asset_type_dept_id' => 'asset_type_dept_id']],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['room_id' => 'room_id']],
            [['rep_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => RepairStatus::className(), 'targetAttribute' => ['rep_status_id' => 'rep_status_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User2::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rep_desc_id' => 'Rep Desc ID',
            'rep_desc_detail' => 'รายละเอียด/ลักษณะอาการ*',
            'rep_desc_cost' => 'Rep Desc Cost',
            'rep_desc_room_other' => 'กรณีเลือกอื่นๆ',
            'rep_desc_aaset_no' => 'Rep Desc Aaset No',
            'rep_desc_asset_other' => 'Rep Desc Asset Other',
            'rep_desc_comment' => 'Rep Desc Comment',
            'rep_desc_request_date' => 'วัน/เดือน/ปี ที่แจ้งซ่อม',
            'rep_status_id' => 'Rep Status ID',
            'user_create_time' => 'User Create Time',
            'user_update_time' => 'User Update Time',
            'room_id' => 'Room ID',
            'user_id' => 'User ID',
            'asset_id' => 'Asset ID',
            'asset_type_dept_id' => 'Asset Type Dept ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsset()
    {
        return $this->hasOne(Asset::className(), ['asset_id' => 'asset_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User2::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairPhotos()
    {
        return $this->hasMany(RepairPhoto::className(), ['rep_desc_id' => 'rep_desc_id']);
    }
}
