<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "eolm_type".
 *
 * @property integer $eolm_type_id
 * @property string $eolm_type_name
 *
 * @property EolmApprovalform[] $eolmApprovalforms
 */
class EolmType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_type';
    }
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolmv2');
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eolm_type_id'], 'required'],
            [['eolm_type_id'], 'integer'],
            [['eolm_type_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_type_id' => 'Eolm Type ID',
            'eolm_type_name' => 'Eolm Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApprovalforms()
    {
        return $this->hasMany(EolmApprovalform::className(), ['eolm_type_id' => 'eolm_type_id']);
    }
}
