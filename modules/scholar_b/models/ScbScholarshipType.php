<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\controllers;
use app\modules\scholar_b\components\ModelHelper;
/**
 * This is the model class for table "scb_scholarship_type".
 *
 * @property string $scholarship_id
 * @property string $scholarship_name
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbScholarshipTypeHasYear[] $scbScholarshipTypeHasYears
 * @property ScbScholarshipYear[] $scholarshipYears
 */
class ScbScholarshipType extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_scholarship_type';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scholarship_id'], 'required'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['scholarship_id'], 'string', 'max' => 5],
            [['scholarship_name'], 'string', 'max' => 100],
            [['scholarship_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'scholarship_id' => controllers::t( 'label', 'Scholarship Name' ),
            'scholarship_name' => controllers::t( 'label', 'Scholarship Name' ),
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbScholarshipTypeHasYears()
    {
        return $this->hasMany(ScbScholarshipTypeHasYear::className(), ['scholarship_id' => 'scholarship_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScholarshipYears()
    {
        return $this->hasMany(ScbScholarshipYear::className(), ['year' => 'scholarship_year'])->viaTable('scb_scholarship_type_has_year', ['scholarship_id' => 'scholarship_id']);
    }
}
