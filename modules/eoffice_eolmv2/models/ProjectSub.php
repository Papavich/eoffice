<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "project_sub".
 *
 * @property integer $ProSub_id
 * @property string $ProSub_name
 * @property string $ProSub_code
 * @property string $ProSub_note
 *
 * @property EolmApprovalform[] $eolmApprovalforms
 */
class ProjectSub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_sub';
    }
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolmv2');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ProSub_id', 'ProSub_note'], 'required'],
            [['ProSub_id'], 'integer'],
            [['ProSub_name'], 'string', 'max' => 100],
            [['ProSub_code'], 'string', 'max' => 17],
            [['ProSub_note'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ProSub_id' => 'Pro Sub ID',
            'ProSub_name' => 'Pro Sub Name',
            'ProSub_code' => 'Pro Sub Code',
            'ProSub_note' => 'Pro Sub Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApprovalforms()
    {
        return $this->hasMany(EolmApprovalform::className(), ['pro_id' => 'ProSub_id']);
    }
}
