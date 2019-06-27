<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "eolm_disbursementform_bill".
 *
 * @property int $eolm_dis_bill_id
 * @property string $eolm_dis_bill_path
 * @property string $eolm_dis_bill_type
 * @property int $eolm_dis_bill_size
 * @property string $eolm_dis_bill_name
 */
class EolmDisbursementformBill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_disbursementform_bill';
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
            [['eolm_dis_bill_id', 'eolm_dis_bill_path'], 'required'],
            [['eolm_dis_bill_id', 'eolm_dis_bill_size'], 'integer'],
            [['eolm_dis_bill_path'], 'string', 'max' => 1024],
            [['eolm_dis_bill_type'], 'string', 'max' => 255],
            [['eolm_dis_bill_name'], 'string', 'max' => 225],
            [['eolm_dis_bill_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_dis_bill_id' => 'Eolm Dis Bill ID',
            'eolm_dis_bill_path' => 'Eolm Dis Bill Path',
            'eolm_dis_bill_type' => 'Eolm Dis Bill Type',
            'eolm_dis_bill_size' => 'Eolm Dis Bill Size',
            'eolm_dis_bill_name' => 'Eolm Dis Bill Name',
        ];
    }
}
