<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "pis_enroll".
 *
 * @property string $section_no
 * @property string $subject_id
 * @property int $subject_version
 * @property string $term_id
 * @property string $year_id
 * @property string $user_id
 *
 * @property Kku30Section $sectionNo
 */
class ViewPisEnroll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pis_enroll';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['section_no', 'subject_id', 'subject_version', 'term_id', 'year_id', 'user_id'], 'required'],
            [['subject_version'], 'integer'],
            [['section_no', 'subject_id', 'term_id', 'year_id'], 'string', 'max' => 10],
            [['user_id'], 'string', 'max' => 20],
            [['section_no', 'subject_id', 'subject_version', 'term_id', 'year_id', 'user_id'], 'unique', 'targetAttribute' => ['section_no', 'subject_id', 'subject_version', 'term_id', 'year_id', 'user_id']],
            [['section_no', 'subject_id', 'subject_version', 'term_id', 'year_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'term_id' => 'term_id', 'year_id' => 'year_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'section_no' => 'Section No',
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
            'term_id' => 'Term ID',
            'year_id' => 'Year ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionNo()
    {
        return $this->hasOne(Section::className(), ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'term_id' => 'term_id', 'year_id' => 'year_id']);
    }
}
