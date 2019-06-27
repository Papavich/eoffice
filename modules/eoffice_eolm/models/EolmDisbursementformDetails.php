<?php

namespace app\modules\eoffice_eolm\models;

use Yii;

/**
 * This is the model class for table "eolm_disbursementform_details".
 *
 * @property int $person_id
 * @property int $eolm_app_id
 * @property int $eolm_dis_type
 *
 * @property EolmDisbursementform $eolmApp
 * @property EolmDisbursementformDetailsItem[] $eolmDisbursementformDetailsItems
 */
class EolmDisbursementformDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_disbursementform_details';
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
            [['person_id', /*'eolm_app_id',*/ 'eolm_dis_type'], 'required'],
            [['person_id', 'eolm_app_id', 'eolm_dis_type'], 'integer'],
            [['person_id', 'eolm_app_id', 'eolm_dis_type'], 'unique', 'targetAttribute' => ['person_id', 'eolm_app_id', 'eolm_dis_type']],
            [['eolm_app_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmDisbursementform::className(), 'targetAttribute' => ['eolm_app_id' => 'eolm_app_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'eolm_app_id' => 'Eolm App ID',
            'eolm_dis_type' => 'Eolm Dis Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApp()
    {
        return $this->hasOne(EolmDisbursementform::className(), ['eolm_app_id' => 'eolm_app_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmDisbursementformDetailsItems()
    {
        return $this->hasMany(EolmDisbursementformDetailsItem::className(), ['person_id' => 'person_id', 'eolm_app_id' => 'eolm_app_id', 'eolm_dis_type' => 'eolm_dis_type']);
    }
}
