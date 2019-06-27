<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "attribute_function".
 *
 * @property int $attribute_function_id
 * @property string $attribute_function_name
 *
 * @property DesignSectionAttribute[] $designSectionAttributes
 */
class AttributeFunction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attribute_function';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_form');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_function_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attribute_function_id' => 'ฟังก์ชันฟิลด์',
            'attribute_function_name' => 'ฟังก์ชันฟิลด์',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesignSectionAttributes()
    {
        return $this->hasMany(DesignSectionAttribute::className(), ['attribute_function_id' => 'attribute_function_id']);
    }
}
