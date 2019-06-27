<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_doc_check".
 *
 * @property integer $check_id
 * @property string $check_name
 *
 * @property CmsDocument[] $cmsDocuments
 */
class CmsDocCheck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_doc_check';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['check_id'], 'required'],
            [['check_id'], 'integer'],
            [['check_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'check_id' => 'Check ID',
            'check_name' => 'Check Name',
        ];
    }
    public static function getDb()
    {
        return Yii::$app->get('db_cms');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasMany(CmsDocument::className(), ['check_id' => 'check_id']);
    }
}
