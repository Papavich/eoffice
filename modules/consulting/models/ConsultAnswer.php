<?php

namespace app\modules\consulting\models;

use Yii;

/**
 * This is the model class for table "consult_answer".
 *
 * @property int $consult_answer_id
 * @property string $consult_answer_text
 * @property int $consult_post_id
 *
 * @property ConsultPost $consultPost
 */
class ConsultAnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consult_answer';
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
            [['consult_answer_id', 'consult_answer_text', 'consult_post_id'], 'required'],
            [['consult_answer_id', 'consult_post_id'], 'integer'],
            [['consult_answer_text'], 'string', 'max' => 100],
            [['consult_answer_id'], 'unique'],
            [['consult_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultPost::className(), 'targetAttribute' => ['consult_post_id' => 'consult_post_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'consult_answer_id' => 'Consult Answer ID',
            'consult_answer_text' => 'Consult Answer Text',
            'consult_post_id' => 'Consult Post ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultPost()
    {
        return $this->hasOne(ConsultPost::className(), ['consult_post_id' => 'consult_post_id']);
    }
}
