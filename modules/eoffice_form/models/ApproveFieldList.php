<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "approve_field_list".
 *
 * @property int $approve_field_list_id
 * @property string $approve_field_list_name
 * @property int $approve_field_list_order
 * @property string $approve_field_ref
 *
 * @property ApproveDesignField $approveFieldRef
 */
class ApproveFieldList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'approve_field_list';
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
            [['approve_field_list_order'], 'integer'],
            [['approve_field_ref'], 'required'],
            [['approve_field_list_name', 'approve_field_ref'], 'string', 'max' => 45],
            [['approve_field_ref'], 'exist', 'skipOnError' => true, 'targetClass' => ApproveDesignField::className(), 'targetAttribute' => ['approve_field_ref' => 'approve_field_ref']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'approve_field_list_id' => 'รหัสลิสต์',
            'approve_field_list_name' => 'ชื่อลิสต์',
            'approve_field_list_order' => 'ลำดับลิสต์',
            'approve_field_ref' => 'Approve Field Ref',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproveFieldRef()
    {
        return $this->hasOne(ApproveDesignField::className(), ['approve_field_ref' => 'approve_field_ref']);
    }
}
