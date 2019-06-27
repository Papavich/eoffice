<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use Yii;

/**
 * This is the model class for table "epro_change_adviser".
 *
 * @property integer $id
 * @property integer $to
 * @property integer $project_id
 * @property string $reason
 * @property integer $from
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 * @property string $status
 *
 * @property User $from0
 * @property User $to0
 * @property Project $project
 */
class ChangeAdviser extends \yii\db\ActiveRecord
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
    const STATUS_PENDING='0';
    const STATUS_SOURCE_ADVISER_APPROVED='1';
    const STATUS_APPROVED='2';
    const STATUS_DISAPPROVED='3';
    public static function tableName()
    {
        return 'epro_change_adviser';
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
            [['to', 'project_id', 'from', ], 'required'],
            [['to', 'project_id', 'from', 'crby', 'udby'], 'integer'],
            [['reason'], 'string'],
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
            'to' => controllers::t( 'label', 'To' ),
            'project_id' => 'Project ID',
            'reason' => controllers::t( 'label', 'Reason' ),
            'from' => 'From',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
            'status' => 'Status',
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
