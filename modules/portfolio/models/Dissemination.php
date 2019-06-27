<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "dissemination".
 *
 * @property int $id
 * @property string $name
 *
 * @property PublicationOrder[] $publicationOrders
 */
class Dissemination extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dissemination';
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
            [['id'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationOrders()
    {
        return $this->hasMany(PublicationOrder::className(), ['dissemination_id' => 'id']);
    }
}
