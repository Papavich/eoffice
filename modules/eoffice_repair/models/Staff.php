<?php

namespace app\modules\eoffice_repair\models;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property int $staff_id
 * @property string $staff_name
 *
 * @property RepairResponsibility[] $repairResponsibilities
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staff';
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
            [['staff_name'], 'required'],
            [['staff_name'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'staff_id' => 'Staff ID',
            'staff_name' => 'Staff Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairResponsibilities()
    {
        return $this->hasMany(RepairResponsibility::className(), ['staff_id' => 'staff_id']);
    }
}
