<?php

namespace app\modules\eoffice_eolm\models;

use Yii;

/**
 * This is the model class for table "eolm_status".
 *
 * @property integer $eolm_status_id
 * @property string $eolm_status_name
 *
 * @property EolmApprovalform[] $eolmApprovalforms
 */
class EolmStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_status';
    }
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolm');
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eolm_status_id'], 'required'],
            [['eolm_status_id'], 'integer'],
            [['eolm_status_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_status_id' => 'Eolm Status ID',
            'eolm_status_name' => 'Eolm Status Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApprovalforms()
    {
        return $this->hasMany(EolmApprovalform::className(), ['eolm_status_id' => 'eolm_status_id']);
    }
}
