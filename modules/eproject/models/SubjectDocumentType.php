<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_subject_document_type".
 *
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 * @property int $document_type_id
 * @property int $subject_id
 *
 * @property DocumentType $documentType
 * @property Subject $subject
 */
class SubjectDocumentType extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_subject_document_type';
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
            [[ 'document_type_id', 'subject_id'], 'required'],
            [['crby', 'udby', 'document_type_id'], 'integer'],
            [['subject_id'], 'string', 'max' => 10],
            [['crtime', 'udtime'], 'safe'],
            [['document_type_id', 'subject_id'], 'unique', 'targetAttribute' => ['document_type_id', 'subject_id']],
            [['document_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentType::className(), 'targetAttribute' => ['document_type_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
            'document_type_id' => 'Document Type ID',
            'subject_id' => 'Subject ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentType()
    {
        return $this->hasOne(DocumentType::className(), ['id' => 'document_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }
}
