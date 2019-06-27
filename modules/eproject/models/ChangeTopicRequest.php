<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use Yii;

/**
 * This is the model class for table "epro_change_topic_request".
 *
 * @property int $id ไม่ได้ มีหลาย request
 * @property string $pro_name_th
 * @property string $pro_name_en
 * @property string $pro_name_th_old
 * @property string $pro_name_en_old
 * @property string $reason
 * @property int $status
 * @property int $project_id
 * @property string $comment
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property Project $project
 */
class ChangeTopicRequest extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    const STATUS_PENDING=0;
    const STATUS_APPROVED=1;
    const STATUS_DISAPPROVED=2;
    const STATUS_CANCELED=3;
    const STATUS_WAITING=4;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_change_topic_request';
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
            [['pro_name_th', 'pro_name_en', 'pro_name_th_old', 'pro_name_en_old','status', 'project_id', ], 'required'],
            [['reason', 'comment'], 'string'],
            [['status', 'project_id', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['pro_name_th', 'pro_name_en','pro_name_th_old', 'pro_name_en_old'], 'string', 'max' => 255],
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
            'pro_name_th' => controllers::t( 'label', 'New Project Name (Thai)' ),
            'pro_name_en' => controllers::t( 'label', 'New Project Name (English)' ),
            'pro_name_th_old' => controllers::t( 'label', 'Old Project Name (Thai)' ),
            'pro_name_en_old' => controllers::t( 'label', 'Old Project Name (English)' ),
            'reason' => controllers::t( 'label', 'Reason' ),
            'status' => 'Status',
            'project_id' => 'Project ID',
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
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
