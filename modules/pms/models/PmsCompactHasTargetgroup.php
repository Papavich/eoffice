<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_compact_has_targetgroup".
 *
 * @property int $id
 * @property string $targetgroup
 * @property int $result_amount
 * @property int $pms_compact_has_prosub_id
 *
 * @property PmsCompactHasProsub $pmsCompactHasProsub
 */
class PmsCompactHasTargetgroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_compact_has_targetgroup';
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
            [['result_amount', 'pms_compact_has_prosub_id'], 'integer'],
            [['pms_compact_has_prosub_id'], 'required'],
            [['targetgroup'], 'string', 'max' => 100],
            [['pms_compact_has_prosub_id'], 'exist', 'skipOnError' => true, 'targetClass' => PmsCompactHasProsub::className(), 'targetAttribute' => ['pms_compact_has_prosub_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'targetgroup' => 'Targetgroup',
            'result_amount' => 'Result Amount',
            'pms_compact_has_prosub_id' => 'Pms Compact Has Prosub ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsCompactHasProsub()
    {
        return $this->hasOne(PmsCompactHasProsub::className(), ['id' => 'pms_compact_has_prosub_id']);
    }
}
