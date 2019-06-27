<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "attribute_type".
 *
 * @property int $attribute_type_id
 * @property string $attribute_type_name
 *
 * @property DesignSectionAttribute[] $designSectionAttributes
 */
class AttributeType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attribute_type';
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
            [['attribute_type_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attribute_type_id' => 'ประเภทฟิลด์',
            'attribute_type_name' => 'ประเภทฟิลด์',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesignSectionAttributes()
    {
        return $this->hasMany(DesignSectionAttribute::className(), ['attribute_type_id' => 'attribute_type_id']);
    }
}
