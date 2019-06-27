<?php

namespace app\modules\materialsystem\models;

use Yii;

/**
 * This is the model class for table "matsys_order_detail".
 *
 * @property string $order_detail_id รหัสรายละเอียดการนำไปใช้
 * @property string $order_detail รายละเอียด
 * @property string $order_detail_name ชื่อโครงการหรือชื่อวิชา
 * @property string $order_detail_name_id รหัสโครงการหรือรหัสวิชา
 * @property string $detail_id รหัสประเภทรายละเอียดการนำไปใช้
 *
 * @property MatsysOrder[] $matsysOrders
 * @property MatsysDetail $detail
 */
class MatsysOrderDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matsys_order_detail';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_mat');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_detail_id', 'detail_id'], 'required'],
            [['order_detail_id', 'detail_id'], 'string', 'max' => 20],
            [['order_detail', 'order_detail_name', 'order_detail_name_id'], 'string', 'max' => 45],
            [['order_detail_id'], 'unique'],
            [['detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatsysDetail::className(), 'targetAttribute' => ['detail_id' => 'detail_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_detail_id' => 'Order Detail ID',
            'order_detail' => 'Order Detail',
            'order_detail_name' => 'Order Detail Name',
            'order_detail_name_id' => 'Order Detail Name ID',
            'detail_id' => 'Detail ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatsysOrders()
    {
        return $this->hasMany(MatsysOrder::className(), ['order_detail_id' => 'order_detail_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetail()
    {
        return $this->hasOne(MatsysDetail::className(), ['detail_id' => 'detail_id']);
    }
}
