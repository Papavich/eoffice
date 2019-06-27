<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "approve_position".
 *
 * @property int $position_id
 * @property string $position_name
 * @property int $position_order
 * @property int $approve_group_id
 *
 * @property ApproveGroup $approveGroup
 */
class ApprovePosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'approve_position';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_form');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_order','position_id', 'approve_group_id'], 'required'],
            [['position_id', 'position_order', 'approve_group_id'], 'integer'],
            [['position_name'], 'string', 'max' => 255],
            [['position_id', 'approve_group_id'], 'unique', 'targetAttribute' => ['position_id', 'approve_group_id']],
            [['approve_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ApproveGroup::className(), 'targetAttribute' => ['approve_group_id' => 'group_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'position_id' => 'ตำแหน่ง',
            'position_name' => 'ชื่อตำแหน่ง',
            'position_order' => 'ลำดับการพิจารณา',
            'approve_group_id' => 'Approve Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproveGroup()
    {
        return $this->hasOne(ApproveGroup::className(), ['group_id' => 'approve_group_id']);
    }
}
