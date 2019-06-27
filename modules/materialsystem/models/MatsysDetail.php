<?php

namespace app\modules\materialsystem\models;

use Yii;

/**
 * This is the model class for table "matsys_detail".
 *
 * @property string $detail_id รหัสประเภทรายละเอียดการนำไปใช้
 * @property string $detail_name ชื่อประเภทรายละเอียดการนำไปใช้
 *
 * @property MatsysOrderDetail[] $matsysOrderDetails
 */
class MatsysDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matsys_detail';
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
            [['detail_id'], 'required'],
            [['detail_id'], 'string', 'max' => 20],
            [['detail_name'], 'string', 'max' => 45],
            [['detail_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'detail_id' => 'Detail ID',
            'detail_name' => 'Detail Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatsysOrderDetails()
    {
        return $this->hasMany(MatsysOrderDetail::className(), ['detail_id' => 'detail_id']);
    }
}
