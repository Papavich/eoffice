<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_delete_roll".
 *
 * @property string $delete_id
 * @property string $time_start
 * @property string $status
 * @property string $time_end
 * @property integer $amount
 * @property string $doc_id
 * @property integer $roll
 * @property integer $user_id1
 *
 * @property CmsDocument $doc
 * @property User $userId1
 */
class CmsDeleteRoll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_delete_roll';
    }
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
            [['delete_id', 'time_start', 'status', 'time_end', 'amount', 'doc_id', 'user_id'], 'required'],
            [['time_start', 'time_end'], 'safe'],
            [['amount', 'roll', 'user_id'], 'integer'],
            [['delete_id'], 'string', 'max' => 13],
            [['status', 'doc_id'], 'string', 'max' => 45],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsDocument::className(), 'targetAttribute' => ['doc_id' => 'doc_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'delete_id' => 'Delete ID',
            'time_start' => 'Time Start',
            'status' => 'Status',
            'time_end' => 'Time End',
            'amount' => 'Amount',
            'doc_id' => 'Doc ID',
            'roll' => 'Roll',
            'user_id' => 'User Id',
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
    public function getUserId()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
