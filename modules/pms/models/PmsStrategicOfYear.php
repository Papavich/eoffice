<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_strategic_of_year".
 *
 * @property int $id
 * @property int $year
 * @property int $strategic_id
 * @property int $strategic_issues_id
 *
 * @property Strategic $strategic
 */
class PmsStrategicOfYear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_strategic_of_year';
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
            [['year', 'strategic_id', 'strategic_issues_id'], 'integer'],
            [['strategic_id', 'strategic_issues_id'], 'required'],
            [['strategic_id', 'strategic_issues_id'], 'exist', 'skipOnError' => true, 'targetClass' => Strategic::className(), 'targetAttribute' => ['strategic_id' => 'strategic_id', 'strategic_issues_id' => 'strategic_issues_strategic_issues_id']],
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
            'strategic_id' => 'Strategic ID',
            'strategic_issues_id' => 'Strategic Issues ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStrategic()
    {
        return $this->hasOne(Strategic::className(), ['strategic_id' => 'strategic_id', 'strategic_issues_strategic_issues_id' => 'strategic_issues_id']);
    }
}
