<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_scholarship_year".
 *
 * @property integer $year
 *
 * @property ScbScholarshipTypeHasYear[] $scbScholarshipTypeHasYears
 * @property ScbScholarshipType[] $scholarshipTypes
 */
class ScbScholarshipYear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_scholarship_year';
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
            [['year'], 'required'],
            [['year'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'year' => 'Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbScholarshipTypeHasYears()
    {
        return $this->hasMany(ScbScholarshipTypeHasYear::className(), ['scholarship_year' => 'year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScholarshipTypes()
    {
        return $this->hasMany(ScbScholarshipType::className(), ['scholarship_id' => 'scholarship_type_id'])->viaTable('scb_scholarship_type_has_year', ['scholarship_year' => 'year']);
    }
}
