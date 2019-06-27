<?php

namespace app\modules\eproject\models;

use Yii;

/**
 * This is the model class for table "eoffice_kku30.view_kku30_subject".
 *
 * @property string $id
 * @property string $name_th
 * @property string $name_en
 * @property int $major_id
 */
class SubjectView extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_kku30.view_kku30_subject';
    }
    public static function primaryKey()
    {
        return ['id'];
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eproject');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name_th', 'name_en', 'major_id'], 'required'],
            [['major_id'], 'integer'],
            [['id'], 'string', 'max' => 10],
            [['name_th', 'name_en'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_th' => 'Name Th',
            'name_en' => 'Name En',
            'major_id' => 'Major ID',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectDocumentTypes()
    {
        return $this->hasMany(SubjectDocumentType::className(), ['subject_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentTypes()
    {
        return $this->hasMany(DocumentType::className(), ['id' => 'document_type_id'])->viaTable('epro_subject_document_type', ['subject_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpenSubjects()
    {
        return $this->hasMany(OpenSubject::className(), ['subject_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYears()
    {
        return $this->hasMany(YearSemester::className(), ['year_id' => 'year_id', 'semester_id' => 'semester_id'])->viaTable('view_kku30_open_subject', ['subject_id' => 'id']);
    }

    public function getName(){
        if (Yii::$app->language == "en") {

                return $this->id.':'.$this->name_en;

        } else {
                return $this->id.':'.$this->name_th;
        }
    }

}
