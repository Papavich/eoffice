<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_result_problem".
 *
 * @property int $problem_id
 * @property string $problem_detail
 * @property int $pms_compact_has_prosub_id
 *
 * @property PmsCompactHasProsub $pmsCompactHasProsub
 */
class PmsResultProblem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_result_problem';
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
            [['problem_detail'], 'string', 'max' => 256],
            [['pms_compact_has_prosub_id'], 'exist', 'skipOnError' => true, 'targetClass' => PmsCompactHasProsub::className(), 'targetAttribute' => ['pms_compact_has_prosub_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'problem_id' => 'Problem ID',
            'problem_detail' => 'Problem Detail',
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
