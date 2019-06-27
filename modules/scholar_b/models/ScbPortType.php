<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_port_type".
 *
 * @property integer $port_type_id
 * @property string $port_type_name
 *
 * @property ScbCandPortfolio[] $scbCandPortfolios
 */
class ScbPortType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_port_type';
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
            [['port_type_id'], 'required'],
            [['port_type_id'], 'integer'],
            [['port_type_name'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'port_type_id' => 'Port Type ID',
            'port_type_name' => 'Port Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbCandPortfolios()
    {
        return $this->hasMany(ScbCandPortfolio::className(), ['port_type_id' => 'port_type_id']);
    }
}
