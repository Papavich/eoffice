<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_group_section".
 *
 * @property string $group_no
 * @property string $section_no
 * @property string $subject_id
 * @property int $subject_version
 * @property int $subopen_semester
 * @property int $subopen_year
 *
 * @property Kku30Group $groupNo
 * @property Kku30Section $sectionNo
 */
class Kku30GroupSection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kku30_group_section';
    }

    /**
     * {@inheritdoc}
     */

    public static function getDb()
    {
        return Yii::$app->get('db_kku30');
    }

    public function rules()
    {
        return [
            [['group_no', 'section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year'], 'required'],
            [['subject_version', 'subopen_semester', 'subopen_year'], 'integer'],
            [['group_no'], 'string', 'max' => 25],
            [['section_no', 'subject_id'], 'string', 'max' => 10],
            [['group_no', 'section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year'], 'unique', 'targetAttribute' => ['group_no', 'section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year']],
            [['group_no'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Group::className(), 'targetAttribute' => ['group_no' => 'group_no']],
            [['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Section::className(), 'targetAttribute' => ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'group_no' => 'Group No',
            'section_no' => 'Section No',
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
            'subopen_semester' => 'Subopen Semester',
            'subopen_year' => 'Subopen Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupNo()
    {
        return $this->hasOne(Kku30Group::className(), ['group_no' => 'group_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionNo()
    {
        return $this->hasOne(Kku30Section::className(), ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year']);
    }
}
