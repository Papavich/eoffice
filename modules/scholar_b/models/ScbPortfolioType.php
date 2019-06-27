<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_portfolio_type".
 *
 * @property int $type_id
 * @property string $type_name
 *
 * @property ScbPortfolio[] $scbPortfolios
 */
class ScbPortfolioType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_portfolio_type';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id'], 'required'],
            [['type_id'], 'integer'],
            [['type_name'], 'string', 'max' => 45],
            [['type_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type_id' => 'Type ID',
            'type_name' => 'Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbPortfolios()
    {
        return $this->hasMany(ScbPortfolio::className(), ['port_type_id' => 'type_id']);
    }
}
