<?php

namespace app\modules\requestform\models;

use Yii;

/**
 * This is the model class for table "req_template".
 *
 * @property integer $template_id
 * @property string $template_name
 * @property string $template_attribute
 * @property string $template_accept
 * @property integer $template_available
 * @property string $template_layout
 * @property string $crby
 * @property string $crtime
 * @property string $udby
 * @property string $udtime
 * @property integer $req_type_req_type_id
 * @property integer $req_category_category_id
 * @property integer $user_id
 *
 * @property ReqDetail[] $reqDetails
 * @property ReqCategory $reqCategoryCategory
 * @property ReqType $reqTypeReqType
 * @property User $user
 */
class ReqTemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'req_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_attribute', 'template_accept', 'template_layout'], 'string'],
            [['template_available', 'req_type_req_type_id', 'req_category_category_id', 'user_id'], 'integer'],
            [['req_type_req_type_id', 'req_category_category_id', 'user_id'], 'required'],
            [['template_name'], 'string', 'max' => 255],
            [['crby', 'udby'], 'string', 'max' => 45],
            [['crtime', 'udtime'], 'string', 'max' => 100],
            [['req_category_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReqCategory::className(), 'targetAttribute' => ['req_category_category_id' => 'category_id']],
            [['req_type_req_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReqType::className(), 'targetAttribute' => ['req_type_req_type_id' => 'req_type_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'template_id' => 'ชื่อแบบฟอร์มคำร้อง',
            'template_name' => 'ชื่อแบบฟอร์มคำร้อง',
            'template_attribute' => 'Template Attribute',
            'template_accept' => 'Template Accept',
            'template_available' => 'Template Available',
            'template_layout' => 'เทมเพลตคำร้อง',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
            'req_type_req_type_id' => 'ประเภทคำร้อง',
            'req_category_category_id' => 'การดำเนินการคำร้อง',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqDetails()
    {
        return $this->hasMany(ReqDetail::className(), ['req_template_template_id' => 'template_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqCategoryCategory()
    {
        return $this->hasOne(ReqCategory::className(), ['category_id' => 'req_category_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqTypeReqType()
    {
        return $this->hasOne(ReqType::className(), ['req_type_id' => 'req_type_req_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
