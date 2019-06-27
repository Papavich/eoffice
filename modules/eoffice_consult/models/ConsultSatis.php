<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_satis".
 *
 * @property int $satis_id
 * @property int $post_id
 *
 * @property ConsultQuestion[] $consultQuestions
 * @property ConsultPost $post
 */
class ConsultSatis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consult_satis';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_consult');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['satis_id', 'post_id'], 'required'],
            [['satis_id', 'post_id'], 'integer'],
            [['satis_id'], 'unique'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultPost::className(), 'targetAttribute' => ['post_id' => 'post_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'satis_id' => 'Satis ID',
            'post_id' => 'Post ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultQuestions()
    {
        return $this->hasMany(ConsultQuestion::className(), ['satis_id' => 'satis_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(ConsultPost::className(), ['post_id' => 'post_id']);
    }
}
