<?php

namespace app\modules\consulting\models;

use Yii;

/**
 * This is the model class for table "consult_faq".
 *
 * @property int $faq_id
 * @property string $faq_ark
 * @property string $faq_ans
 * @property string $faq_crby
 * @property string $faq_crtime
 * @property string $faq_upby
 * @property string $faq_uptime
 * @property int $user_id
 *
 * @property ViewPisUser $user
 */
class ConsultFaq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consult_faq';
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
            [['faq_ans'], 'string'],
            [['faq_crtime', 'faq_uptime'], 'safe'],
            [['user_id'], 'integer'],
            [['faq_ark'], 'string', 'max' => 100],
            [['faq_crby', 'faq_upby'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => ViewPisUser::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'faq_id' => 'ID',
            'faq_ark' => 'คำถาม',
            'faq_ans' => 'คำตอบ',
            'faq_crby' => 'สร้างโดย',
            'faq_crtime' => 'วันที่สร้าง',
            'faq_upby' => 'อัพเดตโดย',
            'faq_uptime' => 'อัพเดตวันที่',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(ViewPisUser::className(), ['user_id' => 'user_id']);
    }
}
