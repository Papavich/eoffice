<?php

namespace app\modules\requestform\models;

use Yii;

/**
 * This is the model class for table "req_category".
 *
 * @property integer $category_id
 * @property string $category_name
 *
 * @property ReqTemplate[] $reqTemplates
 */
class ReqCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'req_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name'], 'required'],
            [['category_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqTemplates()
    {
        return $this->hasMany(ReqTemplate::className(), ['req_category_category_id' => 'category_id']);
    }
}
