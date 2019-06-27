<?php

namespace app\modules\repairsystem\models;

use Yii;

/**
 * This is the model class for table "asset_type_department".
 *
 * @property integer $asset_type_dept_id
 * @property string $asset_type_dept_name
 * @property string $asset_type_dept_code
 *
 * @property AssetDetail[] $assetDetails
 * @property RepDes[] $repDes
 * @property RepairDescription[] $repairDescriptions
 */
class AssetTypeDepartment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset_type_department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['asset_type_dept_code'], 'required'],
            [['asset_type_dept_name'], 'string', 'max' => 100],
            [['asset_type_dept_code'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'asset_type_dept_id' => 'Asset Type Dept ID',
            'asset_type_dept_name' => 'Asset Type Dept Name',
            'asset_type_dept_code' => 'Asset Type Dept Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetDetails()
    {
        return $this->hasMany(AssetDetail::className(), ['asset_type_dept_id' => 'asset_type_dept_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepDes()
    {
        return $this->hasMany(RepDes::className(), ['asset_type_dept_id' => 'asset_type_dept_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairDescriptions()
    {
        return $this->hasMany(RepairDescription::className(), ['asset_type_dept_id' => 'asset_type_dept_id']);
    }
}
