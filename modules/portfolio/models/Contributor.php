<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "contributor".
 *
 * @property int $contributor_id
 * @property string $contributor_name
 *
 * @property PublicationOrder[] $publicationOrders
 */
class Contributor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contributor';
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
            [['contributor_id'], 'required'],
            [['contributor_id'], 'integer'],
            [['contributor_name'], 'string', 'max' => 45],
            [['contributor_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'contributor_id' => 'Contributor ID',
            'contributor_name' => 'Contributor Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationOrders()
    {
        return $this->hasMany(PublicationOrder::className(), ['contributor_contributor_id' => 'contributor_id']);
    }
}
