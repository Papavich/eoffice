<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "author_level".
 *
 * @property int $auth_level_id
 * @property string $auth_level_name
 *
 * @property PublicationOrder[] $publicationOrders
 */
class AuthorLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author_level';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auth_level_name'], 'required'],
            [['auth_level_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auth_level_id' => 'รหัสลำดับผู้เขียน',
            'auth_level_name' => 'ชื่อลำดับผู้เขียน',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationOrders()
    {
        return $this->hasMany(PublicationOrder::className(), ['author_level_auth_level_id' => 'auth_level_id']);
    }
}
