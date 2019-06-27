<?php

namespace app\modules\repairsystem\models;

use Yii;

/**
 * This is the model class for table "asset".
 *
 * @property integer $asset_id
 * @property string $asset_date
 * @property string $asset_year
 * @property integer $asset_get
 * @property integer $asset_budget
 * @property integer $asset_company
 *
 * @property RepairDescription[] $repairDescriptions
 */
class Asset extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['asset_id', 'asset_date', 'asset_year', 'asset_get', 'asset_budget', 'asset_company'], 'required'],
            [['asset_id', 'asset_get', 'asset_budget', 'asset_company'], 'integer'],
            [['asset_date'], 'safe'],
            [['asset_year'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'asset_id' => 'Asset ID',
            'asset_date' => 'Asset Date',
            'asset_year' => 'Asset Year',
            'asset_get' => 'Asset Get',
            'asset_budget' => 'Asset Budget',
            'asset_company' => 'Asset Company',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairDescriptions()
    {
        return $this->hasMany(RepairDescription::className(), ['asset_id' => 'asset_id']);
    }
}
