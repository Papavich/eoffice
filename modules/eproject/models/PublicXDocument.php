<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_public_x_document".
 *
 * @property integer $id
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 * @property integer $public_type_id
 * @property string $title
 * @property integer $project_id
 *
 * @property ProjectDocument[] $projectDocument
 * @property PublicType $publicType
 * @property Project $project
 */
class PublicXDocument extends \yii\db\ActiveRecord
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
        return 'epro_public_x_document';
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
            [[ 'public_type_id' ,'project_id'], 'required'],
            [['crby', 'udby', 'public_type_id', 'project_id'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['title'], 'string', 'max' => 255],
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
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
            'public_type_id' => 'Public Type ID',
            'project_id' => 'Project ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectDocument()
    {
        return $this->hasMany(ProjectDocument::className(), ['public_document_id' => 'id']);
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
    public function beforeDelete()
    {
        foreach($this->projectDocument as $item){
            $item->delete();
        }
        return parent::beforeDelete();
    }
}
