<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_log".
 *
 * @property int $log_id
 * @property string $crtime
 * @property string $udtime
 * @property string $doc_id
 * @property int $crby_user_id
 * @property int $udby_user_id
 *
 * @property CmsDocument $doc
 * @property User $crbyUser
 * @property User $udbyUser
 */
class CmsLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_log';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_cms');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['log_id', 'doc_id', 'crby_user_id', 'udby_user_id'], 'required'],
            [['log_id', 'crby_user_id', 'udby_user_id'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['doc_id'], 'string', 'max' => 45],
            [['log_id', 'crby_user_id', 'udby_user_id'], 'unique', 'targetAttribute' => ['log_id', 'crby_user_id', 'udby_user_id']],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsDocument::className(), 'targetAttribute' => ['doc_id' => 'doc_id']],
            [['crby_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['crby_user_id' => 'id']],
            [['udby_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['udby_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'log_id' => Yii::t('app\modules\correspondence\messages\th', 'Log ID'),
            'crtime' => Yii::t('app\modules\correspondence\messages\th', 'Crtime'),
            'udtime' => Yii::t('app\modules\correspondence\messages\th', 'Udtime'),
            'doc_id' => Yii::t('app\modules\correspondence\messages\th', 'Doc ID'),
            'crby_user_id' => Yii::t('app\modules\correspondence\messages\th', 'Crby User ID'),
            'udby_user_id' => Yii::t('app\modules\correspondence\messages\th', 'Udby User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasOne(CmsDocument::className(), ['doc_id' => 'doc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrbyUser()
    {
        return $this->hasOne(User::className(), ['id' => 'crby_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUdbyUser()
    {
        return $this->hasOne(User::className(), ['id' => 'udby_user_id']);
    }
}
