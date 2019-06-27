<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_governance_of_year".
 *
 * @property int $id
 * @property int $year
 * @property int $governance_id
 *
 * @property Governance $governance
 */
class PmsGovernanceOfYear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_governance_of_year';
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
            [['year', 'governance_id'], 'integer'],
            [['governance_id'], 'required'],
            [['governance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Governance::className(), 'targetAttribute' => ['governance_id' => 'governance_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'Year',
            'governance_id' => 'Governance ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovernance()
    {
        return $this->hasOne(Governance::className(), ['governance_id' => 'governance_id']);
    }
}
