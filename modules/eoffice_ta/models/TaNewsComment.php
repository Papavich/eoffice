<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "ta_news_comment".
 *
 * @property integer $ta_news_comment_id
 * @property string $ta_news_comment_text
 * @property string $ta_news_comment_img
 * @property integer $ta_news_id
 * @property string $ta_status
 * @property integer $crby
 * @property string $crtime
 * @property integer $udby
 * @property string $udtime
 *
 * @property TaStatus $taStatus
 * @property TaNews $taNews
 */
class TaNewsComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_news_comment';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_news_id', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['ta_news_comment_text'], 'string', 'max' => 1000],
            [['ta_news_comment_img'], 'string', 'max' => 200],
            [['ta_status'], 'string', 'max' => 15],
            [['ta_status'], 'exist', 'skipOnError' => true, 'targetClass' => TaStatus::className(), 'targetAttribute' => ['ta_status' => 'ta_status_id']],
            [['ta_news_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaNews::className(), 'targetAttribute' => ['ta_news_id' => 'ta_news_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ta_news_comment_id' => 'Ta News Comment ID',
            'ta_news_comment_text' => 'Ta News Comment Text',
            'ta_news_comment_img' => 'Ta News Comment Img',
            'ta_news_id' => 'Ta News ID',
            'ta_status' => 'Ta Status',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaStatus()
    {
        return $this->hasOne(TaStatus::className(), ['ta_status_id' => 'ta_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaNews()
    {
        return $this->hasOne(TaNews::className(), ['ta_news_id' => 'ta_news_id']);
    }
}
