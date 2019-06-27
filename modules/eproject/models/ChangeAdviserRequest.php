<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use Yii;

/**
 * This is the model class for table "epro_change_adviser_request".
 *
 * @property int $id
 * @property int $to
 * @property int $from
 * @property int $project_id
 * @property string $reason
 * @property string $status
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $comment
 * @property string $udtime
 *
 * @property User $from0
 * @property User $to0
 * @property Project $project
 */
class ChangeAdviserRequest extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    const STATUS_PENDING='0';
    const STATUS_SOURCE_ADVISER_APPROVED='1';
    const STATUS_APPROVED='2';
    const STATUS_DISAPPROVED='3';
    const STATUS_CANCELED='4';
    const STATUS_WAITING_SOURCE='5';
    const STATUS_WAITING_DESTINATION='6';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_change_adviser_request';
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
            [['to', 'from', 'project_id', 'status', ], 'required'],
            [['to', 'from', 'project_id', 'crby', 'udby'], 'integer'],
            [['reason'], 'string'],
            [['comment'], 'string', 'max' => 512],
            [['crtime', 'udtime'], 'safe'],
            [['status'], 'string', 'max' => 1],
            [['from'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['from' => 'id']],
            [['to'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['to' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'to' => controllers::t('label','To'),
            'from' => 'From',
            'project_id' => 'Project ID',
            'reason' =>  controllers::t('label','Reason'),
            'status' => 'Status',
            'comment' => 'Comment',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrom0()
    {
        return $this->hasOne(User::className(), ['id' => 'from']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTo0()
    {
        return $this->hasOne(User::className(), ['id' => 'to']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
