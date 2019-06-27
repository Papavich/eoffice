<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "section".
 *
 * @property int $section_id
 * @property string $section_name
 * @property string $section_type
 * @property int $section_order
 * @property int $req_template_template_id
 *
 * @property ApproveGroup[] $approveGroups
 * @property BoxAttribute[] $boxAttributes
 * @property ReqTemplate $reqTemplateTemplate
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'section';
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
            [['section_order', 'req_template_template_id'], 'integer'],
            [['req_template_template_id'], 'required'],
            [['section_name'], 'string', 'max' => 150],
            [['section_type'], 'string', 'max' => 45],
            [['req_template_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReqTemplate::className(), 'targetAttribute' => ['req_template_template_id' => 'template_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'section_id' => 'Section ID',
            'section_name' => 'Section Name',
            'section_type' => 'Section Type',
            'section_order' => 'Section Order',
            'req_template_template_id' => 'Req Template Template ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproveGroups()
    {
        return $this->hasMany(ApproveGroup::className(), ['section_section_id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoxAttributes()
    {
        return $this->hasMany(BoxAttribute::className(), ['section_section_id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqTemplateTemplate()
    {
        return $this->hasOne(ReqTemplate::className(), ['template_id' => 'req_template_template_id']);
    }
}
