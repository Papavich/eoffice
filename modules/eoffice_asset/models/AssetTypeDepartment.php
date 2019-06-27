<?php

namespace app\modules\eoffice_asset\models;

use Yii;

/**
 * This is the model class for table "asset_type_department".
 *
 * @property integer $asset_type_dept_id
 * @property string $asset_type_dept_name
 * @property string $asset_type_dept_code
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
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_asset');
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
}
