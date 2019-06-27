<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_broadcast_major".
 *
 * @property integer $adviser_broadcast_id
 * @property integer $major_id
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property AdviserBroadcast $adviserBroadcast
 * @property Major $major
 */
class BroadcastMajor extends \yii\db\ActiveRecord
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
        return 'epro_broadcast_major';
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
            [['adviser_broadcast_id', 'major_id', ], 'required'],
            [['adviser_broadcast_id', 'major_id', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['adviser_broadcast_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdviserBroadcast::className(), 'targetAttribute' => ['adviser_broadcast_id' => 'id']],
            [['major_id'], 'exist', 'skipOnError' => true, 'targetClass' => Major::className(), 'targetAttribute' => ['major_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'adviser_broadcast_id' => 'Adviser Broadcast ID',
            'major_id' => 'Major ID',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdviserBroadcast()
    {
        return $this->hasOne(AdviserBroadcast::className(), ['id' => 'adviser_broadcast_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMajor()
    {
        return $this->hasOne(Major::className(), ['id' => 'major_id']);
    }
}
