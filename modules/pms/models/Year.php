<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "year".
 *
 * @property int $year_id
 *
 * @property PmsGovernanceOfYear[] $pmsGovernanceOfYears
 * @property Governance[] $governances
 * @property PmsProject[] $pmsProjects
 * @property PmsStrategicOfYear[] $pmsStrategicOfYears
 * @property Strategic[] $strategics
 */
class Year extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'year';
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
            [['year_id'], 'required'],
            [['year_id'], 'integer'],
            [['year_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'year_id' => 'Year ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsGovernanceOfYears()
    {
        return $this->hasMany(PmsGovernanceOfYear::className(), ['year_id' => 'year_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovernances()
    {
        return $this->hasMany(Governance::className(), ['governance_id' => 'governance_id'])->viaTable('pms_governance_of_year', ['year_id' => 'year_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsProjects()
    {
        return $this->hasMany(PmsProject::className(), ['project_year' => 'year_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsStrategicOfYears()
    {
        return $this->hasMany(PmsStrategicOfYear::className(), ['year_id' => 'year_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStrategics()
    {
        return $this->hasMany(Strategic::className(), ['strategic_id' => 'strategic_id', 'strategic_issues_strategic_issues_id' => 'strategic_issues_id'])->viaTable('pms_strategic_of_year', ['year_id' => 'year_id']);
    }
}
