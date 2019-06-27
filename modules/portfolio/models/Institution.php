<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "institution".
 *
 * @property int $ag_award_id
 * @property string $ag_award_name
 *
 * @property ArewardOrder[] $arewardOrders
 */
class Institution extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'institution';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ag_award_name'], 'required'],
            [['ag_award_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
           // 'ag_award_id' => 'รหัสสถาบันที่ให้รางวัล',
            'ag_award_name' => 'ชื่อสถาบันที่ให้รางวัล',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArewardOrders()
    {
        return $this->hasMany(ArewardOrder::className(), ['institution_ag_award_id' => 'ag_award_id']);
    }
}
