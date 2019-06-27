<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;

/**
 * This is the model class for table "matsys_detail".
 *
 * @property string $detail_id
 * @property string $detail_name
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
