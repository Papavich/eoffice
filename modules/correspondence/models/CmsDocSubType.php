<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_doc_sub_type".
 *
 * @property integer $sub_type_id
 * @property string $sub_type_name
 *
 * @property CmsDocument[] $cmsDocuments
 */
class CmsDocSubType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_doc_sub_type';
    }
    public static function getDb()
    {
        return Yii::$app->get('db_cms');
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sub_type_id','sub_type_name'], 'required'],
            [['sub_type_id'], 'integer'],
            [['sub_type_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $funcT = '\app\modules\\' . Yii::$app->controller->module->id . '\controllers::t';
        return [
            'sub_type_id' => $funcT('menu', 'Sub Type ID'),
            'sub_type_name' => $funcT('menu', 'Sub Type Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasMany(CmsDocument::className(), ['sub_type_id' => 'sub_type_id']);
    }
}
