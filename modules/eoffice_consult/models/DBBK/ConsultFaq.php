<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_faq".
 *
 * @property int $consult_faq_id
 * @property string $consult_faq_ark
 * @property string $consult_faq_ans
 * @property string $consult_faq_crby
 * @property string $consult_faq_crtime
 * @property string $consult_faq_upby
 * @property string $consult_faq_uptime
 * @property string $consult_faq_photo
 * @property string $consult_faq_photos
 *
 * @property ConsultPost[] $consultPosts
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
            [['consult_faq_ans', 'consult_faq_photos'], 'string'],
            [['consult_faq_crtime', 'consult_faq_uptime'], 'safe'],
            [['consult_faq_ark'], 'string', 'max' => 100],
            [['consult_faq_crby', 'consult_faq_upby'], 'string', 'max' => 45],
            [['consult_faq_photo'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'png,jpg'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'consult_faq_id' => 'Consult Faq ID',
            'consult_faq_ark' => 'Consult Faq Ark',
            'consult_faq_ans' => 'Consult Faq Ans',
            'consult_faq_crby' => 'Consult Faq Crby',
            'consult_faq_crtime' => 'Consult Faq Crtime',
            'consult_faq_upby' => 'Consult Faq Upby',
            'consult_faq_uptime' => 'Consult Faq Uptime',
            'consult_faq_photo' => 'Consult Faq Photo',
            'consult_faq_photos' => 'Consult Faq Photos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultPosts()
    {
        return $this->hasMany(ConsultPost::className(), ['consult_faq_id' => 'consult_faq_id']);
    }
}
