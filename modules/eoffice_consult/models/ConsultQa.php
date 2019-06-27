<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_qa".
 *
 * @property int $id
 * @property string $topic
 * @property string $detail
 * @property string $tag
 */
class ConsultQa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'consult_qa';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_consult');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detail', 'tag'], 'string'],
            [['topic'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'topic' => 'Topic',
            'detail' => 'Detail',
            'tag' => 'Tag',
        ];
    }
}
