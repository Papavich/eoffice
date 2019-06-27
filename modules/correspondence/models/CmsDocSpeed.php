<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_doc_speed".
 *
 * @property integer $speed_id
 * @property string $speed_name
 *
 * @property CmsDocument[] $cmsDocuments
 */
class CmsDocSpeed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_doc_speed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['speed_id','speed_name'], 'required'],
            [['speed_id'], 'integer'],
            [['speed_name'], 'string', 'max' => 45],
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
            'speed_id' => 'Speed ID',
            'speed_name' => $funcT('menu', 'Speed Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasMany(CmsDocument::className(), ['speed_id' => 'speed_id']);
    }
}
