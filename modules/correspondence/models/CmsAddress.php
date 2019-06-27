<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_address".
 *
 * @property string $address_id
 * @property string $address_name
 * @property string $address_year
 * @property integer $sub_type_id
 *
 * @property CmsDocSubType $subType
 * @property CmsDocument[] $cmsDocuments
 */
class CmsAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_address';
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
            [['address_id', 'sub_type_id','address_year','address_name'], 'required'],
            [['address_id'], 'unique'],
            [['address_year'], 'string', 'max' => 4],
            [['sub_type_id'], 'integer'],
            [['address_id'], 'string', 'max' => 11],
            [['address_name'], 'string', 'max' => 200],
            [['sub_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsDocSubType::className(), 'targetAttribute' => ['sub_type_id' => 'sub_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {

        $funcT = '\app\modules\\' . Yii::$app->controller->module->id . '\controllers::t';
        return [
            'address_id' => $funcT('menu', 'Address ID'),
            'address_name' => $funcT('menu','Address Name'),
            'address_year' => $funcT('menu','Address Year'),
            'sub_type_id' =>$funcT('menu', 'Sub Type ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubType()
    {
        return $this->hasOne(CmsDocSubType::className(), ['sub_type_id' => 'sub_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsDocuments()
    {
        return $this->hasMany(CmsDocument::className(), ['address_id' => 'address_id']);
    }
}