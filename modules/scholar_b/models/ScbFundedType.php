<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_funded_type".
 *
 * @property int $funded_type_id
 * @property string $funded_type_name
 *
 * @property ScbFunded[] $scbFundeds
 */
class ScbFundedType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_funded_type';
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
            [['funded_type_id'], 'required'],
            [['funded_type_id'], 'integer'],
            [['funded_type_name'], 'string', 'max' => 45],
            [['funded_type_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'funded_type_id' => 'Funded Type ID',
            'funded_type_name' => 'Funded Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbFundeds()
    {
        return $this->hasMany(ScbFunded::className(), ['funded_type_id' => 'funded_type_id']);
    }
}
