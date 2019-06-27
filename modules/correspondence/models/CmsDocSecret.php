<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_doc_secret".
 *
 * @property integer $secret_id
 * @property string $secret_name
 *
 * @property CmsDocument[] $cmsDocuments
 */
class CmsDocSecret extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_doc_secret';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['secret_id','secret_name'], 'required'],
            [['secret_id'], 'integer'],
            [['secret_name'], 'string', 'max' => 45],
        ];
    }
    public static function getDb()
    {
        return Yii::$app->get('db_cms');
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $funcT = '\app\modules\\' . Yii::$app->controller->module->id . '\controllers::t';
        return [
            'secret_id' => 'Secret ID',
            'secret_name' => $funcT('menu', 'Secret Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasMany(CmsDocument::className(), ['secret_id' => 'secret_id']);
    }
}
