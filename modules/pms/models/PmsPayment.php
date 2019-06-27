<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_payment".
 *
 * @property int $payment_id
 * @property string $payment_detail
 * @property int $payment_price
 */
class PmsPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_payment';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pms');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_price'], 'integer'],
            [['payment_detail'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'payment_id' => 'Payment ID',
            'payment_detail' => 'Payment Detail',
            'payment_price' => 'Payment Price',
        ];
    }
}
