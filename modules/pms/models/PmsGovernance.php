<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_governance".
 *
 * @property int $governance_id
 * @property string $governance_name
 * @property string $governance_status
 */
class PmsGovernance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_governance';
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
            [['governance_name'], 'required'],
            [['governance_name'], 'string', 'max' => 256],
            [['governance_status'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'governance_id' => 'Governance ID',
            'governance_name' => 'Governance Name',
            'governance_status' => 'Governance Status',
        ];
    }
}
