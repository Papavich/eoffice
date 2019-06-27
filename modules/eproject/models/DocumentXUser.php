<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_document_x_user".
 *
 * @property integer $id
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 * @property string $name
 * @property integer $eproject_document_id
 * @property integer $user_id
 *
 * @property ProjectDocument $eprojectDocument
 * @property User $user
 */
class DocumentXUser extends \yii\db\ActiveRecord
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
        return 'epro_document_x_user';
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
            [[ 'eproject_document_id', 'user_id'], 'required'],
            [['crby', 'udby', 'eproject_document_id', 'user_id'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['name'], 'string', 'max' => 45],
            [['eproject_document_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectDocument::className(), 'targetAttribute' => ['eproject_document_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'name' => 'Name',
            'eproject_document_id' => 'Eproject Document ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEprojectDocument()
    {
        return $this->hasOne(ProjectDocument::className(), ['id' => 'eproject_document_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
