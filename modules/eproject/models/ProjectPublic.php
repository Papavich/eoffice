<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_project_public".
 *
 * @property int $id
 * @property int $project_id
 * @property int $public_type_id
 * @property string $title
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property Project $project
 * @property PublicType $publicType
 * @property PublicDocument[] $eproPublicDocuments
 * @property FileType[] $fileTypes
 */
class ProjectPublic extends \yii\db\ActiveRecord
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
        return 'epro_project_public';
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
            [['project_id', 'public_type_id', 'title', ], 'required'],
            [['project_id', 'public_type_id', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['title'], 'string', 'max' => 256],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['public_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PublicType::className(), 'targetAttribute' => ['public_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'public_type_id' => 'Public Type ID',
            'title' => 'Title',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicType()
    {
        return $this->hasOne(PublicType::className(), ['id' => 'public_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicDocuments()
    {
        return $this->hasMany(PublicDocument::className(), ['project_public_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileTypes()
    {
        return $this->hasMany(FileType::className(), ['id' => 'file_type_id'])->viaTable('epro_public_document', ['project_public_id' => 'id']);
    }
}
