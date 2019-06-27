<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "governance".
 *
 * @property int $governance_id
 * @property string $governance_name
 *
 * @property PmsGovernanceOfYear[] $pmsGovernanceOfYears
 */
class Governance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'governance';
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
            [['governance_name'], 'string', 'max' => 100],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsGovernanceOfYears()
    {
        return $this->hasMany(PmsGovernanceOfYear::className(), ['governance_id' => 'governance_id']);
    }
}
