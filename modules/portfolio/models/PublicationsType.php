<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "publications_type".
 *
 * @property int $pub_type_id
 * @property string $pub_type_name
 */
class PublicationsType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publications_type';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pub_type_name'], 'required'],
            [['pub_type_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pub_type_id' => 'Pub Type ID',
            'pub_type_name' => 'Pub Type Name',
        ];
    }
}
