<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use Yii;

/**
 * This is the model class for table "epro_adviser_broadcast".
 *
 * @property integer $id
 * @property integer $adviser_id
 * @property integer $year_id
 * @property integer $semester_id
 * @property string $detail
 * @property integer $need
 * @property string $topic
 * @property string $contact
 * @property integer $status
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property User $adviser
 * @property BroadcastMajor[] $broadcastMajors
 * @property Major[] $majors
 */
class AdviserBroadcast extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }

    const STATUS_ACTIVE=1;
    const STATUS_NOT_ACTIVE=0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_adviser_broadcast';
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
            [['adviser_id', 'year_id', 'semester_id', 'need', 'topic', 'status', ], 'required'],
            [['adviser_id', 'year_id', 'semester_id', 'need', 'status', 'crby', 'udby'], 'integer'],
            [['detail', 'contact'], 'string'],
            [['crtime', 'udtime'], 'safe'],
            [['topic'], 'string', 'max' => 255],
            [['adviser_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['adviser_id' => 'id']],
             ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'adviser_id' => 'Adviser ID',
            'year_id' => 'Year ID',
            'semester_id' => 'Semester ID',
            'detail' =>controllers::t('label','Detail'),
            'need' => controllers::t('label','Need'),
            'topic' => controllers::t('label','Topic'),
            'contact' => controllers::t('label','Contact'),
            'status' => 'Status',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdviser()
    {
        return $this->hasOne(User::className(), ['id' => 'adviser_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcastMajors()
    {
        return $this->hasMany(BroadcastMajor::className(), ['adviser_broadcast_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMajors()
    {
        return $this->hasMany(Major::className(), ['id' => 'major_id'])->viaTable('epro_broadcast_major', ['adviser_broadcast_id' => 'id']);
    }
    public function getCrbyObj(){
        return User::findOne($this->crby);
    }
}
