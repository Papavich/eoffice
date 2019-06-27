<?php

namespace app\modules\repairsystem\models;

use Yii;

/**
 * This is the model class for table "repair_photo".
 *
 * @property integer $rep_photo_id
 * @property string $rep_photo_detail
 *
 * @property RepDes[] $repDes
 */
class RepairPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repair_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rep_photo_id', 'rep_photo_detail'], 'required'],
            [['rep_photo_id'], 'integer'],
            [['rep_photo_detail'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rep_photo_id' => 'Rep Photo ID',
            'rep_photo_detail' => 'Rep Photo Detail',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepDes()
    {
        return $this->hasMany(RepDes::className(), ['rep_photo_id' => 'rep_photo_id']);
    }
}
