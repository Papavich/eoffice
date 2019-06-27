<?php

namespace app\modules\eoffice_repair\models;

use Yii;

/**
 * This is the model class for table "repair_responsibility".
 *
 * @property int $rep_resp_id
 * @property int $staff_id
 * @property string $rep_location
 *
 * @property Staff $staff
 */
class RepairResponsibility extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repair_responsibility';
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
            [['staff_id'], 'integer'],
            [['rep_location'], 'required'],
            [['rep_location'], 'string', 'max' => 255],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::className(), 'targetAttribute' => ['staff_id' => 'staff_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rep_resp_id' => 'Rep Resp ID',
            'staff_id' => 'Staff ID',
            'rep_location' => 'Rep Location',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['staff_id' => 'staff_id']);
    }
}
