<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_satis".
 *
 * @property int $consult_satis_id
 * @property int $consult_post_id
 *
 * @property ConsultQuestion[] $consultQuestions
 * @property ConsultPost $consultPost
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
            [['consult_satis_id', 'consult_post_id'], 'required'],
            [['consult_satis_id', 'consult_post_id'], 'integer'],
            [['consult_satis_id'], 'unique'],
            [['consult_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultPost::className(), 'targetAttribute' => ['consult_post_id' => 'consult_post_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'consult_satis_id' => 'Consult Satis ID',
            'consult_post_id' => 'Consult Post ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultQuestions()
    {
        return $this->hasMany(ConsultQuestion::className(), ['consult_satis_id' => 'consult_satis_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultPost()
    {
        return $this->hasOne(ConsultPost::className(), ['consult_post_id' => 'consult_post_id']);
    }
}
