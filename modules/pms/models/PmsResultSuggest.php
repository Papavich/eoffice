<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_result_suggest".
 *
 * @property int $suggest_id
 * @property string $suggest_detail
 * @property int $pms_compact_has_prosub_id
 *
 * @property PmsCompactHasProsub $pmsCompactHasProsub
 */
class PmsResultSuggest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_result_suggest';
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
            [['pms_compact_has_prosub_id'], 'required'],
            [['pms_compact_has_prosub_id'], 'integer'],
            [['suggest_detail'], 'string', 'max' => 256],
            [['pms_compact_has_prosub_id'], 'exist', 'skipOnError' => true, 'targetClass' => PmsCompactHasProsub::className(), 'targetAttribute' => ['pms_compact_has_prosub_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'suggest_id' => 'Suggest ID',
            'suggest_detail' => 'Suggest Detail',
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
